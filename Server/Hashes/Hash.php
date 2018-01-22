<?php

namespace Server\Hashes;


/**
 * Interface Hash
 * Define base methods for all hash classes
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Hashes
 */
interface Hash {

    /**
     * @param $plain_text
     * @return mixed
     */
    public function getHash($plain_text);
}