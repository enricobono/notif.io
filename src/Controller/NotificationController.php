<?php

namespace App\Controller;

use App\ValueObject\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    public function __construct()
    {
    }

    #[Route('/notification', name: 'notification', methods: ['POST'])]
    public function notification(MessageBusInterface $bus, Request $request): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $channels = $request->get('channels');
        $failOverChannels = $request->get('fail_over_channels');

        try {
            $message = new Message(
                $request->get('email_address'),
                $request->get('phone_number'),
                $request->get('title'),
                $request->get('body'),
                is_string($channels) ? explode(',', $channels) : $channels,
                is_null($failOverChannels) ? [] : (is_string($failOverChannels) ? explode(',', $failOverChannels) : $failOverChannels)
            );


            $bus->dispatch($message);

            $response->setStatusCode(201);
        } catch (\Throwable $e) {
            $response->setStatusCode(400);
            $response->setContent(json_encode([
                'error' => [
                    'errors' => [
                        $e->getMessage()
                    ]
                ]
            ]));

        }

        return $response;
    }
}
