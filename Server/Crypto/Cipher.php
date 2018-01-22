<?php

namespace Server\Crypto;


/**
 * Interface Cipher
 * Define base methods for all crypto classes
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Crypto
 */
interface Cipher {

    /**
     * @param $original_text
     * @return mixed
     */
    public function encrypt($original_text);

    /**
     * @param $encrypted_text
     * @return mixed
     */
    public function decipher($encrypted_text);
}