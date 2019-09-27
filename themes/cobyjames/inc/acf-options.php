<?php

if(function_exists('acf_add_options_page')) {
	acf_add_options_page();
}


function my_acf_admin_head() {
    ?>
    <style type="text/css">

		/* css here */
		
		.acf-field[data-name="chords"] textarea {
			font-family: 'Courier New', monospace;
		}
		
		#editor h2.hndle.ui-sortable-handle {
			font-size: 22px;
	}

    </style>
    <?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');
