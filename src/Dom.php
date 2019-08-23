<?php

namespace Sb;

use Psr\Http\Message\UriInterface;
use Sunra\PhpSimple\HtmlDomParser;
use GuzzleHttp\Psr7;

class Dom
{
    private $dom;
    private $url;

    public function __construct($html, $url)
    {
        $this->dom = HtmlDomParser::str_get_html($html);
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function getHtml()
    {
        return $this->__toString();
    }

    /**
     * @param $selector
     * @param \simple_html_dom_node|null $dom
     * @return \simple_html_dom_node[]
     */
    public function find($selector, $dom = null)
    {
        if (null === $dom) {
            $dom = $this->dom;
        }

        if (!$dom) {
            return null;
        }

        return $dom->find($selector);
    }

    /**
     * @param $selector
     * @param \simple_html_dom_node|null $dom
     * @return \simple_html_dom_node
     */
    public function findFirst($selector, $dom = null)
    {
        if (null === $dom) {
            $dom = $this->dom;
        }

        if (!$dom) {
            return null;
        }

        return $dom->find($selector, 0);
    }

    /**
     * @param $selector
     * @param \simple_html_dom_node $dom
     * @param int $idx
     * @return \simple_html_dom_node
     */
    public function findNElement($selector, $idx, $dom = null)
    {
        if (null === $dom) {
            $dom = $this->dom;
        }

        if (!$dom) {
            return null;
        }

        return $dom->find($selector, $idx);
    }

    /**
     * @param string|UriInterface $uri
     * @param string|UriInterface $baseUri
     * @return string
     */
    public static function resolveUri($uri, $baseUri)
    {
        $formUri = Psr7\uri_for($uri === null ? '' : $uri);
        return (string) Psr7\UriResolver::resolve(Psr7\uri_for($baseUri), $formUri);
    }

    public function __toString()
    {
        if (!$this->dom) {
            return '';
        }

        return $this->dom->innertext;
    }
    
}