<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 01.02.18
 * Time: 21:58
 */
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Flagoon\ImageDownloader;

$imgDownloader = new ImageDownloader();
$imgDownloader->setUrl('https://www.verbanent.pl/ksiazki/card/orson/scott');
$imgDownloader->extractImages();