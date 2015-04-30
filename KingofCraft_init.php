<?php
/**
*@package KingofCraft
*@version 0.1
*/
/*
Plugin Name: King of Craft
Description: This plugin has support for a craft beer website.
Author: Shamlian
Version: 0.1
Author URI: nope
*/
global $KingofCraft_db_version;
$KingofCraft_db_version = "1.0";
global $debug;
$debug = 0;

create_beerTable();

function create_beerTable() {
  global $wpdb;
  global $KingofCraft_db_version;
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
  
  $table_name = $wpdb->prefix . "KC_beer";    
  $sql = "
	CREATE TABLE IF NOT EXISTS $table_name (
		beerID 	    int not null auto_increment,
		beername 	  varchar(40) not null,
		beertype 		varchar(20) not null,
		beerABV 		decimal(3,2),
		brewery 		varchar(40) not null,
		brewery_location	varchar(80),
		beer_description  varchar(250),
		PRIMARY KEY (beerID)
	) engine = InnoDB;";
	$wpdb->query($sql);
	add_option("KingofCraft_db_version", $KingofCraft_db_version);
}

register_activation_hook(__FILE__, 'create_beerTable');

function KingofCraft_deactivate() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . "KC_beers";
	$sql = "DROP TABLE IF EXISTS $table_name;";
	$wpdb->query($sql);
}

/*Support for beer enthusiats */
include 'KingofCraft_addbeer.php';

/**
* Shortcode functions
**/
include 'KingofCraft_user_support.php';
add_action('register_form', 'KingofCraft_register_form');

add_filter('login_redirect', 'my_login_redirect', 10, 3);

function my_login_redirect($redirect_to, $request, $user) {
  global $user;
  if (isset($user->roles) && is_array($user->roles)) {
    if (in_array('administrator', $user->roles)) {
      return $redirect_to;
    }
  }
  return home_url();
}
