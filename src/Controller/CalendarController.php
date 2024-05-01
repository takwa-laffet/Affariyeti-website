<?php
namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\EnchereRepository;

use App\Entity\Enchere;

class CalendarController extends AbstractController
{
    #[Route('admin/auction/Calendar', name: 'Calendar')]
    public function calendar(EnchereRepository $enchereRepository): Response
    {
        $encheres = $enchereRepository->findAll(); // Fetch all encheres

        // Prepare events data
        $events = [];
        foreach ($encheres as $enchere) {
            // Assuming $enchere->getDateDebut() and $enchere->getDateFin() return DateTime objects
            $events[] = [
                'title' => $enchere->getNomEnchere(),
                'start' => $enchere->getDateDebut(),
                'end' => $enchere->getDateFin(),
            ];
        }

        // Render the template with events
        return $this->render('admin/auction/calendar.html.twig', [
            'events' => json_encode($events), // Convert events array to JSON
        ]);
    }}
