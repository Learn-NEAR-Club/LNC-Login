<?php

namespace LNCNearLogin\Controllers;

use LNCNearLogin\Model\Constructor\Constructor;

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
        if (get_current_user_id()) {
            return "<a class='{$logoutButtonExtraClasses} logout-with-near-link' href='javascript:;' onclick='window.logOutAction(); return false;'>{$logoutButtonText}</a>";
        }

        return "<a class='{$loginButtonExtraClasses} login-with-near-link' href='#'>{$loginButtonText}</a>";
    }

}
