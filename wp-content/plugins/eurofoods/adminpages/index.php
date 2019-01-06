<?php

class EuroFoods_Settings{

    public function __construct(){
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        //add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    public function add_plugin_page(){
        add_menu_page(
            'EuroFoods',
            'EuroFoods',
            'manage_options',
            'eurofoods',
            array( $this, 'dashboard_page' ),
            'dashicons-tickets',
            6 
        );

        add_submenu_page(
            'eurofoods',
            'Customers',
            'Customers',
            'manage_options',
            'customers',
            array( $this, 'customers_page' )
        ); 
    }

    public function dashboard_page(){
        include "pages/index.php";
    }

    public function customers_page(){
        include "pages/customers.php";
    }
}

new EuroFoods_Settings;