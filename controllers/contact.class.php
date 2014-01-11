<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-11 00:05
 * Last Updater:
 * Last Updated:
 * Filename:     index.php
 * Description:
 */

namespace CataloniaFramework;

class Contact extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        // Load multi-language
        Translations::loadTranslations(CONTROLLER, USER_LANGUAGE);

        // Form Contact DO
        require_once CLASSES_ROOT.'formcontact.class.php';

        $st_parameters = Array();

        $o_contact_form = new FormContact();

        $s_error_msg = '';
        $s_ok_msg = '';

        $o_contact_form->checkParams($_POST);
        if (Requests::isPostRequest()==true) {
            if (!$o_contact_form->mayContinue()) {
                $s_error_msg = t('Error fix the fields');
            } else {
                // All the Data is Ok
                if (Core::loadModel('contactmodel')) {
                    // Model loaded Ok

                    $st_form_params = $o_contact_form->getParamsValidated(Form::MODE_EXPECTED_VALUES, true);
                    $s_name = $st_form_params['first_name'];
                    $s_surname = $st_form_params['surname'];
                    $s_email = $st_form_params['email'];
                    $s_message = $st_form_params['message'];

                    $s_ip_address = Requests::getClientIp(Requests::MODE_IP_REQUEST_CLIENT);

                    if (ContactModel::saveMessage($o_db, $s_name, $s_surname, $s_email, $s_message, $s_ip_address)) {
                        // Successful
                        $s_ok_msg = t('Message saved successfully');
                    } else {
                        $s_error_msg = t('Unable to save message');
                    }

                } else {
                    $s_error_msg = t('Internal Error');
                }

            }
        }


        $st_parameters['o_contact_form'] = $o_contact_form;
        $st_parameters['s_error_msg'] = $s_error_msg;
        $st_parameters['s_ok_msg'] = $s_ok_msg;

        $s_view = $this->getView('contact_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

}
