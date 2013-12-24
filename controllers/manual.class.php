<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-15 17:33
 * Last Updater:
 * Last Updated:
 * Filename:     manual.class.php
 * Description:  Manual on the Framework
 */

namespace CataloniaFramework;

class Manual extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations('about', USER_LANGUAGE);

        $st_parameters = Array();

        $s_error_msg = '';

        $st_parameters['s_error_msg'] = $s_error_msg;

        if (isset($st_params[1]) && isset($st_params[2]) && $st_params[1] == 'v1' && $st_params[2] == 'getting_started') {
            $s_view = $this->getView('manual/manual_v1_getting_started', $st_parameters, USER_LANGUAGE);
        } elseif (isset($st_params[1]) && isset($st_params[2]) && $st_params[1] == 'v1' && $st_params[2] == 'directory_structure') {
            $s_view = $this->getView('manual/manual_v1_directory_structure', $st_parameters, USER_LANGUAGE);
        } elseif (isset($st_params[1]) && isset($st_params[2]) && $st_params[1] == 'v1' && $st_params[2] == 'bootstrap') {
            $s_view = $this->getView('manual/manual_v1_bootstrap', $st_parameters, USER_LANGUAGE);
        } else {
            $s_view = $this->getView('manual_index', $st_parameters, USER_LANGUAGE);
        }

        return $s_view;
    }

}
