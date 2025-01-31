<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\MiniProgram;

use App\Account\Exceptions\MiniProgramLoginException;
use TheFairLib\ByteDance\Kernel\Encryptor as BaseEncryptor;
use TheFairLib\ByteDance\Kernel\Exceptions\DecryptException;
use TheFairLib\ByteDance\Kernel\Support\AES;


/**
 * Class Encryptor.
 *
 * @author mingyoung <mingyoungcheung@gmail.com>
 */
class Encryptor extends BaseEncryptor
{
    /**
     * Decrypt data.
     *
     * @param string $sessionKey
     * @param string $iv
     * @param string $encrypted
     *
     * @return array
     */
    public function decryptData(string $sessionKey, string $iv, string $encrypted): array
    {

        $decrypted = AES::decrypt(
            base64_decode($encrypted, false), base64_decode($sessionKey, false), base64_decode($iv, false)
        );

        $decrypted = json_decode($this->pkcs7Unpad($decrypted), true);
        if (!$decrypted) {
            throw new DecryptException('The given payload is invalid.');
        }

        return $decrypted;
    }
}
