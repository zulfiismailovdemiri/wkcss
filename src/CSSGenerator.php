<?php

namespace App;

use App\Generators\SpacingGenerator;
use App\Generators\ColorGenerator;
use App\Generators\TypographyGenerator;
use App\Generators\DimensionGenerator;
use App\Generators\ComponentGenerator;
use App\Utils\ResponsiveHelper;
use App\Helpers\BaseHelper;

class CSSGenerator
{
    private $spacingGenerator;
    private $colorGenerator;
    private $typographyGenerator;
    private $dimensionGenerator;
    private $componentGenerator;

    public function __construct()
    {
        $this->spacingGenerator = new SpacingGenerator();
        $this->colorGenerator = new ColorGenerator();
        $this->typographyGenerator = new TypographyGenerator();
        $this->dimensionGenerator = new DimensionGenerator();
        $this->componentGenerator = new ComponentGenerator();
    }

    public function writeCSSFiles(): void
    {
        $outputDir = __DIR__ . '/../output';

        if (!is_dir($outputDir)) {
            mkdir($outputDir, 0755, true);
        }

        // Base CSS
        file_put_contents($outputDir . '/base.css', BaseHelper::generateBaseCSS());

        // Utilities CSS
        $utilitiesCSS = $this->spacingGenerator->generateMarginAutoClasses() . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->spacingGenerator->generateSpacingClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->dimensionGenerator->generateWidthClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->dimensionGenerator->generateHeightClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->colorGenerator->generateBackgroundColorClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->colorGenerator->generateTextColorClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->typographyGenerator->generateFontSizeClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->colorGenerator->generateOpacityClasses()) . "\n\n" .
            ResponsiveHelper::addResponsivePrefixes($this->spacingGenerator->generateFlexSpaceClasses());
        file_put_contents($outputDir . '/utilities.css', $utilitiesCSS);

        // Components CSS
        file_put_contents($outputDir . '/components.css', $this->componentGenerator->generateComponentsCSS());
    }
}