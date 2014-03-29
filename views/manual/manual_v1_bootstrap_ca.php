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
        <h1 id="site-name">Manual - Bootstrap i l'ordre de càrrega</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<small>Darrera actualització: 2014-02-01</small>
<h2>.htacess</h2>
<p>Doneu-li un cop d'ull a l'arxiu .htaccess</p>
<pre>RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME} !-f
RewriteRule ^(.*)$ index.php?params=$1 [L,QSA]</pre>
El que fan aquestes rules és revisar si l'arxiu sol·licitat existeix, i si existeix és servit pel servidor web, com sempre, i si no existeix llavors el Bootstrap pren el control.<br />
Així que si demaneu una imatge o un arxiu javascript o un arxiu php independent que existeix al servidor, serà mostrat/executat normalment.<br />
En un altre cas la acció petició serà transferida al Catalonia Framework, concretament a index.php.<br />
Això proporciona molta flexibilitat i Llibertat i permet al desenvolupador decidir si vol servir els continguts pels mecanismes normals del servidor web o pel Framework.<br />
<br />
<h2>Entenent index.php</h2>
index.php és molt net:
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
<h2>Ordre de càrrega</h2>
Com veieu el primer a ser carregat és:<br />
<pre>require_once '../catfwcore/bootstrap.php';</pre>
El primer que es carrega és el Bootstrap del Framework, aquest ho inicialitza tot, i llavors carrega:<br />
<pre>init/commonrequests.class.php</pre>
commonrequests.class.php és l'indret on el desenvolupador afegeix els seu propi codi personalitzat, que s'executa a cada petició http.<br />
L'ordre de les crides és:<br />
<ol>
    <li>Bootstrap carrega tots els arxius del Core requerits</li>
    <li>Les variables $s_params, $st_params i la constant REQUESTED_PATH són definides.</li>
    <li>init/customprebootstrap.php és invocat</li>
    <li>CommonRequests::initSession($o_db); és <br />
    <li>CommonRequests::registerURLS(); per a definir URLs estàtiques</li>
    <li>Constants com USER_LANGUAGE, CONTROLLER, ACTION són fixades, per a que puguin ser emprades arreu del codi</li>
    <li>Els paràmeters són copiat en parells per a un fàcil ús a $st_params_url</li>
    <li>CommonRequests::registerUserVars($o_db); és invocat</li>
    <li>CommonRequests::logRequest($o_db); és invocat</li>
    <li>init/custompostbootstrap.php és invocat</li>
</ol>
Després d'això, l' init/bootstrap.php és executat. Aquest és el Bootstrap del desenvolupador. Aquí el desenvolupador pot afegir <i>requires</i> per a les seves classes i arxius, llibreries de tercers, etc...<br />
L'objectiu d' init/ directory és que el desenvolupador faci els seus canvis aquí, així quan el Catalonia Framework és actualitzat amb una nova versió, no hi haurà conflictes amb el codi del projecte del desenvolupador i el codi Core del Framework.<br />
El Framework proporciona un autoload per a "lazy loading" les classes (quan es demanen si no s'havien carregat), així si una classe desconeguda és invocada el Framework intentarà carregar-la del directori classes/.<br />
</pre>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>