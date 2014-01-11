<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-07 03:15
 * Last Updater:
 * Last Updated:
 * Filename:     history.class.php
 * Description:  History section on www.cataloniaframework.com
 */

namespace CataloniaFramework;

class History extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        //Translations::loadTranslations('history', USER_LANGUAGE);

        $st_parameters = Array();

        $s_error_msg = '';

        $st_parameters['s_error_msg'] = $s_error_msg;

        $s_view = $this->getView('history_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

}
