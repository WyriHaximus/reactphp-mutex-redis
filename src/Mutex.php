<?php

declare(strict_types=1);

namespace WyriHaximus\React\Redis\Mutex;

use React\Promise\PromiseInterface;
use RTCKit\React\Redlock\Custodian;
use RTCKit\React\Redlock\Lock as RedisLock;
use WyriHaximus\React\Mutex\Lock;
use WyriHaximus\React\Mutex\MutexInterface;

use const WyriHaximus\Constants\Numeric\ONE_FLOAT;

final class Mutex implements MutexInterface
{
    private Custodian $custodian;

    public function __construct(Custodian $custodian)
    {
        $this->custodian = $custodian;
    }

    public function acquire(string $key, float $ttl): PromiseInterface
    {
        return $this->custodian->acquire($key, $ttl)->then(
            static fn (?RedisLock $redisLock): ?Lock => $redisLock instanceof RedisLock ? new Lock($redisLock->getResource(), $redisLock->getToken()) : null
        );
    }

    public function release(Lock $lock): PromiseInterface
    {
        return $this->custodian->release(new RedisLock($lock->getKey(), ONE_FLOAT, $lock->getRng()));
    }
}
