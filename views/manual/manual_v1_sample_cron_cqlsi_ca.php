<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-10 18:07
 * Last Updater:
 * Last Updated:
 * Filename:     manual_v1_db_cassandra_cqlsi_en.php
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
        <h1 id="site-name">Manual - A Sample cron using CQLSÍ</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Aquí teniu un exemple de cron a crons/server_stats.php que guarda el percentatge de CPU usat al servidor, cada 5 minuts.</p>
<p>Aquest cron és executat pel cron de Linux. Per a definir-lo feu:</p>
<pre>crontab -e</pre>
I llavors escrigueu una línea com aquesta:
<pre>*/5 * * * * /path/to/server_stats.php</pre>
<p>Aquí està el codi, molt senzill</p>
<h2>Codi d'exemple</h2>
<pre>#!/usr/bin/env php
# Remember to set as executable with chmod +x
# install it with crontab -e
# */5 * * * * /path/to/server_stats.php
&lt;?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-29 20:28
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-30 14:55
 * Filename:     server_stats.php
 * Description:  Stores the stats of the server in the Cassandra Db
 */

$s_path = dirname(__FILE__);
if (substr($s_path,-1) != '/' && substr($s_path,-1) != '\\') {
    $s_path .= '/';
}

require_once $s_path.'../config/general.php';
require_once CATFW_CORE_ROOT.'datetime.class.php';
require_once CATFW_CORE_ROOT.'security.class.php';
require_once CATFW_CORE_ROOT.'file.class.php';
require_once CATFW_CORE_ROOT.'db.class.php';

use CataloniaFramework\Db as Db;

$st_db_config = Array(	'read'  => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                            'server_hostname'   => '127.0.0.1',
                                                                            'server_port'       => Db::PORT_DEFAULT_CASSANDRA,
                                                                            'username'          => 'www_cassandra',
                                                                            'password'          => 'passCassandra',
                                                                            'database'          => 'cataloniafw',
                                                                            'client_encoding'   => 'utf8'
                                                                            )
                                                                )
                                        ),
                        'write' => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                            'server_hostname'   => '127.0.0.1',
                                                                            'server_port'       => Db::PORT_DEFAULT_CASSANDRA,
                                                                            'username'          => 'www_cassandra',
                                                                            'password'          => 'passCassandra',
                                                                            'database'          => 'cataloniafw',
                                                                            'client_encoding'   => 'utf8'
                                                                            )
                                                                )

                                        )


                    );

$s_node = 'CRON01';

$o_db = new Db($st_db_config);


// Simple insert
$s_uuid = \CataloniaFramework\Security::getUUIDV4();
$s_unix_datetime = \CataloniaFramework\Datetime::getDateTime(\CataloniaFramework\Datetime::FORMAT_UNIXTIME);
$s_datetime = \CataloniaFramework\Datetime::getDateTime(\CataloniaFramework\Datetime::FORMAT_MYSQL_COMP);

$i_error_code = 0;

// Use top to get CPU usage.
// Finally converts Catalan decimals comma separated to American decimals point separated in case locale did transformations
// Tested with Ubuntu 13.10 and Ubuntu 12.04 with different locales
$s_command = "top -b -n1 | sed 's/%/ /g' | sed 's/,/./g' | awk '/Cpu/ {print $2 + $4}' | sed 's/,/./g'";
$s_cpu_used = system($s_command, $i_error_code);

$s_cql = "INSERT INTO
                        serverstats
                        (vdate, unix_datetime, node, vname, vvalue, datetime)
               VALUES
                        ('$s_vdate', $s_unix_datetime, '$s_node', 'CPU_USED', '$s_cpu_used', '$s_datetime');";

$st_results = $o_db->queryWrite($s_cql);
if ($st_results['result']['error'] > 0) {
    echo 'The query: '.$st_results['result']['query'].' returned error: '.$st_results['result']['error_description']."\n";
} else {
    echo 'Row inserted!'."\n";
}

</pre>
<br />
Llavors tindreu les dades de consum de la vostra CPU guardades cada 5 minuts.<br />
<img src="/img/manual/cataloniaframework-result-of-querying-serverstats-cron-server_stats-results.png" /><br />
<br />
<a href="<?php echo $s_manual_prefix; ?>">Tornar a la plana principal del Manual</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>