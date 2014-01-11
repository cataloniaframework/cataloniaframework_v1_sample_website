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
<h2>Documentation for the Framework</h2>
The Framework provides a lot of documentation in form of remarks in the code.<br />
<br />
<a href="<?php echo $s_manual_prefix; ?>v1/<?php echo t('seo_section_requirements'); ?>">Requirements</a><br />
<a href="<?php echo Section::getSectionURL('download', true); ?>">Download the Framework</a><br />
<a href="<?php echo Section::getSectionURL('install', true); ?>">Installation</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/getting_started">Getting started</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/directory_structure">Directory structure</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/bootstrap">Bootstrap and loading order</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/<?php echo t('seo_section_url_mechanics'); ?>">Url mechanics</a><br />
<a href="<?php echo $s_manual_prefix; ?>v1/<?php echo t('seo_section_cqlsi'); ?>">Cassandra CQLSÍ</a><br />
<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>