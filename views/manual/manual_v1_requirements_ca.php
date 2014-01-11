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
        <h1 id="site-name">Manual - Requeriments</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
    <h2>Catalonia Framework V.1.1.x Requeriments</h2>

    <ul>
        <li>Apache webserver (funciona amb d'altres però l'arxiu .htaccess proporcionat és per a Apache)</li>
        <li>PHP 5.3 o una versió superior.</li>
        <li>Rewrite per a Apache (extensió mod_rewrite). <br />
            Podeu instal·lar-lo en Debian/Ubuntu amb <pre>sudo a2enmod rewrite</pre></li>
        <li>Suport per a output_buffering a php.ini</li>
    </ul>
    Opcional però recomenat:<br />
    <ul>
        <li>Curl és opcional, només si necessiteu emprar-la.</li>
        <li>GD graphics library és opcional<br />
            Instal·leu-la per a Debian/Ubuntu amb <pre>sudo apt-get install php5-gd</pre>
            Instal·leu-la per a CentOs amb <pre>sudo yum install php-gd</pre></li>
        <li>Mcrypt per a usar les funcions d'encriptació i desencriptació.<br />
            Instal·leu-la per a Debian/Ubuntu amb <pre>sudo apt-get install php5-mcrypt</pre></li>
    </ul>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Tornar a la plana principal del Manual</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>