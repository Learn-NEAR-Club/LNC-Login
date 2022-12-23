<?php

namespace LNCNearLogin\Controllers;

use LNCNearLogin\Model\Constructor\ConfigPage;

/**
 * Class PageConstructor
 * @package BGLoginCustomize
 */
class PageConstructor
{
    /**
     * pages pool
     *
     * @var array
     */
    protected $pages = [];

    /**
     * PageConstructor constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->pageCreator($config);
    }

    /**
     * @param $config
     */
    protected function pageCreator($config)
    {
        $this->pages['config'] = new ConfigPage($config);
    }
}
