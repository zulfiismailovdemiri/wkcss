<?php

use PHPUnit\Framework\TestCase;
use App\ComponentHelper;

class ComponentHelperTest extends TestCase
{
    public function testGenerateFlexboxClasses(): void
    {
        $flexCSS = ComponentHelper::generateFlexboxClasses();
        $this->assertIsString($flexCSS);
        $this->assertStringContainsString('.flex { display: flex; }', $flexCSS);
        $this->assertStringContainsString('.items-center { align-items: center; }', $flexCSS);
        $this->assertStringContainsString('.order-first { order: -1; }', $flexCSS);
    }

    public function testGenerateGridClasses(): void
    {
        $gridCSS = ComponentHelper::generateGridClasses();
        $this->assertIsString($gridCSS);
        $this->assertStringContainsString('.grid { display: grid; }', $gridCSS);
        $this->assertStringContainsString('.grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }', $gridCSS);
        $this->assertStringContainsString('.gap-2 { gap: 8px; }', $gridCSS);
    }
}