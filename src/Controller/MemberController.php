<?php

namespace App\Controller;
use App\Controller\BaseController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RequestStack;

class MemberController extends BaseController
{

     public function __construct(AuthenticationUtils $authenticationUtils , ManagerRegistry $registry , RequestStack $request){
                 parent::__construct($authenticationUtils,$registry,$request);
      }

    #[Route('/UserProfile', name: 'member_profile')]
    public function UserProfile(): Response
    {
        return $this->render('member/UserProfile.html.twig', [
            'controller_name' => 'MemberController',
        ]);
    }
}
