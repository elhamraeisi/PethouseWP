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
{ }
register_deactivation_hook(__FILE__, 'pethouse_form_contact_deactivate');


// Formulaire de contacte en HTML
function html_form_code()
{
  echo '<form action="" method="post">';
  echo '<h1 style="text-align: center; color:#0e3569; font-family:Brandon Grotesque Black , sans-serif;">';
  echo 'Contacter le propriétaire';
  echo '</h1>';
  echo '<p style="color:#297eab; font-family:Brandon Grotesque Black , sans-serif;">';
  echo 'Votre nom* <br/>';
  echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+"  size="40" required/>';
  echo '</p>';
  echo '<p style="color:#297eab; font-family:Brandon Grotesque Black , sans-serif;">';
  echo 'Votre Email* <br/>';
  echo '<input type="email" name="cf-email" size="40" required/>';
  echo '</p>';
  echo '<p style="color:#297eab; font-family:Brandon Grotesque Black , sans-serif;">';
  echo 'Votre message* <br/>';
  echo '<textarea rows="10" cols="35" name="cf-message" required></textarea>';
  echo '</p>';
  echo '<p><input type="submit" name="cf-submitted" value="Envoyer" style="background:#0e3569; font-family:Brandon Grotesque Black , sans-serif;"></p>';
  echo '</form>';
}
//pour recuperé la seasi de l'utilisateur et securisé les seasi
function pethouse_create_contact()
{
  $contact = array();
  $contact['nom']    = sanitize_text_field($_POST["cf-name"]);
  $contact['email']   = sanitize_email($_POST["cf-email"]);
  $contact['message'] = esc_textarea($_POST["cf-message"]);
  return $contact;
}
//envoyer le mail
function deliver_mail()
{

  // si le button envoyer est cliqué on envoie le mail
  if (isset($_POST['cf-submitted'])) {

    //crée un objet qui contients les informations du formulaire
    $contact = pethouse_create_contact();
    //ce message sera envoyé pour proprietaire
    $bodyProprietaire = 'Bonjour,' . "\n";
    $bodyProprietaire .= 'Vous avez recu un message de ' . $contact['nom'] . ' concernant votre annonce :' . "\n\n";
    $bodyProprietaire .= $contact['message'];

    //ce message sera envoyé pour utilisateur
    $bodyConfirmation = 'Bonjour,' . "\n";
    $bodyConfirmation .= 'Voici le message que vous avez envoyé :' . "\n";
    $bodyConfirmation .=  $contact['message'];

    $sujetConfirmation = 'Votre message à été envoyé';
    $sujetProprietaire = 'Vous avez reçu un message concernant votre annonce';

    // recuperer l'adresse mail du proprietaire
    $proprietaireEmail = $_GET['proprEmail'];

    // ici on recuper l'addresse mail de l'admin de WP
    $adminEmail = get_option('admin_email');

    //l'expediteur du mail
    $headers = "From: Pethouse <" . $adminEmail . ">" . "\r\n";

    if (
      wp_mail($proprietaireEmail, $sujetProprietaire, $bodyProprietaire, $headers) &&
      wp_mail($contact['email'], $sujetConfirmation, $bodyConfirmation, $headers)
    ) {
      echo '<div>';
      echo '<p style="color:green; font-family:Brandon Grotesque Black , sans-serif;">Message envoyé avec succès!</p>';
      echo '</div>';
    } else {
      echo '<p style="color:red; font-family:Brandon Grotesque Black , sans-serif;">Une erreur est survenue</p>';
    }
  }
}
//definition de shortcode
function cf_shortcode()
{
  ob_start(); // on demarre l'ecriture
  deliver_mail(); // fonction pour envoyer le mail
  html_form_code(); //fonction pour afficher le formulaire
  return ob_get_clean(); // on ferme l'ecriture
}

add_shortcode('pethouse_contact_form', 'cf_shortcode');
