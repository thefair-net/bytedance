<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Card.php.
 *
 * @author    surpaimb <surpaimb@126.com>
 * @copyright 2015 surpaimb <surpaimb@126.com>
 *
 * @see      https://github.com/overtrue
 * @see      http://overtrue.me
 */

namespace Surpaimb\ByteDance\Kernel\Messages;

/**
 * Class Card.
 */
class Card extends Message
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'wxcard';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = ['card_id'];

    /**
     * Media constructor.
     *
     * @param string $cardId
     */
    public function __construct(string $cardId)
    {
        parent::__construct(['card_id' => $cardId]);
    }
}
