<?php

namespace App;

class CSSGenerator
{
    private const SPACING_MULTIPLIER = 4;

    /**
     * Generate hidden utility classes.
     */
    public function generateHiddenClasses(): string
    {
        return <<<CSS
.hidden { display: none; }
.block { display: block; }
.inline-block { display: inline-block; }
.inline { display: inline; }
.flex { display: flex; }
.grid { display: grid; }
CSS;
    }

    /**
     * Generate opacity utility classes.
     */
    public function generateOpacityClasses(): string
    {
        $levels = range(0, 100, 10);
        $css = "";

        foreach ($levels as $level) {
            $css .= ".opacity-{$level} { opacity: " . ($level / 100) . "; }\n";
        }

        return $css;
    }

    /**
     * Generate visibility utility classes.
     */
    public function generateVisibilityClasses(): string
    {
        return <<<CSS
.visible { visibility: visible; }
.invisible { visibility: hidden; }
CSS;
    }

    /**
     * Generate transition utility classes.
     */
    public function generateTransitionClasses(): string
    {
        return <<<CSS
.transition { transition: all 0.3s ease-in-out; }
.transition-none { transition: none; }
CSS;
    }

    /**
     * Generate transform utility classes.
     */
    public function generateTransformClasses(): string
    {
        return <<<CSS
.transform { transform: none; }
.scale-50 { transform: scale(0.5); }
.scale-100 { transform: scale(1); }
.scale-150 { transform: scale(1.5); }
.rotate-0 { transform: rotate(0deg); }
.rotate-45 { transform: rotate(45deg); }
.rotate-90 { transform: rotate(90deg); }
CSS;
    }

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
     * Generate flex space classes (e.g., .space-x-1, .space-y-2)
     */
    public function generateFlexSpaceClasses(): string
    {
        $sizes = range(0, 5); // Define gap sizes
        $css = "";

        foreach ($sizes as $size) {
            $value = $size * self::SPACING_MULTIPLIER;

            // Horizontal spaces
            $css .= ".space-x-{$size} > * + * { margin-left: {$value}px; }\n";

            // Vertical spaces
            $css .= ".space-y-{$size} > * + * { margin-top: {$value}px; }\n";
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
     * Generate text color classes, including 100-900 scales.
     */
    public function generateTextColorClasses(): string
    {
        $basicColors = ColorHelper::getBasicColors();
        $css = "";

        $css .= ".text-black { color: #000000; }\n";
        $css .= ".text-white { color: #ffffff; }\n";

        foreach ($basicColors as $name => $hex) {
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
     * Generate font size classes (e.g., .text-sm, .text-lg).
     */
    public function generateFontSizeClasses(): string
    {
        $fontSizes = [
            'xs' => '0.75rem',
            'sm' => '0.875rem',
            'md' => '1rem',
            'lg' => '1.125rem',
            'xl' => '1.25rem',
            '2xl' => '1.5rem',
            '3xl' => '1.875rem',
            '4xl' => '2.25rem',
            '5xl' => '3rem',
        ];

        $css = "";

        foreach ($fontSizes as $name => $size) {
            $css .= ".text-{$name} { font-size: {$size}; }\n";
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
     * Write all CSS files.
     */
    public function writeCSSFiles(): void
    {
        $outputDir = __DIR__ . '/../output';

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Write base.css
        file_put_contents($outputDir . '/base.css', BaseHelper::generateBaseCSS());

        // Write utilities.css
        $utilitiesCSS = $this->generateHiddenClasses() . "\n\n" .
            $this->generateOpacityClasses() . "\n\n" .
            $this->generateVisibilityClasses() . "\n\n" .
            $this->generateTransitionClasses() . "\n\n" .
            $this->generateTransformClasses() . "\n\n" .
            $this->generateSpacingClasses() . "\n\n" .
            $this->generateFlexSpaceClasses() . "\n\n" .
            $this->generateBackgroundColorClasses() . "\n\n" .
            $this->generateTextColorClasses() . "\n\n" .
            $this->generateFontSizeClasses();
        file_put_contents($outputDir . '/utilities.css', $utilitiesCSS);

        // Write components.css
        file_put_contents($outputDir . '/components.css', $this->generateComponentsCSS());
    }
}