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
<p>Documentation for the Framework</p>
<a href="<?php echo Section::getSectionURL('download', true); ?>">Download the Framework</a><br />
<a href="<?php echo Section::getSectionURL('install', true); ?>">Installation</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/getting_started">Getting started</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/directory_structure">Directory structure</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/bootstrap">Bootstrap and loading order</a><br />
Url mechanics<br />
<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>