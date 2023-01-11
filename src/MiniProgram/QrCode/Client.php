<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram\QrCode;

use TheFairLib\ByteDance\Kernel\BaseClient;
use TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException;
use ReflectionClass;

/**
 * Class Client.
 *
 * @author hugo <rabbitzhang52@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * {@inheritdoc}.
     */
    protected $message = [
        'appname' => 'douyin',
        'path' => '',
        'width' => '',
        'line_color' => '',
        'background' => '',
        'set_icon' => false,
    ];

    /**
     * {@inheritdoc}.
     */
    protected $required = [];

    /**
     * Send a template message.
     *
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface|\TheFairLib\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function create(array $data = [])
    {
        $params = $this->formatMessage($data);

        $this->restoreMessage();

        $params = $this->withAccessToken($params);
        return $this->httpPostJson('api/apps/qrcode', $params);
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatMessage(array $data = [])
    {
        $params = array_merge($this->message, $data);

        foreach ($params as $key => $value) {
            if (in_array($key, $this->required, true) && empty($value) && empty($this->message[$key])) {
                throw new InvalidArgumentException(sprintf('Attribute "%s" can not be empty!', $key));
            }
            if(empty($value) && empty($this->message[$key]))
            {
                unset($params[$key]);
                continue;
            }
            $params[$key] = empty($value) ? $this->message[$key] : $value;
        }

        return $params;
    }

    /**
     * Restore message.
     */
    protected function restoreMessage()
    {
        $this->message = (new ReflectionClass(static::class))->getDefaultProperties()['message'];
    }

    /**
     * Combine templates and add them to your personal template library under your account.
     *
     * @param string      $tid
     * @param array       $kidList
     * @param string|null $sceneDesc
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function addTemplate(string $tid, array $kidList, string $sceneDesc = null)
    {
        $sceneDesc = $sceneDesc ?? '';
        $data = \compact('tid', 'kidList', 'sceneDesc');

        return $this->httpPost('wxaapi/newtmpl/addtemplate', $data);
    }

    /**
     * Delete personal template under account.
     *
     * @param string $id
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function deleteTemplate(string $id)
    {
        return $this->httpPost('wxaapi/newtmpl/deltemplate', ['priTmplId' => $id]);
    }

    /**
     * Get keyword list under template title.
     *
     * @param string $tid
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTemplateKeywords(string $tid)
    {
        return $this->httpGet('wxaapi/newtmpl/getpubtemplatekeywords', compact('tid'));
    }

    /**
     * Get the title of the public template under the category to which the account belongs.
     *
     * @param array $ids
     * @param int   $start
     * @param int   $limit
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTemplateTitles(array $ids, int $start = 0, int $limit = 30)
    {
        $ids = \implode(',', $ids);
        $query = \compact('ids', 'start', 'limit');

        return $this->httpGet('wxaapi/newtmpl/getpubtemplatetitles', $query);
    }

    /**
     * Get list of personal templates under the current account.
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getTemplates()
    {
        return $this->httpGet('wxaapi/newtmpl/gettemplate');
    }

    /**
     * Get the category of the applet account.
     *
     * @return array|\TheFairLib\ByteDance\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCategory()
    {
        return $this->httpGet('wxaapi/newtmpl/getcategory');
    }
}
