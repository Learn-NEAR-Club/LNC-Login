<?php

namespace TechbridgeNearLogin\Controllers;

use TechbridgeNearLogin\Model\Constructor\Constructor;

class LoginShortcodeCreator
{

    public function __construct()
    {
        add_shortcode('login_near_link', [$this, 'loginNearLink']);
    }

    public function loginNearLink(): string
    {
        $options = Constructor::$options;
        $loginButtonText = $options['login_button_text'];
        $loginButtonExtraClasses = $options['login_button_extra_classes'];
        $logoutButtonText = $options['logout_button_text'];
        $logoutButtonExtraClasses = $options['logout_button_extra_classes'];
        $logoutUrl = wp_logout_url();
        if (get_current_user_id()) {
            return "<a class='{$logoutButtonExtraClasses} logout-with-near-link' href='{$logoutUrl}'>{$logoutButtonText}</a>";
        }

        return "<a class='{$loginButtonExtraClasses} login-with-near-link' href='#'>{$loginButtonText}</a>";
    }

}
