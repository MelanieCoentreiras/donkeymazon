<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('category/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
        ]);
    }
    // liaison avec l'id de la categorie
    #[Route('/categories/{id<^\d+$>}', name: 'app_categories_show')]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    // route pour la création de catégorie
    #[Route('/categories/new', name: 'app_categories_new')]
    public function new(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);

        //si $form est envoyé et le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            
            // je veux persister/save les données du form
            $entityManagerInterface->persist($form->getData());
            // j'enregistre dans la bdd
            $entityManagerInterface->flush();
            // je fais une redirection sur la liste des catégories
            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/categories/{id<^\d+$>}/edit', name: 'app_categories_edit')]
    public function edit(Category $category, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        // affiche le form et renvoie le nom de la categorie $category
        $form = $this->createForm(CategoryType::class, $category); // je crée le formulaire et lui passe l'objet à éditer, ici $category
        $form->handleRequest($request); // pour re remplir le form

        //si $form est envoyé et le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // tu prends la modif et tu l'enregistres
            $entityManagerInterface->flush();
            // je fais une redirection sur la liste des catégories
            return $this->redirectToRoute('app_categories');
        }

        return $this->render('category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }
}