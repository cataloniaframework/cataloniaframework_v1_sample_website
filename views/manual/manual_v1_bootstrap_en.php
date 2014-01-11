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
    require_once CUSTOM_INIT_ROOT.'bootstrap.php';

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
The first thing to be loaded is the Framework's Bootstrap, it initialises everything, and then loads:<br />
<pre>init/commonrequests.class.php</pre>
commonrequests.class.php is the place where the developer adds its his custom code to be run in every requests.<br />
After that, the init/bootstrap.php is executed. This is the developer's Bootstrap. Here the developer can add requires for his classes, third party libraries, etc...<br />
The purpose of the init/ directory is that the developer does his changes here, and so when the Catalonia Framework is updated, there are no conflicts with the existing developer's code projects.<br />
The framework provides an autoload for lazyloading classes, so if an unknown Class is invoked it will try to load from the classes/ directory.<br />
</pre>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>