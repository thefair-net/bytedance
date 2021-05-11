<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Kernel\Messages;

/**
 * Class Raw.
 */
class Raw extends Message
{
    /**
     * @var string
     */
    protected $type = 'raw';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['content'];

    /**
     * Constructor.
     *
     * @param string $content
     */
    public function __construct(string $content)
    {
        parent::__construct(['content' => strval($content)]);
    }

    /**
     * @param array $appends
     * @param bool  $withType
     *
     * @return array
     */
    public function transformForJsonRequest(array $appends = [], $withType = true): array
    {
        return json_decode($this->content, true) ?? [];
    }

    public function __toString()
    {
        return $this->get('content') ?? '';
    }
}
