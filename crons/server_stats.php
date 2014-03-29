#!/usr/bin/env php
# Remember to set as executable with chmod +x
# install it with crontab -e
# */5 * * * * /path/to/server_stats.php
<?php

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
                                                                            'server_port'		=> Db::PORT_DEFAULT_CASSANDRA,
                                                                            'username'			=> 'www_cassandra',
                                                                            'password'			=> 'passCassandra',
                                                                            'database'			=> 'cataloniafw',
                                                                            'client_encoding'   => 'utf8'
                                                                            )
                                                                )
                                        ),
                        'write' => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                            'server_hostname'   => '127.0.0.1',
                                                                            'server_port'		=> Db::PORT_DEFAULT_CASSANDRA,
                                                                            'username'			=> 'www_cassandra',
                                                                            'password'			=> 'passCassandra',
                                                                            'database'			=> 'cataloniafw',
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
$s_vdate = \CataloniaFramework\Datetime::getDateTime(\CataloniaFramework\Datetime::FORMAT_DATE_ONLY);

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
