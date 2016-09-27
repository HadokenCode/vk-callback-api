# НЕ ИСПОЛЬЗОВАТЬ НА ПРОДАКШНЕ! РАЗРАБОТКА ТОЛЬКО НАЧАТА!
# VK Callback API
[![Последняя версиия](https://img.shields.io/github/release/cjmaxik/vk-callback-api.svg?style=flat-square)](https://github.com/cjmaxik/vk-callback-api/releases)
[![Лицензиия](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Статус сборки](https://img.shields.io/travis/cjmaxik/vk-callback-api/master.svg?style=flat-square)](https://travis-ci.org/cjmaxik/vk-callback-api)
[![Покрытие тестами](https://img.shields.io/scrutinizer/coverage/g/cjmaxik/vk-callback-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/cjmaxik/vk-callback-api/code-structure)
[![Процент качеества](https://img.shields.io/scrutinizer/g/cjmaxik/vk-callback-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/cjmaxik/vk-callback-api)
[![Количество скачиваний](https://img.shields.io/packagist/dt/cjmaxik/vk-callback-api.svg?style=flat-square)](https://packagist.org/packages/cjmaxik/vk-callback-api)

PHP-пакет для получения и обработки запросов от [Callback API социальной сети ВКонтакте](https://vk.com/dev/callback_api).

## НО ЗАЧЕМ???
С помощью данного пакета вы получаете уже готовый для использования другими пакетами объект, в котором хранится вся нужная информация без необходимости обращаться к API ВКонтакте для уточнения (например, информация о пользователе, группе и т.д.).

В моих планах - разработка пакета для публикации уведомлений Callback API в Slack.

## ОТКАЗ ОТ ОТВЕТСТВЕННОСТИ
**Данный пакет - первый написанный мною с нуля. Прошу не сильно бить из-за ошибок и некорректного написания кода. Примеры корректного кода, советы и посильная помощь в виде пул-реквестов привествуется!**

## Установка
Через Composer
``` bash
$ composer require cjmaxik/vk-callback-api
```

## Использование
### Простое
``` php
use cjmaxik\VKCallbackAPI\Callback;

$groupId = 1234567; // ID группы
$confirmationToken = 'sadfaf11'; // Строка, которую должен вернуть сервер (Управление сообществом -> Работа с API -> Callback API)
$callback = file_get_contents("php://input");

$vk = new Callback($groupId, $confirmationToken);
var_export($vk->listen($callback));
```

### С секретным ключом
``` php
...
$secretKey = 'thisisasupersecretkey'; // Секретный ключ
...
$vk = new Callback($groupId, $confirmationToken, $secretKey);
...
```

## Чеклист фич
- Типы событий:
  - [x] confirmation
  - [ ] wall_reply_new
  - [ ] wall_reply_edit
  - [ ] wall_post_new
  - [ ] audio_new
  - [ ] photo_new
  - [ ] photo_comment_new
  - [ ] video_new
  - [ ] video_comment_new
  - [x] message_new
  - [ ] group_leave
  - [ ] group_join
  - [ ] board_post_new
  - [ ] board_post_edit
  - [ ] board_post_restore
  - [ ] board_post_delete
  - [ ] market_comment_new
  - [ ] заглушка для неподдерживаемых/новых событий
- Типы вложений:
  - [X] photo
  - [X] video
  - [X] audio
  - [X] doc
  - [X] link
  - [X] note
  - [ ] poll
  - [ ] page
  - [ ] album
  - [ ] photos_list
  - [ ] market
  - [ ] market_album
- [x] Работа с API Вконтакте
- [ ] Тесты
- [ ] Комментарии в коде (DocBlockr)
- [ ] Использование для нескольких групп
- [ ] Корректная обработка исключений


## Автор
- [Максим Мекеня aka CJMAXiK](https://github.com/cjmaxik)

## Лицензия
**MIT License (MIT)**. Более подробная информация - [в файле лицензии](LICENSE.md).
