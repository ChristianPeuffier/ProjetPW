<?php

namespace App\Controller;

use App\Entity\Educateur;
use App\Form\EducateurType;
use App\Repository\EducateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EducateurController extends AbstractController
{
    #[Route('/educateur', name: 'educateur.index', methods: ['GET'])]
    public function index(EducateurRepository $repository, PaginatorInterface $paginator,Request $request): Response
    {
        $educateurs = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/educateur/index.html.twig', [
            'educateurs' => $educateurs
        ]);
    }

    #[Route('/educateur/new', name: 'educateur.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $educateur = new Educateur();
        $form = $this->createForm(EducateurType::class, $educateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $educateur = $form->getData();
            $manager->persist($educateur);
            $manager->flush();
            $this->addFlash('success', 'Le educateur a bien été ajoutée.');
            return $this->redirectToRoute('educateur.index');
        }
        return $this->render('pages/educateur/new.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    #[Route('/educateur/edition/{id}', name: 'educateur.edit', methods: ['GET', 'POST'])]
    public function edit(Educateur $educateur, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EducateurType::class, $educateur);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $educateur = $form->getData();
            $manager->persist($educateur);
            $manager->flush();
            $this->addFlash('success', 'Le educateur a bien été modifiée.');
            return $this->redirectToRoute('educateur.index');
        }
        return $this->render('pages/educateur/edit.html.twig',
            [
                'form' => $form->createView(),
                'educateur' => $educateur
            ]);
    }

    #[Route('/educateur/suppression/{id}', name: 'educateur.delete', methods: ['GET', 'POST'])]
    public function delete(Educateur $educateur, EntityManagerInterface $manager): Response
    {
        $manager->remove($educateur);
        $manager->flush();
        $this->addFlash('success', 'Le educateur a bien été supprimée.');
        return $this->redirectToRoute('educateur.index');
    }

}
