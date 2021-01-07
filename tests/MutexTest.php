<?php

declare(strict_types=1);

namespace WyriHaximus\Tests\React\Redis\Mutex;

use Clue\React\Redis\Factory;
use React\EventLoop\LoopInterface;
use RTCKit\React\Redlock\Custodian;
use WyriHaximus\React\Mutex\AbstractMutexTestCase;
use WyriHaximus\React\Mutex\MutexInterface;
use WyriHaximus\React\Redis\Mutex\Mutex;

use function getenv;

final class MutexTest extends AbstractMutexTestCase
{
    public function provideMutex(LoopInterface $loop): MutexInterface
    {
        /** @phpstan-ignore-next-line */
        return new Mutex(new Custodian($loop, (new Factory($loop))->createLazyClient(getenv('REDIS_DSN'))));
    }
}
