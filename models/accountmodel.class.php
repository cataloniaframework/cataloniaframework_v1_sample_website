<?php

/**
 * Creator:      CM
 * Date Created: 2013-12-15 23:13
 * Last Updater: CM
 * Last Updated: 2013-12-22 13:53
 * Filename:     accountmodel.class.php
 * Description:
 */

namespace CataloniaFramework;

abstract class AccountModel extends ModelBase
{
    const ACCOUNT_TABLE_NAME = 'accounts';
    const USER_TABLE_NAME = 'accounts_users';

    public static function insertAccount($o_db, $s_company_name, $s_email, $s_created, $s_modified)
    {
        // SQL for insert account
        $s_query = 'INSERT INTO '.self::ACCOUNT_TABLE_NAME.'(
            account_company_name,
            account_email_created_with,
            account_datetime_created,
            account_datetime_last_modified
        ) VALUES (
            \''.Db::prepareInsert($s_company_name).'\',
            \''.Db::prepareInsert($s_email).'\',
            \''.Db::prepareInsert($s_created).'\',
            \''.Db::prepareInsert($s_modified).'\'
        )';

        return $o_db->queryWrite($s_query);
    }

    public static function insertUser($o_db, $i_account_id, $s_email, $s_password, $s_name, $s_surname1, $s_surname2, $s_lang, $s_active, $s_created, $s_modified)
    {
        // SQL for insert account_user
        $s_query = 'INSERT INTO '.self::USER_TABLE_NAME.'(
            accounts_id_fk,
            accounts_users_email,
            accounts_users_password,
            accounts_users_name,
            accounts_users_surname1,
            accounts_users_surname2,
            accounts_users_lang,
            accounts_users_active,
            accounts_users_datetime_created,
            accounts_users_datetime_last_modified
        ) VALUES (
            '.Db::prepareInsert($i_account_id, Db::DATA_TYPE_INT).',
            \''.Db::prepareInsert($s_email).'\',
            \''.Db::prepareInsert($s_password).'\',
            \''.Db::prepareInsert($s_name).'\',
            \''.Db::prepareInsert($s_surname1).'\',
            \''.Db::prepareInsert($s_surname2).'\',
            \''.Db::prepareInsert($s_lang).'\',
            \''.Db::prepareInsert($s_active).'\',
            \''.Db::prepareInsert($s_created).'\',
            \''.Db::prepareInsert($s_modified).'\'
        )';

        return $o_db->queryWrite($s_query);
    }

    public static function getAccountByEmail($o_db, $s_email)
    {
        $h_account = null;

        // SQL for select account by email
        $s_query = '
            SELECT
                account_id,
                account_company_name,
                account_email_created_with,
                account_datetime_created,
                account_datetime_last_modified
            FROM
                '.self::ACCOUNT_TABLE_NAME.'
            WHERE
                account_email_created_with = \''.Db::prepareInsert($s_email).'\'
            LIMIT 1
        ';

        $h_result =  $o_db->queryRead($s_query);
        if(isset($h_result['data'][0])) $h_account = $h_result['data'][0];

        return $h_account;
    }

    public static function getUserByEmail($o_db, $s_email)
    {
        $h_user = null;

        // SQL for select account by email
        $s_query = '
            SELECT
                accounts_users_id,
                accounts_id_fk,
                accounts_users_email,
                accounts_users_password,
                accounts_users_name,
                accounts_users_surname1,
                accounts_users_surname2,
                accounts_users_lang,
                accounts_users_active,
                accounts_users_datetime_created,
                accounts_users_datetime_last_modified
            FROM
                '.self::USER_TABLE_NAME.'
            WHERE
                accounts_users_email = \''.Db::prepareInsert($s_email).'\'
            LIMIT 1
        ';

        $h_result =  $o_db->queryRead($s_query);
        if(isset($h_result['data'][0])) $h_user = $h_result['data'][0];

        return $h_user;
    }
}
