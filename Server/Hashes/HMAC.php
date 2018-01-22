<?php

namespace Server\Hashes;

/**
 * Class HMAC
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Hashes
 */
class HMAC implements Hash
{

    /**
     * @var string $key
     * @see http://www.sethcardoza.com/tools/random-password-generator/
     */
    private $key = 'DBR7vUx9_U)%uq(e';

    /**
     * @param $plain_text
     * @return string
     */
    public function getHash($plain_text)
    {
        return hash_hmac('sha256', $plain_text, $this->key);
    }
}