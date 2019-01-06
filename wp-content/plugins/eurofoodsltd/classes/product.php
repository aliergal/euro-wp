<?php
    class Product extends WP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Product', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Products', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );

	}


	/**
	 * Retrieve products data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_products( $per_page = 20, $page_number = 1 ) {

		global $wpdb;

		$sql = "SELECT * FROM Products";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		}

		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;


		$result = $wpdb->get_results( $sql, 'ARRAY_A' );

		return $result;
	}


	/**
	 * Delete a product record.
	 *
	 * @param int $id product ID
	 */
	// public static function delete_product( $id ) {
	// 	global $wpdb;

	// 	$wpdb->delete(
	// 		"{Products",
	// 		[ 'ProductID' => $id ],
	// 		[ '%d' ]
	// 	);
	// }


	/**
	 * Returns the count of records in the database.
	 *
	 * @return null|string
	 */
	public static function record_count() {
		global $wpdb;

		$sql = "SELECT COUNT(*) FROM Products";

		return $wpdb->get_var( $sql );
	}


	/** Text displayed when no product data is available */
	public function no_items() {
		_e( 'No product avaliable.', 'sp' );
	}


	/**
	 * Render a column when no column specific method exist.
	 *
	 * @param array $item
	 * @param string $column_name
	 *
	 * @return mixed
	 */
	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
            case 'Description1':
				return $item[ $column_name ];
            case 'Barcode1':
                return $item[ $column_name ];
            case 'Stock':
				return $item[ $column_name ];
			case 'Status':
				return $item[ $column_name ];
			default:
				return print_r( $item, true ); //Show the whole array for troubleshooting purposes
		}
	}

	/**
	 * Render the bulk edit checkbox
	 *
	 * @param array $item
	 *
	 * @return string
	 */
	// function column_cb( $item ) {
	// 	return sprintf(
	// 		'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ProductID']
	// 	);
	// }


	/**
	 * Method for name column
	 *
	 * @param array $item an array of DB data
	 *
	 * @return string
	 */
	function column_name( $item ) {

		$nonce = wp_create_nonce( 'sp_delete_product' );

		$title = '<strong>' . $item['description'] . '</strong>';

		$actions2 = [
            /*'delete' => sprintf( '<a href="?page=%s&action=%s&product=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['ProductID'] ), $nonce ),*/
            'edit' => sprintf( '<a href="?page=%s&action=%s&product=%s&_wpnonce=%s">Edit</a>', esc_attr( $_REQUEST['page'] ), 'edit', absint( $item['ProductID'] ), $nonce ),
		];

		return $title . $this->row_actions( $actions2 );
	}


	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			/*'cb'      => '<input type="checkbox" />',*/
            'Description1'    => __( 'Description', 'sp' ),
            'Barcode1' => __( 'Barcode', 'sp' ),
            'Stock' => __( 'Stock', 'sp' ),
            'Status' => __( 'Status', 'sp' )
		];

		return $columns;
	}


	/**
	 * Columns to make sortable.
	 *
	 * @return array
	 */
	public function get_sortable_columns() {
		$sortable_columns = array(
            'Description1' => array( 'description', true ),
            'Barcode1' => array( 'barcode', false ),
            'Stock' => array( 'stock', false ),
			'Status' => array( 'status', false )
		);

		return $sortable_columns;
	}

	/**
	 * Returns an associative array containing the bulk action
	 *
	 * @return array
	 */
	// public function get_bulk_actions() {
	// 	$actions = [
	// 		'bulk-delete' => 'Delete'
	// 	];

	// 	return $actions;
	// }


	/**
	 * Handles data query and filter, sorting, and pagination.
	 */
	public function prepare_items() {

		$this->_column_headers = $this->get_column_info();

		/** Process bulk action */
		$this->process_bulk_action();

		$per_page     = $this->get_items_per_page( 'products_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_products( $per_page, $current_page );
	}

	// public function process_bulk_action() {

	// 	//Detect when a bulk action is being triggered...
	// 	if ( 'delete' === $this->current_action() ) {

	// 		// In our file that handles the request, verify the nonce.
	// 		$nonce = esc_attr( $_REQUEST['_wpnonce'] );

	// 		if ( ! wp_verify_nonce( $nonce, 'sp_delete_product' ) ) {
	// 			die( 'Go get a life script kiddies' );
	// 		}
	// 		else {
	// 			self::delete_product( absint( $_GET['product'] ) );

	// 	                // esc_url_raw() is used to prevent converting ampersand in url to "#038;"
	// 	                // add_query_arg() return the current url
	// 	                wp_redirect( esc_url_raw(add_query_arg()) );
	// 			exit;
	// 		}

	// 	}

	// 	// If the delete bulk action is triggered
	// 	if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' )
	// 	     || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' )
	// 	) {

	// 		$delete_ids = esc_sql( $_POST['bulk-delete'] );

	// 		// loop over the array of record IDs and delete them
	// 		foreach ( $delete_ids as $id ) {
	// 			self::delete_product( $id );

	// 		}

	// 		// esc_url_raw() is used to prevent converting ampersand in url to "#038;"
	// 	        // add_query_arg() return the current url
	// 	        wp_redirect( esc_url_raw(add_query_arg()) );
	// 		exit;
	// 	}
	// }

	public function get_product($id){
		global $wpdb;
		return $wpdb->get_row( "SELECT * FROM Products WHERE ProductID = $id" );
	}

	public static function save_product($data){
		// global $wpdb;
		// $wpdb->update( 
		// 	'Products', 
		// 	array( 
		// 		'Code' => $data["customer-code"],
		// 		'Name' => $data["customer-name"],
		// 		'Address1' => $data["customer-address1"],
		// 		'Address2' => $data["customer-address2"],
		// 		'City' => $data["customer-city"],
		// 		'PostCode' => $data["customer-postcode"],
		// 		'Telephone' => $data["customer-telephone"],
		// 		'Mobile' => $data["customer-mobile"],
		// 		'Comments' => $data["customer-comments"],
		// 		'Currency' => $data["customer-currency"],
		// 		'PaymentType' => $data["customer-paymenttype"],
		// 		'PaymentTerm' => $data["customer-paymentterm"],
		// 		'DeliveryTime1' => $data["customer-deliverytime1"],
		// 		'DeliveryTime2' => $data["customer-deliverytime2"],
		// 		'PriceCode1' => $data["customer-pricecode1"],
		// 		'PriceCode2' => $data["customer-pricecode2"],
		// 		'PriceCode3' => $data["customer-pricecode3"],
		// 		'CreditLimit' => $data["customer-creditlimit"],
		// 		'Balance' => $data["customer-balance"],
		// 		'ClearBalance' => $data["customer-clearbalance"],
		// 		'InRoute' => $data["customer-inroute"],
		// 		'is_active' => $data["customer-isactive"],
		// 	), 
		// 	array( 'ProductID' => $data["customer-id"] ), 
		// 	array( 
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s',
		// 		'%s'
		// 	), 
		// 	array( '%d' ) 
		// );
		
	}

}
