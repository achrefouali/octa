<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 19/08/2017
 * Time: 18:27
 */

namespace App\DataFixtures\ORM;

use App\Entity\Participant;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadParticipant extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getOrder()
    {
        return 3;
    }

    public function load(ObjectManager $manager)
    {
        $participants = [
            0 => [
                "firstname" => "karim",
                "lastname" => "Sahab Ettabaa",
                "email" => "karim@travelportal.cz",
                "username" => "karim@travelportal.cz",
                "password" => "cadmin2309",
                "type" => $this->getReference('participant_type_0'),
                "societe" => "Conf2018",
                "poste" => "Poste Conf2018",
                "telephone" => "+216000000",
                "telephone2" => "+216000000",
                'roles' => array($this->getReference('ROLE_ADMIN')),
            ],

        ];
                //responsable produit
        foreach ($participants as $key => $participant_item){
            $participant = new Participant();

            $participant->setFirstname($participant_item["firstname"]);
            $participant->setLastname($participant_item["lastname"]);
            $participant->setEmail($participant_item["email"]);
            $participant->setUsername($participant_item["username"]);
            $participant->setType($participant_item["type"]);
            $participant->setSociete($participant_item["societe"]);
            $participant->setPoste($participant_item["poste"]);
            $participant->setTelephone($participant_item["telephone"]);
            $participant->setTelephone2($participant_item["telephone2"]);
            $participant->setRoles($participant_item['roles']);

            $participant->setSalt(md5(uniqid()));

            // the 'security.password_encoder' service requires Symfony 2.6 or higher
            $encoder = $this->container->get('security.password_encoder');
            $password = $encoder->encodePassword($participant, $participant_item["password"]);
            $participant->setPassword($password);

            $this->addReference('participant_'.$key , $participant);

            $manager->persist($participant);
        }

        $manager->flush();
    }
}