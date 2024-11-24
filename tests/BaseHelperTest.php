<?php

use PHPUnit\Framework\TestCase;
use App\BaseHelper;

class BaseHelperTest extends TestCase
{
    public function testGenerateBaseCSS(): void
    {
        $baseCSS = BaseHelper::generateBaseCSS();
        $this->assertStringContainsString('*', $baseCSS);
        $this->assertStringContainsString('body', $baseCSS);
    }
}