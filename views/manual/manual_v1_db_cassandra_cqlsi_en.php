<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-10 18:07
 * Last Updater: Carles Mateo
 * Last Updated: 2014-03-25 19:43
 * Filename:     manual_v1_db_cassandra_cqlsi_en.php
 * Description:
 */

namespace CataloniaFramework;

$s_manual_prefix = Section::getSectionURL('manual', true);
$s_download_prefix = Section::getSectionURL('download', true);

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
        <h1 id="site-name">Manual - CQLSÍ</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>CQLSÍ - Cassandra Query Language Simple Interface (SÍ means Yes in Catalan).</p>
<p>Introduced in Catalonia Framework v.1.1.014 it can be used with all the Framework or with the <a href="<?php echo $s_download_prefix; ?>">minimal package for CQLSÍ</a></p>
<h2>What is CQLSÍ</h2>
<p>CQLSÍ is a simple interface, a wrapper, for working with CQL from PHP without Thrift.<br />
    After many problems with Thrift, fails trying different third party code solutions and compiling existing uncompilable PDO drivers, and Thrift being <a href="http://wiki.apache.org/cassandra/API" target="_blank">declared legacy by DataStax in favor of CQL for Cassandra 1.2 and 2.0</a>, etc... I decided to create a painless simple way to interface with CQL while nothing better comes to the scene.<br />
    Basically CQLSÍ executes cqlsh through bash, captures the output and provides the data to the Catalonia Framework's Db abstraction layer, so switching from MySqli to Cassandra is just changing config file to use Db::TYPE_CONNECTION_CASSANDRA_CQLSI instead of Db::TYPE_CONNECTION_MYSQLI or Db::TYPE_CONNECTION_POSTGRE</p>
<h2>Pros and Cons</h2>
<h3>The pros</h3>
<ul>
    <li>As it uses the CQLSH DataStax client, it is always compatible with the latest versions of CQL.<br />
        If a new version is released, just update the cqlsh tool and you'll be able to use the new CQL commands and features</li>
    <li>Compatible with CQL 3 and collections, set, list, map</li>
    <li>No Thrift, boost, etc.. dependencies</li>
    <li>Very easy to use, simply send the cql query as you would do from command line</li>
    <li>Abstraction layer that gives you the results as an Array</li>
    <li>The Abstraction layer is the Db Class from Catalonia Framework, so moving your projects from MySql or Postgre to Cassandra is just switching the driver in config files</li>
    <li>Many CQL commands can be sent at once</li>
    <li>All the data is presented to you as String.<br />
    You don't have to worry about the primitive types laying in Cassandra</li>
</ul>
<h3>The cons</h3>
    <ul>
        <li>As all the wrappers, if the response format expected changes, it won't work<br />
        This can happen if a new version of the cqlsh tool changes the output format.<br />
        This problem can be solved by working with PreProduction and never upgrading Base Software in Production without testing first. Is just common sense</li>
        <li>Administration commands (no data commands) do not return a response.<br />
        For example:<br />
        <pre>DESCRIBE KEYSPACES;</pre>
        Use, instead:<br />
        <pre>SELECT * FROM system.schema_keyspaces;</pre>
        <img src="/img/manual/cataloniaframework-com-manual-cql-get-keyspaces.png" />
        </li>
        <li>Unexpected behavior that it has not been tested could happen<br />
        Although I'm using CQLSÍ for my own projects and I've not discovered problems (I fixed things that were not Ok) new issues could appear (but this happens also with well known drivers)</li>
        <li>All the data is presented to you as String, that is wonderful, but causes confusion with:<br />
            <strong>null</strong>, that is presented to you as a string with value 'null'<br />
            Also strings starting with spaces, like ' Hello World!! ', will be wrapped as 'Hello World!! ' as spaces on the left are trimmed</li>
        <li>There is no pool of opened connections<br />
        Every call to $o_db->queryWrite(); or $o_db->queryRead(); has to connect to the cluster, and after executing the command, the connection will be closed. So if you do 10 queries, you'll loss some time, is the cost of connecting to the Cluster everytime.<br />
            Fortunatelly many INSERTS can be sent at once as a single request to CQLSH.
        </li>
        <li>Is only compatible with Unix. No windows support</li>
    </ul>
