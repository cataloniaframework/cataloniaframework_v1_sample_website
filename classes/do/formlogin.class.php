<?php

/**
 * Creator:      CM
 * Date Created: 2013-12-27 12:41
 * Last Updater:
 * Last Updated:
 * Filename:     formlogin.class.php
 * Description:
 */

namespace CataloniaFramework;

class FormLogin extends Form
{
    function __construct()
    {
        $this->setFormHtmlId('login_form');
        $this->addTextToForm('email', t('Email'), Form::HELP_FIELD_NOT_HELP, 15, Form::DATATYPE_EMAIL, 'std_input', 'std_input_error',
                             Form::IS_REQUIRED, 3, 50, Form::REGEXP_EMAIL, Array(), Form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');
        $this->addPasswordToForm('password', t('Password'), Form::HELP_FIELD_NOT_HELP, 15, Form::DATATYPE_STRING, 'std_input', 'std_input_error',
                                 Form::IS_REQUIRED, 3, 50, Form::REGEXP_EMPTY, Array(), Form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');
    }
}
