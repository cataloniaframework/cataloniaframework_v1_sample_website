<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-26 00:24
 * Last Updater:
 * Last Updated:
 * Filename:     login.class.php
 * Description:  Login and Logout controller
 */

namespace CataloniaFramework;

class Login extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionLogin($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load model
        if (Core::loadModel('LoginModel') === false) {
            // TODO: generate a log error and return an error to the user and return
        }

        $h_permissions = LoginModel::checkPermissions();

        if ($h_permissions['is_logged']) {

            // Redirect
            header('Location: ' . $h_permissions['error_url_redirect']);
            Core::end();
        }

        // Load multi-language
        Translations::loadTranslations('login', USER_LANGUAGE);

        $st_parameters = Array();
        $s_error_msg = '';

        // Create form
        require_once CLASSES_ROOT .'do/formlogin.class.php';
        $o_login_form = new FormLogin();

        // Check form params
        if (Requests::isPostRequest() == true) {
            $o_login_form->checkParams($_POST);

            if (!$o_login_form->mayContinue()) {
                $s_error_msg = t('Error');

            } else {

                // Load model
                if (Core::loadModel('AccountModel') === false) {
                    // TODO: generate a log error and return an error to the user and return
                }

                // Validated params
                $h_validated_params = $o_login_form->getParamsValidated();
                $s_email = $h_validated_params['email'];
                $s_password = md5($h_validated_params['password']);

                $h_user = AccountModel::getUserByEmail($o_db, $s_email);

                if ($h_user) {
                    if($s_password != $h_user['accounts_users_password']){
                        $s_error_msg = t('Incorrect Password');
                    }

                } else {
                    $s_error_msg = t('Incorrect Email');
                }

                if (!$s_error_msg) {
                    Session::setVarToSession('USER_ACCOUNT', $h_user['accounts_id_fk']);
                    Session::setVarToSession('USER_ID', $h_user['accounts_users_id']);
                    Session::setVarToSession('USER_NAME', $h_user['accounts_users_name']);

                    // Redirect to home
                    header('Location: ' . Section::getSectionURL('dashboard'));
                    Core::end();
                }
            }
        }

        // Set params
        $st_parameters['o_login_form'] = $o_login_form;
        $st_parameters['s_error_msg'] = $s_error_msg;
        $st_parameters['s_embed_javascript'] = '';

        $s_view = $this->getView('login_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

    public function actionLogout($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // If USER_ID exist, user is logged. Logout user and go to index.
        $s_user_id = Session::getVarFromSession('USER_ID');
        if ($s_user_id) {
            // Destroy Session
            Session::destroySession();

            // Redirect to index
            header('Location: ' . Section::getSectionURL('index'));
            Core::end();
        }

        // If USER_ID don't exist, user is not logged. Go to index.
        header('Location: ' . Section::getSectionURL('index'));
        Core::end();
    }

}
