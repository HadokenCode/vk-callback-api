<?php

    namespace cjmaxik\VKCallbackAPI\Types\Group;

    use cjmaxik\VKCallbackAPI\VKQuery;

    class Leave
    {

        public $user;

        public $self;

        function __construct($object)
        {
            $vk = new VKQuery;
            $this->user  = $vk->users_get($object->user_id);

            $this->leave = $object->leave;
        }
    }
