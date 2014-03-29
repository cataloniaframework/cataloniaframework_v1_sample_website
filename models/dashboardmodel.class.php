<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-02-01 01:00
 * Last Updater:
 * Last Updated:
 * Filename:     dashboardmodel.class.php
 * Description:
 */

namespace CataloniaFramework;

abstract class DashboardModel extends ModelBase
{
    public static function getNumberContactMessages($o_db = null) {

        $i_number_contact_messages = 0;

        $s_sql = 'SELECT COUNT(*) AS NUMBER_MESSAGES FROM `cataloniafw`.`contact_messages`;';

        $st_result = $o_db->queryRead($s_sql);

        if ($st_result['result']['error'] == '0') {
            $i_number_contact_messages = $st_result['data'][0]['NUMBER_MESSAGES'];
        }

        return $i_number_contact_messages;
    }

    public static function getMessages($o_db = null, $i_number = 0) {

        $s_sql = 'SELECT * FROM `cataloniafw`.`contact_messages`';

        $s_sql .= ' ORDER BY `id` DESC';

        if ($i_number > 0) {
            $s_sql .= " LIMIT $i_number";
        }

        $s_sql .=';';

        $st_result = $o_db->queryRead($s_sql);

        return $st_result;

    }

    public static function getValuesStats($s_date_yesterday, $s_node, $s_vname) {

        global $o_db_cassandra;

        $s_cql = "SELECT vvalue FROM serverstats WHERE vdate = '$s_date_yesterday' AND node = '$s_node' AND vname = '$s_vname';";

        $st_results = $o_db_cassandra->queryRead($s_cql);

        if ($st_results['result']['error'] == '0') {
            return $st_results['data'];
        } else {
            return Array();
        }

    }

    public static function getNumberVisits($o_db = null, $s_date_start = null, $s_date_end = null) {

        if ($s_date_start === null) {
            $i_date_yesterday = time() - (24*60*60);
            $s_date_start = Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY, $i_date_yesterday).' 00:00:00';
        }

        if ($s_date_end === null) {
            // today
            $s_date_end = Datetime::getDateTime(Datetime::FORMAT_DATE_ONLY).' 00:00:00';
        }

        $i_number_contact_visits = 0;

        $s_sql = "SELECT COUNT(*) AS NUMBER_VISITS FROM `cataloniafw`.`visits`
                  WHERE
                        s_visit_datetime > '$s_date_start'
                     AND
                        s_visit_datetime < '$s_date_end';";

        $st_result = $o_db->queryRead($s_sql);

        if ($st_result['result']['error'] == '0') {
            $i_number_contact_visits = $st_result['data'][0]['NUMBER_VISITS'];
        }

        return $i_number_contact_visits;
    }

}
