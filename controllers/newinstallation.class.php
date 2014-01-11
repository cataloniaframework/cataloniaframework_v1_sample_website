<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-07 18:54
 * Last Updater:
 * Last Updated:
 * Filename:     newinstallation.class.php
 * Description:  Records new installations
 */

namespace CataloniaFramework;

class NewInstallation extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public $s_content_type = ControllerBase::RESPONSE_IMAGE_PNG;

    public function actionStatsNewInstallations($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations(CONTROLLER, USER_LANGUAGE);

        $s_new_install_os = isset($st_params_url['os']) ? $st_params_url['os'] : '';
        $s_new_install_os = str_replace("'", "\'", $s_new_install_os);

        $s_new_install_php_version = isset($st_param_url['php']) ? $st_param_url['php'] : '';
        $s_new_install_php_version = str_replace("'", "\'", $s_new_install_php_version);

        $s_new_install_framework_version = isset($st_params_url['cfw_ver']) ? $st_params_url['cfw_ver'] : '';
        $s_new_install_framework_version = str_replace("'", "\'", $s_new_install_framework_version);

        $s_visitor_ip    = \CataloniaFramework\Requests::getClientIp(\CataloniaFramework\Requests::MODE_IP_REQUEST_CLIENT);

        $s_user_agent    = \CataloniaFramework\Requests::getUserAgent();

        $st_results = $o_db->queryWrite('INSERT INTO
                                                    `new_install`
                                                    (`s_new_install_datetime`, `s_new_install_os`, `s_new_install_php_version`, `s_new_install_framework_version`,
                                                     `s_new_install_user_agent`, `s_new_install_client_ip`)
                                              VALUES
                                                    (NOW(), \''.$s_new_install_os.'\', \''.$s_new_install_php_version.'\', \''.$s_new_install_framework_version.'\',
                                                    \''.$s_user_agent.'\', \''.$s_visitor_ip.'\');');

        $st_results_count = $o_db->queryRead('SELECT COUNT(*) AS num_installs FROM `new_install`;');

        if (function_exists('imagecreate')) {
            // The GD library is installed
            // Create the image
            $o_my_img = imagecreate( 180, 70 );

            $background = imagecolorallocate( $o_my_img, 0, 0, 255 );
            $text_colour = imagecolorallocate( $o_my_img, 255, 255, 0 );
            $line_colour = imagecolorallocate( $o_my_img, 128, 255, 0 );

            imagestring( $o_my_img, 4, 2, 2, "cataloniaframework.com", $text_colour );
            imagesetthickness ( $o_my_img, 5 );
            imageline( $o_my_img, 4, 25, 176, 25, $line_colour );

            if ($st_results_count['result']['status'] === 1 && $st_results_count['result']['error'] === 0) {
                $s_num_installations = isset($st_results_count['data'][0]['num_installs']) ? $st_results_count['data'][0]['num_installs'] : 'Error!';
            } else {
                $s_num_installations = 'Error!';
            }

            imagestring( $o_my_img, 4, 2, 35, t('Installations:').' '.$s_num_installations, $text_colour );

            ob_start();
            imagepng( $o_my_img );
            $s_html = ob_get_clean();

            imagecolordeallocate( $o_my_img, $line_colour );
            imagecolordeallocate( $o_my_img, $text_colour );
            imagecolordeallocate( $o_my_img, $background );
            imagedestroy( $o_my_img );

        } else {
            // Image with message: Note install GD
            $s_image = "iVBORw0KGgoAAAANSUhEUgAAALQAAABGAgMAAAAY+VazAAAACVBMVEUAAP///wCA/wBN5ClCAAAACXBIWXMAAA7EAAAOxAGVKw4bAAABN0lEQVRIie2UO27DMAyGSUDeOTj3oQB312Dep+fpKcOXHL8SdOnQxL/BWBI/SxQD/ACfI9Joy+i2TeIZTcuI+SWNstAm3mXXE9GHIvCm9QiwvmX4AinAuoYYlK7olxWY0KOy/wpyhYkiKtcS1ERs5wxMFvGdjtjWFhqQjMZON2XaQjenm5KSdFvT+KgkRhy5CiXosqYrMlkkjU6j05PTCGOvW2878wBz1VvbDXVmlcyaE+XEzx6tJ4V2rb309/r5vb7/L33pbYRmwOnG7szd+839BecdzQ965fgE7pUVj3TumXR6fzorb2l1MHf70Rjz+fT+J3Q6a9Dcvf8JXTLvlZiXgnu/00M9p6XTXlfrex9ojL2h05tKzmk9f+yVhPc7jYcO2tlD9AQlZ+r93se57v6dS5cufZTutfnNQtAj5yQAAAAASUVORK5CYII=";
            $s_html = base64_decode($s_image);

        }

        $s_view = $s_html;

        return $s_view;
    }

}
