<?php

    /**
     * Creator:      Carles Mateo
     * Date Created: 2013-02-20 11:22
     * Last Updater: Carles Mateo
     * Last Updated: 2014-02-01 15:32
     * Filename:     commonrequests.class.php
     * Description:  Space for the custom developments
     */

namespace CataloniaFramework;

abstract class CommonRequests
{

    public static function initSession($o_db = null) {

        // Get User and Role details
        $s_user_id      = Session::getVarFromSession('USER_ID');
        $s_user_role    = Session::getVarFromSession('USER_ROLE'); // ADMIN, USER, null
        $s_user_account = Session::getVarFromSession('USER_ACCOUNT');
        $s_user_name    = Session::getVarFromSession('USER_NAME');

        define('USER_ID', $s_user_id);
        define('USER_ROLE', $s_user_role);
        define('USER_ACCOUNT', $s_user_account);
        define('USER_NAME', $s_user_name);

    }

    // Define here the user vars that are to be defined commonly for all the requests
    // for example the footer
    // At this point you have available USER_LANGUAGE constant
    public static function registerUserVars($o_db = null) {

        Views::addUserVar('APP_TITLE', 'Catalonia Framework', Views::VAR_ACTION_REPLACE);
        Views::addUserVar('APP_TITLE_WITH_LINK', 'Catalonia Framework', Views::VAR_ACTION_REPLACE);
        Views::addUserVar('HEAD_TITLE_BLOCK', '<div class="header-body">
                                                    <div class="head_logo">
                                                        <img src="/img/cataloniaframework-logo1-30pc-no_mg.png" />
                                                    </div>
                                                    <div class="head_title">
                                                        <h1 id="site-name">'.
                                                            Views::getUserVar('APP_TITLE_WITH_LINK')
                                                       .'</h1>
                                                    </div>
                                               </div>', Views::VAR_ACTION_REPLACE);
        $s_head_navigation_block =                 '<div id="navigation">
                                                        <div class="in">
                                                            <nav id="site-nav" class="clearfix">
                                                                ||*||[NAV_SECTIONS]||*||
                                                                <div id="flags_lang" class="login_or_register" name="flags_lang">';
        if (USER_ID !== null && USER_ID > 0) {
            $s_head_navigation_block .= '||*||[WELCOME_USER]||*||';
            $s_head_navigation_block .= ' <a href="/'.USER_LANGUAGE.'/logout">'.t('Logout').'</a>';
        } else {
            $s_head_navigation_block .= '<a href="/'.USER_LANGUAGE.'/login">'.t('Login').'</a> or '.t('Register');
        }
        $s_head_navigation_block .= '
                                                                    <a href="/ca/"><img border="0" alt="Català" src="/img/flag_cat.png" /></a>
                                                                    <a href="/en/"><img border="0" alt="English" src="/img/flag_usa.png" /></a>
                                                                </div>
                                                            </nav>
                                                        </div>
                                                    </div>';

        Views::addUserVar('HEAD_NAVIGATION_BLOCK', $s_head_navigation_block);

        $o_menu_navigation = new Menu();
        $o_menu_navigation->addMenuItemFromSection('index', 'Home', t('Home'));
        $o_menu_navigation->addMenuItemFromSection('download', 'Download', t('Download'));
        $o_menu_navigation->addMenuItemFromSection('downloadvm', 'Download Virtual Machines', t('Download Virtual Machines'));
        $o_menu_navigation->addMenuItemFromSection('install', 'Install', t('Install'));
        $o_menu_navigation->addMenuItemFromSection('manual', 'Manual', t('Manual'));
        $o_menu_navigation->addMenuItemFromSection('history', 'History', t('History'));
        $o_menu_navigation->addMenuItemFromSection('about', 'About', t('About us'));
        $o_menu_navigation->addMenuItemFromSection('contact', 'Contact', t('Contact'));
        $o_menu_navigation->addMenuItemFromSection('blog', 'Blog', t('Blog'));

        if (USER_ID !== null && USER_ID > 0) {
            Views::addUserVar('WELCOME_USER', USER_NAME, Views::VAR_ACTION_REPLACE);

            // Private sections of the Menu
            $o_menu_navigation->addMenuItemFromSection('dashboard', 'dashboard', t('Dashboard'));
        }

        $st_menu_links = $o_menu_navigation->getMenuItemsAsLinks();

        $s_menus = implode(' ', $st_menu_links);

        Views::addUserVar('NAV_SECTIONS', $s_menus, Views::VAR_ACTION_REPLACE);

        Views::addUserVar('FOOTER', 'Powered by Catalonia Framework', Views::VAR_ACTION_REPLACE);
    }

    public static function registerURLS($o_db = null) {
        // By default the framework shows a file if exists
        // But you can define custom urls that will be processed at your will

        // Add here your custom URLs not processed by MVC pattern
        Navigation::addURL('this-is-a-sample/humans.txt', WEB_ROOT.'humans.txt', Navigation::ACTION_REQUIRE_FILE,
                            ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);
        Navigation::addURL('this-is-a-sample/robots.txt', WEB_ROOT.'robots.txt', Navigation::ACTION_REQUIRE_FILE,
                            ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);

    }

    public static function registerSections($o_db = null) {
        // Here can register your own sections

        if (MULTILANG==true) {
            $s_prefix = '/'.USER_LANGUAGE.'/';
        } else {
            $s_prefix = '/';
        }

        Translations::loadTranslations('common_menu');

        //Section::registerSection('donate', $s_prefix.'donate');
        Section::registerSection('install', $s_prefix.t('seo_url_install'), 'Install', 'Index');
        Section::registerSection('download', $s_prefix.t('seo_url_download'), 'Download', 'Index');
        Section::registerSection('downloadvm', $s_prefix.t('seo_url_downloadvm'), 'Download', 'DownloadVm');
        Section::registerSection('manual', $s_prefix.'manual', 'Manual', 'Index');
        Section::registerSection('history', $s_prefix.t('seo_url_history'), 'History', 'Index');
        Section::registerSection('about', $s_prefix.t('seo_url_about_us'), 'About', 'Index');
        Section::registerSection('contact', $s_prefix.t('seo_url_contact'), 'Contact', 'Index');
        Section::registerSection('blog', t('seo_url_blog'), 'Blog');

        Section::registerSection('login', $s_prefix.t('url_user_login'), 'Login', 'Login');
        Section::registerSection('logout', $s_prefix.t('url_user_logout'), 'Login', 'Logout');

        Section::registerSection('dashboard', $s_prefix.t('url_dashboard'), 'Dashboard', 'Index');
        Section::registerSection('dashboard_stats', $s_prefix.t('url_dashboard').'/graphstats', 'Dashboard', 'GraphStats');


    }

    // Use this method to log to the database the request
    public static function logRequest($o_db = null) {

        $s_visitor_ip    = \CataloniaFramework\Requests::getClientIp(\CataloniaFramework\Requests::MODE_IP_REQUEST_CLIENT);

        $s_referer       = \CataloniaFramework\Requests::getHttpReferer();

        $s_user_agent    = \CataloniaFramework\Requests::getUserAgent();

        $s_url_requested = \CataloniaFramework\Requests::getRequestedUrl();

        $st_results = $o_db->queryWrite('INSERT INTO
                                                    `visits`
                                                    (`s_visit_datetime`, `s_visit_ip`, `s_referer`, `s_visit_user_agent`, `s_visit_url_requested`)
                                              VALUES
                                                    (NOW(), \''.$s_visitor_ip.'\', \''.$s_referer.'\', \''.$s_user_agent.'\', \''.$s_url_requested.'\');');

    }


}
