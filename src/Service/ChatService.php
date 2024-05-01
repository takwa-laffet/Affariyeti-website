<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

use Symfony\Component\HttpClient\Exception\ServerException;

class ChatService


{   private $model = 'gpt-3.5-turbo';
    public function chatGPT($message)
    {
        $httpClient = HttpClient::create();

        $url = 'https://api.openai.com/v1/chat/completions';

        // Retry up to 3 times with exponential backoff
        $attempts = 0;
        while ($attempts < 3) {
            try {
                $response = $httpClient->request('POST', $url, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->apiKey,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => $this->model,
                        'messages' => [
                            ['role' => 'user', 'content' => $message]
                        ]
                    ]
                ]);

                $content = $response->toArray();

                return $this->extractContentFromResponse($content['choices'][0]['message']['content']);
            } catch (ServerException $exception) {
                if ($exception->getResponse()->getStatusCode() === 429) {
                    // Implement exponential backoff
                    usleep(500000 * (2 ** $attempts)); // 0.5 seconds, 1 second, 2 seconds
                    $attempts++;
                } else {
                    throw $exception; // Re-throw other server exceptions
                }
            }
        }

        throw new \RuntimeException('Exceeded maximum number of retries.');
    }
    private function extractContentFromResponse($response)
    {
        return $response;
    }
}
