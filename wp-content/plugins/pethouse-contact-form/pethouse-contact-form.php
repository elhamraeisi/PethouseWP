<?php
/*
Plugin Name: Pethouse formulaire de contact
Description: Formulaire pour contacter un proprietaire
Version: 1.0
Author: Elham RAEISI
*/

/**
 * Activate the plugin.
 */
function pethouse_form_contact_activate()
{ }
register_activation_hook(__FILE__, 'pethouse_form_contact_activate');

/**
 * Deactivation hook.
 */
function pethouse_form_contact_deactivate()
{
  //
}
register_deactivation_hook(__FILE__, 'pethouse_form_contact_deactivate');

function html_form_code()
{
  echo '<form action="' . esc_url($_SERVER['REQUEST_URI']) . '" method="post">';
  echo '<p>';
  echo 'Votre nom* <br/>';
  echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . (isset($_POST["cf-name"]) ? esc_attr($_POST["cf-name"]) : '') . '" size="40" />';
  echo '</p>';
  echo '<p>';
  echo 'Votre Email* <br/>';
  echo '<input type="email" name="cf-email" value="' . (isset($_POST["cf-email"]) ? esc_attr($_POST["cf-email"]) : '') . '" size="40" />';
  echo '</p>';
  echo 'Votre message* <br/>';
  echo '<textarea rows="10" cols="35" name="cf-message">' . (isset($_POST["cf-message"]) ? esc_attr($_POST["cf-message"]) : '') . '</textarea>';
  echo '</p>';
  echo '<p><input type="submit" name="cf-submitted" value="Envoyer"></p>';
  echo '</form>';
}

function pethouse_create_contact()
{
  // sanitize form values
  $contact = array();
  $contact['nom']    = sanitize_text_field($_POST["cf-name"]);
  $contact['email']   = sanitize_email($_POST["cf-email"]);
  $contact['sujet'] = 'Vous avez reçu un message concernant votre annonce';
  $contact['message'] = esc_textarea($_POST["cf-message"]);
  return $contact;
}

function deliver_mail()
{

  // if the submit button is clicked, send the email
  if (isset($_POST['cf-submitted'])) {
    $contact = pethouse_create_contact();

    $bodyProprietaire = 'Bonjour,' . "\n";
    $bodyProprietaire .= 'Vous avez recu un message de ' . $contact['nom'] . ' concernant votre annonce :' . "\n\n";
    $bodyProprietaire .= $contact['message'];

    $bodyConfirmation = 'Bonjour,' . "\n";
    $bodyConfirmation .= 'Voici le message que vous avez envoyé :' . "\n";
    $bodyConfirmation .=  $contact['message'];

    $sujetConfirmation = 'Votre message à été envoyé';

    // recuperer l'adresse mail du proprietaire
    $proprietaireEmail = $_GET['proprEmail'];
    $adminEmail = get_option('admin_email');

    $headers = "From: Pethouse <" . $adminEmail . ">" . "\r\n";

    // If email has been process for sending, display a success message
    if (
      wp_mail($proprietaireEmail, $contact['sujet'], $bodyProprietaire, $headers) &&
      wp_mail($contact['email'], $sujetConfirmation, $bodyConfirmation, $headers)
    ) {
      echo '<div>';
      echo '<p>Message envoyé avec succès!</p>';
      echo '</div>';
    } else {
      echo 'Une erreur est survenue';
    }
  }
}


function cf_shortcode()
{
  ob_start();
  deliver_mail();
  html_form_code();
  return ob_get_clean();
}

add_shortcode('pethouse_contact_form', 'cf_shortcode');
