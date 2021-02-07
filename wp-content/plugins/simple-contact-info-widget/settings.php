<?php

if ( !defined('ABSPATH') )
  die('-1');

add_action( 'admin_menu', 'ci_add_admin_menu' );
add_action( 'admin_init', 'ci_settings_init' );




function ci_add_admin_menu(  ) { 

	add_options_page( 'Contact Info Widget', 'Contact Info Widget', 'manage_options', 'contact-info-widget', 'ci_options_page' );

}




function ci_settings_init(  ) { 

	register_setting( 'pluginPage', 'ci_settings' );
}



function ci_options_page(  ) { 

	?>


	
<div width="95%" border="0" style="background-color:#ffffff; border:1px solid #ccc; margin-top:10px; padding:10px; border-top-color: #0085ba;border-top-width: medium;">
		<h2>Simple Contact Info Widget</h2>
<div style="border:1px dashed #ccc; padding:10px;">
		<h3>How to use?</h3>
			<p>To use the plugin go to <strong>Appearance</strong> &#10140; <strong>Widgets</strong>. Drag the <strong>Contact Info Widget</strong> into the widget area.</p>
            <p>Icon effects examples: <a href="https://ianlunn.github.io/Hover/" target="_blank">Click here</a></p>
</div>
<br>

<div style="border:1px dashed #ccc; padding:10px; width:65%; float:left;">
        <h3>Like this plugin?</h3>
        <?php echo '<img style="float:right; width:130px; top:60%;" src="' . plugins_url( 'simple-contact-info-widget/images/icon.png', dirname(__FILE__) ) . '" > '; ?>
            <p>Do you like this plugin? Give this plugin a <strong>rating</strong> on the wordpress page!<br> By <strong>rating</strong> this plugin you let others know how you feel about this plugin. With a good <br> rating you make the developers feel special. :)</p> 
            <?php echo '<img style="" src="' . plugins_url( 'simple-contact-info-widget/images/stars.png', dirname(__FILE__) ) . '" > '; ?><br>
            <a class='button-primary' href='https://wordpress.org/support/plugin/simple-contact-info-widget/reviews/' title='Rate this plugin' target="_blank">Rate this plugin!</a><br><br>
             <br>
            <em>Version 2.6.2</em>
   </div>


<div style="border:1px dashed #ccc; padding:14px; width:30%; height:30%; float:right;">

    <h3>Support</h3>
            <p>Check out the <strong>free support</strong> forum on <strong>WordPress.org</strong> to see if your issue has not already been solved or to post your question so that others may benefit from your resolution.</p>
    <br><br><a class='button-secondary' href='https://wordpress.org/support/plugin/simple-contact-info-widget' target="_blank" title='Get support'>Get Support</a>
            <br><br><br>
<em style="float:right; ">Made by <a style="text-decoration:none;" href="http://www.riotweb.nl/plugins">RiotWeb</a></em>
       </div>
	<?php

}



?>
