<?php

namespace TechbridgeNearLogin\Model;

/**
 * Class Config
 * @package TechbridgeNearLogin\Model
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
     *  Script directory const
     */
    const SCRIPTS_PATH = '/wp-content/plugins/'. self::PLUGIN_NAME . '/public/';

    /**
     *  Style directory const
     */
    const STYLES_PATH = '/wp-content/plugins/'. self::PLUGIN_NAME . '/public/css';

    /**
     *  Languages path const
     */
    const LANGUAGES_PATH  = '/wp-content/plugins/'. self::PLUGIN_NAME . '/lang';

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
     * Path to styles directory
     *
     * @var string $_stylesPath
     */
    private string $_stylesPath;

    /**
     * Path to templates.
     *
     * @var $_templatesPath
     */
    private string $_templatesPath;

    /**
     * Path to languages dir.
     *
     * @var string $_langPath
     */
    private string $_langPath;

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
        $this->_scriptsPath = self::SCRIPTS_PATH;
        $this->_stylesPath = self::STYLES_PATH;
        $this->_templatesPath = self::getBasePath() . self::TEMPLATES_DIR;
        $this->_langPath = self::LANGUAGES_PATH;
    }

    /**
     * Method to get plugin name
     *
     * @return string
     */
    public function getPluginName()
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
     * Method to get path to styles directory
     *
     * @return string
     */
    public function getStylesPath(): string
    {
        return $this->_stylesPath = self::STYLES_PATH;
    }

    /**
     * Path to languages dir.
     *
     * @return string
     */
    public function getLangPath(): string
    {
        return $this->_langPath;
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
