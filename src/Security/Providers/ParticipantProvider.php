<?php
/**
 * Created by PhpStorm.
 * User: air
 * Date: 19/08/2017
 * Time: 17:59
 */

namespace App\Security\Providers;


use App\Entity\Participant;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ParticipantProvider implements UserProviderInterface
{

    private $entityManager;

    public function setEntityManager($entityManager){
        $this->entityManager = $entityManager;
    }

    public function loadUserByUsername($username)
    {

        $user = $this->entityManager->getRepository("App:Participant")->loadUserByUsername($username);

        if (!empty($user)) {

            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof Participant) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return Participant::class === $class;
    }
}