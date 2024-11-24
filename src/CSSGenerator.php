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
     * Generate margin auto classes (e.g., .mx-auto, .my-auto)
     */
    public function generateMarginAutoClasses(): string
    {
        return <<<CSS
.mx-auto { margin-left: auto; margin-right: auto; }
.my-auto { margin-top: auto; margin-bottom: auto; }
CSS;
    }

    /**
     * Generate background color classes, including variants.
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
     * Generate text color classes, including variants.
     */
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

    /**
     * Generate font size classes (e.g., .text-sm, .text-lg)
     */
    public function generateFontSizeClasses(): string
    {
        $fontSizes = [
            'xs' => '0.75rem',  // Extra small
            'sm' => '0.875rem', // Small
            'md' => '1rem',     // Medium
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
     * Generate width utility classes
     */
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

    /**
     * Generate height utility classes
     */
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

    /**
     * Generate opacity-related classes (e.g., .opacity-10, .bg-opacity-10)
     */
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

        foreach ($opacityLevels as $level => $value) {
            // Generate opacity classes
            $css .= ".opacity-{$level} { opacity: {$value}; }\n";

            // Generate background-opacity classes
            $css .= ".bg-opacity-{$level} { background-color: rgba(0, 0, 0, {$value}); }\n";
        }

        return $css;
    }

    /**
     * Generate spacing between flex items (e.g., .space-x-1, .space-y-2)
     */
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

    /**
     * Add responsive prefixes (e.g., sm:, md:, lg:, xl:) to utility classes.
     */
    private function addResponsivePrefixes(string $css): string
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

    /**
     * Write all generated CSS files to the output directory
     */
    public function writeCSSFiles(): void
    {
        $outputDir = __DIR__ . '/../output';

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Base CSS
        file_put_contents($outputDir . '/base.css', BaseHelper::generateBaseCSS());

        // Utilities CSS
        $utilitiesCSS = $this->generateMarginAutoClasses() . "\n\n" .
            $this->addResponsivePrefixes($this->generateSpacingClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateWidthClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateHeightClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateBackgroundColorClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateTextColorClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateFontSizeClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateOpacityClasses()) . "\n\n" .
            $this->addResponsivePrefixes($this->generateFlexSpaceClasses());
        file_put_contents($outputDir . '/utilities.css', $utilitiesCSS);

        // Components CSS
        file_put_contents($outputDir . '/components.css', $this->generateComponentsCSS());
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
}