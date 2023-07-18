<?php

namespace Agmedia\Api\Helper;

class Helper
{

    /**
     * @param string|null $text
     *
     * @return string
     */
    public static function setText(string $text = null): string
    {
        if ($text) {
            $text = str_replace("'", "", $text);

            return str_replace('"', 'in', $text);
        }

        return '';
    }


    /**
     * @param string|null $text
     *
     * @return string
     */
    public static function setDescription(string $text = null): string
    {
        if ($text) {
            $text = str_replace("\n", '<br>', $text);
            $text = str_replace("\r", '<br>', $text);

            return str_replace("\t", '<tab>', $text);
        }

        return '';
    }


    /**
     * @param string $base64_string
     * @param string $output_file
     *
     * @return string
     */
    public static function base64_to_jpeg(string $base64_string, string $output_file): string
    {
        file_put_contents(DIR_IMAGE . $output_file, base64_decode($base64_string));

        return $output_file;
    }

}