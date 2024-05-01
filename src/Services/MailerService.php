<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Envelope;
use Symfony\Component\Mime\RawMessage;
use App\Entity\Livraison;

class MailerService implements MailerInterface
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(RawMessage $message, ?Envelope $envelope = null): void
    {
        // Envoyez le message en utilisant le MailerInterface fourni
        $this->mailer->send($message, $envelope);
    }

    public function sendEmail(Livraison $livraison, string $template, array $context, $attachmentContent, string $filename): void
    {
        // Générez le contenu de l'email
        $email = (new Email())
            ->from('njahimaram2@gmail.com')
            ->to($livraison->getEmail())
            ->subject('Votre commande a été traitée')
            ->html('<p>Bonjour,</p><p>Votre commande a été traitée avec succès.</p>')
            ->attach($attachmentContent, $filename); // Attachez le contenu du fichier PDF

        // Envoyez l'email
        $this->send($email);
    }
}
