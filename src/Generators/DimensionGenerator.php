<?php

namespace App\Generators;

class DimensionGenerator
{
    public function generateWidthClasses(): string
    {
        $fractionalSizes = [
            '1/2' => '50%',
            '1/3' => '33.333%',
            '2/3' => '66.666%',
            '1/4' => '25%',
            '3/4' => '75%',
            '1/5' => '20%',
            '2/5' => '40%',
            '3/5' => '60%',
            '4/5' => '80%',
            '1/6' => '16.666%',
            '5/6' => '83.333%',
        ];

        $percentageSizes = range(10, 100, 10);
        $specialSizes = ['full' => '100%', 'screen' => '100vw'];

        $css = "";

        // Fractional sizes
        foreach ($fractionalSizes as $key => $value) {
            $escapedKey = str_replace('/', '\\/', $key);
            $css .= ".w-{$escapedKey} { width: {$value}; }\n";
        }

        // Percentage sizes
        foreach ($percentageSizes as $percent) {
            $css .= ".w-{$percent} { width: {$percent}%; }\n";
        }

        // Special sizes
        foreach ($specialSizes as $key => $value) {
            $css .= ".w-{$key} { width: {$value}; }\n";
        }

        return $css;
    }

    public function generateHeightClasses(): string
    {
        $fractionalSizes = [
            '1/2' => '50%',
            '1/3' => '33.333%',
            '2/3' => '66.666%',
            '1/4' => '25%',
            '3/4' => '75%',
            '1/5' => '20%',
            '2/5' => '40%',
            '3/5' => '60%',
            '4/5' => '80%',
            '1/6' => '16.666%',
            '5/6' => '83.333%',
        ];

        $percentageSizes = range(10, 100, 10);
        $specialSizes = ['full' => '100%', 'screen' => '100vh'];

        $css = "";

        // Fractional sizes
        foreach ($fractionalSizes as $key => $value) {
            $escapedKey = str_replace('/', '\\/', $key);
            $css .= ".h-{$escapedKey} { height: {$value}; }\n";
        }

        // Percentage sizes
        foreach ($percentageSizes as $percent) {
            $css .= ".h-{$percent} { height: {$percent}%; }\n";
        }

        // Special sizes
        foreach ($specialSizes as $key => $value) {
            $css .= ".h-{$key} { height: {$value}; }\n";
        }

        return $css;
    }
}