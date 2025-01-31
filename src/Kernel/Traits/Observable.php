<?php

/*
 * This file is part of the surpaimb/bytedance.
 *
 * (c) surpaimb <surpaimb@126.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace TheFairLib\ByteDance\Kernel\Traits;

use TheFairLib\ByteDance\Kernel\Clauses\Clause;
use TheFairLib\ByteDance\Kernel\Contracts\EventHandlerInterface;
use TheFairLib\ByteDance\Kernel\Decorators\FinallyResult;
use TheFairLib\ByteDance\Kernel\Decorators\TerminateResult;
use TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException;
use TheFairLib\ByteDance\Kernel\ServiceContainer;

/**
 * Trait Observable.
 *
 * @author surpaimb <surpaimb@126.com>
 */
trait Observable
{
    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @var array
     */
    protected $clauses = [];

    /**
     * @param \Closure|EventHandlerInterface|callable|string $handler
     * @param \Closure|EventHandlerInterface|callable|string $condition
     *
     * @return \TheFairLib\ByteDance\Kernel\Clauses\Clause
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function push($handler, $condition = '*')
    {
        list($handler, $condition) = $this->resolveHandlerAndCondition($handler, $condition);

        if (!isset($this->handlers[$condition])) {
            $this->handlers[$condition] = [];
        }

        array_push($this->handlers[$condition], $handler);

        return $this->newClause($handler);
    }

    /**
     * @param array $handlers
     *
     * @return $this
     */
    public function setHandlers(array $handlers = [])
    {
        $this->handlers = $handlers;

        return $this;
    }

    /**
     * @param \Closure|EventHandlerInterface|string $handler
     * @param \Closure|EventHandlerInterface|string $condition
     *
     * @return \TheFairLib\ByteDance\Kernel\Clauses\Clause
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function unshift($handler, $condition = '*')
    {
        list($handler, $condition) = $this->resolveHandlerAndCondition($handler, $condition);

        if (!isset($this->handlers[$condition])) {
            $this->handlers[$condition] = [];
        }

        array_unshift($this->handlers[$condition], $handler);

        return $this->newClause($handler);
    }

    /**
     * @param string                                $condition
     * @param \Closure|EventHandlerInterface|string $handler
     *
     * @return \TheFairLib\ByteDance\Kernel\Clauses\Clause
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function observe($condition, $handler)
    {
        return $this->push($handler, $condition);
    }

    /**
     * @param string                                $condition
     * @param \Closure|EventHandlerInterface|string $handler
     *
     * @return \TheFairLib\ByteDance\Kernel\Clauses\Clause
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    public function on($condition, $handler)
    {
        return $this->push($handler, $condition);
    }

    /**
     * @param string|int $event
     * @param mixed      ...$payload
     *
     * @return mixed|null
     */
    public function dispatch($event, $payload)
    {
        return $this->notify($event, $payload);
    }

    /**
     * @param string|int $event
     * @param mixed      ...$payload
     *
     * @return mixed|null
     */
    public function notify($event, $payload)
    {
        $result = null;

        foreach ($this->handlers as $condition => $handlers) {
            if ('*' === $condition || ($condition & $event) === $event) {
                foreach ($handlers as $handler) {
                    if ($clause = $this->clauses[$this->getHandlerHash($handler)] ?? null) {
                        if ($clause->intercepted($payload)) {
                            continue;
                        }
                    }

                    $response = $this->callHandler($handler, $payload);

                    switch (true) {
                        case $response instanceof TerminateResult:
                            return $response->content;
                        case true === $response:
                            continue 2;
                        case false === $response:
                            break 3;
                        case !empty($response) && !($result instanceof FinallyResult):
                            $result = $response;
                    }
                }
            }
        }

        return $result instanceof FinallyResult ? $result->content : $result;
    }

    /**
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * @param mixed $handler
     *
     * @return \TheFairLib\ByteDance\Kernel\Clauses\Clause
     */
    protected function newClause($handler): Clause
    {
        return $this->clauses[$this->getHandlerHash($handler)] = new Clause();
    }

    /**
     * @param mixed $handler
     *
     * @return string
     */
    protected function getHandlerHash($handler)
    {
        if (is_string($handler)) {
            return $handler;
        }

        if (is_array($handler)) {
            return is_string($handler[0])
                ? $handler[0].'::'.$handler[1]
                : get_class($handler[0]).$handler[1];
        }

        return spl_object_hash($handler);
    }

    /**
     * @param callable $handler
     * @param mixed    $payload
     *
     * @return mixed
     */
    protected function callHandler(callable $handler, $payload)
    {
        try {
            return call_user_func_array($handler, [$payload]);
        } catch (\Exception $e) {
            if (property_exists($this, 'app') && $this->app instanceof ServiceContainer) {
                $this->app['logger']->error($e->getCode().': '.$e->getMessage(), [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);
            }
        }
    }

    /**
     * @param mixed $handler
     *
     * @return \Closure
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    protected function makeClosure($handler)
    {
        if (is_callable($handler)) {
            return $handler;
        }

        if (is_string($handler) && '*' !== $handler) {
            if (!class_exists($handler)) {
                throw new InvalidArgumentException(sprintf('Class "%s" not exists.', $handler));
            }

            if (!in_array(EventHandlerInterface::class, (new \ReflectionClass($handler))->getInterfaceNames(), true)) {
                throw new InvalidArgumentException(sprintf('Class "%s" not an instance of "%s".', $handler, EventHandlerInterface::class));
            }

            return function ($payload) use ($handler) {
                return (new $handler($this->app ?? null))->handle($payload);
            };
        }

        if ($handler instanceof EventHandlerInterface) {
            return function () use ($handler) {
                return $handler->handle(...func_get_args());
            };
        }

        throw new InvalidArgumentException('No valid handler is found in arguments.');
    }

    /**
     * @param mixed $handler
     * @param mixed $condition
     *
     * @return array
     *
     * @throws \TheFairLib\ByteDance\Kernel\Exceptions\InvalidArgumentException
     * @throws \ReflectionException
     */
    protected function resolveHandlerAndCondition($handler, $condition): array
    {
        if (is_int($handler) || (is_string($handler) && !class_exists($handler))) {
            list($handler, $condition) = [$condition, $handler];
        }

        return [$this->makeClosure($handler), $condition];
    }
}
