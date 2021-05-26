<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\MiniProgram\Content;

use Surpaimb\ByteDance\Kernel\BaseClient;
use Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException;
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
        'tasks' => '',
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
     * @return \Psr\Http\Message\ResponseInterface|\Surpaimb\ByteDance\Kernel\Support\Collection|array|object|string
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function check(array $data = [])
    {
        $params = $this->formatMessage($data);

        $this->restoreMessage();

        // $params = $this->withCommonParams($params);
        
        return $this->httpPostWithToken('api/v2/tags/text/antidirt', $params);
    }

    /**
     * @param array $data
     *
     * @return array
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    protected function formatMessage(array $data = [])
    {
        $params =[];
        foreach ($data as $value) {
           
            $value = [
                'content' => strval($value),
            ];
            $params['tasks'][] = $value;
        }


        foreach ($params as $key => $value) {
            if (in_array($key, $this->required, true) && empty($value) && empty($this->message[$key])) {
                throw new InvalidArgumentException(sprintf('Attribute "%s" can not be empty!', $key));
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

}
