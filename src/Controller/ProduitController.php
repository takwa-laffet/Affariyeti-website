<?php

namespace App\Controller;
use App\Entity\Rating;

use App\Entity\Produit;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Form\ProduitType;
use App\Form\RatingType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Mailer\MailerInterface;
use Knp\Component\Pager\PaginatorInterface;



#[Route('/produit')]
class ProduitController extends AbstractController
{  


    #[Route('/Client/{id_client}/details/{idC}/{idP}', name: 'app_produit_details', methods: ['GET', 'POST'])]
    public function details(int $id_client, int $idC, int $idP, EntityManagerInterface $entityManager, Request $request): Response
    {
        $produit = $entityManager
            ->getRepository(Produit::class)
            ->findOneBy(['idP' => $idP]);
    
        if (!$produit) {
            throw $this->createNotFoundException('Product not found');
        }
    
        $ratings = $entityManager
            ->getRepository(Rating::class)
            ->findBy(['product' => $produit]);
    
        $user = $entityManager
            ->getRepository(User::class)
            ->findOneBy(['id' => $id_client]); // Use findOneBy instead of findBy
    
        // Create a new rating form
        $rating = new Rating();
        $form = $this->createForm(RatingType::class, $rating);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Set additional parameters
            $rating->setUser($user);
            $rating->setProduct($produit);
    
            $entityManager->persist($rating);
            $entityManager->flush();
    
            // Redirect back to the same page after adding the rating
            return $this->redirectToRoute('app_produit_details', ['id_client' => $id_client, 'idC' => $idC, 'idP' => $idP]);
        }
    
