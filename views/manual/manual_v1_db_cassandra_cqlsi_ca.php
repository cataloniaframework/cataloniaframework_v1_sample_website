<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-11 16:11
 * Last Updater:
 * Last Updated:
 * Filename:     manual_v1_db_cassandra_cqlsi_ca.php
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
        <h1 id="site-name">Manual - CQLSÍ</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>CQLSÍ - Cassandra Query Language Simple Interface (SÍ és per l'afirmació Sí, en Català).</p>
<p>Introduït a Catalonia Framework v.1.1.014</p>
<h2>Què és CQLSÍ</h2>
<p>CQLSÍ és una interfície simple, un wrapper, per a treballar amb CQL des de PHP sense Thrift.<br />
    Després de molts problemes amb Thrift, fails intentant diferent solucions de codi de tercers i compilant existents incompilables drivers PDO, i Thrift essent <a href="http://wiki.apache.org/cassandra/API" target="_blank">declarat obsolet per DataStax en favor de CQL per a Cassandra 1.2 i 2.0</a>, etc... vaig decidir crear una manera simple, sense dolor, per a comunicar-me amb CQL mentre un mecanisme millor no aparegui en escena.<br />
    Bàsicament CQLSÍ executa cqlsh des de bash, captura la sortida i proporciona les dades a la capa d'abstracció de la classe Db del Catalonia Framework, així que passar de MySqli a Cassandra implica només canviar l'arxiu de configuració per a que usi Db::TYPE_CONNECTION_CASSANDRA_CQLSI en comptes de Db::TYPE_CONNECTION_MYSQLI o Db::TYPE_CONNECTION_POSTGRE</p>
<h2>Pros i Contres</h2>
Els pros:<br />
<ul>
    <li>Com usa el client CQLSH de DataStax, és compatible amb les més recents versions de CQL.<br />
        Si una nova versió és alliberada, simplement actualitzeu la eina cqlsh al servidor web i podreu usar les noves comandes CQLi funcionalitats</li>
    <li>No Thrift, boost, etc.. sense dependències</li>
    <li>Molt fàcil d'usar, simplement envieu la consulta cql com ho farieu des de línia de comandes</li>
    <li>La capa d'abstracció us proporciona tots els resultats en un Array</li>
    <li>La cap d'abstracció és la classe Db del Catalonia Framework, així que migrar el vostre codi de MySql o Postgre a Cassandra és tan simple com canviar el driver als arxius de configuració</li>
    <li>Moltes comandes CQL poden ser llanççades de cop</li>
    <li>Totes les dades us són presentades com Strings.<br />
    No us heu de preocupar sobre els tipus primitius que hi ha a Cassandra</li>
</ul>
Els contres:<br />
    <ul>
        <li>Com tots els wrappers, si el format de la resposta canviés, no funcionaria<br />
        Això pot passar si una nova versió de la eina cqlsh canvia el format de sortida.<br />
        Aquest problema es pot solucionar fent els canvis a PreProducció primer i mai actualitzant el Software Base directament a Producció sense testejar primer. És simplement sentit comú</li>
        <li>Comportaments no esperats que no han estat testejats podrien passar<br />
        Malgrat jo estic emprant CQLSÍ per als meus propis projectes i no he descobert problemes (vaig solucionar el que no funcionava) nous incidents poden revelar-se (encara que això passa amb els drivers molt probats i ben coneguts)</li>
        <li>Tota la data és presentada com a String, això causa confussió amb:<br />
            <strong>null</strong>, que és presentat com un cadena amb valor 'null'<br />
            També els Strings començant amb espais, com ' Hello World!! ', seran capturats com 'Hello World!! ' ja que els espais de l'esquerra són eliminats pel wrapper</li>
        <li>No hi ha un pool de connexions obertes<br />
        Cada crida a to $o_db->queryWrite(); o $o_db->queryRead(); s'ha de connectar al cluster, i després d'executar la comanda, la connexió serà tancada. Així que si feu 10 queries, perdreu algun temps, és el cost de connectar al cluster cada cop.<br />
            Afortunadament molts INSERTS poden ser enviats de cop com una simple petició a CQLSH.
        </li>
    </ul>
<h2>Llançant moltes consultes de cop</h2>
Si heu d'executar diverses consultes INSERT o UPDATE de cop, les podeu agrupar en una única cadena $s_cql i salvareu el temps de connectar cada vegada.<br />
Per exemple, aquest codi:<br />
<pre>$s_cql_long_query = '';
for ($i_userid=3000;$i_userid<4000;$i_userid++) {
    $s_cql_long_query .= "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( ".$i_userid.", 'Carles', 'X', 'whatever');";
}
$o_db_cassandra->queryWrite($s_cql_long_query);</pre>
Aquest codi crea 1.000 inserts, en el meu modest i ocupat portàtil comporta 2,9599 segons de processar aquests inserts. Això inclou tot el temps, o sigui el cost d'execució de cqlsh, el temps d'establir la connexió, el temps de processar el cql per part de Cassandra i fer les 1.000 inserts i el temps de tancar la connexió, parsejar el resultat i ensamblar la capa d'abstracció a l'array de dades.<br />
Un insert simple triga 0,6536 segons i 10 inserts enviats com un simple $s_sql triguen 0,6992 seconds, així que el més car és llançar la comanda cqlsh, i establir la connexió.<br />
<br />
Les consultes han de ser del mateix tipus. Lectura o escripture (Read o Write).<br />

<h2>Instal·lació</h2>
<p>CQLSÍ no requereix d'instal·lar res, simplement necessiteu tenir el client cqlsh instal·lat al sistema.</p>
<p>Això és fet típicament:</p>
Editar /etc/apt/sources.list i afegir:
    <pre>deb http://debian.datastax.com/community stable main</pre>
    <p>Com es descriu a <a href="http://www.datastax.com/docs/1.0/install/install_deb" target="_blank">http://www.datastax.com/docs/1.0/install/install_deb</a></p>
    <p>Afegir la key:</p>
    <pre>curl -L http://debian.datastax.com/debian/repo_key | sudo apt-key add -</pre>
    <p>Llavors instal·lar la clau cqlsh i si voleu Cassandra (però no necessiteu que corri al webserver)</p>
<pre>
sudo apt-get install python-cql=1.0.10-1
sudo apt-get install dsc=1.0.10 cassandra=1.0.10</pre>
    <p>Probablement el vostre sistema no permet a l'usuari del webserver (www-data) crear l'arxiu d'history. Això ho necessita bash, segurament haureu de fer:</p>
<pre>
sudo mkdir /var/www/.cassandra
sudo chmod 777 /var/www/.cassandra</pre>
    O similar, de manaera que bash pugui crear l'arxiu history.<br />
<h2>Treballant amb diferents clusters / keyspaces</h2>
Podeu definir tants objectes Db com volgueu, cadascun configurat per a usar un cluster diferent o un keyspace diferent.<br />
Preneu aquest exemple a l'arxiu init/boostrap.php :<br />
<pre>
$st_other_config1['database'] = Array(  'read'  => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                                            'server_hostname'   => '127.0.0.1',
                                                                                            'server_port'		=> Db::PORT_DEFAULT_CASSANDRA,
                                                                                            'username'			=> 'www_cassandra',
                                                                                            'password'			=> 'yourpassword',
                                                                                            'database'			=> 'mykeyspace',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )
                                                        ),
                                        'write' => Array(   'servers'   => Array(0 => Array('connection_type'   => Db::TYPE_CONNECTION_CASSANDRA_CQLSI,
                                                                                            'connection_method' => Db::CONNECTION_METHOD_TCPIP,
                                                                                            'server_hostname'   => '127.0.0.1',
                                                                                            'server_port'		=> Db::PORT_DEFAULT_CASSANDRA,
                                                                                            'username'			=> 'www_cassandra',
                                                                                            'password'			=> 'yourpassword',
                                                                                            'database'			=> 'mykeyspace',
                                                                                            'client_encoding'   => 'utf8'
                                                                                            )
                                                                                )

                                                        )
                                    );

