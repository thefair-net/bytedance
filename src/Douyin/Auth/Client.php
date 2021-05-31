<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Douyin\Auth;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Surpaimb\ByteDance\Douyin\BaseClient;
use Surpaimb\ByteDance\Kernel\Traits\HasHttpRequests;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Stream;
use Overtrue\Socialite\Exceptions\AuthorizeFailedException;
use Surpaimb\ByteDance\Kernel\Contracts\AccessTokenInterface;
use Surpaimb\ByteDance\Kernel\ServiceContainer;

/**
 * Class AuthorizerAccessToken.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Client extends BaseClient
{


    /**
     * @var string
     */
    protected $baseUrl = 'https://open.douyin.com/';
    protected array $scopes = [];
    protected string $scopeSeparator = ',';
    protected ?string $state = null;
    protected array $parameters = [];
    protected int $encodingType = PHP_QUERY_RFC1738;
    protected string $openId;
    protected string $openidKey = 'open_id';
    protected string $expiresInKey = 'expires_in';
    protected string $accessTokenKey = 'access_token';
    protected string $refreshTokenKey = 'refresh_token';

    /**
     * 生成client_token
     * 该接口用于获取接口调用的凭证client_access_token，主要用于调用不需要用户授权就可以调用的接口；该接口适用于抖音/头条授权。
     */
    public function clientToken()
    {
        $params = [
            'client_key' => $this->app['config']['client_key'],
            'client_secret' => $this->app['config']['client_secret'],
            'grant_type' => 'client_credential'
        ];
        $rs = $this->httpGet('oauth/client_token/', $params);
        if($rs && $rs['message'] == 'success'){
            return $rs['data']['access_token'];
        }
        return null;
    }
    /**
     * 
     * 获取access_token
     * 该接口用于获取用户授权第三方接口调用的凭证access_token；该接口适用于抖音/头条授权。
     * 
     * 注意：
     * 
     * 抖音的OAuth API以https://open.douyin.com/开头。
     * 头条的OAuth API以https://open.snssdk.com/开头。
     * 西瓜的OAuth API以https://open-api.ixigua.com/开头。
     * access_token 为用户授权第三方接口调用的凭证，存储在客户端，可能会被窃取，泄漏后可能会发生用户隐私数据泄漏的风险，建议存储在服务端。
     * @param  string  $code
     *
     * @return array
     * @throws \Overtrue\Socialite\Exceptions\AuthorizeFailedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function tokenFromCode($code): array
    {
        $response = $this->getHttpClient()->request(
            'get',
            $this->getTokenUrl(),
            [
                'query' => $this->getTokenFields($code),
            ]
        );

        // dd($response->getBody()->getContents());
        $response = \json_decode($response->getBody()->getContents(), true) ?? [];

        if (empty($response['data'])) {
            logger('token from code error', [$response]);
            throw new AuthorizeFailedException('Invalid token response', $response);
        }

        // $this->withOpenId($response['data']['open_id']);

        return $this->normalizeAccessTokenResponse($response['data']);
    }


    protected function getAuthUrl(): string
    {
        // return $this->buildAuthUrlFromBase($this->baseUrl . '/platform/oauth/connect/');
        return $this->baseUrl . 'platform/oauth/connect/';
    }

    protected function getTokenUrl(): string
    {
        return $this->baseUrl . 'oauth/access_token/';
    }


    protected function getClientTokenUrl(): string
    {
        return $this->baseUrl . 'oauth/client_token';
    }

    /**
     * @param string $url
     *
     * @return string
     */
    protected function buildAuthUrlFromBase(string $url): string
    {
        $query = $this->getCodeFields() + ($this->state ? ['state' => $this->state] : []);

        return $url . '?' . \http_build_query($query, '', '&', $this->encodingType);
    }

    protected function getCodeFields(): array
    {
        $fields = array_merge(
            [
                'client_id' => $this->app['config']['client_key'],
                'redirect_uri' => $this->app['config']['redirect_url'] . '?appid=' . $this->app['config']['client_key'],
                'scope' => $this->formatScopes($this->scopes, $this->scopeSeparator),
                'response_type' => 'code',
            ],
            $this->parameters
        );

        if ($this->state) {
            $fields['state'] = $this->state;
        }
        return $fields;
    }

    /**
     * @param array  $scopes
     * @param string $scopeSeparator
     *
     * @return string
     */
    protected function formatScopes(array $scopes, $scopeSeparator): string
    {
        return implode($scopeSeparator, $scopes);
    }

    /**
     * @param array|string $response
     *
     * @return mixed
     * @return array
     * @throws \Overtrue\Socialite\Exceptions\AuthorizeFailedException
     *
     */
    protected function normalizeAccessTokenResponse($response): array
    {
        if ($response instanceof Stream) {
            $response->rewind();
            $response = $response->getContents();
        }

        if (\is_string($response)) {
            $response = json_decode($response, true) ?? [];
        }

        if (!\is_array($response)) {
            throw new AuthorizeFailedException('Invalid token response', [$response]);
        }

        if (empty($response[$this->accessTokenKey])) {
            throw new AuthorizeFailedException('Authorize Failed: ' . json_encode($response, JSON_UNESCAPED_UNICODE), $response);
        }

        return $response + [
            'openid' => $response[$this->openidKey],
            'access_token' => $response[$this->accessTokenKey],
            'refresh_token' => $response[$this->refreshTokenKey] ?? null,
            'expires_in' => \intval($response[$this->expiresInKey] ?? 0),
        ];
    }

    /**
     * @param string $code
     *
     * @return array
     */
    protected function getTokenFields($code): array
    {
        logger('get token field', [$this->app['config']]);
        return [
            'client_key' => $this->app['config']['client_key'],
            'client_secret' => $this->app['config']['client_secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',
        ];
    }


    public function withOpenId(string $openId): self
    {
        $this->openId = $openId;

        return $this;
    }
}
