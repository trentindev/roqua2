<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactInfoController extends AbstractController
{
    #[Route('/contact/info', name: 'app_contact_info')]
    public function index(): Response
    {
        return $this->render('contact_info/index.html.twig', [
            'controller_name' => 'ContactInfoController',
        ]);
    }
}
