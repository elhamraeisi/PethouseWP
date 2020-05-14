<?php
add_action('wp_enqueue_scripts', 'enqueue_parent_styles');

function enqueue_parent_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

// define the wp_mail_failed callback 
function action_wp_mail_failed($wp_error)
{
  return error_log(print_r($wp_error, true));
}

// add the action 
add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);
