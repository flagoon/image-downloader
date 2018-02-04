<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 02.02.18
 * Time: 22:37
 */
declare(strict_types=1);

require_once('../src/Flagoon/ImageDownloader.php');
require_once('../src/Flagoon/Helper.php');

$imgDownloader = new Flagoon\ImageDownloader();
$imgDownloader->setUrl('https://www.verbanent.pl/ksiazki/card/orson/scott');
$imgDownloader->saveImages();