<?php

namespace App\Controller;

use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatisticsController extends AbstractController
{
    #[Route('/statistics/address-delivery', name: 'address_delivery_statistics')]
    public function showAddressDeliveryStatistics(LivraisonRepository $livraisonRepository): Response
    {
        // Here you might fetch statistics data from your repository
        $deliveryStatistics = $livraisonRepository->getDeliveryStatisticsByAddress('YourAddress'); // Example: replace 'YourAddress' with an actual address
        
        return $this->render('livraison/address_delivery.html.twig', [
            'deliveryStatistics' => $deliveryStatistics,
        ]);
    }
}
