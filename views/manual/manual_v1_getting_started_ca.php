<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-15 17:36
 * Last Updater:
 * Last Updated:
 * Filename:     manual_index_en.php
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
        <h1 id="site-name">Manual - Començant, primeres passes</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Un cop s'ha clonat des de Git, i el servidor Apache està configurat, heu de fer algunes passes:</p>
<ol>
    <li>Donar permissos al directori <strong>cache/</strong> . 777 per al directori i 0666 a <strong>cache/.</strong></li>
    <li>Reviseu que la configuració bàsica és funcionat. Obriu el navegador apuntant al vostre Virtual Host i hauríeu de veure un missatge com aquest:<br />
        <img src="/img/manual/cataloniaframework-first-time.png" border="1" /></li>
    <li>Editar config/general.php i canviar:
        <pre>define('FIRST_TIME', true);</pre>
        A:
        <pre>define('FIRST_TIME', false);</pre>
        Això activarà el Framework i us mostrarà l'aplicació bàsica DemoApp quan hagueu configurat les rutes a <strong>config/development.php</strong>.
    </li>
    <li>Editeu <strong>config/general.php</strong> si voleu desactivar el multi-idioma (activat per defecte)
        <pre>define('MULTILANG', true);</pre></li>
    <li>Editar el vostre config/development.php per a reflectir les rutes i les url per al projecte
        <pre>
$st_server_config = array(  'environment'   => ENVIRONMENT,
                            'web'           => array(   'http'  => 'http://develwww.cataloniafw.com/',
                                                        'http_enabled'	=> true,
                                                        'https' => 'https://develwww.cataloniafw.com/',
                                                        'https_enabled' => false),
                            'cdn'           => array(   'images' => array(  'http'  => 'http://images.cataloniafw.com/',
                                                                            'https' => 'https://images.cataloniafw.com/'),
                                                        'videos' => array(  'http'  => 'http://video.cataloniafw.com/',
                                                                            'https' => 'https://video.cataloniafw.com/')
                                                    ),
                            'storage'       => array(   'web_root'          => '/srv/web/cataloniaweb/www/',
                                                        'catfw_root'        => '/srv/web/cataloniaweb/',
                                                        'classes_root'      => '/srv/web/cataloniaweb/classes/',
                                                        'cache'             => '/srv/web/cataloniaweb/cache/',
                                                        'tmp'               => '/tmp/',
                                                        'logs'              => '/var/logs/www/'
                                                    )
                         );</pre></li>
    <li>Si necessiteu configurar un entorn de desenvolupament per a múltiples desenvolupadors, se suggereix usar server name:
    <pre>$s_requested_host = \CataloniaFramework\Requests::getServerName();

if ($s_requested_host == 'devel1.elvostrelloc.cat') {
    $s_dir = '/srv/devel1.elvostrelloc.cat/elvostrelloc.cat/';
} elseif ($s_requested_host == 'devel2.elvostrelloc.cat') {
    $s_dir = '/srv/devel2.elvostrelloc.cat/elvostrelloc.cat/';
/* ... */
} else {
    $s_dir = '/srv/elvostrelloc.cat/';
}

// I redefinir l' array $st_server_config
$st_server_config['storage'] = Array('web_root'     => $s_dir.'www/',
                                     'catfw_root'   => $s_dir,
                                     'classes_root' => $s_dir.'classes/',
                                     'cache'        => $s_dir.'cache/',
                                     'tmp'          => '/tmp/',
                                     'logs'         => '/var/logs/www/'
                                     );
</pre></li>
</ol>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Tornar a la plana principal del Manual</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>