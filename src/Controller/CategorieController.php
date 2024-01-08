<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CategorieType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CategorieController extends AbstractController
{

    #[Route('/categorie', name: 'categorie.index', methods: ['GET'])]
    public function index(CategorieRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $categories = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/categorie/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/categorie/new', name: 'categorie.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $categorie = $form->getData();
            $manager->persist($categorie);
            $manager->flush();
            $this->addFlash('success', 'La catégorie a bien été ajoutée.');
            return $this->redirectToRoute('categorie.index');
        }
        return $this->render('pages/categorie/new.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/categorie/edition/{id}', name: 'categorie.edit', methods: ['GET', 'POST'])]
    public function edit(Categorie $categorie, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $categorie = $form->getData();
            $manager->persist($categorie);
            $manager->flush();
            $this->addFlash('success', 'La catégorie a bien été modifiée.');
            return $this->redirectToRoute('categorie.index');
        }
        return $this->render('pages/categorie/edit.html.twig',
            [
                'form' => $form->createView()
            ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/categorie/suppression/{id}', name: 'categorie.delete', methods: ['GET'])]
    public function delete(Categorie $categorie,EntityManagerInterface $manager): Response
    {
        $manager->remove($categorie);
        $manager->flush();
        $this->addFlash('success', 'La catégorie a bien été supprimée.');
        return $this->redirectToRoute('categorie.index');
    }

}
