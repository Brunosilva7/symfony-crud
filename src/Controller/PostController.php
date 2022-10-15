<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

//Crud controller
/**
 *@Route("/post", name="post.")
*
*/
class PostController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}

     /**
     *@Route("/", name="index")
    *
    */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        return $this->render('post/index.html.twig', [
            "posts" => $posts,
        ]);
    }

     /**
     *@Route("/create", name="create")
    * @param Request $request
    * @return Response
    */

    public function create(Request $request)
    {
        // create a new post

        $post = new Post();

        //getting the object inside the form
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        $form->getErrors();
        if($form->isSubmitted() && $form->isValid()){
            //entity manager
            $em = $this->doctrine->getManager();
            $em -> persist($post);
            $em->flush();

            $this->addFlash('success', 'The form was submitted successfully!');
            return $this->redirect($this->generateUrl('post.index'));

        }


        // if your controller extends the AbstractController class
        return $this->render('post/create.html.twig',[
            "form" => $form->createView(),
        ]);
    }

     /**
     *@Route("/show/{id}", name="show")
    * @param Post $post
    * @return Response
    */
     public function show(Post $post){
        return $this->render('post/show.html.twig',[
            "post" => $post
        ]);
     }

     /**
      *
      * @Route("/delete/{id}", name="delete")
      */
     public function remove(Post $post) {
        $em  = $this->doctrine->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was removed successfully');
        return $this->redirect($this->generateUrl('post.index'));

     }



}
