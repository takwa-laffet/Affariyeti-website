<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{    #[Route('/chatboot', name: 'chat', methods: ['GET', 'POST'])]
    public function chatAction(Request $request): Response
    {   return $this->render('chatbot/chatbot.html.twig', [
        'chatbot_config' => [
            'chatbotId' => '-Jj_peuKPRbW3WYCOyaDt',
            'domain' => 'www.chatbase.co'
        ]
        ]);
    }
}
