<?php

namespace App\Generators;

use App\Helpers\ColorHelper;

class ColorGenerator
{
    public function generateBackgroundColorClasses(): string
    {
        $basicColors = ColorHelper::getBasicColors();
        $css = "";

        foreach ($basicColors as $name => $hex) {
            $rgb = ColorHelper::hexToRgb($hex);

            // Base color with RGB variable
            $css .= ".bg-{$name} { background-color: {$hex}; --bg-color-rgb: {$rgb['r']}, {$rgb['g']}, {$rgb['b']}; }\n";

            // Generate color scale variants
            $variants = ColorHelper::generateColorScale($hex);
            foreach ($variants as $scale => $variantHex) {
                $rgbVariant = ColorHelper::hexToRgb($variantHex);
                $css .= ".bg-{$name}-{$scale} { background-color: {$variantHex}; --bg-color-rgb: {$rgbVariant['r']}, {$rgbVariant['g']}, {$rgbVariant['b']}; }\n";
            }
        }

        return $css;
    }

    public function generateTextColorClasses(): string
    {
        $basicColors = ColorHelper::getBasicColors();
        $css = "";

        foreach ($basicColors as $name => $hex) {
            // Add the base color
            $css .= ".text-{$name} { color: {$hex}; }\n";

            // Generate and add variants
            $variants = ColorHelper::generateColorScale($hex);
            foreach ($variants as $scale => $variantHex) {
                $css .= ".text-{$name}-{$scale} { color: {$variantHex}; }\n";
            }
        }

        return $css;
    }

    public function generateOpacityClasses(): string
    {
        $opacityLevels = [
            0 => '0',
            10 => '0.1',
            20 => '0.2',
            30 => '0.3',
            40 => '0.4',
            50 => '0.5',
            60 => '0.6',
            70 => '0.7',
            80 => '0.8',
            90 => '0.9',
            100 => '1',
        ];

        $css = "";

        // Element opacity classes
        foreach ($opacityLevels as $level => $value) {
            $css .= ".opacity-{$level} { opacity: {$value}; }\n";
        }

        // Background opacity classes
        foreach ($opacityLevels as $level => $value) {
            $css .= ".bg-opacity-{$level} { background-color: rgba(var(--bg-color-rgb), {$value}); }\n";
        }

        return $css;
    }
}