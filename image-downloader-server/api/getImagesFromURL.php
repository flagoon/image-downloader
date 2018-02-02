<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 02.02.18
 * Time: 22:37
 */
declare(strict_types=1);
use Flagoon\ImageDownloader;

$imgDownloader = new ImageDownloader();
$imgDownloader->setUrl('test.php');
$imgDownloader->saveImages();