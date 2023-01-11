<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel;

use TheFairLib\ByteDance\Kernel\Contracts\Arrayable;
use TheFairLib\ByteDance\Kernel\Exceptions\RuntimeException;
use TheFairLib\ByteDance\Kernel\Support\Arr;
use TheFairLib\ByteDance\Kernel\Support\Collection;

function data_get($data, $key, $default = null)
{
    switch (true) {
        case is_array($data):
            return Arr::get($data, $key, $default);
        case $data instanceof Collection:
            return $data->get($key, $default);
        case $data instanceof Arrayable:
            return Arr::get($data->toArray(), $key, $default);
        case $data instanceof \ArrayIterator:
            return $data->getArrayCopy()[$key] ?? $default;
        case $data instanceof \ArrayAccess:
            return $data[$key] ?? $default;
        case $data instanceof \IteratorAggregate && $data->getIterator() instanceof \ArrayIterator:
            return $data->getIterator()->getArrayCopy()[$key] ?? $default;
        case is_object($data):
            return $data->{$key} ?? $default;
        default:
            throw new RuntimeException(sprintf('Can\'t access data with key "%s"', $key));
    }
}

function data_to_array($data)
{
    switch (true) {
        case is_array($data):
            return $data;
        case $data instanceof Collection:
            return $data->all();
        case $data instanceof Arrayable:
            return $data->toArray();
        case $data instanceof \IteratorAggregate && $data->getIterator() instanceof \ArrayIterator:
            return $data->getIterator()->getArrayCopy();
        case $data instanceof \ArrayIterator:
            return $data->getArrayCopy();
        default:
            throw new RuntimeException(sprintf('Can\'t transform data to array'));
    }
}
