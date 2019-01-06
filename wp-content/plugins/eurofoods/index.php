<?php
/*
Plugin Name: EuroFoods
Description: Integrate orders and customers to website
Version: 1.0
Author: Ali Ergal
*/
//Disable direct access to the file for security
if ( ! defined( 'ABSPATH' ) ) exit;

define('euro_path', plugin_dir_path(__FILE__));

require_once euro_path . 'adminpages/index.php';