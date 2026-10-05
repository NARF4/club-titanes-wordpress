<?php
/*
Plugin Name: Servicios Club Titanes
Description: Añade el acceso de usuarios y el formulario de contacto del club.
Version: 1.0
*/
function aula_servicios_activate(){
  foreach(array('Acceso'=>'[aula_login]','Contacto'=>'[aula_contacto]') as $title=>$content){
    $slug=sanitize_title($title); if(!get_page_by_path($slug)) wp_insert_post(array('post_title'=>$title,'post_name'=>$slug,'post_content'=>$content,'post_status'=>'publish','post_type'=>'page'));
  }
}
register_activation_hook(__FILE__,'aula_servicios_activate');
function aula_login_shortcode(){ ob_start(); echo '<div class="card"><h2>Acceso del equipo</h2><p>Accede con tu usuario del Club Titanes.</p>'; wp_login_form(array('redirect'=>home_url('/'))); echo '</div>'; return ob_get_clean(); }
add_shortcode('aula_login','aula_login_shortcode');
function aula_contacto_shortcode(){ $sent=false; if(isset($_POST['aula_contacto_nonce']) && wp_verify_nonce($_POST['aula_contacto_nonce'],'aula_contacto')) $sent=true; ob_start(); echo '<div class="card"><h2>Contacto</h2><p>Si quieres conocer el equipo, puedes escribirnos.</p>'; if($sent) echo '<p><strong>Mensaje recibido.</strong></p>'; echo '<form method="post"><p><label>Nombre<br><input name="nombre" required></label></p><p><label>Correo<br><input type="email" name="correo" required></label></p><p><label>Mensaje<br><textarea name="mensaje" rows="5" required></textarea></label></p>'; wp_nonce_field('aula_contacto','aula_contacto_nonce'); echo '<button class="cta" type="submit">Enviar mensaje</button></form></div>'; return ob_get_clean(); }
add_shortcode('aula_contacto','aula_contacto_shortcode');
