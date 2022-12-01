<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
  #[Route('/', name: 'home')]
  public function index(): Response {
    // Fake question remove after doctrine implémentation
    $questions = [
      [ 'id' => '1',
        'title' => 'Je suis une super question',
        'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit, soluta repellat. Modi, quibusdam eligendi. Natus cupiditate, a accusantium inventore suscipit modi minima recusandae tempora! Modi sit repudiandae accusamus incidunt reprehenderit?',
        'rating' => 20,
        'author' => [
          'name' => 'Paul Aroide',
          'avatar' => 'https://randomuser.me/api/portraits/men/41.jpg'
        ],
        'nbrOfResponse' => 15
      ],
      [
        'id' => '2',
        'title' => 'Comment cuire les choux de bruxelle ?',
        'content' => ' Sit, soluta repellat. Modi, quibusdam eligendi. Picolo ipsum dolor sit, amet consectetur adipisicing elit.  Natus cupiditate, a accusantium inventore suscipit modi minima recusandae tempora! Modi sit repudiandae accusamus incidunt reprehenderit?',
        'rating' => 8,
        'author' => [
          'name' => 'Hillarie Vanbus',
          'avatar' => 'https://randomuser.me/api/portraits/women/27.jpg'
        ],
        'nbrOfResponse' => 23
      ],
      [
        'id' => '3',
        'title' => 'Quel est la méthode la plus cool',
        'content' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sit, soluta repellat. Modi, quibusdam eligendi. Natus cupiditate, a accusantium inventore suscipit modi minima recusandae tempora! Modi sit repudiandae accusamus incidunt reprehenderit?',
        'rating' => 12,
        'author' => [
          'name' => 'Elma Tej',
          'avatar' => 'https://randomuser.me/api/portraits/women/41.jpg'
        ],
        'nbrOfResponse' => 25
      ],
      [
        'id' => '4',
        'title' => 'Comment annuler un commit',
        'content' => 'Commit dolor met polidior consectetur adipisicing elit. Sit, soluta repellat. Modi, quibusdam eligendi. Natus cupiditate, a accusantium inventore suscipit modi minima recusandae tempora! Modi sit repudiandae accusamus incidunt reprehenderit?',
        'rating' => -12,
        'author' => [
          'name' => 'Amedeous Danlaquesse',
          'avatar' => 'https://randomuser.me/api/portraits/men/51.jpg'
        ],
        'nbrOfResponse' => 7
      ],
    ];

    return $this->render('home/index.html.twig', [
      'controller_name' => 'HomeController',
      'questions' => $questions
    ]);
  }
}
