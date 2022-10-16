<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {}

    #[Route('/register', name: 'register')]
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $form = $this->createFormBuilder()
        ->add('username', TextType::class)
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'The password fields must match.',
            'options' => ['attr' => ['class' => 'password-field']],
            'required' => true,
            'first_options'  => ['label' => 'Password'],
            'second_options' => ['label' => 'Confirm Password'],
        ])

        ->add('register', SubmitType::class,[
            'attr' => [
                'class' => 'btn btn-success float-end',
            ]
        ])
        ->getForm();

        $form ->handleRequest($request);

        if($form->isSubmitted()){
             $user  = new User();
            //entity manager
            $em = $this->doctrine->getManager();
            $em -> persist($user);
            $em ->flush();

            $this->addFlash('success', 'The form was submitted successfully!');
            // return $this->redirect($this->generateUrl('post.index'));

        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
