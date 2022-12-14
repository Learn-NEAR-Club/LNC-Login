<?php

namespace TechbridgeNearLogin\Helper;

/**
 * Class Data
 * @package TechbridgeNearLogin\Helper
 */
class FormData
{
    public static function getAllowedTagsForFormEscape(): array
    {
        $allowedAtts = [
            'align' => [],
            'class' => [],
            'type' => [],
            'id' => [],
            'dir' => [],
            'lang' => [],
            'style' => [],
            'xml:lang' => [],
            'src' => [],
            'alt' => [],
            'href' => [],
            'rel' => [],
            'rev' => [],
            'target' => [],
            'novalidate' => [],
            'value' => [],
            'name' => [],
            'tabindex' => [],
            'action' => [],
            'method' => [],
            'for' => [],
            'width' => [],
            'height' => [],
            'data' => [],
            'title' => [],
            'selected' => [],
        ];
        return [
            'h1' => $allowedAtts,
            'label' => $allowedAtts,
            'form' => $allowedAtts,
            'input' => $allowedAtts,
            'button' => $allowedAtts,
            'div' => $allowedAtts,
            'select' => $allowedAtts,
            'option' => $allowedAtts,
        ];
    }
}
