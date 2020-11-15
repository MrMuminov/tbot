<?php


namespace mrmuminov\tbot;


/**
 * Trait TbotMethods
 * @package mrmuminov\tbot
 */
trait TbotMethods
{
    /**
     * @return mixed
     */
    public function getMe()
    {
        return $this->request('getMe');
    }

    /**
     * @return mixed
     */
    public function logOut()
    {
        return $this->request('logOut');
    }

    /**
     * @return mixed
     */
    public function close()
    {
        return $this->request('close');
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendMessage($options = [])
    {
        return $this->request('sendMessage', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function forwardMessage($options = [])
    {
        return $this->request('forwardMessage', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function copyMessage($options = [])
    {
        return $this->request('copyMessage', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendPhoto($options = [])
    {
        return $this->request('sendPhoto', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendAudio($options = [])
    {
        return $this->request('sendAudio', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendDocument($options = [])
    {
        return $this->request('sendDocument', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendVideo($options = [])
    {
        return $this->request('sendVideo', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendAnimation($options = [])
    {
        return $this->request('sendAnimation', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendVoice($options = [])
    {
        return $this->request('sendVoice', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendVideoNote($options = [])
    {
        return $this->request('sendVideoNote', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendMediaGroup($options = [])
    {
        return $this->request('sendMediaGroup', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendLocation($options = [])
    {
        return $this->request('sendLocation', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function editMessageLiveLocation($options = [])
    {
        return $this->request('editMessageLiveLocation', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function stopMessageLiveLocation($options = [])
    {
        return $this->request('stopMessageLiveLocation', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendVenue($options = [])
    {
        return $this->request('sendVenue', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendContact($options = [])
    {
        return $this->request('sendContact', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendPoll($options = [])
    {
        return $this->request('sendPoll', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendDice($options = [])
    {
        return $this->request('sendDice', $options);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function sendChatAction($options = [])
    {
        return $this->request('sendChatAction', $options);
    }

    /**
     * @param int $user_id
     * @param int|null $offset
     * @param int $limit
     * @return mixed
     */
    public function getUserProfilePhotos(int $user_id, int $offset = null, int $limit = 100)
    {
        return $this->request('getUserProfilePhotos', [
            'user_id' => $user_id,
            'offset' => $offset,
            'limit' => $limit,
        ]);
    }

    /**
     * @param string $document_file_id
     * @return mixed
     */
    public function getFile(string $document_file_id)
    {
        return $this->request('getFile', [
            'file_id' => $document_file_id,
        ]);
    }

    /**
     * @param $chat_id
     * @param int $user_id
     * @param int|null $until_date
     * @return mixed
     */
    public function kickChatMember($chat_id, int $user_id, int $until_date = null)
    {
        return $this->request('kickChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'until_date' => $until_date,
        ]);
    }

    /**
     * @param $chat_id
     * @param int $user_id
     * @param int $only_if_banned
     * @return mixed
     */
    public function unbanChatMember($chat_id, int $user_id, int $only_if_banned)
    {
        return $this->request('unbanChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'only_if_banned' => $only_if_banned,
        ]);
    }

    /**
     * @param $chat_id
     * @param int $user_id
     * @param array $permissions
     * @param int $until_date
     * @return mixed
     */
    public function restrictChatMember($chat_id, int $user_id, array $permissions, int $until_date)
    {
        return $this->request('restrictChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'permissions' => json_encode($permissions),
            'until_date' => $until_date,
        ]);
    }

    /**
     * @param array $options
     * @return mixed
     */
    public function promoteChatMember(array $options)
    {
        return $this->request('promoteChatMember', $options);
    }

    /**
     * @param $chat_id
     * @param int $user_id
     * @param string $custom_title
     * @return mixed
     */
    public function setChatAdministratorCustomTitle($chat_id, int $user_id, string $custom_title)
    {
        return $this->request('setChatAdministratorCustomTitle', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
            'custom_title' => $custom_title,
        ]);
    }

    /**
     * @param $chat_id
     * @param $permissions
     * @return mixed
     */
    public function setChatPermissions($chat_id, $permissions)
    {
        return $this->request('setChatPermissions', [
            'chat_id' => $chat_id,
            'permissions' => $permissions,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function exportChatInviteLink($chat_id)
    {
        return $this->request('exportChatInviteLink', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @param $photo
     * @return mixed
     */
    public function setChatPhoto($chat_id, $photo)
    {
        return $this->request('setChatPhoto', [
            'chat_id' => $chat_id,
            'photo' => $photo,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function deleteChatPhoto($chat_id)
    {
        return $this->request('deleteChatPhoto', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @param string $title
     * @return mixed
     */
    public function setChatTitle($chat_id, string $title)
    {
        return $this->request('setChatTitle', [
            'chat_id' => $chat_id,
            'title' => $title,
        ]);
    }

    /**
     * @param $chat_id
     * @param string $description
     * @return mixed
     */
    public function setChatDescription($chat_id, string $description = "")
    {
        return $this->request('setChatDescription', [
            'chat_id' => $chat_id,
            'description' => $description,
        ]);
    }

    /**
     * @param $chat_id
     * @param int $message_id
     * @param bool $disable_notification
     * @return mixed
     */
    public function pinChatMessage($chat_id, int $message_id, bool $disable_notification = true)
    {
        return $this->request('pinChatMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'disable_notification' => $disable_notification,
        ]);
    }


    /**
     * @param $chat_id
     * @param int|null $message_id
     * @return mixed
     */
    public function unpinChatMessage($chat_id, int $message_id = null)
    {
        return $this->request('unpinChatMessage', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function unpinAllChatMessages($chat_id)
    {
        return $this->request('unpinAllChatMessages', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function leaveChat($chat_id)
    {
        return $this->request('leaveChat', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function getChat($chat_id)
    {
        return $this->request('getChat', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function getChatAdministrators($chat_id)
    {
        return $this->request('getChatAdministrators', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function getChatMembersCount($chat_id)
    {
        return $this->request('getChatMembersCount', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param $chat_id
     * @param $user_id
     * @return mixed
     */
    public function getChatMember($chat_id, $user_id)
    {
        return $this->request('getChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $user_id,
        ]);
    }

    /**
     * @param $chat_id
     * @param $sticker_set_name
     * @return mixed
     */
    public function setChatStickerSet($chat_id, $sticker_set_name)
    {
        return $this->request('setChatStickerSet    ', [
            'chat_id' => $chat_id,
            'sticker_set_name' => $sticker_set_name,
        ]);
    }

    /**
     * @param $chat_id
     * @return mixed
     */
    public function deleteChatStickerSet($chat_id)
    {
        return $this->request('deleteChatStickerSet    ', [
            'chat_id' => $chat_id,
        ]);
    }

    /**
     * @param string $callback_query_id
     * @param string $text
     * @param bool $show_alert
     * @param string $url
     * @param int $cache_time
     * @return mixed
     */
    public function answerCallbackQuery(string $callback_query_id, string $text, bool $show_alert, string $url = "", int $cache_time = 0)
    {
        return $this->request('answerCallbackQuery    ', [
            'callback_query_id' => $callback_query_id,
            'text' => $callback_query_id,
            'show_alert' => $callback_query_id,
            'url' => $callback_query_id,
            'cache_time' => $callback_query_id,
        ]);
    }

    /**
     * @param array $commands
     * @return mixed
     */
    public function setMyCommands(array $commands)
    {
        return $this->request('setMyCommands    ', [
            'commands' => json_encode($commands),
        ]);
    }

    /**
     * @return mixed
     */
    public function getMyCommands()
    {
        return $this->request('getMyCommands');
    }

    /**
     * @param $method
     * @param $options
     * @return mixed
     */
    private function request($method, $options = [])
    {
        $url = str_replace(["{bot_token}", "{method}"], [$this->getBotToken(), $method], $this->getApiUrl());
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $options);
        $res = curl_exec($ch);
        if (empty(curl_error($ch))) {
            var_dump(curl_error($ch));
            return $res;
        }
        return json_decode($res, 1);

    }

}