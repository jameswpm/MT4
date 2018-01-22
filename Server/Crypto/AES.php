<?php

namespace Server\Crypto;

/**
 * Class AES
 * Implements AES encrypt/decrypt
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Crypto
 */
class AES implements Cipher {

    /**
     * @var string $key
     * @see http://www.sethcardoza.com/tools/random-password-generator/
     */
    private $key = 'ZOudk@5$DIGvr6em4Nlvzoyngd6XgNk$GFu&&K)C';

    /**
     * @var string $iv_secret
     * @see http://www.sethcardoza.com/tools/random-password-generator/
     */
    private $iv_secret = '(f1cM(KRjt16xpZ@';

    /**
     * @param $original_text
     * @return mixed
     */
    public function encrypt($original_text)
    {
        $method = 'aes-256-cbc';

        $key_to_use = hash('sha256', $this->key);// using hash sha256 to create the salt

        // needs to have 16 bytes
        $iv = substr(hash('sha256', $this->iv_secret), 0, 16);

        $encrypted = base64_encode(openssl_encrypt($original_text, $method, $key_to_use, 0, $iv));

        return $encrypted;
    }

    /**
     * @param $encrypted_text
     * @return mixed
     */
    public function decipher($encrypted_text)
    {
        $method = 'aes-256-cbc';

        $key_to_use = hash('sha256', $this->key); // using hash sha256 to create the salt

        // needs to have 16 bytes
        $iv = substr(hash('sha256', $this->iv_secret), 0, 16);


        $dec = openssl_decrypt(base64_decode($encrypted_text), $method, $key_to_use, 0, $iv);

        return $dec;
    }
}