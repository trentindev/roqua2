<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
  #[Route('/user/{id}', name: 'user')]
  #[IsGranted('ROLE_USER')]
  public function userProfile(User $user): Response
  {
    $currentUser = $this->getUser();
    if ($currentUser === $user) {
      return $this->redirectToRoute('current_user');
    }
    return $this->render('user/show.html.twig', [
      'user'=>$user
    ]);
  }

  #[Route('/user', name: 'current_user')]
  #[IsGranted('ROLE_USER')]
  public function currentUserProfile(): Response
  {
    return $this->render('user/index.html.twig', [
      'controller_name' => 'Profil'
    ]);
  }
}
