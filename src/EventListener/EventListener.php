<?php
/**
 * Created by PhpStorm.
 * User: acf
 * Date: 23/11/2018
 * Time: 13:37
 */

namespace App\EventListener;


use App\Entity\ReservationEvent;
use App\Entity\ReservationHotel;
use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Utils\CodeGenerator;


class EventListener
{

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        $codeGenerator = new CodeGenerator();
        $entityManager = $args->getEntityManager();

        if ($entity instanceof ReservationEvent) {
            $generatedCode = $codeGenerator->eventCodeGenerator($entity);
            $entity->setCode($generatedCode);
            $entityManager->persist($entity);
            $entityManager->flush();

        }


        if ($entity instanceof ReservationHotel) {
            $generatedCode = $codeGenerator->hotelCodeGenerator($entity);
            $entity->setCode($generatedCode);
            $entityManager->persist($entity);
            $entityManager->flush();
        }


    }
}