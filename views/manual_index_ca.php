<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-15 17:35
 * Last Updater:
 * Last Updated:
 * Filename:     manual_index_ca.php
 * Description:
 */

namespace CataloniaFramework;

$s_manual_prefix = Section::getSectionURL('manual', true);

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
        <h1 id="site-name">Manuals</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Documentació sobre el Framework</p>
<a href="<?php echo Section::getSectionURL('download', true); ?>">Descarregueu el Framework</a><br />
<a href="<?php echo Section::getSectionURL('install', true); ?>">Instal·lació</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/getting_started">Primeres passes</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/directory_structure">Estructura de directoris</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/bootstrap">Bootstrap i ordre de càrrega</a><br />
Mecànica de les url<br />
<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>