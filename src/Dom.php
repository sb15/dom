<?php

namespace Sb;

use Psr\Http\Message\UriInterface;
use Sunra\PhpSimple\HtmlDomParser;
use GuzzleHttp\Psr7;

class Dom
{
    private $dom;
    private $url;

    public function __construct($html, $url, $encoding = 'UTF-8')
    {
        if ($encoding !== 'UTF-8') {
            $html = mb_convert_encoding($html, 'UTF-8', $encoding);
        }

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
     * @param $uri
     * @return string
     */
    public function resolveUri($uri)
    {
        $rel = Psr7\uri_for($uri === null ? '' : $uri);
        return (string) Psr7\UriResolver::resolve(Psr7\uri_for($this->getUrl()), $rel);
    }

    public function __toString()
    {
        if (!$this->dom) {
            return '';
        }

        return $this->dom->innertext;
    }
    
}