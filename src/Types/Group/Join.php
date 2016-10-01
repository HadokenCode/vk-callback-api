<?php

namespace cjmaxik\VKCallbackAPI\Types\Group;

use cjmaxik\VKCallbackAPI\VKQuery;

    class Join
    {
        public $user;

        public $join_type;

        public function __construct($object)
        {
            $vk = new VKQuery();
            $this->user = $vk->users_get($object->user_id);

            $this->join_type = $object->join_type;
        }
    }
