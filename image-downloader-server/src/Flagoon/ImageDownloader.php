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
        $htmlPage = file_get_contents($this->url);
        $matches = [];
        preg_match_all('/<img.{1,}src="(.*\.jpg)".*>/U', $htmlPage, $matches);
        $images = $matches[1];
        foreach ($images as $image) {
            $download = file_get_contents($image);
            file_put_contents('./resources/images/' . preg_replace('/[0-9]*/', '', basename($image)), $download);
        }
    }
}
