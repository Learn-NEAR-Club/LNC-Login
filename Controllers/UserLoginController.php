<?php

namespace TechbridgeNearLogin\Controllers;

class UserLoginController

{
    /**
     * Self Constructor object.
     * @var UserLoginController $instance
     */
    private static UserLoginController $instance;

    private function __construct()
    {
        add_action('wp_ajax_nopriv_loginWithNearLogin', [$this, 'ajaxLoginWithNear']);
    }

    public function ajaxLoginWithNear()
    {
        $response = [
            'isLoggedIn' => false,
            'errorMessage' => 'Something goes wrong, please try again later',
        ];
        if (isset($_POST['account'])) {
            $account = sanitize_text_field($_POST['account']);
            $userEmail = $this->getUserEmailByAccount($account);

            $user = get_user_by('email', $userEmail);
            if (!$user->ID) {
                $user = $this->registerUser($userEmail, $account);
            }
            wp_clear_auth_cookie();
            wp_set_current_user($user->ID);
            wp_set_auth_cookie($user->ID);
            $response = [
                'isLoggedIn' => true,
            ];
        }
        wp_send_json($response);
        die;
    }

    /**
     * Get self object
     *
     * @return UserLoginController object
     */
    public static function getInstance(): UserLoginController
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function registerUser($userEmail, $account)
    {
        return wp_insert_user([
            'user_login' => $userEmail,
            'user_nicename' => $account,
            'display_name' => $account,
            'user_pass' => wp_generate_password(12),
            'user_email' => $userEmail,
        ]);
    }

    public function getUserEmailByAccount($account): string
    {
        $account = trim(strip_tags($account));

        return "$account@near.org";
    }
}
