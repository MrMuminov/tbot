<?php

namespace mrmuminov\tbot;


/**
 * Class Tbot
 * @package mrmuminov\tbot
 */
class Tbot
{
    use TbotMethods;

    public const PARSE_HTML = "html";
    public const PARSE_MARKDOWN = "markdown";
    public const PARSE_MARKDOWNV2 = "markdownv2";
    public const KEYBOARD_BUTTON = 'keyboard';
    public const KEYBOARD_INLINE = 'inline_keyboard';
    public const KEYBOARD_DEV = 'developer_keyboard';
    public const REQUEST_CONTACT = 'request_contact';
    public const REQUEST_LOCATION = 'request_location';

    /**
     * @var $bot_token string
     */
    private string $bot_token;
    /**
     * @var $user_data_path string
     * @default ./user_data
     */
    private string $user_data_path = "./user_data";
    /**
     * @var $api_url string
     * @default  "https://api.telegram.org/bot{bot_token}/{method}" <br>
     * {bot_token} - this is Telegram bot api token <br>
     * {method} - this is request method name <br>
     */
    public string $api_url = "https://api.telegram.org/bot{bot_token}/{method}";
    /**
     * @var $api_file_url string
     * @default  "https://api.telegram.org/file/bot{bot_token}/{file_path}" <br>
     * {bot_token} - this is Telegram bot api token <br>
     * {method} - this is request method name <br>
     */
    public string $api_file_url = "https://api.telegram.org/file/bot{bot_token}/{file_path}";
    /**
     * @var string
     * @default ext
     */
    public string $data_file_format = "ext";
    /**
     * @var array
     */
    public array $update;

    /**
     * Tbot constructor.
     * @param $bot_token
     * @param string $user_data_path
     * @param string $api_url
     */
    public function __construct($bot_token, $user_data_path = "./user_data",
                                $api_url = "https://api.telegram.org/bot{bot_token}/{method}"
    )
    {
        $this->setBotToken($bot_token);
        $this->setUserDataPath($user_data_path);
        $this->setApiUrl($api_url);
        $this->init();
    }

    /**
     * Initial method
     */
    private function init()
    {
        $this->setUpdate(json_decode(file_get_contents("php://input"), true));
//        $this->setUpdate(json_decode(json_encode($this->update), true));
        if (!empty($this->getUserDataPath())) {
            if (!file_exists($this->getUserDataPath())) {
                mkdir($this->getUserDataPath());
            }
        }
    }

    /**
     * @return mixed|string
     */
    public function getBotToken()
    {
        return $this->bot_token;
    }

    /**
     * @param mixed|string $bot_token
     */
    public function setBotToken(string $bot_token)
    {
        $this->bot_token = $bot_token;
    }

    /**
     * @return mixed|string
     */
    public function getUserDataPath()
    {
        return $this->user_data_path;
    }

    /**
     * @param mixed|string $user_data_path
     */
    public function setUserDataPath(string $user_data_path): void
    {
        $this->user_data_path = $user_data_path;
    }

    /**
     * @return mixed|string
     */
    public function getApiUrl()
    {
        return $this->api_url;
    }

    /**
     * @param mixed|string $api_url
     */
    public function setApiUrl(string $api_url): void
    {
        $this->api_url = $api_url;
    }

    /**
     * @return string
     */
    public function getApiFileUrl(): string
    {
        return $this->api_file_url;
    }

    /**
     * @param string $api_file_url
     */
    public function setApiFileUrl(string $api_file_url): void
    {
        $this->api_file_url = $api_file_url;
    }

    /**
     * @param string $path
     * @return mixed|string
     */
    public function getUpdate($path = "")
    {
        if (empty($path)) {
            return $this->update;
        }
        $update = $this->update;
        $exppath = explode(".", $path);
        if (count($exppath) < 2) {
            return isset($update[$path]) ? $update[$path] : false;
        }
        foreach ($exppath as $value) {
            if (!isset($update[$value])) {
                break;
            }
            $update = $update[$value];
        }
        return $update;
    }

    /**
     * @param array[]|mixed $update
     */
    public function setUpdate(array $update): void
    {
        $this->update = $update;
    }

