<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel\Messages;

/**
 * Class NewsItem.
 */
class NewsItem extends Message
{
    /**
     * Messages type.
     *
     * @var string
     */
    protected $type = 'news';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'title',
        'description',
        'url',
        'image',
    ];

    public function toJsonArray()
    {
        return [
            'title' => $this->get('title'),
            'description' => $this->get('description'),
            'url' => $this->get('url'),
            'picurl' => $this->get('image'),
        ];
    }

    public function toXmlArray()
    {
        return [
            'Title' => $this->get('title'),
            'Description' => $this->get('description'),
            'Url' => $this->get('url'),
            'PicUrl' => $this->get('image'),
        ];
    }
}