        return $this->render('produit/ClientView/Show.html.twig', [
            'produit' => $produit,
            'id_client' => $id_client,
            'idC' => $idC,
            'ratings' => $ratings, // Pass ratings to the Twig template
            'form' => $form->createView(), // Pass the form to the Twig template
        ]);
    }
    

    ///////////////////// Client functions /////////////////////////
    #[Route('/Client/{id_client}/Category/{idC}', name: 'app_produit_index', methods: ['GET'])]
    public function indexProductswithcategory(EntityManagerInterface $entityManager, int $id_client, int $idC, PaginatorInterface $paginator, Request $request): Response
{
    $query = $entityManager
        ->getRepository(Produit::class)
        ->createQueryBuilder('p')
        ->where('p.idC = :idC')
        ->setParameter('idC', $idC)
        ->getQuery();

    $produits = $paginator->paginate(
        $query, // Requête contenant les données à paginer
        $request->query->getInt('page', 1), // Numéro de page par défaut
        4 // Nombre d'éléments par page
    );

    return $this->render('produit/ClientView/index.html.twig', [
        'produits' => $produits,
        'id_client' => $id_client,
        'pagination' => $produits,
        'idC' => $idC,
    ]);
}

    #[Route('/Client/{id_client}/new/{idC}', name: 'app_produit_new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
        CategorieRepository $categorieRepository,
        int $id_client,
        int $idC,
        MailerController $mailer, MailerInterface $test,): Response {
        $produit = new Produit();
    
        // Fetch the user object from the repository
        $client = $userRepository->find($id_client);
        if (!$client) {
            throw $this->createNotFoundException('User not found');
        }
    
        // Fetch the Categorie object from the repository
        $categorie = $categorieRepository->find($idC);
        if (!$categorie) {
            throw $this->createNotFoundException('Categorie not found');
        }
    
        $produit->setIdClient($client);
        $produit->setIdC($categorie); // Set the Categorie object
    
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form['imageP']->getData();
            if ($pictureFile) {
                $filename = md5(uniqid()) . '.' . $pictureFile->guessExtension();
                $pictureFile->move(
                    $this->getParameter('pictures_directory'),
                    $filename
                );
                $produit->setImageP($filename); // Set the image property of the entity
            }
    
            $entityManager->persist($produit);
            $entityManager->flush();
            $users = $userRepository->findAll();
            //


            // Loop through each user and send them an email
            foreach ($users as $user) {
                $mailer->sendEmail($test, $user->getEmail(), "test");
            }            return $this->redirectToRoute('app_produit_index', ['idC' => $idC, 'id_client' => $id_client], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('produit/ClientView/new.html.twig', [
            'form' => $form->createView(),
            'id_client' => $id_client,
            'idC' => $idC,
        ]);
    }
    /*
    */
    

    
    #[Route('/Client/{id_client}/edit/{idP}/{idC}', name: 'app_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, EntityManagerInterface $entityManager, int $id_client, int $idP, int $idC): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pictureFile = $form['imageP']->getData();
            if ($pictureFile) {
                $filename = md5(uniqid()) . '.' . $pictureFile->guessExtension();
                $pictureFile->move(
                    $this->getParameter('pictures_directory'),
                    $filename
                );
                $produit->setImageP($filename); 
            }
   
    
            $entityManager->flush();
    
            return $this->redirectToRoute('Client_Products_index', ['id_client' => $id_client], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form->createView(),
            'id_client' => $id_client,
            'idC' => $idC,
        ]);
    }
    

    #[Route('/Client/{id_client}/delete/{idP}', name: 'app_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, EntityManagerInterface $entityManager , int $id_client): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdP(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('Client_Products_index', ['id_client' => $id_client], Response::HTTP_SEE_OTHER);
    }


    
    #[Route('/Client/{id_client}/OwnProducts', name: 'Client_Products_index', methods: ['GET'])]
    public function indexProductsClient(EntityManagerInterface $entityManager, int $id_client): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findBy(['idClient' => $id_client]); // Fetch products with idC equal to $idC

        return $this->render('produit/ClientView/OwnProductsindex.html.twig', [
            'produits' => $produits,
            'id_client' => $id_client,
        ]);
    }

   


    #[Route('/Client/{id_client}/shop', name: 'shop_Products_index', methods: ['GET'])]
    public function indexProductsShop(EntityManagerInterface $entityManager, int $id_client, Request $request, PaginatorInterface $paginator): Response
{
    $minPrice = $request->query->get('min_price');
    $maxPrice = $request->query->get('max_price');

    // Récupérer les produits basés sur la plage de prix
    $query = $entityManager
        ->getRepository(Produit::class)
        ->findProductsByPriceRange($minPrice, $maxPrice);

    // Paginer les résultats
    $produits = $paginator->paginate(
        $query, // Requête contenant les données à paginer
        $request->query->getInt('page', 1), // Numéro de page par défaut
        4 // Nombre d'éléments par page
    );

    return $this->render('produit/ClientView/index.html.twig', [
        'produits' => $produits,
        'pagination' => $produits,
        'id_client' => $id_client,
    ]);
}

    ////////////////// Admin functions /////////////////

    #[Route('/admin/products/Category/{idC}', name: 'admin_produit_index', methods: ['GET'])]
    public function indexProductadmin(EntityManagerInterface $entityManager, int $idC): Response
    {
        $produits = $entityManager
            ->getRepository(Produit::class)
            ->findBy(['idC' => $idC]); // Fetch products with idC equal to $idC

        return $this->render('produit/AdminView/index.html.twig', [
            'produits' => $produits,
            'idC' => $idC,
        ]);
    }


    #[Route('/Admin/Product/{idC}/delete/{idP}', name: 'admin_produit_delete', methods: ['POST'])]
    public function deleteAdmin(Request $request, Produit $produit, EntityManagerInterface $entityManager , int $idC): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getIdP(), $request->request->get('_token'))) {
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_produit_index', ['idC' => $idC], Response::HTTP_SEE_OTHER);
    }
    #[Route('/Client/{id_client}/savedproducts', name: 'client_saved_products_index', methods: ['GET'])]
public function indexSavedProducts(EntityManagerInterface $entityManager, int $id_client): Response
{
    $produitsEnregistres = $entityManager
        ->getRepository(Produit::class)
        ->findBy(['idClient' => $id_client, 'enregistre' => true]);

    return $this->render('produit/ClientView/saved_products_index.html.twig', [
        'produitsEnregistres' => $produitsEnregistres,
        'id_client' => $id_client,
    ]);
}
#[Route('/Client/{id_client}/shop', name: 'shops_Products_index', methods: ['GET'])]
public function indexProductsShops(EntityManagerInterface $entityManager, int $id_client, Request $request): Response
{
    $minPrice = $request->query->get('min_price');
    $maxPrice = $request->query->get('max_price');

    // Fetch products based on price range
    $produits = $entityManager
        ->getRepository(Produit::class)
        ->findProductsByPriceRange($minPrice, $maxPrice);

    return $this->render('produit/ClientView/index.html.twig', [
        'produits' => $produits,
        'id_client' => $id_client,
    ]);
}

}
