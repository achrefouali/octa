<?php
namespace App\Services;

use App\Entity\Participant;
use App\Model\CurlInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Translation\TranslatorInterface;
use Application\CoreBundle\Utils\YMLParser;


class CurlManagerService implements CurlInterface
{

    private $em;
    private $translator;
    private $mailer;
    private $siParameters;
    private $container;


    public function getParameter()
    {
        $parameters = YMLParser::parse();

        return $parameters;
    }


    /**
     *
     * {@inheritDoc}
     * @see \Application\CoreBundle\Model\MoodleInterface::client()
     */
    function client($url, $data = false, $method = 'GET', $header = array(), $body=false)
    {

        $curl = curl_init();
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // To delete in prod for dev purpose only
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // To delete in prod for dev purpose only
		
        switch ($method)
            {
            case "POST" :
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data){                   
                    curl_setopt($curl, CURLOPT_POSTFIELDS, ($body)?json_encode($data) : http_build_query($data));
                    }
                break;
            case "PATCH" :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
                if ($data){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, ($body)?json_encode($data) : http_build_query($data));
                    }
                break;
            case "PUT" :
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            case "DELETE" :
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                if ($data){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, ($body)?json_encode($data) : http_build_query($data));
                }
                break;
            default :
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
                break;
        }


    	// Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($curl);
        $err = curl_error($curl);
//        $info = curl_getinfo($curl);
//        dump($header);

        curl_close($curl);

        if ($err) {
            return ['success' => FALSE, "response" => ['error'=>"cURL Error #:", 'message'=> $err]];
        }

        return ['success' => TRUE, "response" => $response];
    }

    /**
     * @param string $resultats
     * @param Model $class
     * @param string $type XML|JSON
     * @return object
     */
    public function serializerClient($resultats, $class, $type='json'){
        $serializer = new Serializer( array(new ObjectNormalizer()), array(new XmlEncoder(), new JsonEncoder()));
        $json = json_encode($resultats);
        return $objCopy = $serializer->deserialize($json, $class, $type);
    }




}