<?php

use App\Helpers\ColorHelper;
use PHPUnit\Framework\TestCase;

class ColorHelperTest extends TestCase
{
    public function testGetBasicColors(): void
    {
        $colors = ColorHelper::getBasicColors();
        $this->assertIsArray($colors);
        $this->assertArrayHasKey('red', $colors);
        $this->assertSame('#ff0000', $colors['red']);
    }

    public function testGenerateColorScale(): void
    {
        $redScale = ColorHelper::generateColorScale('#ff0000');

        $this->assertIsArray($redScale);
        $this->assertCount(19, $redScale); // Ensure 19 shades are generated (50 to 950).
        $this->assertArrayHasKey(50, $redScale); // Check the lightest shade key.
        $this->assertArrayHasKey(950, $redScale); // Check the darkest shade key.
        $this->assertNotSame('#ff0000', $redScale[50]); // Lightest should not be the base color.
        $this->assertSame('#ff0000', $redScale[500]); // Base color should be at 500.
    }
}