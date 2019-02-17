<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 14:46
 */

namespace NicholasMuestras\AllDifferentDirections\models;


class Painter
{
    private static $_width;
    private static $_height;
    private static $_widthScale;
    private static $_heightScale;


    public static function draw(array $graphs, $width, $height) {

        self::$_height = $height;
        self::$_width = $width;

        $image = @ImageCreate (self::$_width, self::$_height) or die ("Cannot Initialize new GD image stream");
        self::getScale($graphs);

        $bgcolor = self::ImageColor($image, array('r'=>255, 'g'=>255, 'b'=>255));
        $color = self::ImageColor($image, array('b'=>175));
        $green = self::ImageColor($image, array('g'=>175));
        $gray = self::ImageColor($image, array('r'=>175, 'g'=>175, 'b'=>175));

        ImageLine($image, 0, self::$_height / 2, self::$_width, self::$_height / 2, $gray);
        ImageLine($image, self::$_width / 2, 0, self::$_width / 2, self::$_height, $gray);


        foreach ($graphs as $graph) {
            self::drawGraph($image, $graph, $color);
        }

        header ("Content-type: image/png");
        ImagePng ($image);

    }


    private static function ImageColor($image, $color_array)
    {
        return ImageColorAllocate(
            $image,
            isset($color_array['r']) ? $color_array['r'] : 0,
            isset($color_array['g']) ? $color_array['g'] : 0,
            isset($color_array['b']) ? $color_array['b'] : 0
        );
    }


    private static function getScale(array $graphs) {
        $maxValue = 1;

        foreach ($graphs as $graph) {
            foreach ($graph as $point) {
                foreach ($point as $value) {
                    if($maxValue < abs($value)) {
                        $maxValue = abs($value);
                    }
                }
            }
        }

        self::$_widthScale = round(self::$_width / $maxValue, 0);
        self::$_heightScale = round(self::$_height / $maxValue, 0);
    }


    private static function drawGraph(&$src, array &$graph, &$color) {

        $fixX = self::$_width / 2;
        $fixY = self::$_height / 2;

        foreach ($graph as $index => $dot) {
            imagefilledellipse($src,  $fixX + $dot[0], $fixY - $dot[1], 5, 5, $color);
            imagettftext($src, 6, 0, $fixX + $dot[0] + 5, $fixY - $dot[1], $color, 'C:\Windows\Fonts\Verdana.ttf', $dot[0] .', ' . $dot[1] . ';');
            if(isset($graph[$index + 1])) {
                ImageLine($src,  $fixX + $dot[0], $fixY - $dot[1], $fixX + $graph[$index + 1][0], $fixY - $graph[$index + 1][1], $color);
            }
        }
    }
}
