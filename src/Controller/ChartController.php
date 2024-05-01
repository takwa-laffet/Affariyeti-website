<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Entity\Enchere;
use Symfony\Component\HttpFoundation\JsonResponse;

class ChartController extends AbstractController
{
    #[Route('admin/auction/charts', name: 'chart')]
    public function index(ChartBuilderInterface $chartBuilder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        // Fetch data from the Enchere entity
        $enchereRepository = $entityManager->getRepository(Enchere::class);
        $enchereData = $enchereRepository->findAll();

        // Prepare data for the chart
        $labels = [];
        $data = [];

        foreach ($enchereData as $enchere) {
            $labels[] = $enchere->getDateDebut(); // Use date début as labels
            $data[] = $enchere->getMontantInitial(); // Use montant initial as data
        }

        // Create and configure the chart
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Montant Initial',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);

        $chartData = [
            'labels' => $chart->getData()['labels'],
            'datasets' => $chart->getData()['datasets'],
        ];

        return $this->render('admin/auction/charts.html.twig', [
            'chartData' => json_encode($chartData),
        ]);
    }
}
