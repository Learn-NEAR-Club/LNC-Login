<?php

namespace LNCNearLogin\Model;

/**
 * Class Config
 * @package LNCNearLogin\Model
 */
class Config
{
    /**
     * Plugin name
     */
    const PLUGIN_NAME = 'lnc-login-with-near';

    /**
     *  Views directory const
     */
    const VIEWS_DIR = 'views';

    /**
     *  default language
     */
    const DEFAULT_LANG = 'en';

    /**
     * Templates dir const
     */
    const TEMPLATES_DIR = 'templates';

    /**
     * Plugin base path
     *
     * @var string $_basePath
     */
    private string $_basePath;

    /**
     * Path to views directory
     * @var string $_viewsPath
     */
    private string $_viewsPath;

    /**
     * Path to scripts directory
     * @var string $_scriptsPath
     */
    private string $_scriptsPath;

    /**
     * Path to templates.
     *
     * @var $_templatesPath
     */
    private string $_templatesPath;

    /**
     * @var $_config
     */
    public $config;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->_setPaths();
    }

    /**
     * Method to set default plugin paths for DI
     */
    private function _setPaths()
    {
        $this->_basePath = plugin_dir_path(__DIR__);
        $this->_viewsPath = self::getBasePath() . self::VIEWS_DIR;
        $this->_scriptsPath = plugin_dir_url(__DIR__) . '/public/';
        $this->_templatesPath = self::getBasePath() . self::TEMPLATES_DIR;
    }

    /**
     * Method to get plugin name
     *
     * @return string
     */
    public function getPluginName(): string
    {
        return self::PLUGIN_NAME;
    }

    /**
     * Method to get base plugin path
     *
     * @return string
     */
    public  function getBasePath(): string
    {
        return $this->_basePath;
    }

    /**
     * Method to get path to template directory
     *
     * @return string
     */
    public function getViewsPath(): string
    {
        return $this->_viewsPath;
    }

    /**
     * Method to get path to scripts directory
     *
     * @return string
     */
    public function getScriptsPath(): string
    {
        return $this->_scriptsPath;
    }

    /**
     * Path to templates dir.
     *
     * @return string
     */
    public function getTemplatesPath(): string
    {
        return $this->_templatesPath;
    }

    /**
     * Method to get Default lang
     *
     * @return string
     */
    public function getDefaultLang(): string
    {
        return self::DEFAULT_LANG;
    }

    /**
     * Method to get config from file.
     *
     * @param $file
     * @param string $dir
     * @return array|mixed|object
     */
    public function getConfig($file, $dir ='')
    {
        if ($dir !='') {
            $file = $this->getBasePath() . 'config/' . $dir .'/' . $file . '.json';
        }
        else {
            $file = $this->getBasePath() . 'config/' . $file . '.json';
        }
        if (file_exists($file)) {
            $this->config = json_decode(file_get_contents($file), true);
        }
        else {
            $this->config = [];
        }
        return $this->config;
    }
}
