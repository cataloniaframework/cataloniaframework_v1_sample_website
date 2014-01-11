<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-12-26 11:20
 * Last Updater:
 * Last Updated:
 * Filename:     contactmodel.class.php
 * Description:  Model for Contact controller. Stores the messages received
 */

namespace CataloniaFramework;

abstract class ContactModel extends ModelBase
{

    public static function saveMessage($o_db, $s_name, $s_surname, $s_email, $s_message, $s_ip_address) {

        $s_sql = "INSERT INTO
                              `cataloniafw`.`contact_messages`
                              (`name`, `surname`, `email`, `message`, `ip_address`, `datetime_created`)
                       VALUES ('".Db::prepareInsert($s_name, Db::DATA_TYPE_STRING)."', '".Db::prepareInsert($s_surname, Db::DATA_TYPE_STRING)."',
                               '".Db::prepareInsert($s_email, Db::DATA_TYPE_STRING)."', '".Db::prepareInsert($s_message, Db::DATA_TYPE_STRING)."',
                               '".Db::prepareInsert($s_ip_address, Db::DATA_TYPE_STRING)."', NOW());";

        $st_result = $o_db->queryWrite($s_sql);

         if ($st_result['result']['error'] == '0' && intval($st_result['result']['insert_id']) > 0) {
             // Saved successfully
             return true;
         } else {
             return false;
         }


    }

}
