<?php

class Pakat
{
    private $private_key, $public_key, $callback;

    /**
     * Pakat constructor.
     * @param $private_key
     * @param $public_key
     * @param $callback
     */
    public function __construct($callback)
    {
        $this->private_key = PAKAT_PRIVATE_KEY;
        $this->public_key = PAKAT_PUBLIC_KEY;
        $this->callback = $callback;
    }

    /**
     * @return bool|mixed|string
     */
    public function newLink()
    {
        return $this->curl(PAKAT_API_LINK, [
            'token' => $this->private_key,
            'public_key' => $this->public_key,
            'action' => "newLink",
            "callback" => $this->callback
        ]);
    }

    /**
     * @param $login_token
     * @return bool|mixed|string
     */
    public function getUserData($login_token)
    {
        return $this->curl(PAKAT_API_LINK, [
            'token' => $this->private_key,
            'public_key' => $this->public_key,
            'action' => "getUserData",
            'login_token' => $login_token
        ]);
    }

    /**
     * @param $login_token
     * @param $developer_hash
     * @return bool
     */
    public function checkRequest($login_token, $developer_hash)
    {
        if ($developer_hash == hash('sha256', $this->private_key . $login_token . $this->public_key)) {
            return true;
        } else {
            return false;
        }
    }

    private function curl($url, $datas = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['request' => $this->encrypt(json_encode($datas)), "developer_key" => (PAKAT_DEVELOPER_KEY)]);
        $res = $this->decrypt(curl_exec($ch));
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
        return $res;
    }


    public function encrypt($data)
    {
        $encrypted = openssl_encrypt($data, AES_256_CBC, PAKAT_KEY, 0, PAKAT_DEVELOPER_KEY);
        return $encrypted;
    }

    public function decrypt($data)
    {
        $decrypted = openssl_decrypt($data, AES_256_CBC, PAKAT_KEY, 0, PAKAT_DEVELOPER_KEY);
        return $decrypted;
    }
}


define('AES_256_CBC', 'aes-256-cbc');
define("PAKAT_API_LINK", "https://my-pakat.ir/developer/api/");
define("PAKAT_KEY", ("{REGISTER_KEY}"));// KEEP IT SAFE (ایمن نگه دارید)
define("PAKAT_DEVELOPER_KEY", ("{DEVELOPER_KEY}"));// KEEP IT SAFE (ایمن نگه دارید)
define("PAKAT_PRIVATE_KEY", ("{PRIVATE_KEY}"));// KEEP IT SAFE (ایمن نگه دارید)
define("PAKAT_PUBLIC_KEY", ("{PUBLIC_KEY}"));// KEEP IT SAFE (ایمن نگه دارید)
