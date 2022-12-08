<?php

namespace TechbridgeNearLogin\Model\Constructor;

use TechbridgeNearLogin\Controllers\UserLoginController;
use TechbridgeNearLogin\Controllers\PageConstructor;
use TechbridgeNearLogin\Model\Config;
use TechbridgeNearLogin\Controllers\LoginShortcodeCreator;

/**
 * Init all main functionality
 *
 * Class Constructor
 * @package TechbridgeNearLogin\Model\Constructor
 */
class Constructor
{
    /**
     * Self Constructor object.
     * @var Constructor $instance
     */
    private static Constructor $instance;

    /**
     * Plugin options
     *
     * @var mixed
     */
    public static $options;

    /**
     * @var Config
     */
    private Config $config;

    /**
     * Controllers
     *
     * @var array
     */
    protected array $controllers = [];


    public function getController($name)
    {
        if ($this->controllers[$name]) {
            return $this->controllers[$name];
        }
        return false;
    }

    /**
     * protect singleton  clone
     */
    private function __clone()
    {

    }

    /**
     * Method to use native functions as methods
     *
     * @param $name
     * @param $arguments
     * @return bool|mixed
     */
    public function __call($name, $arguments)
    {
        if (function_exists($name)) {
            return call_user_func_array($name, $arguments);
        }
        return false;
    }

    /**
     * protect singleton __wakeup
     */
    private function __wakeup()
    {

    }

    /**
     * Constructor method.
     *
     */
    private function __construct()
    {
        $this->config = new Config();
        $this->controllersInit();
        $this->setUpActions();
        self::$options = apply_filters('getLoginWithNearOptions', 'options');
    }

    private function setUpActions()
    {
        add_action('init', [&$this, 'addScripts']);
    }

    public function addScripts()
    {
        wp_enqueue_script(
            $this->config->getPluginName(),
            $this->config->getScriptsPath() . 'index.js',
            ['jquery'],
            '0.01'
        );
        $localize = [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'network' => self::$options['network'],
            'contract_id' => self::$options['contract_id'],
        ];

        $userId = get_current_user_id();

        if ($userId) {
            $user = get_user_by('id', $userId);
            $localize['user'] = $user->user_email;
        } else {
            $localize['user'] = null;
        }
        wp_localize_script($this->config->getPluginName(), 'near_login', $localize);
    }

    /**
     * Method to init controllers
     */
    protected function controllersInit()
    {
        $this->controllers['pageController'] = new PageConstructor($this->config);
        $this->controllers['loginShortcodeCreator'] = new LoginShortcodeCreator();
        $this->controllers['userLoginController'] = UserLoginController::getInstance();
    }

    /**
     * Get self object
     *
     * @return Constructor object
     */
    public static function getInstance(): Constructor
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
