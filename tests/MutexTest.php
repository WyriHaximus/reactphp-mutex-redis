<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\React\Redis\Mutex;

use Clue\React\Redis\Factory;
use RTCKit\React\Redlock\Custodian;
use WyriHaximus\React\Mutex\AbstractMutexTestCase;
use WyriHaximus\React\Mutex\Contracts\MutexInterface;
use WyriHaximus\React\Redis\Mutex\Mutex;

use function getenv;

final class MutexTest extends AbstractMutexTestCase
{
    public function provideMutex(): MutexInterface
    {
        /** @phpstan-ignore-next-line */
        return new Mutex(new Custodian((new Factory())->createLazyClient(getenv('REDIS_DSN'))));
    }
}
