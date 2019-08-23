<?php

namespace Sb\Curl\Tests;

use PHPUnit\Framework\TestCase;
use Sb\Dom;

class DomTest extends TestCase
{

    public function testTitle()
    {
        $url = 'https://httpbin.org';
        $html = file_get_contents($url);

        $dom  = new Dom($html, $url);

        $element = $dom->findFirst('title');

        $this->assertNotEmpty($element);
    }

    public function testEmptyHtml()
    {
        $url = 'https://httpbin.org';
        $html = '';

        $dom  = new Dom($html, $url);

        $element = $dom->findFirst('title');

        $this->assertNull($element);
    }

}