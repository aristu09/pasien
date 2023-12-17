<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vigenere
{
    private $key;

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function encrypt($text)
    {
        $text = strtoupper($text);
        $key = strtoupper($this->key);
        $keyLength = strlen($key);
        $encryptedText = '';

        for ($i = 0, $j = 0; $i < strlen($text); $i++) {
            $char = $text[$i];
            if (ctype_alpha($char)) {
                $encryptedText .= chr((ord($char) - 65 + ord($key[$j % $keyLength]) - 65) % 26 + 65);
                $j++;
            } else {
                $encryptedText .= $char;
            }
        }

        $base64Encoded = base64_encode($encryptedText);

        return $base64Encoded;
    }

    public function decrypt($encryptedText)
    {
        $base64Decoded = base64_decode($encryptedText);
        $encryptedText = strtoupper($base64Decoded);
        $key = strtoupper($this->key);
        $keyLength = strlen($key);
        $decryptedText = '';

        for ($i = 0, $j = 0; $i < strlen($encryptedText); $i++) {
            $char = $encryptedText[$i];
            if (ctype_alpha($char)) {
                $decryptedText .= chr((ord($char) - ord($key[$j % $keyLength]) + 26) % 26 + 65);
                $j++;
            } else {
                $decryptedText .= $char;
            }
        }

        return $decryptedText;
    }
}