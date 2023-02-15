<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Douyin\Auth;

use Illuminate\Auth\Access\AuthorizationException;
use TheFairLib\ByteDance\Douyin\BaseClient;
use GuzzleHttp\Psr7\Stream;
use Overtrue\Socialite\AuthorizeFailedException;
use TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException;
use TheFairLib\ByteDance\Kernel\Traits\InteractsWithCache;

/**
 * Class AuthorizerAccessToken.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class Client extends BaseClient
{
    use InteractsWithCache;
    /**
     * @var string
     */
    protected $baseUrl = 'https://open.douyin.com/';
    protected  $scopes = [];
    protected  $scopeSeparator = ',';
    protected  $state = null;
    protected  $parameters = [];
    protected  $encodingType = PHP_QUERY_RFC1738;
    protected  $openidKey = 'open_id';
    protected  $expiresInKey = 'expires_in';
    protected  $refreshExpiresInKey = "refresh_expires_in";
    protected  $accessTokenKey = 'access_token';
    protected  $refreshTokenKey = 'refresh_token';
    protected $accessTokenCacheKeyPrefix = "douyin.auth.access_token.%s";

    public function getAccessTokenCacheKey(string $openId):string{
        return sprintf($this->accessTokenCacheKeyPrefix,$openId);
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
     * @param string $code
     *
     * @return array
     * @throws AuthorizeFailedException
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     */
    public function getAccessTokenByCode(string $code): array
    {
        $response = $this->getHttpClient()->request(
            'get',
            $this->getTokenUrl(),
            [
                'query' => $this->getTokenFields($code),
            ]
        );

        $response = \json_decode($response->getBody()->getContents(), true) ?? [];
        if (empty($response['data'])) {
            throw new AuthorizeFailedException('Invalid token response', $response);
        }
        if (empty($response["data"]["open_id"])){
            throw new AuthorizeFailedException('Invalid token response', $response);
        }
        $return = $this->normalizeAccessTokenResponse($response['data']);
        $this->setAccessTokenCache($return["openid"], $return);
        return $return;
    }


    /**
     * @throws InvalidArgumentException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getAccessToken(string $openId):array{
        $accessToken = $this->getCache()->get($this->getAccessTokenCacheKey($openId));
        return $accessToken?json_decode($accessToken,true):[];
    }

    /**
     * @throws AuthorizeFailedException
     */
    public function refreshAccessToken(string $openId):array {
        $accessToken = $this->getAccessToken($openId);
        if (!$accessToken){
            throw new  AuthorizeFailedException("access token empty",["open_id"=>$openId]);
        }
        $response = $this->getHttpClient()->request(
            'post',
            $this->getRefreshTokenUrl(),
            [
                'client_key' => $this->app['config']['client_key'],
                'grant_type'=>"refresh_token",
                "refresh_token"=>$accessToken[$this->refreshTokenKey]
            ]
        );
        $response = \json_decode($response->getBody()->getContents(), true) ?? [];
        $return = $this->normalizeAccessTokenResponse($response);
        $this->setAccessTokenCache($return["openid"], $return);
        return $return;
    }
    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws InvalidArgumentException
     */
    public function setAccessTokenCache(string $openId, array $data):bool{
        $cache = $this->getCache();
        return $cache->set($this->getAccessTokenCacheKey($openId),\json_encode($data),$data["expires_in"]??86400);
    }
    protected function getAuthUrl(): string
    {
        return $this->baseUrl . 'platform/oauth/connect/';
    }
    protected function getRefreshTokenUrl():string{
        return $this->baseUrl. 'oauth/refresh_token/';
    }
    protected function getTokenUrl(): string
    {
        return $this->baseUrl . 'oauth/access_token/';
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
     * @throws AuthorizeFailedException
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
                "open_id"=>$response[$this->openidKey],
                'access_token' => $response[$this->accessTokenKey],
                'refresh_token' => $response[$this->refreshTokenKey] ?? null,
                'expires_in' => \intval($response[$this->expiresInKey] ?? 0),
                'refresh_expires_in' => \intval($response[$this->refreshExpiresInKey] ?? 0),
            ];
    }

    /**
     * @param string $code
     *
     * @return array
     */
    protected function getTokenFields(string $code): array
    {
        return [
            'client_key' => $this->app['config']['client_key'],
            'client_secret' => $this->app['config']['client_secret'],
            'code' => $code,
            'grant_type' => 'authorization_code',
        ];
    }
}
