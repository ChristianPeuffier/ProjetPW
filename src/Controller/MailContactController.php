<?php

namespace App\Controller;

use App\Repository\MailContactRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailContactController extends AbstractController
{
    #[Route('/mailContact', name: 'mailContact.index')]
    public function index(MailContactRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $mails = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/mailContact/index.html.twig', [
            'mails' => $mails
        ]);
    }
}
