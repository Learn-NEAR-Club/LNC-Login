<?php

use TechbridgeNearLogin\Model\Constructor\Constructor;
use \TechbridgeNearLogin\Helper\Data;

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
        <h1><?php _e('Near login configuration', 'tb-login-with-near'); ?></h1>
        <form method="post" action="options.php" class="settings-form">
            <?php settings_fields($args->optionsGroup); ?>
            <div>
                <label>
                    <span><?php _e('Contract id'); ?></span>
                    <input type="text"
                           name="<?php echo Data::clearString("$args->optionsGroup[contract_id]"); ?>"
                           value="<?php echo Data::clearString($contractID); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>
            <div>
                <label>
                    <span><?php _e('Login button text'); ?></span>
                    <input type="text"
                           name="<?php echo Data::clearString("$args->optionsGroup[login_button_text]"); ?>"
                           value="<?php echo Data::clearString($loginButtonText); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php _e('Login button extra classes'); ?></span>
                    <input type="text"
                           name="<?php echo Data::clearString("$args->optionsGroup[login_button_extra_classes]"); ?>"
                           value="<?php echo Data::clearString($loginButtonExtraClasses); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php _e('Logout button text'); ?></span>
                    <input type="text"
                           name="<?php echo Data::clearString("$args->optionsGroup[logout_button_text]"); ?>"
                           value="<?php echo Data::clearString($logoutButtonText); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php _e('Logout button extra classes'); ?></span>
                    <input type="text"
                           name="<?php echo Data::clearString("$args->optionsGroup[logout_button_extra_classes]"); ?>"
                           value="<?php echo Data::clearString($logoutButtonExtraClasses); ?>"
                           size="50"
                    />
                </label>
            </div>
            <br/>

            <div>
                <label>
                    <span><?php _e('Enable redeem confirmation'); ?></span>
                    <select name="<?php echo Data::clearString("$args->optionsGroup[network]"); ?>">
                        <?php $selected = $network == 'mainnet' ? 'selected = "selected"' : ''; ?>
                        <option value="testnet"><?php _e('Testnet', 'tb-login-with-near'); ?></option>
                        <option value="mainnet" <?php echo $selected; ?> ><?php _e('Mainnet', 'tb-login-with-near'); ?></option>
                    </select>
                </label>
            </div>
            <br/>
            <button><?php _e('Save', 'tb-login-with-near'); ?></button>
        </form>
    </div>
<?php endif; ?>
<?php return ob_get_clean(); ?>
