<?php

/*
 * This file is part of the overtrue/wechat.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\OfficialAccount\Broadcasting;

use Surpaimb\ByteDance\Kernel\Contracts\MessageInterface;
use Surpaimb\ByteDance\Kernel\Exceptions\RuntimeException;

/**
 * Class MessageBuilder.
 *
 * @author surpaimb <surpaimb@126.com>
 */
class MessageBuilder
{
    /**
     * @var array
     */
    protected $to = [];

    /**
     * @var \Surpaimb\ByteDance\Kernel\Contracts\MessageInterface
     */
    protected $message;

    /**
     * @var array
     */
    protected $attributes = [];

    /**
     * Set message.
     *
     * @param \Surpaimb\ByteDance\Kernel\Contracts\MessageInterface $message
     *
     * @return $this
     */
    public function message(MessageInterface $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set target user or group.
     *
     * @param array $to
     *
     * @return $this
     */
    public function to(array $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * @param int $tagId
     *
     * @return \Surpaimb\ByteDance\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function toTag(int $tagId)
    {
        $this->to([
            'filter' => [
                'is_to_all' => false,
                'tag_id' => $tagId,
            ],
        ]);

        return $this;
    }

    /**
     * @param array $openids
     *
     * @return \Surpaimb\ByteDance\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function toUsers(array $openids)
    {
        $this->to([
            'touser' => $openids,
        ]);

        return $this;
    }

    /**
     * @return $this
     */
    public function toAll()
    {
        $this->to([
            'filter' => ['is_to_all' => true],
        ]);

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return \Surpaimb\ByteDance\OfficialAccount\Broadcasting\MessageBuilder
     */
    public function with(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    /**
     * Build message.
     *
     * @param array $prepends
     *
     * @return array
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\RuntimeException
     */
    public function build(array $prepends = []): array
    {
        if (empty($this->message)) {
            throw new RuntimeException('No message content to send.');
        }

        $content = $this->message->transformForJsonRequest();

        if (empty($prepends)) {
            $prepends = $this->to;
        }

        $message = array_merge($prepends, $content, $this->attributes);

        return $message;
    }

    /**
     * Build preview message.
     *
     * @param string $by
     * @param string $user
     *
     * @return array
     *
     * @throws \Surpaimb\ByteDance\Kernel\Exceptions\RuntimeException
     */
    public function buildForPreview(string $by, string $user): array
    {
        return $this->build([$by => $user]);
    }
}
