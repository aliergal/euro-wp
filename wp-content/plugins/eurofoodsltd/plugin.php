<?php

/*
Plugin Name: EuroFoods LTD
Description: EuroFoods Integration
Version: 1.0
Author: Ali Ergal
*/
error_reporting(E_ALL); ini_set('display_errors', 1);
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

require_once("classes/customer.php");
require_once("classes/product.php");


class EuroFoods_Plugin {

	// class instance
	static $instance;

	// customer WP_List_Table object
	public $customers_obj;

	// product WP_List_Table object
	public $products_obj;

	// class constructor
	public function __construct() {

		/* Admin Area */
		add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'plugin_menu' ] );

		//Customer Save
		add_action( 'admin_post_save_customer', [$this, 'save_customer'] );
		add_action( 'admin_post_nopriv_save_customer', [$this, 'save_customer'] );

		//Product Save
		add_action( 'admin_post_save_product', [$this, 'save_product'] );
		add_action( 'admin_post_nopriv_save_product', [$this, 'save_product'] );


		/* Front End */
		add_action( 'admin_post_register_customer', [$this, 'register_customer'] );
		add_action( 'admin_post_nopriv_register_customer', [$this, 'register_customer'] );
	}


	public static function set_screen( $status, $option, $value ) {
		return $value;
	}

	public function plugin_menu() {

		//Customers
		$customer_hook = add_menu_page(
			'Customers',
			'Customers',
			'manage_options',
			'customers',
			[ $this, 'customer_settings_page' ]
		);
		add_action( "load-$customer_hook", [ $this, 'customer_screen_option' ] );

		//Products
		$product_hook = add_menu_page(
			'Products',
			'Products',
			'manage_options',
			'products',
			[ $this, 'product_settings_page' ]
		);
		add_action( "load-$product_hook", [ $this, 'product_screen_option' ] );

	}


	/**
	 * Customer page
	 */
	public function customer_settings_page() {
		if(!isset($_GET['action'])) {
			include("customers/list.php");
		} elseif ($_GET['action'] === 'edit') {
			include("customers/edit.php");
		}
	}

	/**
	 * Customer screen options
	 */
	public function customer_screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'Customers',
			'default' => 20,
			'option'  => 'customers_per_page'
		];

		add_screen_option( $option, $args );

		$this->customers_obj = new Customer();
	}

	//Save Customer
	function save_customer() {
		Customer::save_customer($_POST);
	}

	//Register Customer
	function register_customer() {
		Customer::register_customer($_POST);
	}


	/**
	 * Product page
	 */
	public function product_settings_page() {
		if(!isset($_GET['action'])) {
			include("products/list.php");
		} elseif ($_GET['action'] === 'edit') {
			include("products/edit.php");
		}
	}

	/**
	 * Product screen options
	 */
	public function product_screen_option() {

		$option = 'per_page';
		$args   = [
			'label'   => 'Products',
			'default' => 20,
			'option'  => 'products_per_page'
		];

		add_screen_option( $option, $args );

		$this->products_obj = new Product();
	}

	//Save Product
	function save_product() {
		Product::save_product($_POST);
	}


	/** Singleton instance */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

}


add_action( 'plugins_loaded', function () {
	EuroFoods_Plugin::get_instance();
} );