<h2>Launching many queries at once</h2>
If you have to send several INSERT or UPDATE queries at once, you can group them in a single $s_cql string and you will save the time of connecting every time.<br />
For example, this code:<br />
<pre>$s_cql_long_query = '';
for ($i_userid=3000;$i_userid<4000;$i_userid++) {
    $s_cql_long_query .= "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( ".$i_userid.", 'Carles', 'X', 'whatever');";
}
$o_db_cassandra->queryWrite($s_cql_long_query);</pre>
This code creates 1,000 inserts, in my modest and busy laptop takes 2.9599 seconds to process the inserts. This time includes all the time, so the cost of the execution of cqlsh, the time of establishing the connection, the time to process the cql and do the 1,000 inserts by Cassandra and the time to close the connection, parse the result and assembly the abstraction layer data Array.<br />
A single insert takes 0.6536 seconds and 10 inserts send as a single $s_sql take 0.6992 seconds, so the most expensive is to launch the cqlsh command, and stablish the connection.<br />
<br />
Simultaneous queries have to be of he same type: Write. It is not recommended although is possible to send many INSERT and a final SELECT at the end and process everything at once (execute with queryRead).<br />

<h2>Installation</h2>
<p>CQLSÍ does not require you to install anything, you just need to have cqlsh client installed in the system.</p>
<p>This is tipically done for Ubuntu/Debian by:</p>
Edit /etc/apt/sources.list and add:
    <pre>deb http://debian.datastax.com/community stable main</pre>
    <p>As descrived in <a href="http://www.datastax.com/docs/1.0/install/install_deb" target="_blank">http://www.datastax.com/docs/1.0/install/install_deb</a></p>
    <p>Add the key:</p>
    <pre>curl -L http://debian.datastax.com/debian/repo_key | sudo apt-key add -</pre>
    <p>Then install the cqlsh tool and if you want Cassandra (although you don't need to have it running on the webserver)</p>
<pre>
sudo apt-get update
sudo apt-get install python-cql=1.0.10-1
sudo apt-get install dsc=1.0.10 cassandra=1.0.10</pre>
<p>Look for upgrades, just in case a new version has been releases:</p>
<pre>
sudo apt-get upgrade
</pre>
Ubuntu on Amazon EC2 will return: The following packages have been kept back, showing cassandra and not updating.<br />
To force the newest version to be installed do:<br />
<pre>sudo apt-get install cassandra</pre>
If Cassandra fails to restart after upgrading, probably has a problem with logs from old version.<br />
If your installation is new you can simple ignore the old logs and everything will work:<br />
<pre>
root@ip-10-10-10-10:/var/lib/cassandra/commitlog# mkdir old_logs
root@ip-10-10-10-10:/var/lib/cassandra/commitlog# mv *.log old_logs/
root@ip-10-10-10-10:/var/lib/cassandra/commitlog# service cassandra start
</pre>
Please keep in mind that cqlsh has to be the version 4.1.0 at least to work with CQLSÍ.<br />
<br />

<p>Probably your system does not allow the webserver's user (www-data) to create history in home folder. This is required for bash, so probably you will have to do:</p>
<pre>
sudo mkdir /var/www/.cassandra
sudo chmod 777 /var/www/.cassandra</pre>
    Or similar, so bash can create cqlsh_history file.<br />
<h2>Working with different clusters / keyspaces</h2>
You can define as many Db objects as you want, each one configured to use a different cluster or keyspace.<br />
Take this sample init/boostrap.php custom file:<br />
<pre>
$st_other_config1['database'] = Array(  'read'  => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                                            'server_hostname'   => '127.0.0.1',
                                                                                            'server_port'       => Db::PORT_DEFAULT_CASSANDRA,
                                                                                            'username'          => 'www_cassandra',
                                                                                            'password'          => 'yourpassword',
                                                                                            'database'          => 'mykeyspace',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )
                                                        ),
                                        'write' => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                                            'server_hostname'   => '127.0.0.1',
                                                                                            'server_port'       => Db::PORT_DEFAULT_CASSANDRA,
                                                                                            'username'          => 'www_cassandra',
                                                                                            'password'          => 'yourpassword',
                                                                                            'database'          => 'mykeyspace',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )

                                                        )
                                    );

