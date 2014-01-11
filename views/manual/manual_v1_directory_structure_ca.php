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
        <h1 id="site-name">Manual - Estructura dels directoris</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Aquesta és la estructura dels directoris del projecte:</p>
<ul>
<li>cache
    <pre>El directori on els arxius de catxé són generals.
    Pot ser customitzat per a apuntar a qualsevol altra ruta als arxius de configuració a config/
    Ha de tenir màscar 777 i a dins permissos d'escriptori per a l'usuari del Webserver o 0666</pre>
</li>
<li>catfwcore
    <pre>Core classes of the Catalonia Framework</pre>
</li>
<li>classes
    <pre>For external classes/libraries not using MVC or yours.</pre>
</li>
<li>config
    <pre>Config files for you to setup</pre>
</li>
<li>controllers
    <pre>Folder for your controllers</pre>
</li>
<li>doc
    <pre>Information and documentation on the project.</pre>
</li>
<li>init
    <pre>This is the initialization directory.
Custom changes in your development go to commonrequests.class.php</pre>
</li>
<li>lib
    <pre>Directory for third party libraries.</pre>
</li>
<li>models
    <pre>Put your models here</pre>
</li>
<li>sql
    <pre>Put your sql creation tables here</pre>
</li>
<li>translations
    <pre>If you want to use localization put your localization files here in format section_{lang}.php</pre>
</li>
<li>views
    <pre>Put yout views here</pre>
</li>
<li>www
    <pre>Here is index.php and the root for your files visible from the Internet
    <strong>js</strong>
        For your Javascript code
    <strong>img</strong>
        For your images</pre>
</li>
</ul>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Tornar a la plana principal del Manual</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>