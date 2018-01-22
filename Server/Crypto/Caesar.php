<?php

namespace Server\Crypto;

/**
 * Class Caesar
 * Implements Caesar encrypt/decrypt
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Crypto
 */
class Caesar implements Cipher {

    /**
     * @param $original_text
     * @return mixed
     */
    public function encrypt($original_text)
    {
        $result = '';

        $text_size = strlen($original_text);

        for ($i=0 ; $i < $text_size ; $i++) {

            $ascii_num = ord($original_text[$i]);
            if($ascii_num == 90) {
                // 65 is A in asscii table
                $ascii_num = 65;
            }
            else if($ascii_num == 122) {
                // 97 is a in asscii table
                $ascii_num = 97;
            }
            else {
                //original 3 for substituion
                $ascii_num += 3;
            }
            $result[$i] = chr($ascii_num);
        }

        return $result;
    }

    /**
     * @param $encrypted_text
     * @return mixed
     */
    public function decipher($encrypted_text)
    {
        $result = '';

        $text_size = strlen($encrypted_text);

        for ($i=0 ; $i < $text_size ; $i++) {

            $ascii_num = ord($encrypted_text[$i]);
            if($ascii_num == 65) {
                $ascii_num = 90;
            }
            else if($ascii_num == 97) {
                $ascii_num = 122;
            }
            else {
                $ascii_num -= 3;
            }
            $result[$i] = chr($ascii_num);
        }

        return $result;
    }
}