<?php
/**
 * Created by PhpStorm.
 * User: flagoon
 * Date: 02.02.18
 * Time: 11:07
 */
declare(strict_types=1);
namespace Flagoon;

class Helper
{
    private static $instance = null;

    private function __construct()
    {
        /**
         * private, so no one can construct new Helper, but Helper
         */
    }

    /**
     * It's looking after img tags in html and extract links to images.
     * TODO: find the way to catch images with relative path.
     *
     * @param string $htmlBody
     * @return array
     */
    public function extractImages(string $htmlBody): array
    {
        $matches = [];
        preg_match_all('/<img.{1,}src="(.*\.jpg)".*>/U', $htmlBody, $matches);
        return $matches[1];
    }

    /**
     * Function that makes only one instance of Helper class.
     * @return Helper instance.
     */
    public static function Instance(): Helper
    {
        {
            if (self::$instance == null) {
                self::$instance = new Helper();
            }

            return self::$instance;
        }
    }

    /**
     * Checks if file exists locally.
     *
     * @param string $name name of the file we are looking.
     * @return bool
     */
    public function checkIfImageExists(string $name): bool
    {
        return file_exists('./resources/images/' . $name);
    }

    /**
     * Compares if two files are identical. Returns true or false.
     *
     * @param string $fileOne first file
     * @param string $fileTwo second file
     * @return bool
     */
    public function compareFiles(string $fileOne, string $fileTwo): bool
    {
        return $fileOne === $fileTwo;
    }

    /**
     * Adds a random hash to the name of the file.
     *
     * @param string $name name to add hash to.
     * @return string
     */
    public function addHash(string $name): string
    {
        $separateName= explode('.', $name);
        $hash = substr(md5((string)rand(1,100)), -4);
        return "{$separateName[0]}_$hash.$separateName[1]";
    }
}
