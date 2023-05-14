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
            $text = str_replace('"', 'in', $text);

            return $text;
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
            $text = str_replace("\t", '<tab>', $text);

            return $text;
        }

        return '';
    }

}