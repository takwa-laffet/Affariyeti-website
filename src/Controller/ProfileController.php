<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()){
            $userInfo = $entityManager
                ->getRepository(User::class)
                ->findOneByEmail($this->getUser()->getUserIdentifier());
    
            return $this->render('profile/index.html.twig', [
                'userInfo' => $userInfo,
            ]);
        }else{
            return $this->redirectToRoute('app_login');
        }
    }
    #[Route('profile/edit', name: 'app_information_personnele_edit', methods: ['POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {   
        if($this->getUser()){
        $informationPersonneleId = $request->request->get('id');

        $user = $entityManager->getRepository(User::class)->find($this->getUser());
        if( $request->request->get('nom') && $request->request->get('prenom')){
        $user->setNom($request->request->get('nom'));
        $user->setPrenom($request->request->get('prenom'));
        $entityManager->persist($user);
        $entityManager->flush();
        $request->getSession()->getFlashBag()->add('success', 'Profile updated successfully');

        return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
    }else{
                $request->getSession()->getFlashBag()->add('error', 'all fields are required');
        return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);

    }
    }else{
        return $this->redirectToRoute('app_login');
    }
    }
}
