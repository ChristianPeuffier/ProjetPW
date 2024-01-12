<?php

namespace App\Controller;

use App\Repository\MailEduRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailEduController extends AbstractController
{
    #[Route('/mailedu', name: 'mailedu.index')]
    public function index(MailEduRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $mails = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/mailedu/index.html.twig', [
            'mails' => $mails
        ]);
    }
}
