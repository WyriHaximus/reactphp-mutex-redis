# Redlock Mutex for wyrihaximus/react-mutex

[![Continuous Integration](https://github.com/WyriHaximus/reactphp-mutex-redis/actions/workflows/ci.yml/badge.svg?event=push)](https://github.com/WyriHaximus/reactphp-mutex-redis/actions/workflows/ci.yml)
[![Latest Stable Version](https://poser.pugx.org/WyriHaximus/react-mutex-redis/v/stable.png)](https://packagist.org/packages/WyriHaximus/react-mutex-redis)
[![Total Downloads](https://poser.pugx.org/WyriHaximus/react-mutex-redis/downloads.png)](https://packagist.org/packages/WyriHaximus/react-mutex-redis)
[![License](https://poser.pugx.org/WyriHaximus/react-mutex-redis/license.png)](https://packagist.org/packages/WyriHaximus/react-mutex-redis)

# Installation

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require wyrihaximus/react-mutex-redis
```

# Credit

This package builds on [`rtckit/react-redlock`](https://github.com/rtckit/reactphp-redlock) and only functions as a
wrapper around it.

# Usage

```php
<?php

use Clue\React\Redis\Factory;
use RTCKit\React\Redlock\Custodian;
use WyriHaximus\React\Redis\Mutex\Mutex;

$mutex = new Mutex(new Custodian((new Factory())->createLazyClient('redis://localhost:6379/13'))); // Use DB 13 as mutex database
$lock = $mutex->acquire('key', 1.23);
$mutex->release($lock);
```

# License

The MIT License (MIT)

Copyright (c) 2021 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
