<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\FormLoginAuthenticator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use App\Repository\UserRepository;
use App\Entity\ResetPassword;
use App\Repository\ResetPasswordRepository;
use Symfony\Component\Validator\Constraints\NotBlank;


class SecurityController extends AbstractController {

  public function __construct(
    private FormLoginAuthenticator $authenticator
  ) {
  }

  #[Route('/signup', name: 'signup')]
  public function signup(UserAuthenticatorInterface $userAuthenticator, Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher, MailerInterface $mailer) {
    $user = new User();
    $userForm = $this->createForm(UserType::class, $user);
    $userForm->handleRequest($request);
    if ($userForm->isSubmitted() && $userForm->isValid()) {
      $hash = $passwordHasher->hashPassword($user, $user->getPassword());
      $user->setPassword($hash);
      $em->persist($user);
      $em->flush();
      $this->addFlash('success', 'Bienvenue sur Wonder !');
      $email = new TemplatedEmail();
      $email->to($user->getEmail())
        ->subject('Bienvenue sur Roqua')
        ->htmlTemplate('@email_templates/welcome.html.twig')
        ->context([
          'username' => $user->getFirstname()
        ]);
      $mailer->send($email);


      return $userAuthenticator->authenticateUser($user, $this->authenticator, $request);
    }
    return $this->render('security/signup.html.twig', ['form' => $userForm->createView()]);
  }


  #[Route("/login", name: "login")]
  public function login(AuthenticationUtils $authenticationUtils): Response {
    if ($this->getUser()) {
      return $this->redirectToRoute('home');
    }
    $error = $authenticationUtils->getLastAuthenticationError();
    $lastUsername = $authenticationUtils->getLastUsername();
    return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
  }

  #[Route("/logout", name: "logout")]
  public function logout() {
  }

  #[Route('/reset-password/{token}', name: 'reset-password')]
  public function resetPassword() {
    return $this->json('');
  }

  #[Route('/reset-password-request', name: 'reset-password-request')]
  public function resetPasswordRequest(MailerInterface $mailer, Request $request, UserRepository $userRepository, ResetPasswordRepository $resetPasswordRepository, EntityManagerInterface $em)
  {
    $emailForm = $this->createFormBuilder()->add('email', EmailType::class, [
      'constraints' => [
        new NotBlank([
          'message' => 'Veuillez renseigner votre email'
        ])
      ]
    ])->getForm();
    $emailForm->handleRequest($request);
    if ($emailForm->isSubmitted() && $emailForm->isValid()) {
      $emailValue = $emailForm->get('email')->getData();
      $user = $userRepository->findOneBy(['email' => $emailValue]);
      if ($user) {
        $oldResetPassword = $resetPasswordRepository->findOneBy(['user' => $user]);
        if ($oldResetPassword) {
          $em->remove($oldResetPassword);
          $em->flush();
        }
        $resetPassword = new ResetPassword();
        $resetPassword->setUser($user);
        $resetPassword->setExpireAt(new \DateTimeImmutable('+2 hours'));
        $token = substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(30))), 0, 20);
        $resetPassword->setToken($token);
        $em->persist($resetPassword);
        $em->flush();
        $email = new TemplatedEmail();
        $email->to($emailValue)
          ->subject('Demande de réinitialisation de mot de passe')
          ->htmlTemplate('@email_templates/reset_password_request.html.twig')
          ->context([
            'token' => $token
          ]);
        $mailer->send($email);
      }
      $this->addFlash('success', 'Un email vous a été envoyé pour réinitialiser votre mot de passe');
      return $this->redirectToRoute('home');
    }

    return $this->render('security/reset_password_request.html.twig', [
      'form' => $emailForm->createView()
    ]);
  }
}
