<?php

namespace Server\Controller;

use Server\Crypto\AES;
use Server\Crypto\Caesar;
use Server\Crypto\TripleDES;
use Server\Utils;

/**
 * Class Crypto
 * Controller for Crypto section
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class Crypto
{
    /**
     * @var $original_text
     */
    protected $original_text;


    public function __construct()
    {
        session_start();
    }

    /**
     * Method view
     * Method that loads the devices page info and redirect the user to the page
     */
    public function view()
    {
        header('Location: ' . "pages/crypto.php");

        exit();
    }

    /**
     * Method encrypt
     * Create the encryption of each configured method
     */
    public function encrypt()
    {
        $data = Utils::decodeRequest();
        $original = $data->original;

        try {
            $caesar = new Caesar();
            $aes =  new AES();
            $tdes = new TripleDES();
            $aes_cipher = $aes->encrypt($original);
            $caesar_cipher = $caesar->encrypt($original);
            $tdes_cipher = $tdes->encrypt($original);
            $json = json_encode(["caesar" => $caesar_cipher, "aes"=> $aes_cipher, "tdes" => $tdes_cipher]);
            echo $json;
        } catch (\Exception $e)
        {
            echo "false";
        }
    }

    /**
     * Method decipher
     * Return the deciphered text of each configured method
     */
    public function decipher()
    {
        $data = Utils::decodeRequest();
        $original = $data->original;

        try {
            $caesar = new Caesar();
            $aes =  new AES();
            $tdes = new TripleDES();
            $aes_cipher = $aes->decipher($original) ? $aes->decipher($original) : 'Impossível decifrar';
            $caesar_cipher = $caesar->decipher($original) ? $caesar->decipher($original): 'Impossível decifrar';
            $tdes_cipher = $tdes->decipher($original) ? $tdes->decipher($original) : 'Impossível decifrar';
            $json = json_encode(["caesar" => $caesar_cipher, "aes"=> $aes_cipher, "tdes" => $tdes_cipher]);

            echo $json;
        } catch (\Exception $e)
        {
            echo "false";
        }
    }

}

