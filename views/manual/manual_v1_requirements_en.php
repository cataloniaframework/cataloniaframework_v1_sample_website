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
        <h1 id="site-name">Manual - Requirements</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
    <h2>Catalonia Framework V.1.1.x Requirements</h2>

    <ul>
        <li>Apache webserver (can work with others but .htaccess is provided for Apache)</li>
        <li>PHP 5.3 or higher version.</li>
        <li>Rewrite for Apache (mod_rewrite). <br />
            You can add it in Debian/Ubuntu with <pre>sudo a2enmod rewrite</pre></li>
        <li>Support for output_buffering in php.ini</li>
    </ul>
    Optional but recommended:<br />
    <ul>
        <li>Curl is optional, only if you need to use it.</li>
        <li>GD graphics library is optional<br />
            Install it for Debian/Ubuntu with <pre>sudo apt-get install php5-gd</pre>
            Install it for CentOs with <pre>sudo yum install php-gd</pre></li>
        <li>Mcrypt for using crypt/decrypt functionality.<br />
            Install it for Debian/Ubuntu with <pre>sudo apt-get install php5-mcrypt</pre></li>
    </ul>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>