$o_db_cassandra = new Db($st_other_config1['database']);
$s_cql = "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( 1714, 'Carles', 'Mateo', 'whatever...');";
$st_result = $o_db_cassandra->queryWrite( $s_cql);
</pre>
Per a inserir apòstrofs, que són salvats usant '' i per a evitar injeccions useu Db::prepareInsert(), per exemple:<br />
<pre>
$i_user_id = prepareInsert($i_user_id, self::DATA_TYPE_INT, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_fname = prepareInsert($s_fname, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_lname = prepareInsert($s_lname, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_longtext = prepareInsert($s_longtext, self::DATA_TYPE_STRING, self::TYPE_CONNECTION_CASSANDRA_CQLSI);
$s_cql = "INSERT INTO users (user_id, fname, lname, longtext) VALUES ( $i_user_id, '$s_fname', '$s_lname', '$s_longtext');";
$st_result = $o_db_cassandra->queryWrite($s_cql);
</pre>
<h2>Treballant amb dades</h2>
El caracter Enter serà retornat com \n, de manera que tindreu una cadena com:<br />
"Diverses\nnoves\nlínies"<br />
El tipus de dades Null seran proporcionats com la cadena "null".<br />
Els caracter UTF-8 tenen suport total, així accents, i d'altres caracters especials codificats per defecte amb LANG=ca_ES.UTF-8.<br />
<br />
Examinem un exemple per a agafar dades:<br />
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
Aquest codi a init/bootstrap.php produeix aquesta sortida:<br />
    <img src="/img/manual/cataloniaframework-manual-cqlsi-fetching-utf8-data.png" border="1" /><br />
<br />
En cas d'error <strong>echo 'Error: '.$st_results['result']['error_description'];</strong> serà mostrat:<br />
    <img src="/img/manual/cataloniaframework-manual-cqlsi-sample-error-output.png" border="1" /><br />
<br />
<a href="<?php echo $s_manual_prefix; ?>">Tornar a la plana principal del Manual</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>