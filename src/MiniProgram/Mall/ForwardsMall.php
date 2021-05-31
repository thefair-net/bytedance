<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\MiniProgram\Mall;

/**
 * Class Application.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 *
 * @property \Surpaimb\ByteDance\MiniProgram\Mall\OrderClient   $order
 * @property \Surpaimb\ByteDance\MiniProgram\Mall\CartClient    $cart
 * @property \Surpaimb\ByteDance\MiniProgram\Mall\ProductClient $product
 * @property \Surpaimb\ByteDance\MiniProgram\Mall\MediaClient   $media
 */
class ForwardsMall
{
    /**
     * @var \Surpaimb\ByteDance\Kernel\ServiceContainer
     */
    protected $app;

    /**
     * @param \Surpaimb\ByteDance\Kernel\ServiceContainer $app
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @param string $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        return $this->app["mall.{$property}"];
    }
}
