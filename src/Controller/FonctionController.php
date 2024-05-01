<?php

namespace App\Controller;

use App\Entity\Depot;
use App\Repository\DepotRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FonctionController extends AbstractController
{
    #[Route('/fonction', name: 'app_fonction')]
    public function index(): Response
    {
        return $this->render('fonction/index.html.twig', [
            'controller_name' => 'FonctionController',
        ]);
    }

    /**
     * @Route("/TrierspcASC", name="triespc",methods={"GET"})
     */
    public function trierSpecialite(Request $request, DepotRepository $DepotRepository): Response
    {
        // Utilisez directement la méthode trie() du repository
        $depots = $DepotRepository->trie();

        return $this->render('depot/index.html.twig', [
            'depots' => $depots,
        ]);
    }

    /**
     * @Route("/TrierspcDESC", name="triespcDESC",methods={"GET"})
     */
    public function trierSp(Request $request, DepotRepository $depotRepository): Response
    {
        // Utilisez directement la méthode trieDes() du repository
        $depots = $depotRepository->trieDes();

        return $this->render('depot/index.html.twig', [
            'depots' => $depots,
        ]);
    }

    /**
     * @Route("/Trieprix", name="trieprix",methods={"GET"})
     */
    public function trierprode(Request $request, DepotRepository $depotRepository): Response
    {
        // Utilisez directement la méthode trierepas() du repository
        $depots = $depotRepository->trierepas();

        return $this->render('depot/index.html.twig', [
            'depots' => $depots,
        ]);
    }

    /**
     * @Route("/search", name="recherchearb",methods={"GET"})
     */
    public function searchoffreajax(Request $request, DepotRepository $depotRepository): Response
    {
        $requestString = $request->get('searchValue');

        // Utilisez directement la méthode findbyNom() du repository
        $depots = $depotRepository->findbyNom($requestString);

        return $this->render('depot/index.html.twig', [
            'depots' => $depots,
        ]);
    }
}
