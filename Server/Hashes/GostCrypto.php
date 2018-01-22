<?php

namespace Server\Hashes;

/**
 * Class GostCrypto
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Hashes
 */
class GostCrypto implements Hash
{

    /**
     * @param $plain_text
     * @return string
     */
    public function getHash($plain_text)
    {
        return hash('gost-crypto', $plain_text);
    }
}