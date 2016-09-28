<?php

    namespace cjmaxik\VKCallbackAPI\Types\Wall;

    use cjmaxik\VKCallbackAPI\VKQuery;
    use cjmaxik\VKCallbackAPI\Attachments;

    /**
    *
    */
    class Reply
    {

        public $id;

        public $from;

        public $date;

        public $text;

        public $reply_to_user;

        public $reply_to_comment;

        public $attachments;

        public $link;

        public function __construct($object, $group_id)
        {
            $this->id = $object->id;
            $this->date = $object->date;
            $this->text = $object->text;
            $this->reply_to_comment = $object->reply_to_comment;

            $vk = new VKQuery;
            $this->from = $vk->author_get($object->from_id);
            $this->reply_to_user = $vk->author_get($object->reply_to_user);

            $this->attachments = new Attachments($object->attachments);

            $this->link = 'https://vk.com/wall-'.$group_id.'_'.$object->id;
            if ($object->reply_to_comment) {
                $this->link .= '?'.$object->reply_to_comment;
            }
        }

    }

