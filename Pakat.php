<?php

class Pakat
{
    private $webhook;
    public function __construct($WebHook = "")
    {
        $this->webhook = $WebHook;
    }

    /**
     * @param $PakatID - User Pakat ID
     * @return bool|mixed|string
     */
    public function requestForInformation($PakatID)
    {
        return $this->endpoint([
            "pakat_id" => $PakatID,
            "webhook" => $this->webhook,
            "action" => "requestForInformation"
        ]);
    }

    /**
     * @param $PakatID - User Pakat ID
     * @param $VerifyCode - Sended Verify code
     * @return bool|mixed|string
     */
    public function verifyPakatId($PakatID, $VerifyCode)
    {
        return $this->endpoint([
            "pakat_id" => $PakatID,
            "verify_code" => $VerifyCode,
            "action" => "verifyPakatId"
        ]);
    }

    /**
     * @param $UserHash - User Hash you get
     * @return bool|mixed|string
     */
    public function getUserInformation($UserHash)
    {
        return $this->endpoint([
            "user_hash" => $UserHash,
            "action" => "getUserInformation"
        ]);
    }

    public function endpoint($datas = [])
    {
        return $this->curl(PAKAT_API_LINK, $datas);
    }

    private function curl($url, $datas = [])
    {
        $datas['token'] = PAKAT_APPLICATION_TOKEN;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['request' => json_encode($datas)]);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res, true);
        }
        return $res;
    }
}


define("PAKAT_API_LINK", "https://my-pakat.ir/developers/api/");
define("PAKAT_APPLICATION_TOKEN", "{{PAKAT_APPLICATION_TOKEN}}");
