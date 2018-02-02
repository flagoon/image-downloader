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
}
