<?php

namespace App\Model;



/**
 * Description of CurlInterface
 *
 * @author Aymen Amairia <aymen.amairia@wevioo.com>
 */
interface CurlInterface
{
	
    /**
     * REST CLIENT Through CURL
     * @param string $url
     * @param string $data Data: array("param" => "value") ==> index.php?param=value
     * @param string $method Method: POST, PUT, GET etc
     * @return mixed
     */
    public function client($url, $data = false, $method = 'GET', $header= array());

}
