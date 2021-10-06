<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route('', name: 'homepage', methods: ['GET'])]
    public function index(): Response
    {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->setStatusCode(200);
        $response->setContent(json_encode([
            'data' => 'Hello, world',
        ]));

        return $response;
    }

}
