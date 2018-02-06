<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 02.02.18
 * Time: 22:37
 */
declare(strict_types=1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-type:application/json");

require_once('../src/Flagoon/ImageDownloader.php');
require_once('../src/Flagoon/Helper.php');

/**
 * @var $str_json string values get from frontend. In this case, it's stringify object with url
 */
$str_json = file_get_contents('php://input');

/**
 * @var $sentObject object, well we need this part decoded, it means change it to object again.
 */
$sentObject = json_decode($str_json);

/**
 * @var $url string it's and URL we sent in the form
 */
$url = $sentObject->url->url;

/**
 * First we are chcecking if sent URL is valid URL. If not, we are sending back to frontend error message.
 */
if (!filter_var($sentObject->url->url, FILTER_VALIDATE_URL)) {

    // if it's not a valid URL, we are sending information to frontend that URL was not valid.
    echo json_encode(["message" => "Invalid url", "images" => false]);
} else {

    // if URL is valid, we get it's body as string.
    $htmlBody = file_get_contents($url);

    // declare helper instance
    $helper = Flagoon\Helper::Instance();

    // create an array of image links
    $imageArray = $helper->extractImages($htmlBody);

    // send to fron end information, that it's OK, and also array of links.
    echo json_encode(["message" => "OK", "images" => $imageArray]);
}
