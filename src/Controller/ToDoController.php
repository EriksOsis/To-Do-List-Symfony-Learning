<?php

namespace App\Controller;

use App\Entity\Task;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToDoController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/', name: 'app_to_do')]
    public function index(): Response // READ
    {
        $tasks = $this->doctrine->getRepository(Task::class)->findBy([], ['id' => 'DESC']);
        return $this->render('to_do/index.html.twig', ['tasks' => $tasks]);
    }

    #[Route('/create', name: 'create_task', methods: 'POST')]
    public function create(Request $request): Response // CREATE
    {
        $title = trim($request->request->get('title'));
        if (empty($title)) {
            return $this->redirectToRoute('app_to_do');
        }

        $entityManager = $this->doctrine->getManager();

        $task = new Task();
        $task->setTitle($title);
        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('app_to_do');

    }

    #[Route('/switch-status/{id}', name: 'switch_status')]
    public function switchStatus($id): Response // UNDO
    {
        $entityManager = $this->doctrine->getManager();
        $task = $entityManager->getRepository(Task::class)->find($id);

        $task->setStatus(!$task->isStatus());
        $entityManager->flush();

        return $this->redirectToRoute('app_to_do');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Task $id): Response // DELETE
    {
        $entityManager = $this->doctrine->getManager();

        $entityManager->remove($id);
        $entityManager->flush();

        return $this->redirectToRoute('app_to_do');
    }
}
