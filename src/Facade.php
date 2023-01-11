<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) alim <tuple@youshui.ren>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Class Facade.
 *
 * @author alim <tuple@youshui.ren>
 */
class Facade extends LaravelFacade
{
    /**
     * 默认为 Server.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'bytedance.mini_program';
    }

    /**
     * @return \TheFairLib\ByteDance\MiniProgram\Application
     */
    public static function miniProgram($name = '')
    {
        return $name ? app('bytedance.mini_program.'.$name) : app('bytedance.mini_program');
    }

    /**
     * @return \TheFairLib\ByteDance\Douyin\Application
     */
    public static function douyin($name = '')
    {
        return $name ? app('bytedance.douyin.'.$name) : app('bytedance.douyin');
    }

}
