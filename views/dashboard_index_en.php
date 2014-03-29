<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-26 10:36
 * Last Updater:
 * Last Updated:
 * Filename:
 * Description:  View for Dashboard Controller index Action, language English
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
<h1>Dashboard</h1>
You Ip: <?php echo $st_view_vars['s_detected_ip']; ?><br />
Contact messages: <?php echo $st_view_vars['i_number_contact_messages']; ?><br />
Last <?php echo $st_view_vars['i_number_contact_messages_to_display']; ?> messages: <?php
        if (count($st_view_vars['st_messages']) > 0 ) {
            $s_html_values = '';
            foreach($st_view_vars['st_messages'] as $i_key=>$st_value) {
                $s_html_labels = '<tr>';
                foreach($st_value as $s_label=>$s_value) {
                    $s_html_labels .= '<th>'.$s_label.'</th>';
                    $s_html_values .= '<td>'.$s_value.'</td>';
                }
                $s_html_labels .= '</tr>';
                $s_html_values .= '</tr>';
            }
            echo '<table border="1">';
            echo $s_html_labels;
            echo $s_html_values;
            echo '</table>';
        } else {
            echo 'There are no messages';
        }
        ?>
<br />
Visits today: <?php echo $st_view_vars['i_number_visits_today']; ?><br />
Visits yesterday: <?php echo $st_view_vars['i_number_visits_yesterday']; ?><br />
Visits past yesterday: <?php echo $st_view_vars['i_number_visits_past_yesterday']; ?><br />
<br />
<table border="0" cellspacing="1" cellpadding="1">
    <tr><td><img src="/en/dashboard/graphstats" /></td><td><img src="/en/dashboard/graphstats/date/today" /></td></tr>
</table>

    <br />
</div>
<br />
<?php require 'index_footer.php'; ?>
</body>
</html>