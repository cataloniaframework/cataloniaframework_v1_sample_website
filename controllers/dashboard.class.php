<?php

/**
 * Creator:      CM
 * Date Created: 2013-12-23 16:18
 * Last Updater: Carles Mateo
 * Last Updated: 2014-03-27 21:28
 * Filename:     dashboard.class.php
 * Description:
 */

namespace CataloniaFramework;

class Dashboard extends ControllerBase {

    // Cache the controller
    public $b_cache_controller = false;
    // Cache for 1 hour
    public $i_cache_TTL_seconds = 3600;

    public $s_content_type = ControllerBase::RESPONSE_TEXTHTML;

    public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        $i_number_contact_messages_to_display = 10;

        // Load model
        if (Core::loadModel('LoginModel') === false) {
            // TODO: generate a log error and return an error to the user and return
        }
// TODO: ps -afe | grep httpd | wc -l
        $h_permissions = LoginModel::checkPermissions('Dashboard');
        if ( ! $h_permissions['is_logged']) {
            // Redirect
            header('Location: ' . $h_permissions['error_url_redirect']);
            Core::end();
        }

        // Load multi-language
        Translations::loadTranslations('dashboard', USER_LANGUAGE);

        $st_parameters = Array();

        $i_number_contact_messages = 0;
        $st_messages = Array();

        if (Core::loadModel('DashboardModel')) {
            $i_number_contact_messages = DashboardModel::getNumberContactMessages($o_db);

            $i_number_visits_today = DashboardModel::getNumberVisits($o_db, Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time()).' 00:00:00', Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time()).' 23:59:59');
            $i_number_visits_yesterday = DashboardModel::getNumberVisits($o_db);
            $i_number_visits_past_yesterday = DashboardModel::getNumberVisits($o_db, Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time() - (24*60*60*2)).' 00:00:00', Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time() - (24*60*60*1)).' 00:00:00');

            $st_results = DashboardModel::getMessages($o_db, $i_number_contact_messages_to_display);
            if ($st_results['result']['error'] == '0') {
                $st_messages = $st_results['data'];
            }
        }

        $st_parameters['i_number_contact_messages'] = $i_number_contact_messages;
        $st_parameters['i_number_contact_messages_to_display'] = $i_number_contact_messages_to_display;
        $st_parameters['st_messages'] = $st_messages;
        $st_parameters['i_number_visits_today'] = $i_number_visits_today;
        $st_parameters['i_number_visits_yesterday'] = $i_number_visits_yesterday;
        $st_parameters['i_number_visits_past_yesterday'] = $i_number_visits_past_yesterday;
        $st_parameters['s_detected_ip'] = Requests::getClientIp(Requests::MODE_IP_REQUEST_CLIENT);

        $s_view = $this->getView('dashboard_index', $st_parameters, USER_LANGUAGE);

        return $s_view;
    }

    public function actionGraphStats($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {

        global $st_db_cassandra;

        $s_date_yesterday = Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time() - (24*60*60));
        $s_date = $s_date_yesterday;

        if (isset($st_params_url['date']) && $st_params_url['date'] == 'today') {
            $s_date = Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, time());
        }

        $st_values = Array();
        if (Core::loadModel('DashboardModel')) {

            $st_values = DashboardModel::getValuesStats($s_date, 'CRON01', 'CPU_USED');

        }

        $this->s_content_type = ControllerBase::RESPONSE_IMAGE_PNG;

        $s_html = Graphics::createImageStats(200, 200, $st_values, 'Stats '.$s_date);

        return $s_html;

    }

}
