<?php

/**
 * Creator:      CM
 * Date Created: 2013-12-23 17:25
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-31 19:25
 * Filename:     loginmodel.class.php
 * Description:
 */

namespace CataloniaFramework;

abstract class LoginModel extends ModelBase
{
    public static function checkPermissions($s_section_name = null) {
        $h_permissions = array( 'is_logged'          => false,
                                'is_permitted'       => false,
                                'error_url_redirect' => Section::getSectionURL('index')
        );

        // Check if logged
        if (defined('USER_ID') && USER_ID > 0) {
            $h_permissions['is_logged'] = true;
            $h_permissions['error_url_redirect'] = Section::getSectionURL('dashboard');

            // TODO: implement permissions
            // Check permissions.
            $h_permissions['is_permitted'] = true;
        }

        return $h_permissions;
    }
}
