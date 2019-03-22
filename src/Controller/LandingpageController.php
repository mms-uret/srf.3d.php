<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;

class LandingpageController extends AbstractController
{
    /**
     * @Route("/landingpage/{landingpage}", name="landingpage")
     */
    public function index($landingpage = 4267482)
    {
        $client = HttpClient::create();
        $landingpage = intval($landingpage);
        $response = $client->request('GET', 'https://www.srf.ch/landingpage/' . $landingpage . '?format=json');

        $data = json_decode($response->getContent(), true);

        return $this->json($data, 200, ['Access-Control-Allow-Origin' => '*']);
    }
}
