<?php

namespace App\Controller;

use App\Entity\Licencie;
use App\Form\CategorieType;
use App\Form\LicencieType;
use App\Repository\LicencieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LicencieController extends AbstractController
{
    #[Route('/licencie', name: 'licencie.index', methods: ['GET'])]
    public function index(LicencieRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {
        $licencies = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/licencie/index.html.twig', [
            'licencies' => $licencies
        ]);
    }

    #[Route('licencie/new', name: 'licencie.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $licencie = new Licencie();
        $form = $this->createForm(LicencieType::class, $licencie);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $categorie = $form->getData();
            $manager->persist($categorie);
            $manager->flush();
            $this->addFlash('success', 'Le licencie a bien été ajoutée.');
            return $this->redirectToRoute('licencie.index');
        }
        return $this->render('pages/licencie/new.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    #[Route('/licencie/edition/{id}', name: 'licencie.edit', methods: ['GET', 'POST'])]
    public function edit(Licencie $licencie, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(LicencieType::class, $licencie);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $licencie = $form->getData();
            $manager->persist($licencie);
            $manager->flush();
            $this->addFlash('success', 'Le licencie a bien été modifiée.');
            return $this->redirectToRoute('licencie.index');
        }
        return $this->render('pages/licencie/edit.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    #[Route('/licencie/suppression/{id}', name: 'licencie.delete', methods: ['GET'])]
    public function delete(Licencie $licencie,EntityManagerInterface $manager): Response
    {
        $manager->remove($licencie);
        $manager->flush();
        $this->addFlash('success', 'Le licencié a bien été supprimée.');
        return $this->redirectToRoute('licencie.index');
    }
}
