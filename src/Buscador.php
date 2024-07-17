<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    private Crawler $crawler;
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->crawler = $crawler;
        $this->httpClient = $httpClient;
    }

    public function buscar(string $url): array
    {
        // Pega HTML
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();

        // Passa HTML para o Crawler para ser filtrado
        $this->crawler->addHtmlContent($html);
        $elementosCursos = $this->crawler->filter('span.card-curso__nome');

        // Retorna Array
        $cursos = [];
        foreach ($elementosCursos as $curso) {
            $cursos[] = $curso->textContent;
        }
        return $cursos;
    }
}