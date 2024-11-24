<?php

namespace App\Utils;

class ResponsiveHelper
{
    public static function addResponsivePrefixes(string $css): string
    {
        $breakpoints = [
            'sm' => '640px',
            'md' => '768px',
            'lg' => '1024px',
            'xl' => '1280px',
        ];

        $responsiveCSS = "";

        foreach ($breakpoints as $prefix => $minWidth) {
            $responsiveCSS .= "@media (min-width: {$minWidth}) {\n";
            // Escape the colon in the prefix with a backslash
            $responsiveCSS .= preg_replace('/^\.(\w+)/m', ".{$prefix}\\:$1", $css);
            $responsiveCSS .= "}\n";
        }

        return $css . "\n" . $responsiveCSS;
    }
}