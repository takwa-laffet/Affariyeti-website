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
    #[Route('admin/auction/Calendar', name: 'appCalendar')]
    public function calendar(EnchereRepository $enchereRepository): Response
    {

    $repository = $this->getDoctrine()->getRepository(Enchere::class);
        $enchereEvents = $repository->findAll();

        return $this->render('admin/auction/calendar.html.twig', [
            'enchereEvents' => $enchereEvents,
        ]);
    }
}
