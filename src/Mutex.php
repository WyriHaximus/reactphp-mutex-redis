<?php

declare(strict_types=1);

namespace WyriHaximus\React\Redis\Mutex;

use React\Promise\PromiseInterface;
use RTCKit\React\Redlock\Custodian;
use RTCKit\React\Redlock\Lock as RedisLock;
use WyriHaximus\React\Mutex\Contracts\LockInterface;
use WyriHaximus\React\Mutex\Contracts\MutexInterface;

use const WyriHaximus\Constants\Numeric\ONE_FLOAT;

final class Mutex implements MutexInterface
{
    public function __construct(private Custodian $custodian)
    {
    }

    public function acquire(string $key, float $ttl): PromiseInterface
    {
        return $this->custodian->acquire($key, $ttl)->then(
            /** @phpstan-ignore-next-line */
            static fn (RedisLock|null $redisLock): Lock|null => $redisLock instanceof RedisLock ? new Lock($redisLock->getResource(), $redisLock->getToken()) : null,
        );
    }

    public function spin(string $key, float $ttl, int $attempts, float $interval): PromiseInterface
    {
        return $this->custodian->spin($attempts, $interval, $key, $ttl)->then(
            /** @phpstan-ignore-next-line */
            static fn (RedisLock|null $redisLock): Lock|null => $redisLock instanceof RedisLock ? new Lock($redisLock->getResource(), $redisLock->getToken()) : null,
        );
    }

    public function release(LockInterface $lock): PromiseInterface
    {
        return $this->custodian->release(new RedisLock($lock->key(), ONE_FLOAT, $lock->rng()));
    }
}
