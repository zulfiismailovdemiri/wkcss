<?php

namespace App;

require_once __DIR__ . '/vendor/autoload.php';

$generator = new CSSGenerator();
$generator->writeCSSFiles();

echo "CSS files (base.css, utilities.css, components.css) generated successfully in the output directory!\n";