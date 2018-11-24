<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @Security("has_role('ROLE_ADMIN')")
 * @package App\Controller
 */
class DashboardController extends Controller
{

    /**
     * @Route("/back", name="dashboard")
     */
    public function DashboardAction()
    {
        return $this->render('back/dashboard.html.twig', []);
    }
}
