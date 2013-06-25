<?php 
/*
 * 1. Add your shortcode into shortcodes.php
 * 2. Register your shortcode in register_shortcodes()
 * 3. Regiter your button into TinyMCE register_button()
 * 4. Add your CSS/JS file/s for your shortcode in shortcodes_enqueue_scripts()
 * 5. Add your button into TinyMCE into shortcodes.js
 * 6. Add an icon for your button into TinyMCE
 * 
 * NOTE: all your assets goes into it's respective folder's inside the shortcodes folder
 */

/*-------------------------------------
Accordion
--------------------------------------*/
function accordion($atts,$content = null)
{
    extract(shortcode_atts(array("id" => 'accordion1'), $atts));
    $html = '<div class="accordion" id="acord-'.$id.'">'.do_shortcode($content).'</div>';
    return $html;
}
/*-------------------------------------
Accordion element
--------------------------------------*/
function accordion_element($atts,$content = null)
{
    extract(shortcode_atts(array("heading" => '','href' => '' ,"pid" => 'accordion1'), $atts));
    $html = '<div class="accordion-group"><div class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="#acord-'.$pid.'" href="#a-'.$href.'">'.$heading.'</a></div><div id="a-'.$href.'" class="accordion-body collapse"><div class="accordion-inner">'.do_shortcode($content).'</div></div></div>';
    return $html;
}


/*--------------------------------
 Register the codes
---------------------------------*/
function register_shortcodes()
{
  add_shortcode('accordion', 'accordion');
  add_shortcode('accordion_element', 'accordion_element');       
}
/*Add to wordpress action*/
add_action('init','register_shortcodes');

function register_button( $buttons )
{
  array_push($buttons, "|","accordion");
   
  return $buttons;
}

function add_plugin( $plugin_array )
{
  $plugin_array['shortcodes'] = get_template_directory_uri() . '/shortcodes/shortcodes.js';
  return $plugin_array;
}

function shortcodes_buttons()
{
  if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
  {
    return;
  }

  if (get_user_option('rich_editing') == 'true' )
  {
    add_filter( 'mce_external_plugins', 'add_plugin' );
    add_filter( 'mce_buttons', 'register_button' );
  }
}
add_action('init', 'shortcodes_buttons'); 

function shortcodes_enqueue_scripts() {
	wp_enqueue_script( 'twitter-bootstrap-js', get_template_directory_uri() . '/shortcodes/javascript/bootstrap.min.js', array( 'jquery' ));
  wp_enqueue_style( 'accordion-css', get_template_directory_uri() . '/shortcodes/css/accordion.css', array(), '', 'all' );
}
add_action( 'wp_enqueue_scripts', 'shortcodes_enqueue_scripts' );
?>
