<?php
/*
 * Class VK
 * @author: CJMAXiK
 */

namespace cjmaxik\VKCallbackAPI;

class VKQuery {

    private static $v = '5.52';
    const METHOD_URL = "https://api.vk.com/method/";

    public static function users_get($user_id) {
        $user = json_decode(file_get_contents(self::METHOD_URL."users.get?user_ids={$user_id}&v=".self::$v));
        $user = $user->response[0];
        return (object)[
            'id' => $user->id,
            'name' => $user->first_name." ".$user->last_name,
            'link' => 'https://vk.com/id'.$user->id,
        ];
    }

    public static function groups_getMembers($group_id) {
        $group = json_decode(file_get_contents(self::METHOD_URL."groups.getMembers?group_id={$group_id}&count=0&v=".self::v));
        return $group->response;
    }

    public static function groups_getById($group_id) {
        $group = json_decode(file_get_contents(self::METHOD_URL."groups.getById?group_ids={$group_id}&v=".self::v));
        return $group->response[0];
    }

    public static function wall_getById($post_id) {
        $wall = json_decode(file_get_contents(self::METHOD_URL."wall.getById?posts={$post_id}&v=".self::v));
        return $wall->response[0];
    }

    public static function photos_getById($post_id) {
        $photo = json_decode(file_get_contents(self::METHOD_URL."photos.getById?photos={$post_id}&v=".self::v));
        return $photo->response[0];
    }

}