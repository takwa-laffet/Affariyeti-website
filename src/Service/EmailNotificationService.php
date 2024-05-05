<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Produit;
use App\Entity\User;

class EmailNotificationService
{
    private $mailer;
    private $entityManager;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $entityManager)
    {
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
    }

    public function notifyUsersAboutNewProduct(Produit $produit)
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        foreach ($users as $user) {
            $this->sendEmailToUser($user, $produit);
        }
    }

    private function sendEmailToUser(User $user, Produit $produit)
    {
        $email = (new Email())
            ->from('ghadabm1641@gmail.com')
            ->to($user->getEmail())
            ->subject('Nouveau produit sajouté')
            ->html('<p>Un nouveau produit a été ajouté : ' . $produit->getNomP() . '</p>');

        $this->mailer->send($email);
    }
}
