<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 02.02.18
 * Time: 22:37
 */
declare(strict_types=1);
namespace Flagoon;

$imgDownloader = new ImageDownloader();
$imgDownloader->setUrl('test.php');


echo $imgDownloader->getUrl();
$imgDownloader->saveImages();

echo "<div>JHellos</div>";