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

    /**
     * Set URL for this class.
     *
     * @param string $url
     */
    public function setUrl(string $url):void
    {
        $this->url = $url;
    }

    /**
     * Returns this URL.
     *
     * @return string
     */
    public function getUrl():string
    {
        return $this->url;
    }

    /**
     * Function is searching for img tags in provided HTML and returns array of links
     *
     * @return array
     */
    private function getImageLinks(): array
    {
        $helper = Helper::Instance();
        $htmlPage = file_get_contents($this->url);
        return $helper->extractImages($htmlPage);
    }

    /**
     * Function is getting array of links from getImageLink() and then save them in folder. It reports to logger
     * when some files are a duplicate.
     */
    public function saveImages(): void
    {
        $helper = Helper::Instance();
        $links = $this->getImageLinks();

        foreach ($links as $link) {
            $name = basename($link);
            $download = file_get_contents($link);

            if ($helper->checkIfImageExists($name)) {
                $localImage = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/images/' . $name);
                if ($helper->compareFiles($download, $localImage)) {
                    continue;
                } else {
                    $name = $helper->addHash($name);
                }
            }
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/resources/images/' . $name, $download);
        }
        echo json_encode(["message" => "Images downloaded"]);
    }
}
