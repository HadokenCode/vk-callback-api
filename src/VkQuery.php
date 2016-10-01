<?php
/*
 * Class VK
 * @author: CJMAXiK
 */

namespace cjmaxik\VKCallbackAPI;

class VkQuery
{
    const v = '5.53';
    const METHOD_URL = 'https://api.vk.com/method/';

    public function author_get($id)
    {
        if (is_null($id)) {
            return;
        }

        if (substr_count($id, '-')) {
            $id = substr($id, 1);

            return $this->groups_getById($id);
        } else {
            return $this->users_get($id);
        }
    }

    public function users_get($user_id)
    {
        $user = json_decode(file_get_contents(self::METHOD_URL."users.get?user_ids={$user_id}&v=".self::v));
        $user = $user->response[0];

        return (object) [
            'id'   => $user->id,
            'name' => $user->first_name.' '.$user->last_name,
            'link' => 'https://vk.com/id'.$user->id,
        ];
    }

    public function groups_getById($group_id)
    {
        $group = json_decode(file_get_contents(self::METHOD_URL."groups.getById?group_ids={$group_id}&v=".self::v));
        $group = $group->response[0];

        return (object) [
            'id'   => $group->id,
            'name' => $group->name,
            'link' => 'https://vk.com/public'.$group->id,
        ];
    }

    private function wall_getById($post_id)
    {
        $wall = json_decode(file_get_contents(self::METHOD_URL."wall.getById?posts={$post_id}&v=".self::v));

        return $wall->response[0];
    }

    private function photos_getById($post_id)
    {
        $photo = json_decode(file_get_contents(self::METHOD_URL."photos.getById?photos={$post_id}&v=".self::v));

        return $photo->response[0];
    }
}