$o_db_cassandra = new Db($st_other_config1['database']);
$s_cql = "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( 1714, 'Carles', 'Mateo', 'whatever...');";
$st_result = $o_db_cassandra->queryWrite( $s_cql);
</pre>
You can change the keyspace used for the next queries:<br />
<pre>
$o_db->setDatabaseOrKeyspace('cataloniasample', Db::CONNECTION_READ);
$o_db->setDatabaseOrKeyspace('cataloniasample', Db::CONNECTION_WRITE);
</pre>
It is not recommended, but is possible to use different keyspaces for Read and Write.<br/>
<br />
In order to insert apostrophe, that is saved using '' and avoid injection use Db::prepareInsert(), for example:<br />
<pre>
$i_user_id = prepareInsert($i_user_id, self::DATA_TYPE_INT, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_fname = prepareInsert($s_fname, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_lname = prepareInsert($s_lname, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_longtext = prepareInsert($s_longtext, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_cql = "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( $i_user_id, '$s_fname', '$s_lname', '$s_longtext');";
$st_result = $o_db_cassandra-&gt;queryWrite($s_cql);
</pre>

<h2>Working with data</h2>
For queries that return data, like SELECT $o_db->queryRead($s_cql) must be used.<br />
For queries that INSERT, UPDATE data, or ALTER the Schema, $o_db->queryWrite($s_cql) must be used.<br />
For MySql and Postgre this has another meaning (going to primary or secondaries), but for CQLSÍ it is required by the wrapper, as the error handling is performed in a different way for insertion commands and data fetching commands.<br />
<br />
The enter characters will be returned as \n, so you will have a string like:<br />
"Several\nnew\nlines"<br />
Null data types will be provided as "null" string.<br />
Fully UTF-8 characters are supported, so accents, and other special chars codified by default with LANG=ca_ES.UTF-8.<br />
<br />
Let's see a sample code to fetch data:<br />
<pre>
$st_results = $o_db_cassandra->queryRead('SELECT * FROM users LIMIT 10;');
$i_row_num = 0;
$s_first_data = '';
if ($st_results['result']['status'] == Db::QUERY_RESULT_STATUS_EXECUTED && $st_results['result']['error'] == 0) {
    echo '&lt;table border="1"&gt;';
    foreach($st_results['data'] as $i_row=>$st_data) {
        $i_row_num++;
        echo '&lt;tr&gt;';
        foreach($st_data as $s_key => $s_value) {
            if ($i_row_num == 1) {
                // Write headers
                echo '&lt;th&gt;'.$s_key.'&lt;/th&gt;';
                $s_first_data .= '&lt;td&gt;'.$s_value.'&lt;/td&gt;';
            } else {
                echo '&lt;td&gt;'.$s_value.'&lt;/td&gt;';
            }
        }
        echo '&lt;/tr&gt;';
        if ($i_row_num == 1) {
            echo '&lt;tr&gt;'.$s_first_data.'&lt;/tr&gt;';
        }
    }
    echo '&lt;/table&gt;';
} else {
    echo 'Error: '.$st_results['result']['error_description'];
}
</pre>
This code in init/bootstrap.php produces this output:<br />
    <img src="/img/manual/cataloniaframework-manual-cqlsi-fetching-utf8-data.png" border="1" /><br />
<br />
In case of error <strong>echo 'Error: '.$st_results['result']['error_description'];</strong> will output:<br />
    <img src="/img/manual/cataloniaframework-manual-cqlsi-sample-error-output.png" border="1" /><br />

<h2>Enable debug</h2>
CQLSÍ generates temp files under /tmp.<br />
Those are the .sh files executed and .cqlsi with the commands send to cqlsh.<br />
If you need to debug and see what is the exact error you get, you can indicate to CQLSÍ to do not delete those files after use.<br />
<br />
For example:<br />
<pre>$s_cql = "CREATE TABLE IF NOT EXISTS test (userid int,
                                           firstname text,
                                           lastname text,
                                           tele set&lt;text&gt;,
                                           emails set&lt;text&gt;,
                                           skills list&lt;text&gt;,
                                           todos map&lt;timestamp,text&gt;,
                     PRIMARY KEY (userid) );";

$o_db_cassandra-&gt;setKeepCqlFiles(true);

$st_result = $o_db_cassandra-&gt;queryWrite($s_cql);</pre>

<h2>Common errors</h2>
<ul>
    <li>If you have installed cqlsh in other than the default path /usr/bin/cqlsh:<br />
<img src="/img/manual/cataloniaframework-manual-common-errors-cqlsh-not-found.png" /><br />
Use $o_db->setCqlshPath($s_new_path); to setup it.</li>
    <br />
    <li>If cqlsh can't connect to the db server:<br />
<img src="/img/manual/cataloniaframework-com-manual-common-errors-cannot-connect-to-database.png" /><br />
Check it your firewall, dns, etc...</li>
    <br />
    <li>If you forget to end the cql with ;<br />
    Some commands are accepted without ending ; but most of them aren't, so to be sure end always your CQL commands with ;</li>
    <br />
    <li>To insert now() with apostrophes, like in 'now()'. now() corresponds to timeuuid and not to string type</li>
</ul>

<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>