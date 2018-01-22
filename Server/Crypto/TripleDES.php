<?php

namespace Server\Crypto;

/**
 * Class 3DES
 * Implements 3DES encrypt/decrypt
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Crypto
 */
class TripleDES implements Cipher {

    /**
     * @var string $key
     * @see http://www.sethcardoza.com/tools/random-password-generator/
     */
    private $key = 'erpmY$6c';

    /**
     * @param $original_text
     * @return mixed
     */
    public function encrypt($original_text)
    {
        $key = md5($this->key, true);

        //Take first 8 bytes of $key and append them to the end of $key.
        $key .= substr($key, 0, 8);

        $encData = openssl_encrypt($original_text, 'DES-EDE3', $key, 0);

        return base64_encode($encData);
    }

    /**
     * @param $encrypted_text
     * @return mixed
     */
    public function decipher($encrypted_text)
    {
        $data = base64_decode($encrypted_text);

        $key = md5($this->key, true);

        //Take first 8 bytes of $key and append them to the end of $key.
        $key .= substr($key, 0, 8);

        $decData = openssl_decrypt($data, 'DES-EDE3',$key, 0);

        return $decData;
    }
}