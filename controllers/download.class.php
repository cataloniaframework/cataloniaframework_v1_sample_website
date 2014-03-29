<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-12-21 15:07
 * Last Updater:
 * Last Updated:
 * Filename:     install.class.php
 * Description:  Download section on www.cataloniaframework.com
 */

namespace CataloniaFramework;

class Download extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = true;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations('download', USER_LANGUAGE);

        $st_parameters = Array();

        $s_error_msg = '';

        $st_parameters['s_error_msg'] = $s_error_msg;

        $s_view = $this->getView('download_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

    public function actionDownloadVm($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations('download', USER_LANGUAGE);

        $st_parameters = Array();

        $s_error_msg = '';

        $st_parameters['s_error_msg'] = $s_error_msg;

        $s_view = $this->getView('downloadvm_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }


}
