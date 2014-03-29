<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-11 00:15
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-01 20:25
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
    <div class="std_form" style="width: 310px; margin: 0 auto;">
        <div class="section_title"><h1><?php echo t('Section Title');?></h1></div>
        <div class="section_description"></div>

        <?php
        // $st_view_vars is defined in getView and passed down
        $o_form = $st_view_vars['o_login_form'];
        $s_embed_javascript = $st_view_vars['s_embed_javascript'];
        $s_error_msg = $st_view_vars['s_error_msg'];
        if (isset($st_view_vars['s_ok_msg'])) {
            $s_ok_msg = $st_view_vars['s_ok_msg'];
        } else {
            $s_ok_msg = '';
        }

        if (isset($s_error_msg) && $s_error_msg != '') {
            echo '<div id="error_msg">'.$s_error_msg.'</div>';
            $s_embed_javascript = $o_form->getJavascriptToHighlightFormValidationErrors();
        }
        if (isset($s_ok_msg) && $s_ok_msg != '') {
            echo '<div id="ok_msg">'.$s_ok_msg.'</div>';
        }
        ?>

        <form action="" method="POST" id="<?=$o_form->getFormHtmlId();?>">
            <?php
            $st_register_form = $o_form->getParametersAsHtmlControls();

            foreach($st_register_form as $h_field){
                echo '<div class="std_form_field">';
                echo '<label for="' . $h_field['id'] . '">' . $h_field['label'] . '</label>';
                echo $h_field['html_code'];
                echo '</div>';
            }

            if (isset($s_embed_javascript) && $s_embed_javascript != '') {
                echo $s_embed_javascript;
            }
            ?>

            <input type="submit" class="std_form_submit" name="submit_login" id="submit_login" value="<?=t('Login Submit');?>" />
        </form>
    </div>
</div>
<br />
<?php require 'index_footer.php'; ?>
</body>
</html>