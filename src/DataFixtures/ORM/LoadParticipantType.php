<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 19/08/2017
 * Time: 18:27
 */

namespace App\DataFixtures\ORM;

use App\Entity\ParticipantType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadParticipantType extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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
        return 2;
    }

    public function load(ObjectManager $manager)
    {
        $participantTypes = [
            0 => [
                "label" => "Participant",

            ],
            1 => [
                "label" => "Intervenant",

            ],
            2 => [
                "label" => "Invité",

            ],
            3 => [
                "label" => "VIP",

            ],
            4 => [
                "label" => "Organisation",

            ],
        ];

        foreach ($participantTypes as $key => $participantType_item){
            $participantType = new ParticipantType();

            $participantType->setlabel($participantType_item["label"]);


            $this->addReference('participant_type_'.$key , $participantType);

            $manager->persist($participantType);
        }

        $manager->flush();
    }
}