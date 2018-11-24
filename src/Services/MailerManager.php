<?php
/**
 * Created by PhpStorm.
 * User: abc, air
 * Date: 11/10/2016
 * Time: 16:21
 */

namespace App\Services;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\Common\Collections\ArrayCollection;


class MailerManager
{

    private $fromName = 'no-reply';
    private $fromAdress = 'no-reply@auf.org';

    private $mailer;
    private $container;
    private $accessor;

    
    public function __construct($mailer)
    {
        $this->mailer = $mailer;

        $this->accessor = PropertyAccess::createPropertyAccessor();
    }
    
	/**
	 * Send notification (emails) with/without attachments
	 * @param mixed $contacts
	 * @param string $message
	 * @param string $subject
	 * @param array $attachs
	 */
    public function notify($contacts, $message, $subject, array $attachs = null){
        if(!is_array($contacts)){
            $contacts = array($contacts);
        }
        array_walk($contacts,function(&$item,$key){
            if($item instanceof User){
                $item = array('mail' => $item->getEmail(),'name' => $item->getFirstname());
            }
        });
        $this->sendMessage($contacts, $subject, $message, $attachs);
    }

    /**
     * @param $subject
     * @param $messageBody
     * @param $contacts : array containing arrays with structure array('mail' => , 'name' => )
     */
    private function sendMessage(array $contacts, $subject = '', $messageBody = '', array $attachs = null)
    {

        if (array_key_exists('mail',$contacts)) {
            $contacts = array($contacts);
        }
        foreach ($contacts as $contact) {



            $message = (new \Swift_Message())
                ->setSubject($subject)
                ->setFrom(array($this->fromAdress => $this->fromName))
                // set the destination mailer, and if is defined add the destination name..The mail will be used as name else.
                ->setTo($contact['mail'],isset($contact['name'])?$contact['name']:$contact['mail'])
                ->setBody($messageBody, 'text/html');

            if($attachs != null && count($attachs)>0){
                foreach ($attachs as $attach) {
                    $message->attach(new \Swift_Attachment(
                        $attach
                    ));
                }
            }
            
            $this->mailer->send($message);
        }
    }
        
    /**
     * SetContainer
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container)
    {
    	$this->container = $container;
    }
    
    
/**
 * Notification
 */
    /**
     * @param array $patterns
     * @return array
     */
    public function extractPatterns(array $patterns)
    {
    	$recipientPatterns = new ArrayCollection();
    	$dataPatterns = new ArrayCollection();
    
    	foreach ($patterns as $key => $pattern) {
    		$prefix = explode('_', $pattern->getPropertyPath())[0];
    
    		if ($prefix === 'recipient') {
    			$recipientPatterns->add($pattern);
    		} else {
    			$dataPatterns->add($pattern);
    		}
    	}
    
    	return ['recipient' => $recipientPatterns, 'data' => $dataPatterns];
    }
    
    /**
     * Replacing contact patterns "%recipient_...%"
     * @param User $contact
     * @param $message
     * @param ArrayCollection $recipientPatterns
     * @return string
     */
    public function replaceContactPatterns(User $contact, $message, ArrayCollection $recipientPatterns)
    {
    	foreach ($recipientPatterns as $pattern) {
    		$replacement = false;
    		$suffix = explode('_', $pattern->getPropertyPath())[1];
    		$fqdn = $pattern->getClassPath();
    
    
    		if (!class_exists($fqdn)) {
    			if ($this->container->has($fqdn)) {
    				//$setterMethod = 'set' . ucfirst($suffix);
    				$getterMethod = 'get' . ucfirst($suffix);
    				//$this->container->get($fqdn)->$setterMethod(["user" => $contact]);
    				$replacement = $this->container->get($fqdn)->$getterMethod(["user" => $contact]);
    			}
    		}
    
    		if ($contact instanceof $fqdn) {
    			$replacement = $this->accessor->getValue($contact, $suffix);
    		}
    
    		if (is_object($replacement)) {
    			$replacement = false;
    		}
    
    		if ($replacement !== FALSE) {
    			$message = strtr($message, ['%recipient_' . $suffix . '%' => $replacement]);
    		}
    	}
    
    	return $message;
    }

    /**
     * 
     * @param ArrayCollection $dataCollection
     * @param string $message
     * @param ArrayCollection $dataPatterns
     * @return \Application\CoreBundle\Services\string|string
     */
    public function replaceMessagePatterns( $dataCollection, $message, $dataPatterns)
    {
    	$dataTemp = array();

    	foreach ($dataPatterns as $pattern) {
    		
    		if(!preg_match("/%".$pattern->getPropertyPath()."%/", $message)){    			
    			continue;
    		}
    		$prefix = explode('_', $pattern->getPropertyPath())[0];
    		$suffix = explode('_', $pattern->getPropertyPath ())[1];
			
			$replacement = false;
			foreach ( $dataCollection as $data ) {
				
				if (is_array($data)){
					//To Specify the specific parent to match
	    			if(isset($data['askedPrefix']) && !empty($data['askedPrefix']) && $data['askedPrefix'] !== $prefix){
	    				 continue;
	    			}    
	    			//re-affect data
	    			if(isset($data['data']))$data = $data['data'];
    			}
    			
    			$fqdn = $pattern->getClassPath();
    
    			if (!class_exists($fqdn)) {
    				if ($this->container->has($fqdn)) {
    					$getterMethod = 'get' . ucfirst($suffix);
    					$replacement = $this->container->get($fqdn)->$getterMethod(["data" => $data]);
    				}
    			}

    			if ( ($data instanceof $fqdn)   ) { 
    				$replacement = $this->accessor->getValue($data, $suffix);
    				if ($replacement instanceof \DateTime) {//for dateTime type it can be avoided by changing the pattern by pattern.date
    					$replacement = $replacement->format('d-m-Y');
    				}    				 		
    			}
  
    			if (is_object($replacement)) {//if the replacement is an object so it not handled by the replacement
    				$replacement = false;
    			}
    			
    			if ($replacement !== FALSE) { // if replacement exist update the message's body using it   				
    				$message = strtr($message, array('%' . $pattern->getPropertyPath() . '%' => $replacement));
    				break;
    			}
    
    		}
    	}

    	return $message;
    }

	
    
    
    
    
    
}