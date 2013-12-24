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
        <h1 id="site-name">Manual - Getting started</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Once cloned from git, and Apache is setup, you must do few steps:</p>
<ol>
    <li>Give permission to cache/ directory. 777 For the directory and 0666 for cache/.</li>
    <li>Edit config/general.php and change:
        <pre>define('FIRST_TIME', true);</pre>
        To:
        <pre>define('FIRST_TIME', false);</pre>
    </li>
    <li>Edit config/general.php if you want to disable multi-language (default)
        <pre>define('MULTILANG', true);</pre></li>
    <li>Edit your config/development.php to reflect paths for the project and the urls
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
</ol>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>