<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-15 15:17
 * Last Updater:
 * Last Updated:
 * Filename:     about_index_ca.php
 * Description:
 */

namespace CataloniaFramework;

?><html>
    <head>
    <?php require_once 'index_head.php'; ?>
    </head>
<body>
<div class="header-body">
    <div class="head_logo">
        <img src="/img/cataloniaframework-logo1-30pc-no_mg.png" />
    </div>
    <div class="head_title">
        <h1 id="site-name">Installation of PHP Catalonia Framework</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<h2>Linux Debian/Ubuntu Servers</h2>
<p>Install Apache, PHP and MySql:</p>
<pre>
    sudo apt-get install apache2
    sudo apt-get install libapache2-mod-php5
    sudo apt-get install mysql-server libapache2-mod-auth-mysql php5-mysql
</pre>
Activate ModRewrite:<br />
<pre>
    sudo a2enmod rewrite
</pre>
Download the Framework from GitHub or uncompress the file .tar.gz or zip.<br />
<br />
Config Apache to point to www/ folder of the Framework.<br />
Tipically it is done by creating a file in /etc/apache2/sites-available/yourwebsite<br />
<br />
<pre>
&lt;VirtualHost *:80&gt;
        ServerAdmin webmaster@localhost

        ServerName www.cataloniaframework.com
        ServerAlais cataloniaframework.com

        DocumentRoot /var/www/www.cataloniaframework.com/www
        &lt;Directory /var/www/www.cataloniaframework.com/www/&gt;
                Options Indexes FollowSymLinks MultiViews
                AllowOverride All
                Order allow,deny
                allow from all
        &lt;/Directory&gt;

        ErrorLog ${APACHE_LOG_DIR}/www-cataloniaframework-com-error.log

        # Possible values include: debug, info, notice, warn, error, crit,
        # alert, emerg.
        LogLevel warn

        CustomLog ${APACHE_LOG_DIR}/www-cataloniaframework-com-access.log combined
&lt;/VirtualHost&gt;
</pre>
<br />
Ensure <strong>cache/</strong> folder has permissions.<br />
<pre>
    chmod 777 cache/
    chmod 666 cache/.
</pre>
Optional, if you want to use <strong>curl</strong> functionality:<br />
<pre>sudo apt-get install curl libcurl3 libcurl3-dev php5-curl</pre>
And restart the Web Server.<br />
<br />
Optional, if you want to use <strong>crypt/decrypt</strong> functionality.<br />
<pre>sudo apt-get install php5-mcrypt</pre>
And restart the Web Server.<br />

<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>