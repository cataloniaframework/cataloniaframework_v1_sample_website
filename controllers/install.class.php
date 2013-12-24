<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-15 19:24
 * Last Updater: Carles Mateo
 * Last Updated: 2013-09-15 19:25
 * Filename:     install.class.php
 * Description:  About section on www.cataloniaframework.com
 */

namespace CataloniaFramework;

class Install extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = true;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations('about', USER_LANGUAGE);

        $st_parameters = Array();

        $s_error_msg = '';

        $st_parameters['s_error_msg'] = $s_error_msg;

        $s_view = $this->getView('install_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

}
