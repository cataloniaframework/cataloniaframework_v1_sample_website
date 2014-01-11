<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-26 14:38
 * Last Updater:
 * Last Updated:
 * Filename:     manual_v2_url_mechanics_en.php
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
        <h1 id="site-name">Manual - URL mechanics</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>The framework is thought to be very flexible and to allow very fast development, so you have several ways to map URLs.</p>
<h2>A file in the filesystem</h2>
<p>As discussed on <a href="<?php echo $s_manual_prefix.'v1/getting_started'; ?>">getting started</a> section the .htaccess allows you to add files to www/ folder and so they will be served normally, so the first way to add content is simply uploading to the filesystem. For example sitemap.xml can simply be put there on web root</p>
<h2>Url mapper</h2>
<p>If you don't need multilanguage support for an url, for example, you want to serve /humans.txt the same content for all the languages you can map this url to be addressed by the framework and be fetched from elsewehere in the filesystem.</p>
<p>Edit init/commonrequests.class.php and add those lines to registerURLS method:</p>
<pre>
Navigation::addURL('humans.txt', '/mnt/elsewhereondisk/humans.txt', Navigation::ACTION_REQUIRE_FILE,
                   ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);
</pre>
<p>ControllerBase::CACHE_NO_CACHE specifies that headers will be sent so the browser does not cache the result.</p>
<p>You can server binary files, json, etc... just use ControllerBase::RESPONSE_JSON, ControllerBase::RESPONSE_TEXT or ControllerBase::RESPONSE_TEXTHTML</p>
<p>You can specify the file to be fetched from another place with Navigation::ACTION_REQUIRE_FILE, but you can specify a function to be executed, for example:</p>
<pre>
Navigation::addURL('humans.txt', 'send_humans_file', Navigation::ACTION_CALL_FUNCTION,
                   ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);
</pre>
<p>So in that last case "send_humans_file()" will be invoked when humans.txt file is requested.</p>
<p>If curl is active Navigation::ACTION_REQUIRE_URL can be specified so the Framework will get the url specified in the second parameter.</p>

<h2>MVC /controller/action and params structure</h2>
<p>As said the Catalonia Framework aims to help to develop very fast, so a default system to load controllers easily is provided.</p>
<p>If you have a controller called Forums and an Action called actionListForums (the preceding <strong>action</strong> word in actionListForums is required) you can call invoke it with:</p>
<pre>http://www.cataloniaframework.com/ca/forums/listforums</pre>
<p>That simple.</p>
<p>If you call http://www.cataloniaframework.com/ca/forums then Forums::indexAction will be tried to load. It is expected that you provide an indexAction method for all your controllers</p>
<p>If you call:</p>
    <pre>http://www.cataloniaframework.com/ca/forums/listforums/order/asc/newer_than/2013</pre>
    <p>Or if you operate in non multi-language Catalonia Framework mode:</p>
    <pre>http://www.cataloniaframework.com/forums/listforums/order/asc/newer_than/2013</pre>
    <p>Then Forums::listForums will be called and provided with $st_params that is an array like:</p>
    <pre>
Array( 0 => 'order',
       1 => 'asc',
       2 => 'newer_than',
       3 => '2013')</pre>
    <p>To make even easier dealing with parameters another array will be provided to the controller, that is $st_params_url that is an array in pairs like:</p>
    <pre>
Array( 'order' => 'asc',
        'newer_than' => '2013);
    </pre>
    <p>Please note that all the Controller Names are sanitized with the regular expression in Strings::getSanitizedControllerName($s_name):</p>
    <pre>$s_sanitized= preg_replace('/([^a-z0-9])/', '', $s_name);</pre>
    <p>Array injections in the params are also removed, so only strings will be passed to the controller</p>
<p>So an usual Controller's Action is like:</p>
    <pre>public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {</pre>
    <p>If the controller does not exists an Exception will be thrown and captured in index.php and an error page will be shown.<br />
       A default view <strong>views/errors/errorgeneric.php</strong> is provided, and all the errors can be customized.</p>
    <img src="/img/manual/cataloniaframework-default-error-10-controller-or-action-not-found.png" border="1" /><br />
<h2>Section definer</h2>
<p>The framework provides an additional way to deal with Urls. Normally all the webs have sections, and they need to be called from other places in the web. And is easy to break those links with a rename of the page (may be for SEO reasons).</p>
    <p>To solve that problem the Frameworks offers the Section mechanism. Through the Section class you can register a section, and you can request the url for that section later, and you will get it independently of the language of the user.</p>
<p>This is done in <strong>commonrequests.class.php</strong> in the method:</p>
    <pre>public static function registerSections($o_db = null) {</pre>
    <p>So there, to define a section manual, that has the same URL for all the languages in your site you will go:</p>
    <pre>Section::registerSection('manual', $s_prefix.'manual', 'Manual', 'Index');</pre>
    <p>So you will define a Section identified by 'manual', that will reply to /[LANG]/manual or /manual depending on if multi-languge is enabled and will call the Class Manual and Method Index (actionIndex)</p>
    <p>If you want to use different SEO URLS for the different languages for the section download you will go like:</p>
    <pre>Section::registerSection('download', $s_prefix.t('seo_url_download'), 'Download', 'Index');</pre>
    <p>In the folder translations/ you have the localization files and a key 'seo_url_download' in each of them with the value for that language.</p>
    <p>Sections can also be attached to Menu objects to create menus, like in the DemoApp.</p>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>