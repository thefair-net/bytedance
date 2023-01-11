<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance;

/**
 * Class Factory.
 *
 * @method static \TheFairLib\ByteDance\Payment\Application            payment(array $config)
 * @method static \TheFairLib\ByteDance\MiniProgram\Application        miniProgram(array $config)
 * @method static \TheFairLib\ByteDance\OpenPlatform\Application       openPlatform(array $config)
 * @method static \TheFairLib\ByteDance\Douyin\Application             douyin(array $config)
 * @method static \TheFairLib\ByteDance\BasicService\Application       basicService(array $config)
 * @method static \TheFairLib\ByteDance\Work\Application               work(array $config)
 * @method static \TheFairLib\ByteDance\OpenWork\Application           openWork(array $config)
 * @method static \TheFairLib\ByteDance\MicroMerchant\Application      microMerchant(array $config)
 */
class Factory
{
    /**
     * @param string $name
     * @param array  $config
     *
     * @return \TheFairLib\ByteDance\Kernel\ServiceContainer
     */
    public static function make($name, array $config)
    {
        $namespace = Kernel\Support\Str::studly($name);
        $application = "\\TheFairLib\ByteDance\\{$namespace}\\Application";

        return new $application($config);
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
