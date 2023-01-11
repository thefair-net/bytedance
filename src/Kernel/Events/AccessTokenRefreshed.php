<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel\Events;

use TheFairLib\ByteDance\Kernel\AccessToken;

/**
 * Class AccessTokenRefreshed.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class AccessTokenRefreshed
{
    /**
     * @var \TheFairLib\ByteDance\Kernel\AccessToken
     */
    public $accessToken;

    /**
     * @param \TheFairLib\ByteDance\Kernel\AccessToken $accessToken
     */
    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }
}
