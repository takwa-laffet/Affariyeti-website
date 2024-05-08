<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Form\LivraisonType;
use App\Repository\DepotRepository;
use App\Repository\LivraisonRepository;
use Doctrine\ORM\EntityManagerInterface;
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
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;
use Twilio\Rest\Client;


#[Route('/livraison')]
class LivraisonController extends AbstractController
{
    private $livraisonRepository;

    public function __construct(LivraisonRepository $livraisonRepository)
    {
        $this->livraisonRepository = $livraisonRepository;
    }


    #[Route('/', name: 'app_livraison_index', methods: ['GET'])]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $statistics = $this->livraisonRepository->getAddressStatistics();

        $query = $this->livraisonRepository->createQueryBuilder('f')->getQuery();
        $this->sendSMS();

        $livraisons = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('livraison/index.html.twig', [
            'statistics' => $statistics,
            'livraisons' => $livraisons,
        ]);
    }

    #[Route('/livraison/new', name: 'app_livraison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, DepotRepository $depotRepository, MailerController $mailerController): Response
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
            $entityManager->persist($livraison);
            $entityManager->flush();
    
            // Call the printPdf method to generate the PDF with client information
            $this->printPdf($livraison, $mailerController);
            $this->sendEmail("Equipement Notif","Equipement Ajouter");
            return $this->redirectToRoute('app_livraison_show', ['id' => $livraison->getId()]);
        }
    
        return $this->render('livraison/new.html.twig', [
            'form' => $form->createView(),
            'depots' => $depots, // Pass depots to the template
        ]);
    }
    
    
    #[Route('/{id}', name: 'livraison_show', methods: ['GET'])]
    public function show(Livraison $livraison,int $id,LivraisonRepository $livraisonRepository): Response
    {

        //$livraisons = $this->livraisonRepository->findBy(['iddepot' => $livraison->getIddepot()]);
        $livraisons = $livraisonRepository->find($id);
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

    #[Route('/livraison-statistics', name: 'livraison_statistics')]
    public function addressStatistics(LivraisonRepository $livraisonRepository): Response
    {
        $statistics = $livraisonRepository->getAddressStatistics();

        return $this->render('livraison/statistics.html.twig', [
            'statistics' => $statistics,
        ]);
    }
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

    // Output the generated PDF to the browser (force download)
    return new Response($pdfContent, Response::HTTP_OK, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="' . $filename . '"',
    ]);
}
function sendEmail($subject, $message)
    {
        $transport = new EsmtpTransport('smtp.gmail.com', 587);
        $transport->setUsername("maram.njahi@esprit.tn");
        $transport->setPassword("fayvnkyzturjntzy");
       
    
        $mailer = new Mailer($transport);
    
        $email = (new Email())
            ->from("pidev@gmail.com")
            ->to("maram.njahi@esprit.tn")
            ->subject($subject)
            ->text($message);
    
        $mailer->send($email);
    }
    public function sendSMS(): Response
{
    $message = "Votre demande a été effectuée avec succès";
    $recipient = "+21625377666"; // Replace with recipient phone number
    try {
        $twilio = new Client($accountSid, $authToken);
        $sms = $twilio->messages->create(
            $recipient,
            [
                'from' => '+18284820135',
                'body' => $message,
            ]
        );

        if ($sms->status === 'sent') {
            $this->addFlash('success', 'SMS sent successfully!');
        } else {
            $this->addFlash('error', 'Error sending SMS: ' . $sms->status);
        }
    } catch (\Exception $e) {
        // Log the exception details for debugging
        $this->addFlash('error', 'An error occurred: ' . $e->getMessage());
        // Log full exception details
        error_log($e->getMessage());
        // Optionally, you can log the stack trace as well
        error_log($e->getTraceAsString());
    }

    return $this->redirectToRoute('app_livraison_index');
}
}

