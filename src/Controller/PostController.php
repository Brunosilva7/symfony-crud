<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Flasher\Prime\FlasherInterface;

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

        $post->setTitle('This is the title!');


        //entity manager
        $em = $this->doctrine->getManager();
        $em -> persist($post);
        $em->flush();
        // if your controller extends the AbstractController class
        return $this->addFlash('success', 'Your post were created!');
        return $this->redirect($this->generateUrl('post.index'));
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
      * @Route("/delete/{id}", name="delete")
      */
     public function remove(Post $post) {
        $em  = $this->doctrine->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirect($this->generateUrl('post.index'));
     }

     public function save(FlasherInterface $flasher): Response
     {
         // ...

         $flasher->addSuccess('Book saved successfully');

         return $this->render('book/index.html.twig');
     }

}
