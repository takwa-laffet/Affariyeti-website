<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\Form\PublicationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\CommentaireRepository;

#[Route('/publication')]
class PublicationController extends AbstractController
{
    #[Route('/', name: 'app_publication_index', methods: ['GET'])]
    public function index(PublicationRepository $publicationRepository): Response
    {
        return $this->render('publication/index.html.twig', [
            'publications' => $publicationRepository->findAll(),
        ]);
        
    }
    #[Route('/front_index', name: 'app_publication_indexfront', methods: ['GET'])]
    public function indexfront(PublicationRepository $publicationRepository): Response
    {
        return $this->render('publication/front.html.twig', [
            'publications' => $publicationRepository->findAll(),
            
        ]);
        
    }

    #[Route('/new', name: 'app_publication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publication = new Publication();
        $publication->setNbLikes(0);
        $publication->setNbDislike(0);
        $publication->setDatePub(new \DateTime());
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer le téléchargement de la photo
            $photoFile = $form->get('photoFile')->getData();

            if ($photoFile) {
                $newFilename = $this->uploadPhoto($photoFile);
                $publication->setPhoto($newFilename);
            }

            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publication/new.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }

    #[Route('/{idPub}', name: 'app_publication_show', methods: ['GET'])]
    public function show(Publication $publication): Response
    {
        return $this->render('publication/show.html.twig', [
            'publication' => $publication,
        ]);
    }
    #[Route('/{idPub}/comments', name: 'app_publication_comments', methods: ['GET'])]
    public function showComments(Publication $publication, CommentaireRepository $commentaireRepository): Response
    {
        $comments = $commentaireRepository->findBy(['idPub' => $publication]);

        return $this->render('commentaire/index.html.twig', [
            'publication' => $publication,
            'commentaires' => $comments,
        ]);
    }
    

    #[Route('/{idPub}/edit', name: 'app_publication_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }

    #[Route('/{idPub}', name: 'app_publication_delete', methods: ['POST'])]
    public function delete(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getIdPub(), $request->request->get('_token'))) {
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
    }

    private function uploadPhoto($photoFile)
{
    // Définir l'emplacement de stockage des photos
    $uploadsDirectory = $this->getParameter('kernel.project_dir').'/public/assets';

    // Générer un nom de fichier unique
    $newFilename = uniqid().'.'.$photoFile->guessExtension();

    try {
        // Déplacer le fichier téléchargé vers l'emplacement de stockage
        $photoFile->move($uploadsDirectory, $newFilename);
    } catch (FileException $e) {
        // Gérer les erreurs de téléchargement de fichier
        throw new FileException('Erreur lors du téléchargement du fichier');
    }

    // Retourner le chemin complet du fichier téléchargé
    return '/assets/'.$newFilename;
}
}
