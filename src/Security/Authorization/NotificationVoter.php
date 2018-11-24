<?php


namespace App\Security\Authorization;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use App\Entity\Notification;

class NotificationVoter extends Voter
{
    
private $decisionManager;

    const LISTING = 'listing';


    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

	///
	 protected function supports($attribute, $subject)
    {
        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(
                self::LISTING,
                )
            )
        ) {
            return false;
        }

        // only vote on Post objects inside this voter
        if (!$subject instanceof Notification) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('IS_AUTHENTICATED_FULLY'))) {
            return Voter::ACCESS_GRANTED;
        }
        // ... all the normal voter logic
        $user = $token->getUser();

        if (!($user instanceof UserInterface)) {
            // the user must be logged in; if not, deny access
            return false;
        }

        switch ($attribute) {
            case self::LISTING:
                return $this->canList($subject, $user);
                break;
        }

        return Voter::ACCESS_ABSTAIN;
    }




  /**
   * Vérifie que l'utilisateur connecté a le droit d'éditer un notification.
   * @param  UserInterface $user     L'utilisateur connecté
   * @param  Notification      $subject L'objet notification
   * @return int                     -1 si l'accès n'est pas autorisé, 1 s'il l'est 0 si le Voter laisse de système de sécurité répondre.
   */
    public function canList(Notification $subject, UserInterface $user)
    {

        // that checks a boolean $private property
        return Voter::ACCESS_ABSTAIN;
    }
}