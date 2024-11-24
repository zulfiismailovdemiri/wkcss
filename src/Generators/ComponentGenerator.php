<?php

namespace App\Generators;

use App\Helpers\ComponentHelper;

class ComponentGenerator
{
    public function generateComponentsCSS(): string
    {
        $flexboxCSS = ComponentHelper::generateFlexboxClasses();
        $gridCSS = ComponentHelper::generateGridClasses();

        return $flexboxCSS . "\n\n" . $gridCSS;
    }
}