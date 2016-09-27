<?php

    namespace cjmaxik\VKCallbackAPI\Types;

    use cjmaxik\VKCallbackAPI\VKQuery;
    use cjmaxik\VKCallbackAPI\Attachments;

    /**
    *
    */
    class MessageNew
    {

        public $id;

        public $date;

        public $user;

        public $read_state;

        public $title;

        public $body;

        public $attachments;

        public $geo;

        public function __construct($object)
        {
            $this->id = $object->id;
            $this->date = $object->date;
            $this->out = $object->out;
            $this->read_state = $object->read_state;
            $this->title = $object->title;
            $this->body = $object->body;

            $vk = new VKQuery;
            $this->user = $vk::users_get($object->user_id);

            if (isset($object->attachments)) {
                $this->attachments = new Attachments($object->attachments);
            };

            if (isset($object->geo)) {
                $this->geo = (object)$object->geo;
            }
        }

    }

