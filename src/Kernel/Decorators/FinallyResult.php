<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel\Decorators;

/**
 * Class FinallyResult.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class FinallyResult
{
    /**
     * @var mixed
     */
    public $content;

    /**
     * FinallyResult constructor.
     *
     * @param mixed $content
     */
    public function __construct($content)
    {
        $this->content = $content;
    }
}
