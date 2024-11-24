<?php

namespace App;
class ColorHelper
{
    /**
     * Get basic colors with their hex values.
     *
     * @return array
     */
    public static function getBasicColors(): array
    {
        return [
            "black" => "#000000",
            "white" => "#ffffff",
            "red" => "#ff0000",
            "green" => "#00ff00",
            "blue" => "#0000ff",
            "yellow" => "#ffff00",
            "cyan" => "#00ffff",
            "magenta" => "#ff00ff",
            "gray" => "#808080",
            "orange" => "#ffa500",
            "purple" => "#800080",
            "brown" => "#a52a2a",
        ];
    }

    /**
     * Generate a color scale (50 to 950) for a given color.
     *
     * @param string $hex Hexadecimal color code (e.g., "#ff0000").
     * @return array Array of generated colors with keys like "50", "100", ..., "950".
     */
    public static function generateColorScale(string $hex): array
    {
        $rgb = self::hexToRgb($hex);

        // Calculate lighter shades (tints)
        $lighterShades = [];
        for ($i = 9; $i >= 1; $i--) { // Start from 9 for the lightest
            $factor = $i / 10; // E.g., 9/10, 8/10, ..., 1/10
            $tint = [
                'r' => (int) (($rgb['r'] * (1 - $factor)) + (255 * $factor)),
                'g' => (int) (($rgb['g'] * (1 - $factor)) + (255 * $factor)),
                'b' => (int) (($rgb['b'] * (1 - $factor)) + (255 * $factor)),
            ];
            $lighterShades[] = self::rgbToHex($tint);
        }

        // Base color (midpoint)
        $baseColor = [$hex];

        // Calculate darker shades (shades)
        $darkerShades = [];
        for ($i = 1; $i <= 9; $i++) { // Start from 1 for the darkest
            $factor = $i / 10; // E.g., 1/10, 2/10, ..., 9/10
            $shade = [
                'r' => (int) ($rgb['r'] * (1 - $factor)),
                'g' => (int) ($rgb['g'] * (1 - $factor)),
                'b' => (int) ($rgb['b'] * (1 - $factor)),
            ];
            $darkerShades[] = self::rgbToHex($shade);
        }

        // Combine lighter shades, base color, and darker shades
        $orderedShades = array_merge($lighterShades, $baseColor, $darkerShades);

        // Assign keys 50 to 950
        $scale = [];
        foreach ($orderedShades as $index => $color) {
            $scale[($index + 1) * 50] = $color; // Start keys from 50, step by 50
        }

        return $scale;
    }

    /**
     * Convert a hex color to RGB.
     *
     * @param string $hex Hexadecimal color code.
     * @return array Associative array with keys "r", "g", "b".
     */
    public static function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, "#");
        if (strlen($hex) === 3) {
            $hex = "{$hex[0]}{$hex[0]}{$hex[1]}{$hex[1]}{$hex[2]}{$hex[2]}";
        }
        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2)),
        ];
    }

    /**
     * Convert an RGB color to hex.
     *
     * @param array $rgb Associative array with keys "r", "g", "b".
     * @return string Hexadecimal color code.
     */
    public static function rgbToHex(array $rgb): string
    {
        return sprintf("#%02x%02x%02x", $rgb['r'], $rgb['g'], $rgb['b']);
    }
}