    /**
     * @param $key
     * @param $value
     * @param null $user_id
     * @return bool
     */
    public function setData($key, $value, $user_id = null)
    {
        if (empty($user_id)) {
            $user_id = $this->getUpdate('message.chat.id');
        }
        $path = $this->generateDataPath($user_id);
        return $this->fileWrite($path . "/" . $user_id . "." . $key . "." . $this->data_file_format, $value);
    }

    /**
     * @param $key
     * @param null $user_id
     * @return false|string
     */
    public function getData($key, $user_id = null)
    {
        if (empty($user_id)) {
            $user_id = $this->getUpdate('message.chat.id');
        }
        $path = $this->generateDataPath($user_id);
        return $this->fileRead($path . "/" . $user_id . "." . $key . "." . $this->data_file_format);
    }

    /**
     * @param $value
     * @return string
     */
    private function generateDataPath($value): string
    {
        $md5 = md5($value);
        $path = $this->getUserDataPath();
        $path .= "/" . mb_substr($md5, 0, 2);
        $path .= "/" . mb_substr($md5, 2, 2);
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    /**
     * @param $filename
     * @return false|string
     */
    private function fileRead($filename)
    {
        if (empty($filename)) {
            return false;
        }
        $filename = trim($filename, "/");
        $path = $filename;
        if (!file_exists($path)) {
            return false;
        }
        return file_get_contents($path);
    }

    /**
     * @param $filename
     * @param $content
     * @return bool
     */
    private function fileWrite($filename, $content)
    {
        if (empty($filename) || empty($content)) {
            return false;
        }
        $filename = trim($filename, "/");
        $path = $filename;
        $result = file_put_contents($path, $content);
        return !!$result;
    }

    /**
     * @param array $keyboards
     * @param false $type
     * @param bool $resize_keyboard
     * @param false $one_time_keyboard
     * @param false $selective
     * @return false|string
     */
    public function createKeyboard(array $keyboards, $type = false, $resize_keyboard = true, $one_time_keyboard = false, $selective = false)
    {
        $type = $type ? $type : self::KEYBOARD_BUTTON;
        $result_keyboard = false;
        switch ($type) {
            case self::KEYBOARD_BUTTON:
                $result_keyboard = [
                    'keyboard' => [],
                    'resize_keyboard' => $resize_keyboard,
                    'one_time_keyboard' => $one_time_keyboard,
                    'selective' => $selective,
                ];
                foreach ($keyboards as $key => $keyboard) {
                    foreach ($keyboard as $subkey => $subkeyboard) {
                        $tmp_keyboard = [
                            'text' => $subkeyboard,
                        ];
                        if ($subkey === self::REQUEST_CONTACT) {
                            $tmp_keyboard[self::REQUEST_CONTACT] = true;
                        } elseif ($subkey === self::REQUEST_LOCATION) {
                            $tmp_keyboard[self::REQUEST_LOCATION] = true;
                        }
                        $result_keyboard['keyboard'][$key][] = $tmp_keyboard;
                    }
                }
                break;
            case self::KEYBOARD_INLINE:
                $result_keyboard = [
                    'inline_keyboard' => [],
                ];
                foreach ($keyboards as $key => $keyboard) {
                    foreach ($keyboard as $subkey => $subkeyboard) {
                        $tmp_keyboard = [
                            'text' => $subkeyboard,
                        ];
                        if ($subkey === self::REQUEST_CONTACT) {
                            $tmp_keyboard[self::REQUEST_CONTACT] = true;
                        } elseif ($subkey === self::REQUEST_LOCATION) {
                            $tmp_keyboard[self::REQUEST_LOCATION] = true;
                        }
                        $result_keyboard['inline_keyboard'][$key][] = $tmp_keyboard;
                    }
                }
                break;
            case self::KEYBOARD_DEV:
                $result_keyboard = $keyboards;
                break;
        }

        return json_encode($result_keyboard);
    }

    /**
     * @param $file_path
     * @return string|string[]
     */
    public function getFilePath($file_path)
    {
        return str_replace(["{bot_token}", "{file_path}"], [$this->getBotToken(), $file_path], $this->getApiFileUrl());
    }

    /**
     * @return string
     */
    public function getDataFileFormat(): string
    {
        return $this->data_file_format;
    }

    /**
     * @param string $data_file_format
     */
    public function setDataFileFormat(string $data_file_format): void
    {
        $this->data_file_format = $data_file_format;
    }

}