<?php
function aula_web_assets(){ wp_enqueue_style('aula-web-style', get_stylesheet_uri(), array(), '1.0'); }
add_action('wp_enqueue_scripts','aula_web_assets');
function aula_web_setup(){ add_theme_support('title-tag'); register_nav_menus(array('primary'=>'Navegación principal')); }
add_action('after_setup_theme','aula_web_setup');
