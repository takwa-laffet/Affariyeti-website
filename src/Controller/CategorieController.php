<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/categorie')]
class CategorieController extends AbstractController
{
    #[Route('/', name: 'app_categorie_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
            ->getRepository(Categorie::class)
            ->findAll();
    
        return $this->render('categorie/index.html.twig', [
            'categories' => $categories,
        ]);
    }
    
   /* #[Route('/chart', name: 'product_count_by_category_chart', methods: ['GET'])]
    public function productCountByCategoryChart(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
        ->getRepository(Categorie::class)
        ->findAllWithProducts(); // Modify this method to fetch categories with associated products

    $categoriesData = [];
    foreach ($categories as $category) {
        $categoriesData[$category->getNomC()] = count($category->getProduits());
    }

    return $this->render('categorie/chart.html.twig', [
        'categoriesData' => $categoriesData,
    ]);
    }        
    */
    #[Route('/category-chart', name: 'product_category_chart')]
    public function categoryChart(ProduitRepository $produitRepository): Response
    {
        // Récupérer les données des produits par catégorie
        $categoriesData = [];
        $categories = $this->getDoctrine()->getRepository(Categorie::class)->findAll();
        foreach ($categories as $categorie) {
            $categoryId = $categorie->getIdC();
            $produits = $produitRepository->fetchProduitByCategory($categoryId);
            $categoriesData[$categorie->getNomC()] = count($produits);
        }

        return $this->render('categorie/chart.html.twig', [
            'categoriesData' => $categoriesData
        ]);
    }
    
    #[Route('/new', name: 'app_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/{idC}', name: 'app_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{idC}/edit', name: 'app_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/{idC}', name: 'app_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getIdC(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
    }

    //////////////////////// Client functions ///////////
    #[Route('/Client/{id_client}', name: 'Client_categorie_index', methods: ['GET'])]
    public function indexClient(EntityManagerInterface $entityManager , int $id_client): Response
    {
        $categories = $entityManager
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render('categorie/ClientView/index.html.twig', [
            'categories' => $categories,
            'id_client' => $id_client,

        ]);
    }
}
