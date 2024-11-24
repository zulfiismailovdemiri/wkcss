<?php

namespace App\Generators;

use App\Utils\ResponsiveHelper;

class SpacingGenerator
{
    private const SPACING_MULTIPLIER = 4;

    public function generateSpacingClasses(): string
    {
        $sizes = range(0, 5);
        $directions = [
            ['prefix' => 't', 'property' => 'top'],
            ['prefix' => 'b', 'property' => 'bottom'],
            ['prefix' => 'l', 'property' => 'left'],
            ['prefix' => 'r', 'property' => 'right'],
            ['prefix' => '', 'property' => ''],
        ];

        $css = "";

        foreach ($sizes as $size) {
            foreach ($directions as $direction) {
                $prefix = $direction['prefix'];
                $property = $direction['property'];

                if ($property) {
                    $css .= ".p{$prefix}-{$size} { padding-{$property}: " . ($size * self::SPACING_MULTIPLIER) . "px; }\n";
                    $css .= ".m{$prefix}-{$size} { margin-{$property}: " . ($size * self::SPACING_MULTIPLIER) . "px; }\n";
                } else {
                    $css .= ".p-{$size} { padding: " . ($size * self::SPACING_MULTIPLIER) . "px; }\n";
                    $css .= ".m-{$size} { margin: " . ($size * self::SPACING_MULTIPLIER) . "px; }\n";
                }
            }
        }

        return $css;
    }

    public function generateMarginAutoClasses(): string
    {
        return <<<CSS
.mx-auto { margin-left: auto; margin-right: auto; }
.my-auto { margin-top: auto; margin-bottom: auto; }
CSS;
    }

    public function generateFlexSpaceClasses(): string
    {
        $sizes = range(0, 5);
        $css = "";

        foreach ($sizes as $size) {
            $spacing = $size * self::SPACING_MULTIPLIER;

            // Space between items along the x-axis
            $css .= ".space-x-{$size} > * + * { margin-left: {$spacing}px; }\n";

            // Space between items along the y-axis
            $css .= ".space-y-{$size} > * + * { margin-top: {$spacing}px; }\n";
        }

        return $css;
    }
}