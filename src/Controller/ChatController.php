<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ChatService;

class ChatController extends AbstractController
{
    private $chatService;

    public function __construct(ChatService $chatService)
    {
        $this->chatService = $chatService;
    }

    /**
     * @Route("/chat", name="chat")
     */
    public function index(Request $request): Response
    {
        // Get the message from the request
        $message = $request->query->get('message');

        // Call the chat service to get the response
        $response = $this->chatService->chatGPT($message);

        // Render the response using Twig
        return $this->render('chat/index.html.twig', [
            'message' => $response,
        ]);
    }
}
