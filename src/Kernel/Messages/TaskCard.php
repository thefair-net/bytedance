<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Surpaimb\ByteDance\Kernel\Messages;

/**
 * Class TaskCard.
 *
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $task_id
 * @property array  $btn
 */
class TaskCard extends Message
{
    /**
     * Messages type.
     *
     * @var string
     */
    protected $type = 'taskcard';

    /**
     * Properties.
     *
     * @var array
     */
    protected $properties = [
        'title',
        'description',
        'url',
        'task_id',
        'btn',
    ];
}
