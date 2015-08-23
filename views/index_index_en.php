<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-11 00:15
 * Last Updater: Carles Mateo
 * Last Updated: 2015-08-23 14:50
 * Filename:
 * Description:  View for index Controller index Action, language English
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
Last version of Catalonia Framework is v.1.1.015 from 2014-01-29.<br />
<br />
Features at a glance:<br />
<ul>
    <li>Compatible with PHP 7, 5.6, 5.5, 5.4, 5.3 and Facebook HHVM</li>
    <li>MVC</li>
    <li>Built in cache, at Controller level, possible override by Action</li>
    <li>Dynamic system that allows infinite live sections under cached contents, customized on-the-fly</li>
    <li>Multi-Language (pages in several languages easily)</li>
    <li>Native SEO multi-language</li>
    <li>Very Fast</li>
    <li>Very Flexible</li>
    <li>Ready to serve content (like images, video, Json/Ajax, Xml...)</li>
    <li>Very Easy to learn</li>
    <li>Database abstraction with supports for several database Engines (MySql, PostgreSQL, Cassandra)</li>
    <li>Saves Db Connection until used</li>
    <li>Supports Primary Db Server (Inserts), Secondaries (for Reads)</li>
    <li>Brings DBSharding feature for working transparently to a Shard of many Database Servers (several DB Engines)</li>
    <li>Brings CQLSÍ - Cassandra Query Language Simple Interface (without Thrift)</li>
    <li>Really Flexible Form manager with fields validation and error marking</li>
    <li>Built-in Seo Sections feature / url remaping</li>
    <li>Built-in Classes for Currency formatting, dates, menus...</li>
    <li>Multi Environment support (Development, PreProd/Staging, Production)</li>
    <li>Native support for CDN statics</li>
    <li>Compatible with Linux, Mac, Unix, and windows Servers</li>
    <li>Custom Exceptions and Custom Error Views</li>
    <li>Integrated Template System for reusable multi-language Views 100% PHP (but you can use others like Smarty)</li>
    <li>Many classes are glueless: can be used without the rest of the Framework</li>
</ul>
<br />
</div>
<br />
<?php require 'index_footer.php'; ?>
</body>
</html>