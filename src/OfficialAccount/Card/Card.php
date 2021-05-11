<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\Card;

use Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Card.
 *
 * @author surpaimb <surpaimb@126.com>
 *
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\CodeClient          $code
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\MeetingTicketClient $meeting_ticket
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\MemberCardClient    $member_card
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\GeneralCardClient   $general_card
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\MovieTicketClient   $movie_ticket
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\CoinClient          $coin
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\SubMerchantClient   $sub_merchant
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\BoardingPassClient  $boarding_pass
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\JssdkClient         $jssdk
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\GiftCardClient      $gift_card
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\GiftCardOrderClient $gift_card_order
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\GiftCardPageClient  $gift_card_page
 * @property \Surpaimb\ByteDance\OfficialAccount\Card\InvoiceClient       $invoice
 */
class Card extends Client
{
    /**
     * @param string $property
     *
     * @return mixed
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\InvalidArgumentException
     */
    public function __get($property)
    {
        if (isset($this->app["card.{$property}"])) {
            return $this->app["card.{$property}"];
        }

        throw new InvalidArgumentException(sprintf('No card service named "%s".', $property));
    }
}
