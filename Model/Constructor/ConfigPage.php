<?php

namespace LNCNearLogin\Model\Constructor;

use LNCNearLogin\Model\Abstractions\AdminPages;
use LNCNearLogin\Helper\View;

/**
 * Class ConfigPage
 * @package LNCNearLogin\Model\Constructor
 */
class ConfigPage extends AdminPages
{
    const OPTIONS_GROUP = 'login-with-near-config';

    const FILE_EXTENSION = 'php';

    public $config;

    public string $optionsGroup;

    public function __construct($config)
    {
        parent::__construct();
        $this->config = $config;
        $this->optionsGroup = $this->getOptionsGroup();
        $this->setUp();
    }

    public function addAdminPage()
    {
        add_menu_page(
            'Login with near config',
            'Login with near config',
            'manage_options',
            'login_with_near_config',
            [&$this, 'displaySettingsPage']
        );
    }

    public function setUp()
    {
        add_filter('getLoginWithNearOptions', [$this, 'getOptions']);
    }

    public function getOptionsGroup(): string
    {
        return self::OPTIONS_GROUP;
    }

    public function registerSettings()
    {
        register_setting(
            self::OPTIONS_GROUP, self::OPTIONS_GROUP
        );
    }

    public function displaySettingsPage()
    {
        $path = $this->config->getTemplatesPath(). '/' . self::OPTIONS_GROUP . '.' . self::FILE_EXTENSION;
        View::view($path, $this);
    }

    public function getOptions()
    {
        return get_option(self::OPTIONS_GROUP);
    }
}
