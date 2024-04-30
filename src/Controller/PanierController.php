<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\PanierProduit;
use App\Entity\Produit;
use App\Form\PanierType;
use App\Repository\PanierProduitRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/panier')]
class PanierController extends AbstractController
{
  
   
    #[Route('/', name: 'app_panier_index', methods: ['GET'])]
    public function index(PanierRepository $repo, UserRepository $userRepository, ProduitRepository $produitRepository): Response
    {
        $userE=$this->getUser()->getUserIdentifier();
        $user=$userRepository->findOneBy(['email'=>$userE]);
        
        $panier=$repo->findByUser($user->getId());
    
        $prods=$panier->getProduits();
        
        

       /*
       $produits=$repo->findAll();
        $prods=array();
        foreach ($produits as $product) {
            $products=$produitRepository->findProductByNameAndPrice($product->getNomArticle(),$product->getPrix());
          
            $prods[]=$products;
            
        }*/
        
        return $this->render('panier/index.html.twig', [
            'produits' => $prods,
        ]);
    }


    #[Route('/new/{idP}/', name: 'app_panier_new', methods: ['GET', 'POST'])]
    public function add($idP, PanierRepository $repo,ProduitRepository $rep , EntityManagerInterface $entityManager): RedirectResponse
    {

       
        $panier=$repo->find(43);
        $produit=$rep->find($idP);
        $panierp = new PanierProduit(); 
        $panierp->setPanier( $panier);
        $panierp->setProduitId($produit->getIdP());
        #$product->setNomArticle($produit->getNomP());
       # $product->setPrix($produit->getPrixP());
       # $product->addProduits($produit);

        $entityManager->persist($panierp);

        $entityManager->flush();
        

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/passerCommande', name: 'app_panier_passer_command')]
    public function deleteAll(PanierRepository $repo, EntityManagerInterface $entityManager): Response
    {

        $paniers=$repo->findAll();
        //ajouter commamde
        foreach ($paniers as $panier) {

            $entityManager->remove($panier);

        }
        $entityManager->flush();

        

        return $this->redirectToRoute('app_panier_index');
    }



    #[Route('/delete/{id}', name: 'app_panier_delete')]
    public function delete($id, PanierRepository $repo, EntityManagerInterface $entityManager): Response
    {

        $panier=$repo->find($id);
        $entityManager->remove($panier);
        $entityManager->flush();
        

        return $this->redirectToRoute('app_panier_index');
    }



    
    #[Route('/deleteiio/{id}', name: 'app_pd_delete')]
    public function deleteoo($id, ProduitRepository $repo, PanierProduitRepository $r, EntityManagerInterface $entityManager): Response
    {
        
        // Assuming $id is the ID of the produit you want to delete
        $p = $r->findOneBy(["produitId" => $id]);
    
        if (!$p) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }
    
        $entityManager->remove($p);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_panier_index');
    }

}
