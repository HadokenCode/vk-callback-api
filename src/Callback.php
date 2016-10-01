<?php

namespace cjmaxik\VKCallbackAPI;

use cjmaxik\VKCallbackAPI\Exceptions\CallbackException;

/**
 * Calss Callback.
 *
 * Основной класс для работы с VK Callback API
 */
class Callback
{
    /** @var string ID группы/сообщества */
    private static $groupId = null;
    private static $instanceGroupID;

    /** @var string Строка ответа для проверки со стороны ВК */
    private static $confirmationToken = null;
    private static $instanceConfirmationToken;

    private static $secretKey = null;
    private static $instanceSecretKey = null;

    public function __construct($groupId = null, $confirmationToken = null, $secretKey = null)
    {
        if ($groupId === null) {
            if (self::$groupId === null) {
                $msg = 'Не установлен ID группы. Передайте его в конструктор первым аргументом.';
                throw new CallbackException($msg);
            }
        } else {
            self::validateGroupID($groupId);
            $this->instanceGroupID = $groupId;
        }

        if ($confirmationToken === null) {
            if (self::$confirmationToken === null) {
                $msg = 'Не установлена строка подтверждения. Передайте ее в конструктор вторым аргументом.';
                throw new CallbackException($msg);
            }
        } else {
            self::validateConfirmationToken($confirmationToken);
            $this->instanceConfirmationToken = $confirmationToken;
        }

        if ($secretKey === null) {
            // nothing
        } else {
            self::validateSecretKey($secretKey);
            $this->instanceSecretKey = $secretKey;
        }
    }

    private static function validateGroupID($groupId)
    {
        // TODO: Проверка ID группы
        return true;
    }

    private static function validateConfirmationToken($confirmationToken)
    {
        // TODO: Проверка строки ответа
        return true;
    }

    private static function validateSecretKey($confirmationToken)
    {
        // TODO: Проверка секретного ключа
        return true;
    }

    public function listen($callback)
    {
        if (!$callback) {
            throw new CallbackException('Пустое сообщение.');
        }

        $callback_object = json_decode($callback);
        if ($this->instanceGroupID === $callback_object->group_id) {
            //
        } else {
            throw new CallbackException('Недействительный ID группы. Проверьте корректность инстанса.');
        }

        if (!is_null($this->instanceSecretKey)) {
            if ($callback_object->secret != $this->instanceSecretKey) {
                throw new CallbackException('Не совпадает секретный ключ.');
            }
        }

        $answer = (object) [
            'type'   => $callback_object->type,
            'object' => null,
        ];

        switch ($callback_object->type) {
            case 'confirmation':
                return $this->getInstanceConfirmationToken();
                break;

            case 'message_new':
                $answer->object = new Types\MessageNew($callback_object->object, $this->instanceGroupID);
                break;

            case 'group_join':
                $answer->object = new Types\Group\Join($callback_object->object, $this->instanceGroupID);
                break;

            case 'group_leave':
                $answer->object = new Types\Group\Leave($callback_object->object, $this->instanceGroupID);
                break;

            case 'wall_reply_new':
            case 'wall_reply_edit':
                $answer->object = new Types\Wall\Reply($callback_object->object, $this->instanceGroupID);
                break;

            case 'wall_post_new':
                $answer->object = new Types\Wall\PostNew($callback_object->object, $this->instanceGroupID);
                break;

            default:
                $answer->object = new Types\DefaultType($callback_object->object, $this->instanceGroupID);
                break;
        }

        return $answer;
    }

    public function getInstanceConfirmationToken()
    {
        return $this->instanceConfirmationToken;
    }

    public function echoJson($json)
    {
        return '<pre>'.var_export(json_decode($json), true).'</pre>';
    }

    public function echoObject($object)
    {
        return '<pre>'.var_export($object, true).'</pre>';
    }

    public function echoString($string)
    {
        return '<pre>'.$string.'</pre>';
    }
}
