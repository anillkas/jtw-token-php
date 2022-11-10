<?php


namespace anillkas\App;

class JWT
{
    private $expTime;
    private $time;
    private $today;
    private $privateKey;
    private $payload = array();

    private function time()
    {
        $toDay = new \DateTime("now");
        $time = $toDay->getTimestamp();
        $expTime = $time + 50;
        return array('exp' => $expTime, 'iat' => $time);
    }

    private function header()
    {
        return $header = json_encode(array(
            "alg" => "RS256",
            "typ" => "JWT"
        ));
    }

    private function payload()
    {
        return $payload = json_encode($this->time());
    }

    public function createJwt($privateKey)
    {
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($this->header()));
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($this->payload()));
        $data = $base64UrlHeader . "." . $base64UrlPayload;
        openssl_sign($data, $signature, $privateKey, OPENSSL_ALGO_SHA256);
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        return $jwt = $data . "." . $base64UrlSignature;
    }
}