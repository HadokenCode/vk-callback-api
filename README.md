# НЕ ИСПОЛЬЗОВАТЬ НА ПРОДАКШНЕ! РАЗРАБОТКА ТОЛЬКО НАЧАТА!

# VK Callback API

[![Последняя версиия](https://img.shields.io/github/release/cjmaxik/vk-callback-api.svg?style=flat-square)](https://github.com/cjmaxik/vk-callback-api/releases)
[![Лицензиия](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Статус сборки](https://img.shields.io/travis/cjmaxik/vk-callback-api/master.svg?style=flat-square)](https://travis-ci.org/cjmaxik/vk-callback-api)
[![Покрытие тестами](https://img.shields.io/scrutinizer/coverage/g/cjmaxik/vk-callback-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/cjmaxik/vk-callback-api/code-structure)
[![Процент качеества](https://img.shields.io/scrutinizer/g/cjmaxik/vk-callback-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/cjmaxik/vk-callback-api)
[![Количество скачиваний](https://img.shields.io/packagist/dt/cjmaxik/vk-callback-api.svg?style=flat-square)](https://packagist.org/packages/cjmaxik/vk-callback-api)

PHP-пакет для получения и обработки запросов от [Callback API социальной сети ВКонтакте](https://vk.com/dev/callback_api).

## Установка

Через Composer

``` bash
$ composer require cjmaxik/vk-callback-api
```

## Использование

### Простое
``` php
use cjmaxik\VKCallbackAPI\Callback;

$groupId = 1234567;
$confirmationToken = 'sadfaf11';
$callback = file_get_contents("php://input");

$vk = new Callback($groupId, $confirmationToken);
var_export($vk->listen($callback));
```

### С секретным ключом
``` php
...
$secretKey = 'thisisasupersecretkey';
...
$vk = new Callback($groupId, $confirmationToken, $secretKey);
...
```

## Testing

TODO: Testing

## Roadmap

[] 


## Credits

- [Maxim Mekenya aka CJMAXiK](https://github.com/cjmaxik)
- [All Contributors](https://github.com/cjmaxik/vk-callback-api/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
