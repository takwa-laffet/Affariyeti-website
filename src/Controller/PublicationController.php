<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Repository\PublicationRepository;
use App\Repository\GrosmotsRepository;

use App\Form\PublicationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\CommentaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Grosmots;
use Symfony\Component\Form\FormError;
use Twilio\Rest\Client;

#[Route('/publication')]
class PublicationController extends AbstractController
{
    #[Route('/', name: 'app_publication_index', methods: ['GET'])]
    public function index(Request $request, PublicationRepository $publicationRepository, PaginatorInterface $paginator): Response
    {
        // Fetch all publications from the repository
        $publications = $publicationRepository->findAll();
    
        // Paginate the results
        $pagination = $paginator->paginate(
            $publications, // The query to paginate
            $request->query->getInt('page', 1), // Get the page number from the request, default to 1
            3 // Number of items per page
        );
    
        return $this->render('publication/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }
    #[Route('/front_index', name: 'app_publication_indexfront', methods: ['GET', 'POST'])]
    public function indexfront(
        Request $request,
        EntityManagerInterface $entityManager,
        CommentaireRepository $commentaireRepository,
        GrosmotsRepository $grosmotsRepository,
        PaginatorInterface $paginator
    ): Response {
        // Création d'une nouvelle instance de Publication
        $publication = new Publication();
        $publication->setNbLikes(0);
        $publication->setNbDislike(0);
        $dateTime = new \DateTime('now', new \DateTimeZone('Africa/Tunis'));
        $publication->setDatePub($dateTime);
    
        // Création du formulaire de Publication
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier la présence de gros mots dans le contenu de la publication
            $content = $publication->getContenu();
            $grosMotsList = $grosmotsRepository->findAll();
            foreach ($grosMotsList as $grosMots) {
                if (stripos($content, $grosMots->getGrosMots()) !== false) {
                    // Si un gros mot est trouvé, envoyer un SMS et ajouter une erreur au formulaire
                    $this->envoyerSms();
                    $form->addError(new FormError('Le contenu de la publication contient un gros mot.'));
                    break;
                }
            }
    
            // Si aucun gros mot n'est trouvé, procéder à l'ajout normal de la publication
            if (!$form->getErrors()->count()) {
                // Gérer le téléchargement de la photo
                $photoFile = $form->get('photoFile')->getData();
                if ($photoFile) {
                    $newFilename = $this->uploadPhoto($photoFile);
                    $publication->setPhoto($newFilename);
                }
                $entityManager->persist($publication);
                $entityManager->flush();
                return $this->redirectToRoute('app_publication_indexfront');
            }
        }
    
        // Récupérer toutes les publications triées par date de la plus récente à la plus ancienne
        $query = $entityManager->getRepository(Publication::class)->createQueryBuilder('p')->orderBy('p.datePub', 'DESC');
        $publications = $paginator->paginate(
            $query->getQuery(), // Requête à paginer
            $request->query->getInt('page', 1), // Numéro de page par défaut
            5 // Nombre d'éléments par page
        );
    
        // Récupérer les commentaires pour chaque publication
        $comments = [];
        foreach ($publications as $pub) {
            $comments[$pub->getIdPub()] = $commentaireRepository->findBy(['idPub' => $pub]);
        }
    
        // Affichage de la vue avec les données
        return $this->render('publication/front.html.twig', [
            'publications' => $publications,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
    
    private function envoyerSms(): void
        {
            // Remplacer ces valeurs par vos identifiants Twilio
           
    
    
            // Initialisez le client Twilio
           
    
    
    
           
        }
    #[Route('/new', name: 'app_publication_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $publication = new Publication();
        $publication->setNbLikes(0);
        $publication->setNbDislike(0);
        $dateTime = new \DateTime('now', new \DateTimeZone('Africa/Tunis'));
        $publication->setDatePub($dateTime);
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
            'idPub' => $publication, // Assurez-vous que $idPub est correctement transmis à la vue

        ]);
        
    }

    #[Route('/{idPub}/commentaires', name: 'app_publication_commentaire', methods: ['GET'])]
    public function LesCommentaires(Publication $publication, CommentaireRepository $commentaireRepository): Response
    {
        $comments = $commentaireRepository->findBy(['idPub' => $publication]);

        return $this->render('commentaire/Comments.html.twig', [
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
            $photoFile = $form->get('photoFile')->getData();
            if ($photoFile) {
                $newFilename = $this->uploadPhoto($photoFile);
                $publication->setPhoto($newFilename);
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_publication_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('publication/edit.html.twig', [
            'publication' => $publication,
            'form' => $form,
        ]);
    }
    #[Route('/{idPub}/editfront', name: 'app_publication_editfront', methods: ['GET', 'POST'])]
    public function editfront(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(PublicationType::class, $publication);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Si vous avez besoin de télécharger une nouvelle photo
        $photoFile = $form->get('photoFile')->getData();
        if ($photoFile) {
            $newFilename = $this->uploadPhoto($photoFile);
            $publication->setPhoto($newFilename);
        }

        // Persistez et enregistrez les modifications dans la base de données
        $entityManager->flush();

        return $this->redirectToRoute('app_publication_indexfront');
    }

    return $this->render('publication/editfront.html.twig', [
        'publication' => $publication,
        'form' => $form->createView(),
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

 #[Route('/{idPub}/supprimer', name: 'app_publication_supprimer', methods: ['POST'])]
public function supprimer(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('supprimer'.$publication->getIdPub(), $request->request->get('_token'))) {
        $entityManager->remove($publication);
        $entityManager->flush();
    }
    
    return $this->redirectToRoute('app_publication_indexfront', [], Response::HTTP_SEE_OTHER);
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
