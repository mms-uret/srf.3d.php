<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route("/article/{article}", name="article")
     */
    public function article($article)
    {
        $client = HttpClient::create();
        $parts = explode(':', $article);

        $response = $client->request('GET', 'https://www.srf.ch/article/' . array_pop($parts) . '/search');

        $data = json_decode($response->getContent(), true);

        return $this->json($data, 200, ['Access-Control-Allow-Origin' => '*']);
    }

    /**
     * @Route("/image/{hash}/{size}", name="image")
     */
    public function image($hash, $size = '320ws')
    {
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://www.srf.ch/static/cms/images/' . $size . '/' . $hash);

        return new Response($response->getContent(), 200, ['Access-Control-Allow-Origin' => '*', 'Content-Type' => 'image/png']);
    }
}
