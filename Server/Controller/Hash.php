<?php

namespace Server\Controller;

use Server\Hashes\GostCrypto;
use Server\Hashes\HMAC;
use Server\Hashes\SHA512;
use Server\Utils;

/**
 * Class Hash
 * Controller for Hash section
 * @author James Miranda <jameswpm@gmail.com>
 * @package Server\Controller
 */
class Hash
{
    /**
     * @var $text_to_hash
     */
    protected $text_to_hash;


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
        header('Location: ' . "pages/hash.php");

        exit();
    }

    /**
     * Method getHash
     * Get the 3 different hashes
     */
    public function getHash()
    {
        $data = Utils::decodeRequest();
        $plain = $data->plain;
        $compare = $data->compare;

        try {
            if(empty($compare)) {
                //just get the hashes
                $sha512 = new SHA512();
                $hmac = new HMAC();
                $gc = new GostCrypto();
                $sha_hash = $sha512->getHash($plain);
                $hmac_hash = $hmac->getHash($plain);
                $gc_hash = $gc->getHash($plain);

                echo json_encode(["results" => "true", "sha512" => $sha_hash, "hmac"=> $hmac_hash, "gc" => $gc_hash]);
            } else {
                //make comparisson
                $sha512 = new SHA512();
                $hmac = new HMAC();
                $gc = new GostCrypto();

                $sha_hash = $sha512->getHash($plain);
                $hmac_hash = $hmac->getHash($plain);
                $gc_hash = $gc->getHash($plain);

                $json = json_encode(["compare" => "true",
                    "sha512" => $sha_hash,
                    "hmac"=> $hmac_hash,
                    "gc" => $gc_hash,
                    "shaCcompare" => $sha_hash == $compare,
                    "hmacCompare"=> $hmac_hash == $compare,
                    "gcCompare" => $gc_hash == $compare]);

                echo $json;

            }

        } catch (\Exception $e)
        {
            echo "false";
        }
    }

}

