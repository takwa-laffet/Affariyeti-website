<?php
namespace App\Controller; 

use App\Entity\Livraison;
use App\Form\LivraisonType;
<<<<<<< Updated upstream
=======
use App\Repository\DepotRepository;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
>>>>>>> Stashed changes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Controller\MailerController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;

#[Route('/livraison')]
class LivraisonController extends AbstractController
{
<<<<<<< Updated upstream
    #[Route('/', name: 'app_livraison_index', methods: ['GET'])]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $livraisons = $entityManager
            ->getRepository(Livraison::class)
            ->findAll();

        return $this->render('livraison/index.html.twig', [
            'livraisons' => $livraisons,
        ]);
=======
    private $LivraisonRepository;

    public function __construct(LivraisonRepository $LivraisonRepository)
    {
        $this->LivraisonRepository = $LivraisonRepository;
>>>>>>> Stashed changes
    }
    #[Route('/', name: 'app_livraison_index', methods: ['GET'])]
    public function index(Request $request,LivraisonRepository $livraisonRepository,PaginatorInterface $paginator): Response
{
    // Get statistics based on address
    $statistics = $livraisonRepository->getAddressStatistics();
    
    // Fetch all deliveries
    $livraisons = $livraisonRepository->findAll();
    // Retrieve all formations query
    $query = $livraisonRepository->createQueryBuilder('f')->getQuery();
        
    // Paginate the results
    $livraisons= $paginator->paginate(
        $query, // Query to paginate
        $request->query->getInt('page', 1), // Current page number, default is 1
        3 // Items per page
    );
    return $this->render('livraison/index.html.twig', [
        'statistics' => $statistics,
        'livraisons' => $livraisons,
    ]);
}

<<<<<<< Updated upstream
    #[Route('/new', name: 'app_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
=======

    
    #[Route('/livraison/new', name: 'app_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, DepotRepository $depotRepository, MailerController $mailerController): Response
>>>>>>> Stashed changes
    {
        $livraison = new Livraison();

        // Set date de commande
        $dateTime = new \DateTime('now', new \DateTimeZone('Africa/Tunis'));
        $livraison->setDatecommande($dateTime);

        // Set date de livraison
        $datelivraison = new \DateTime('now', new \DateTimeZone('Africa/Tunis'));
        $livraison->setDatelivraison($datelivraison);

        $form = $this->createForm(LivraisonType::class, $livraison);
        
        // Fetch depots from the database
        $depots = $depotRepository->findAll();
        
        // Set the 'datecommande' field with the current date and time
        $livraison->setDatecommande(new \DateTime());
        $livraison->setStatuslivraison('En cours'); // Set statuslivraison to 'En cours'

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($livraison);
            $entityManager->flush();

            // Call the printPdf method to generate the PDF with client information
            $this->printPdf($livraison, $mailerController);

            return $this->redirectToRoute('app_livraison_show', ['id' => $livraison->getId()]);
        }

        return $this->render('livraison/new.html.twig', [
<<<<<<< Updated upstream
            'livraison' => $livraison,
            'form' => $form->createView(),
=======
            'form' => $form->createView(),
            'depots' => $depots, // Pass depots to the template
>>>>>>> Stashed changes
        ]);
    }

    #[Route('/{id}', name: 'livraison_show', methods: ['GET'])]
    public function show(Livraison $livraison, EntityManagerInterface $entityManager): Response
    {
        // Fetch all livraisons with the same ID
        $livraisons = $entityManager->getRepository(Livraison::class)->findBy(['iddepot' => $livraison->getIddepot()]);

        return $this->render('livraison/show.html.twig', [
            'livraison' => $livraison,
            'livraisons' => $livraisons,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_livraison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Livraison $livraison): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_livraison_delete', methods: ['POST'])]
    public function delete(Request $request, Livraison $livraison): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_livraison_index', [], Response::HTTP_SEE_OTHER);
    }

<<<<<<< Updated upstream
    #[Route('/search', name: 'app_livraison_search', methods: ['GET'])]
    public function search(Request $request): Response
    {
        $villes = [
            'Tunis',
            'Sousse',
            'Bizerte',
            'Ariana',
            'La Marsa',
            'Ben Arous',
        ];

        return $this->render('livraison/search.html.twig', [
            'villes' => $villes,
        ]);
    }
=======
    #[Route('/livraison/{id}/pdf', name: 'app_livraison_pdf', methods: ['GET'])]
    public function printPdf(Livraison $livraison, MailerController $mailerController): Response
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Generate the HTML content
        $html = $this->renderView('livraison/print.html.twig', ['livraison' => $livraison]);
       
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // Set paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        
        // Render the HTML as PDF
        $dompdf->render();
       
        // Generate a filename for the PDF
        $filename = sprintf('livraison-%s.pdf', date('Y-m-d_H-i-s'));

        // Get the PDF content
        $pdfContent = $dompdf->output();

        // Send email with the PDF attachment
       
        // Output the generated PDF to the browser (force download)
        return new Response($pdfContent, Response::HTTP_OK, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

  
        #[Route('/livraison-statistics', name: 'livraison_statistics')]
        public function addressStatistics(LivraisonRepository $livraisonRepository): Response
        {
            $statistics = $livraisonRepository->getAddressStatistics();
    
            return $this->render('livraison/statistics.html.twig', [
                'statistics' => $statistics,
            ]);
        }
>>>>>>> Stashed changes
}
    
