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
 * Class Text.
 *
 * @property string $content
 */
class Text extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'text';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['content'];

    /**
     * Text constructor.
     *
     * @param string $content
     */
    public function __construct(string $content = '')
    {
        parent::__construct(compact('content'));
    }

    /**
     * @return array
     */
    public function toXmlArray()
    {
        return [
            'Content' => $this->get('content'),
        ];
    }
}
