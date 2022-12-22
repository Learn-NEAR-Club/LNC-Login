<?php
/**
 * Plugin Name: Login With NEAR
 * Description: web3 login with NEAR
 * Version: 0.0.1
 * Author: Learn NEAR Club
 * Author URI: http://learnnear.club/
 */

use \TechbridgeNearLogin\Model\Constructor\Constructor;

$composerLoader =  __DIR__ . '/vendor/autoload.php';
if (file_exists($composerLoader)) {
    require_once $composerLoader;
} else {
    _e('Install composer for current work');
    exit;
}

Constructor::getInstance(__DIR__);
