<?php
/**
 * Plugin Name: LNC Login With Near
 * Description: web3 login with NEAR
 * Version: 0.0.1
 * Author: Learn near club
 * Author URI: http://learnnear.club/
 */

use \LNCNearLogin\Model\Constructor\Constructor;

$composerLoader =  __DIR__ . '/vendor/autoload.php';
if (file_exists($composerLoader)) {
    require_once $composerLoader;
} else {
    _e('Install composer for current work');
    exit;
}

Constructor::getInstance(__DIR__);
