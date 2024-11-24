<?php

namespace App\Helpers;
class BaseHelper
{
    /**
     * Generate base.css content for resets and default styles
     *
     * @return string
     */
    public static function generateBaseCSS(): string
    {
        return <<<CSS
/* base.css */

/* Reset margin, padding, and box-sizing for all elements */
*,
*::before,
*::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* HTML and body */
html, body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    font-size: 16px;
    line-height: 1.5;
    background: #fff;
    color: #000;
}

/* Remove list styles for ul and ol */
ul, ol {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Links without decoration */
a {
    text-decoration: none;
    color: inherit;
}

a:hover {
    text-decoration: underline;
}

/* Inputs, buttons, and textareas */
input, textarea, select, button {
    margin: 0;
    padding: 0;
    border: none;
    outline: none;
    font: inherit;
    background: none;
    color: inherit;
}

/* Remove button appearance */
button {
    background: none;
    border: none;
    cursor: pointer;
}

/* Table resets */
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
}

td, th {
    padding: 0;
    text-align: left;
}

/* Images and media elements */
img, video, iframe {
    max-width: 100%;
    height: auto;
    border: 0;
}

/* Blockquote and figure */
blockquote, figure {
    margin: 0;
    padding: 0;
}

/* Form elements */
fieldset {
    border: 0;
    padding: 0;
    margin: 0;
}

legend {
    padding: 0;
}

/* Strong and bold */
strong {
    font-weight: bold;
}

/* Heading reset */
h1, h2, h3, h4, h5, h6 {
    margin: 0;
    font-size: inherit;
    font-weight: inherit;
}

/* General focus styles for accessibility */
:focus {
    outline: 2px dashed #007bff;
    outline-offset: 2px;
}
CSS;
    }
}