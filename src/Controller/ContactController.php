<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * Affiche la liste des contacts
     *
     * @param ContactRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    #[Route('/contact', name: 'contact.index', methods: ['GET'])]
    public function index(ContactRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {
        $contacts = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('pages/contact/index.html.twig', [
            'contacts' => $contacts
        ]);
    }

    #[Route('/contact/new', name: 'contact.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() and $form->isValid()) {
            $contact = $form->getData();
            $manager->persist($contact);
            $manager->flush();
            $this->addFlash('success', 'Le contact a bien été ajouté.');
            return $this->redirectToRoute('contact.index');
        }
        return $this->render('pages/contact/new.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    #[Route('/contact/edition/{id}', name: 'contact.edit', methods: ['GET', 'POST'])]
    public function edit(Contact $contact, Request $request, EntityManagerInterface $manager):Response{

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', 'Le contact a bien été modifié.');
            return $this->redirectToRoute('contact.index');
        }
        return $this->render('pages/contact/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('/contact/suppression/{id}', name: 'contact.delete', methods: ['GET'])]
    public function delete(Contact $contact, EntityManagerInterface $manager):Response{
        $manager->remove($contact);
        $manager->flush();
        $this->addFlash('success', 'Le contact a bien été supprimé.');
        return $this->redirectToRoute('contact.index');
    }

}
