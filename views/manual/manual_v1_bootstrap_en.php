<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-12-23 13:54
 * Last Updater:
 * Last Updated:
 * Filename:     manual_v1_bootstrap_en.php
 * Description:
 */

namespace CataloniaFramework;

$s_manual_prefix = Section::getSectionURL('manual', true);

?><html>
    <head>
    <?php require_once VIEWS_ROOT.'index_head.php'; ?>
    </head>
<body>
<div class="header-body">
    <div class="head_logo">
        <img src="/img/cataloniaframework-logo1-30pc-no_mg.png" />
    </div>
    <div class="head_title">
        <h1 id="site-name">Manual - Bootstrap and Load order</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<small>Last updated: 2014-02-01</small>
<h2>.htacess</h2>
<p>Take a look at the .htaccess file</p>
<pre>RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?params=$1 [L,QSA]</pre>
What it does is to check if the file requested exists, if it exists it is served normally, and if not the bootstrap takes the action.<br />
So if you request an image or a javascript or a stand alone php file that exists in the server, it will be delivered normally.<br />
Otherwise the action will be transferred to the Catalonia Framework, concretely to index.php.<br />
That gives a lot of flexibility and Freedom and allows the developer to decide where he wants to server contents by normal Apache mechanisms or by the Framework.<br />
<br />
<h2>Understanding index.php</h2>
index.php is very clean:
<pre>&lt;?php
use CataloniaFramework\Views as Views;
use CataloniaFramework\Core as Core;
use CataloniaFramework\Navigation as Navigation;

try {
    $i_start_time = microtime(true);

    require_once '../catfwcore/bootstrap.php';

    if (Navigation::isURLCustom(REQUESTED_PATH)) {
        // custom url
        $s_html = $o_controller->$s_action(REQUESTED_PATH, $o_db);
    } else {
        // MVC pattern
        $s_html = $o_controller->$s_action(REQUESTED_PATH, $st_params, $st_params_url, $o_db);
    }

    Views::replaceUserVars($s_html);
    // Finish time after user work
    $i_finish_time = microtime(true);
    $i_execution_time = $i_finish_time-$i_start_time;
    Views::addSystemVar('EXECUTION_TIME', $i_execution_time, Views::VAR_ACTION_REPLACE);
    // TODO: SetSystemvar finish time
    Views::replaceSystemVars($s_html);

} catch (DatabaseConnectionError $e) {
    // Todo: Check if in Json...
    // Error with Databases
    $s_html = getErrorView(Views::ERROR_EXCEPTION_ERROR, Views::$st_ERROR_MESSAGES[Views::ERROR_EXCEPTION_ERROR].' '.$e->getMessage());
} catch (CustomFileNotFound $e) {
    $s_html = getErrorView(Views::ERROR_EXCEPTION_ERROR, Views::$st_ERROR_MESSAGES[Views::ERROR_EXCEPTION_ERROR].' '.$e->getMessage());
} catch (CustomFileNotDefined $e) {
    $s_html = getErrorView(Views::ERROR_EXCEPTION_ERROR, Views::$st_ERROR_MESSAGES[Views::ERROR_EXCEPTION_ERROR].' '.$e->getMessage());
} catch (CurrencyNotFoundException $e) {
    $s_html = getErrorView(Views::ERROR_EXCEPTION_ERROR, Views::$st_ERROR_MESSAGES[Views::ERROR_EXCEPTION_ERROR].' '.$e->getMessage());
} catch (exception $e) {
    $s_html = getErrorView(Views::ERROR_EXCEPTION_ERROR, Views::$st_ERROR_MESSAGES[Views::ERROR_EXCEPTION_ERROR].' '.$e->getMessage());
}

// Echo page or error
echo $s_html;

Core::end();
</pre>
<h2>Load order</h2>
As you've seen the first to be loaded is:<br />
<pre>require_once '../catfwcore/bootstrap.php';
require_once CUSTOM_INIT_ROOT.'bootstrap.php';</pre>
The first thing to be loaded is the Framework's Bootstrap, it loads all the core classes needed, at a early stage it loads:
<pre>init/customprebootstrap.php</pre>
This is a custom bootstrap from the developer that loads at the very beginning part of the boostraping.<br />
The goal of this file is to provide a place to define Classes, database objects, constants, third party libraries, require additional files... that will be needed later by the custom code.<br />
The bootrap initialises everything, and then loads:<br />
<pre>init/commonrequests.class.php</pre>
commonrequests.class.php is the place where the developer adds its custom code to be run in every requests.<br />
The order of calls is:<br />
<ol>
    <li>Bootstrap loads all the required core files</li>
    <li>Variables $s_params, $st_params and constant REQUESTED_PATH are defined.</li>
    <li>init/customprebootstrap.php is invoked</li>
    <li>CommonRequests::initSession($o_db);<br />
    <li>CommonRequests::registerURLS(); to define user custom hardcoded URLs</li>
    <li>Constants like USER_LANGUAGE, CONTROLLER, ACTION are set, so they can be readed allover the code</li>
    <li>Parameters are copied into pairs for more easy use in $st_params_url</li>
    <li>CommonRequests::registerUserVars($o_db); is invoked</li>
    <li>CommonRequests::logRequest($o_db); is invoked</li>
    <li>init/custompostbootstrap.php is invoked</li>
</ol>
The purpose of the init/ directory is that the developer does his changes here, and so when the Catalonia Framework is updated, there are no conflicts with the existing developer's code projects and Core files.<br />
The framework provides an autoload for lazyloading classes, so if an unknown Class is invoked it will try to load from the classes/ directory.<br />
</pre>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>