<?php

use GuzzleHttp\Client;

$client = new Client();
$respota = $client->request('GET', 'https://www.alura.com.br/cursos-online-programacao/php');

$html = $respota->getBody()->getContents();