<?php

namespace Server\Hashes;

/**
 * Class SHA512
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Hashes
 */
class SHA512 implements Hash
{

    /**
     * @param $plain_text
     * @return string
     */
    public function getHash($plain_text)
    {
       return hash('sha512', $plain_text);
    }
}