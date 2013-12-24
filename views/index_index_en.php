<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-11 00:15
 * Last Updater:
 * Last Updated:
 * Filename:     catfw_index.php
 * Description:
 */

namespace CataloniaFramework;

?><html>
    <head>
    <?php require_once 'index_head.php'; ?>
    </head>
<body>
||*||[HEAD_TITLE_BLOCK]||*||
||*||[HEAD_NAVIGATION_BLOCK]||*||

<div class="body_page">
Welcome to Catalonia Framework page.<br />
Catalonia Framework is a PHP Open Source Framework.<br />
<br />
Last version of Catalonia Framework is v.1.1.010 from 2013-09-15.<br />
<br />
Features at a glance:<br />
<ul>
    <li>Compatible with PHP 5.3, 5.4, 5.5</li>
    <li>MVC</li>
    <li>Built in cache, at Controller level, possible override by Action</li>
    <li>Dynamic system that allows infinite live sections under cached contents, customized on-the-fly</li>
    <li>Multi-Language (pages in several languages easily)</li>
    <li>Native SEO multi-language</li>
    <li>Very Fast</li>
    <li>Very Flexible</li>
    <li>Ready to serve content (like images, video, Json/Ajax, Xml...)</li>
    <li>Very Easy to learn</li>
    <li>Database abstraction with supports for several database Engines (including PostgreSQL)</li>
    <li>Saves Db Connection until used</li>
    <li>Supports Primary Db Server (Inserts), Secondaries (for Reads)</li>
    <li>Brings DBSharding feature for working transparently to a Shard of many Database Servers (several DB Engines)</li>
    <li>Really Flexible Form manager with fields validation and error marking</li>
    <li>Built-in Seo Sections feature / url remaping</li>
    <li>Built-in Classes for Currency formatting, dates, menus...</li>
    <li>Multi Environment support (Development, PreProd/Staging, Production)</li>
    <li>Native support for CDN statics</li>
    <li>Compatible with Linux, Mac, Unix, and windows Servers</li>
</ul>
<br />
</div>
<br />
<?php require 'index_footer.php'; ?>
</body>
</html>