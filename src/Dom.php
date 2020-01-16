<?php

namespace Sb;

use GuzzleHttp\Psr7;
use simplehtmldom\HtmlDocument;
use simplehtmldom\HtmlNode;

class Dom
{
    private $dom;
    private $url;

    public function __construct($html, $url, $encoding = 'UTF-8')
    {
        if ($encoding !== 'UTF-8') {
            $html = mb_convert_encoding($html, 'UTF-8', $encoding);
        }

        $this->dom = new HtmlDocument($html);
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getHtml()
    {
        return $this->__toString();
    }

    /**
     * @param $selector
     * @param null $dom
     * @return HtmlNode[]|null
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
     * @param null $dom
     * @return HtmlNode|null
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
     * @param $idx
     * @param null $dom
     * @return HtmlNode|null
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

    /**
     * @return string
     */
    public function __toString()
    {
        if (!$this->dom) {
            return '';
        }

        return $this->dom->innertext;
    }
    
}