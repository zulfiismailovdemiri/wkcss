<?php

namespace App;
class CSSGenerator
{
    private const SPACING_MULTIPLIER = 4;

    /**
     * Generate spacing classes (e.g., .mt-1, .pt-1)
     */
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

    /**
     * Generate background color classes, including 100-900 scales.
     */
    public function generateBackgroundColorClasses(): string
    {
        $basicColors = ColorHelper::getBasicColors();
        $css = "";

        foreach ($basicColors as $name => $hex) {
            // Add the base color
            $css .= ".bg-{$name} { background-color: {$hex}; }\n";

            // Generate and add variants
            $variants = ColorHelper::generateColorScale($hex);
            foreach ($variants as $scale => $variantHex) {
                $css .= ".bg-{$name}-{$scale} { background-color: {$variantHex}; }\n";
            }
        }

        return $css;
    }

    /**
     * Generate font size classes (e.g., .text-sm, .text-md, .text-lg)
     */
    public function generateFontSizeClasses(): string
    {
        $fontSizes = [
            'xs' => '0.75rem',  // Extra small
            'sm' => '0.875rem', // Small
            'md' => '1rem',     // Medium (default)
            'lg' => '1.125rem', // Large
            'xl' => '1.25rem',  // Extra large
            '2xl' => '1.5rem',  // 2x Extra large
            '3xl' => '1.875rem',// 3x Extra large
            '4xl' => '2.25rem', // 4x Extra large
            '5xl' => '3rem',    // 5x Extra large
        ];

        $css = "";

        foreach ($fontSizes as $name => $size) {
            $css .= ".text-{$name} { font-size: {$size}; }\n";
        }

        return $css;
    }

    /**
     * Generate text color classes (e.g., .text-red, .text-red-100, .text-white, .text-black)
     */
    public function generateTextColorClasses(): string
    {
        $basicColors = ColorHelper::getBasicColors();
        $css = "";

        // Add black and white explicitly
        $css .= ".text-black { color: #000000; }\n";
        $css .= ".text-white { color: #ffffff; }\n";

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

    /**
     * Generate components.css content (flex and grid utilities).
     */
    public function generateComponentsCSS(): string
    {
        $flexboxCSS = ComponentHelper::generateFlexboxClasses();
        $gridCSS = ComponentHelper::generateGridClasses();

        return $flexboxCSS . "\n\n" . $gridCSS;
    }

    /**
     * Generate flex space classes (e.g., .space-x-1, .space-y-2)
     */
    public function generateFlexSpaceClasses(): string
    {
        $sizes = range(0, 10); // Define space sizes (0 to 10 units)
        $css = "";

        foreach ($sizes as $size) {
            $value = $size * self::SPACING_MULTIPLIER; // Use the spacing multiplier for consistency

            // Horizontal spaces
            $css .= ".space-x-{$size} > * + * { margin-left: {$value}px; }\n";

            // Vertical spaces
            $css .= ".space-y-{$size} > * + * { margin-top: {$value}px; }\n";
        }

        return $css;
    }

    /**
     * Write CSS files to the output directory
     */
    public function writeCSSFiles(): void
    {
        $outputDir = __DIR__ . '/../output';

        // Ensure the output directory exists
        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Write base.css
        file_put_contents($outputDir . '/base.css', BaseHelper::generateBaseCSS());

        // Write utilities.css
        $utilitiesCSS = $this->generateSpacingClasses() . "\n" .
            $this->generateBackgroundColorClasses() . "\n" .
            $this->generateFontSizeClasses() . "\n" .
            $this->generateTextColorClasses() . "\n" .
            $this->generateFlexSpaceClasses();
        file_put_contents($outputDir . '/utilities.css', $utilitiesCSS);

        // Write components.css
        file_put_contents($outputDir . '/components.css', $this->generateComponentsCSS());
    }
}