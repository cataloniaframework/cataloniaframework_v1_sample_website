<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-23 20:04
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-30 21:21
 * Filename:     bootstrap.php
 * Description:  Define here what you need: classes, constants, autoloads...
 */

namespace CataloniaFramework;

define('DEMOAPP_VERSION', '1.0');

$st_db_cassandra = Array('read'  => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
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

$o_db_cassandra = new Db($st_db_cassandra);

/* $st_result = $o_db_cassandra->queryWrite("INSERT INTO users (user_id, fname, lname, longtext) VALUES ( 20002, 'Carles', 'X', 'whatever');");
print_r($st_result);
$s_long_query = '';
for ($i_userid=6000;$i_userid<6010;$i_userid++) {
    $s_long_query .= "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( ".$i_userid.", 'Carles', 'X', 'whatever');";
}
$st_result2 = $o_db_cassandra->queryWrite($s_long_query);
print_r($st_result2); exit(); */
//$o_db_cassandra->queryRead('SELECT user_id FROM users;');
//$st_result = $o_db_cassandra->queryWrite("INSERT INTO users (user_id, fname, lname, longtext) VALUES ( 4317, 'Carles', 'Mateo', 'Sample text looooooooooooooooooooooooooooooooooooooooooooooooong');");

//$st_result = $o_db_cassandra->queryWrite("INSERT INTO users (user_id, fname, lname, longtext) VALUES ( 3333, 'Aristoclea', 'Theoclea', 'Aristoxenus\nsays that Pythagoras\ngot most of his moral doctrines from the Delphic priestess Themistoclea.');");


/* $st_results = $o_db_cassandra->queryRead('SELECT * FROM users LIMIT 10;');
$i_row_num = 0;
$s_first_data = '';
if ($st_results['result']['status'] == Db::QUERY_RESULT_STATUS_EXECUTED && $st_results['result']['error'] == 0) {
    echo '<table border="1">';
    foreach($st_results['data'] as $i_row=>$st_data) {
        $i_row_num++;
        echo '<tr>';
        foreach($st_data as $s_key => $s_value) {
            if ($i_row_num == 1) {
                // Write headers
                echo '<th>'.$s_key.'</th>';
                $s_first_data .= '<td>'.$s_value.'</td>';
            } else {
                echo '<td>'.$s_value.'</td>';
            }
        }
        echo '</tr>';
        if ($i_row_num == 1) {
            echo '<tr>'.$s_first_data.'</tr>';
        }
    }
    echo '</table>';
} else {
    echo 'Error: '.$st_results['result']['error_description'];
}
*/
//$o_db_cassandra->queryRead('SELECT * FROM users WHERE user_id=17771;');
//$st_result3 = $o_db_cassandra->queryRead('SELECT * FROM users WHERE user_id=3333;');
//print_r($st_result3);
