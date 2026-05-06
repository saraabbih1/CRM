<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Http\Request;

class ScraperController extends Controller
{


    public function scrape()
{
   $client = new \GuzzleHttp\Client([
    'verify' => false
]);

    $response = $client->get('https://example.com');

    $html = $response->getBody()->getContents();

    $crawler = new Crawler($html);

    $titles = $crawler->filter('h2')->each(function ($node) {
        return $node->text();
    });

    return $titles;
}
}
