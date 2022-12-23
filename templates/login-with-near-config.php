<?php

use LNCNearLogin\Model\Constructor\Constructor;

ob_start(); ?>
<?php if (isset($args) && isset($args->optionsGroup)): ?>
    <?php
    $options = Constructor::$options;
    $contractID = $options['contract_id'] ?? '';
    $loginButtonText = $options['login_button_text'] ?? 'Login with near';
    $loginButtonExtraClasses = $options['login_button_extra_classes'] ?? '';
    $logoutButtonText = $options['logout_button_text'] ?? 'Logout';
    $logoutButtonExtraClasses = $options['logout_button_extra_classes'] ?? '';
    $network = $options['network'] ?? 'testnet';
    ?>
    <div class="form">
        <h1><?php esc_html_e('Near login configuration', 'tb-login-with-near'); ?></h1>
        <form method="post" action="options.php" class="settings-form">
            <?php settings_fields($args->optionsGroup); ?>
            <div>
                <label>
                    <span><?php esc_html_e('Contract id'); ?></span>
                    <input type="text"
                           name="<?php echo esc_html("$args->optionsGroup[contract_id]"); ?>"
                           value="<?php echo esc_html($contractID); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>
            <div>
                <label>
                    <span><?php esc_html_e('Login button text'); ?></span>
                    <input type="text"
                           name="<?php echo esc_html("$args->optionsGroup[login_button_text]"); ?>"
                           value="<?php echo esc_html($loginButtonText); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php esc_html_e('Login button extra classes'); ?></span>
                    <input type="text"
                           name="<?php echo esc_html("$args->optionsGroup[login_button_extra_classes]"); ?>"
                           value="<?php echo esc_html($loginButtonExtraClasses); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php esc_html_e('Logout button text'); ?></span>
                    <input type="text"
                           name="<?php echo esc_html("$args->optionsGroup[logout_button_text]"); ?>"
                           value="<?php echo esc_html($logoutButtonText); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php esc_html_e('Logout button extra classes'); ?></span>
                    <input type="text"
                           name="<?php echo esc_html("$args->optionsGroup[logout_button_extra_classes]"); ?>"
                           value="<?php echo esc_html($logoutButtonExtraClasses); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php esc_html_e('Enable redeem confirmation'); ?></span>
                    <select name="<?php echo esc_html("$args->optionsGroup[network]"); ?>">
                        <?php $selected = $network == 'mainnet' ? 'selected = "selected"' : ''; ?>
                        <option value="testnet"><?php esc_html_e('Testnet', 'tb-login-with-near'); ?></option>
                        <option value="mainnet" <?php echo esc_html($selected); ?> ><?php esc_html_e('Mainnet', 'tb-login-with-near'); ?></option>
                    </select>
                </label>
            </div>
            <br/>
            <button><?php esc_html_e('Save', 'tb-login-with-near'); ?></button>
        </form>
    </div>
<?php endif; ?>
<?php return ob_get_clean(); ?>
