<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Produit;

use App\Entity\Rating;
use App\Form\RatingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

#[Route('/rating')]
class RatingController extends AbstractController
{
    #[Route('/{id_client}/Produit/{idP}/{idC}', name: 'app_rating_index', methods: ['GET'])]
public function index(int $id_client, int $idP, int $idC, EntityManagerInterface $entityManager): Response
{

    $produit = $entityManager
    ->getRepository(Produit::class)
    ->findOneBy(['idP' => $idP]); // Fetch products with idC equal to $idC
    $ratings = $entityManager
        ->getRepository(Rating::class)
        ->findBy(['product' => $produit]);

        return $this->render('rating/index.html.twig', [
        'ratings' => $ratings,
        'id_client' => $id_client,
        'idP' => $idP,
        'idC' => $idC,

    ]);
}

#[Route('/new/avis/{}id_client}/{}', name: 'app_rating_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager, int $id_client, int $idC, int $idP): Response
{
    $rating = new Rating();
    $form = $this->createForm(RatingType::class, $rating);
    $form->handleRequest($request);
    $user = $entityManager
    ->getRepository(User::class)
    ->findOneBy(['id' => $id_client]);
    $produit = $entityManager
    ->getRepository(Produit::class)
    ->findOneBy(['idP' => $idP]);

    if ($form->isSubmitted() && $form->isValid()) {
        $rating->setUser($user);
        $rating->setProduct($produit);
        
        $entityManager->persist($rating);
        $entityManager->flush();

        return $this->redirectToRoute('app_produit_details', ['id_client' => $id_client, 'idC' => $idC, 'idP' => $idP]);
    }

    return $this->renderForm('produit/ClientView/show.html.twig', [
        'rating' => $rating,
        'form' => $form,
    ]);
}


    #[Route('/{ratingId}', name: 'app_rating_show', methods: ['GET'])]
    public function show(Rating $rating): Response
    {
        return $this->render('rating/show.html.twig', [
            'rating' => $rating,
           
        ]);
    }

    #[Route('/{ratingId}/edit/{id_client}/details/{idC}/{idP}', name: 'app_rating_edit', methods: ['GET', 'POST'])]
    public function edit(int $id_client, int $idC, int $idP , Request $request, Rating $rating, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rating_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rating/edit.html.twig', [
            'rating' => $rating,
            'form' => $form,
            'id_client' => $id_client,
            'idC' => $idC,
        ]);
    }

    #[Route('/Client/{id_client}/details/{idC}/{idP}/Rating/{ratingId}', name: 'delete_rating', methods: ['POST'])]
    public function delete(Request $request, Rating $rating, EntityManagerInterface $entityManager , int $id_client , int $idC , int $idP): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rating->getRatingId(), $request->request->get('_token'))) {
            $entityManager->remove($rating);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_produit_details', ['id_client' => $id_client, 'idC' => $idC, 'idP' => $idP]);
    }
    
}
