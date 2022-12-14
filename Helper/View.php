<?php

namespace TechbridgeNearLogin\Helper;

use TechbridgeNearLogin\Model\Config;

/**
 * Class View
 *
 * @package TechbridgeNearLogin\Helper
 */
class View
{

    protected static Config $config;

    /**
     * Method to render template
     *
     * WARNING do not remove  @args It's need to transfer self object, when function calls by hook.
     *
     * @param $templatePath
     * @param $args
     * @return bool
     */
    public static function view($templatePath, $args = null): bool
    {
        try {
            $error = __('You have some problems with template');
            if (!file_exists($templatePath)) {
                throw new \Exception($error);
            }
            $content = require_once($templatePath);
            if ($content != '') {
                echo wp_kses($content, FormData::getAllowedTagsForFormEscape());
                return true;
            }
            throw new \Exception($error);
        } catch (\Exception $e) {
            echo esc_html($e->getMessage());
        }
        return false;
    }

    /**
     *
     * @return Config
     */
    final protected static function getConfig()
    {
        if (!self::$config) {
            self::$config = new Config();
        }
        return self::$config;
    }

    /**
     *
     * @param $templateName
     * @return mixed|string
     */
    final public static function renderParts($templateName, $data = null)
    {

        $templatePath = self::getConfig()->getTemplatesPath()
            . '/frontend/template-parts/'
            . $templateName;
        try {
            $error = __('You have some problems with template');
            if (!file_exists($templatePath)) {
                throw new \Exception($error);
            }
            $content = require($templatePath);
            if ($content != '') {
                return $content;
            }
            throw new \Exception($error);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
