<?php

use App\Helpers\BaseHelper;
use PHPUnit\Framework\TestCase;

class BaseHelperTest extends TestCase
{
    public function testGenerateBaseCSS(): void
    {
        $baseCSS = BaseHelper::generateBaseCSS();
        $this->assertStringContainsString('*', $baseCSS);
        $this->assertStringContainsString('body', $baseCSS);
    }
}