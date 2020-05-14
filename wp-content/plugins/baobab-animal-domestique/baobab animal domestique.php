<?php

/**
 * Plugin Name: baobab animal domestique
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       permet d’interroger et de gérer une base de données d’animaux domestiques
 * Version:           1.0.0
 * Requires PHP:      7.2
 * Author:            Elham RAEISI
 * Author URI:        https://baobab-ingenierie.fr/
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       baobab
 * Domain Path:       /languages
 * License:     GPL2
 */
/*
{Plugin Name} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Plugin Name} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Plugin Name}. If not, see {License URI}.
 */
/**
 * Register the "animal_dom" custom post type
 */
function baobab_setup_post_type()
{
  register_post_type(
    'animal_domestique',
    array(
      'label' => 'Animaux Domestiques',
      'labels' => array(
        'name' => 'Animaux Domestiques',
        'singular_name' => 'Animal Domestique',
        'all_items' => 'Tous les Animaux Domestiques',
        'add_new_item' => 'Ajouter un Animal Domestique',
        'edit_item' => 'Éditer l\'Animal Domestique',
        'new_item' => 'Nouvel Animal Domestique',
        'view_item' => 'Voir l\'Animal Domestique',
        'search_items' => 'Rechercher parmi les Animaux Domestiques',
        'not_found' => 'Pas d\'animal domestique trouvé',
        'not_found_in_trash' => 'Pas d\'animal domestique dans la corbeille'
      ),
      'public' => true,
      'capability_type' => 'post',
      'supports' => array(
        //'title',
        'editor',
        'thumbnail',
        // 'custom-fileds'
      ),
      'has_archive' => true
    )
  );
  register_taxonomy(
    'generique',
    'animal_domestique',
    array(
      'label' => 'Générique',
      'labels' => array(
        'name' => 'Génériques',
        'singular_name' => 'Générique',
        'all_items' => 'Toutes les Génériques',
        'edit_item' => 'Éditer la Générique',
        'view_item' => 'Voir la Générique',
        'update_item' => 'Mettre à jour la Générique',
        'add_new_item' => 'Ajouter une Générique',
        'new_item_name' => 'Nouvelle Générique',
        'search_items' => 'Rechercher parmi les Génériques',
        'popular_items' => 'Générique les plus utilisées'
      ),
      'hierarchical' => false
    )
  );
}
add_action('init', 'baobab_setup_post_type');
/**
 * Activate the plugin.
 */
function baobab_activate()
{
  // Trigger our function that registers the custom post type plugin.
  baobab_setup_post_type();
  // Clear the permalinks after the post type has been registered.
  flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'baobab_activate');

/**
 * Deactivation hook.
 */
function baobab_deactivate()
{
  // Unregister the post type, so the rules are no longer in memory.
  unregister_post_type('animal_domestique');
  // Clear the permalinks to remove our post type's rules from the database.
  flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'baobab_deactivate');

register_taxonomy_for_object_type('generique', 'animal_domestique');
add_filter('manage_animal_domestique_posts_columns', 'baobab_filter_posts_columns');

function baobab_filter_posts_columns($columns)
{
  $columns = array(
    'cb' => $columns['cb'],
    'image' => 'Image',
    'nom' => 'Nom',
    'générique' => 'Générique',
    'author' => 'Propriétaire'
  );
  return $columns;
}

add_action('manage_animal_domestique_posts_custom_column', 'baobab_animal_column', 10, 2);
function baobab_animal_column($column, $post_id)
{
  // Image column
  if ('image' === $column) {
    // echo "test";
    echo get_the_post_thumbnail($post_id, array(80, 80));
  }
  if ('nom' === $column) {
    echo get_the_title($post_id);
    // echo get_post_custom($post_id);
    //echo get_post_custom_values('nom', $post_id)[0];
    echo get_post_meta($post_id, "nom", true);
  }
  if ('générique' === $column) {
    the_terms($post_id, 'generique', '');
  }
}
