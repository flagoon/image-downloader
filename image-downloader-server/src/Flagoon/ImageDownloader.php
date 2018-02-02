<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 01.02.18
 * Time: 22:17
 */
declare(strict_types=1);
namespace Flagoon;

class ImageDownloader
{
    private $url;

    public function setUrl(string $url):void
    {
        $this->url = $url;
    }

    public function getUrl():string
    {
        return $this->url;
    }

    public function extractImages():void
    {
        $helper = Helper::Instance();
        $htmlPage = file_get_contents($this->url);
        $imagesLinks = $helper->extractImages($htmlPage);
        $this->saveImages($imagesLinks);
    }

    private function saveImages(array $links): void
    {
        foreach ($links as $link) {
            $download = file_get_contents($link);
            file_put_contents('./resources/images/' . basename($link), $download);
        }
    }
}
