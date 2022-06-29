<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Video;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;


class DefaultController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/default', name: 'app_default')]
    public function index(Request $request): Response
    {
//        $entityManager = $this->doctrine->getManager();
//
//        $user = new User();
//
//        $user->setName("Ēriks");
//
//        for ($i = 1; $i <= 3; $i++) {
//            $video = new Video();
//            $video->setTitle('Video title -' . $i);
//            $user->addVideo($video);
//            $entityManager->persist($video);
//        }
//
//        $entityManager->persist($user);
//        $entityManager->flush();

//        $video = $this->doctrine
//            ->getRepository(Video::class)
//            ->find(1);
//
////        dump($video->getUser());
//        dump($video->getUser()->getName());

        return $this->render('default/index.html.twig');
    }
}
