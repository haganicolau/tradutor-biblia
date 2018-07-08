<?php

use bibliaAPI\Xml as xml;
use bibliaAPI\Usfm as ufsm;

require('vendor/autoload.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', dirname(__FILE__) . '/error_log.txt');

for ($idiomas = 0; i< 46; $idiomas++) {

    $file = New xml($idiomas);
    $uf = new ufsm($idiomas);

    $file->validarFile();
    $xml = $file->getFile();

    for ($livros = 40; i< 67; $livros++) {

        $book = $uf->getBookByNumer($xml, $livros);
        $organizdosVersiculos = $uf->parseUsfm($book, $livros);

    }
}