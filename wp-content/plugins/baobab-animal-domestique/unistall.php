<?php
//uninstall.php
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

$option_name = 'baobab_option';

delete_option($option_name);

// for site options in multisite
delete_site_option($option_name);
