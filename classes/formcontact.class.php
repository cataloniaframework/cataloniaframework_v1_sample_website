<?php
/**
 * Creator:      Carles Mateo
 * Date Created: 2013-12-25 10:29
 * Last Updater: Carles Mateo
 * Last Updated: 2013-12-26 11:14
 * Filename:     formcontact.class.php
 * Description:  Contact Form
 */

namespace CataloniaFramework;


class FormContact extends Form {

    function __construct() {

        $this->addTextToForm('first_name', t('Name'), Form::HELP_FIELD_NOT_HELP, 15, Form::DATATYPE_STRING, Form::HTML_NO_CLASS, Form::HTML_NO_CLASS,
                             Form::IS_REQUIRED, 3, 50, Form::REGEXP_EMPTY, Array(), Form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');
        $this->addTextToForm('surname', t('Surname'), Form::HELP_FIELD_NOT_HELP, 15, Form::DATATYPE_STRING, Form::HTML_NO_CLASS, Form::HTML_NO_CLASS,
                             Form::IS_NOT_REQUIRED, 3, 50, Form::REGEXP_EMPTY, Array(), Form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');
        $this->addTextToForm('email', t('Email'), Form::HELP_FIELD_NOT_HELP, 25, Form::DATATYPE_EMAIL, Form::HTML_NO_CLASS, Form::HTML_NO_CLASS,
                             Form::IS_REQUIRED, 3, 50, Form::REGEXP_EMPTY, Array(), Form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');
        $this->addTextAreaToForm('message', t('Message'), Form::HELP_FIELD_NOT_HELP, 25, 10, Form::DATATYPE_STRING, Form::HTML_NO_CLASS, Form::HTML_NO_CLASS,
                             Form::IS_REQUIRED, 5, 2000, Form::REGEXP_EMPTY, Array(), form::IS_NOT_READONLY, Form::IS_NOT_DISABLED, '', '', '');

    }



} 