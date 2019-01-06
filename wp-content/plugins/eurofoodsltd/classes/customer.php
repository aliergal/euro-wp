<?php
    class Customer extends WP_List_Table {

	/** Class constructor */
	public function __construct() {

		parent::__construct( [
			'singular' => __( 'Customer', 'sp' ), //singular name of the listed records
			'plural'   => __( 'Customers', 'sp' ), //plural name of the listed records
			'ajax'     => false //does this table support ajax?
		] );

	}


	/**
	 * Retrieve customers data from the database
	 *
	 * @param int $per_page
	 * @param int $page_number
	 *
	 * @return mixed
	 */
	public static function get_customers( $per_page = 20, $page_number = 1 ) {

		global $wpdb;

		$sql = "SELECT * FROM Customers";

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
	 * Delete a customer record.
	 *
	 * @param int $id customer ID
	 */
	// public static function delete_customer( $id ) {
	// 	global $wpdb;

	// 	$wpdb->delete(
	// 		"{Customers",
	// 		[ 'CustomerID' => $id ],
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

		$sql = "SELECT COUNT(*) FROM Customers";

		return $wpdb->get_var( $sql );
	}


	/** Text displayed when no customer data is available */
	public function no_items() {
		_e( 'No customers avaliable.', 'sp' );
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
            case 'Telephone':
				return $item[ $column_name ];
            case 'Address1':
                return $item[ $column_name ];
            case 'PostCode':
				return $item[ $column_name ];
			case 'City':
				return $item[ $column_name ];
			case 'is_active':
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
	// 		'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['CustomerID']
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

		$nonce = wp_create_nonce( 'sp_delete_customer' );

		$title = '<strong>' . $item['Name'] . '</strong>';

		$actions = [
            /*'delete' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Delete</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item['CustomerID'] ), $nonce ),*/
            'edit' => sprintf( '<a href="?page=%s&action=%s&customer=%s&_wpnonce=%s">Edit</a>', esc_attr( $_REQUEST['page'] ), 'edit', absint( $item['CustomerID'] ), $nonce ),
		];

		return $title . $this->row_actions( $actions );
	}


	/**
	 *  Associative array of columns
	 *
	 * @return array
	 */
	function get_columns() {
		$columns = [
			/*'cb'      => '<input type="checkbox" />',*/
            'Name'    => __( 'Name', 'sp' ),
            'Telephone' => __( 'Telephone', 'sp' ),
            'Address1' => __( 'Address1', 'sp' ),
            'PostCode' => __( 'PostCode', 'sp' ),
			'City'    => __( 'City', 'sp' ),
			'is_active' => __( 'Status', 'sp')
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
            'Name' => array( 'name', true ),
			'City' => array( 'city', false ),
			'is_active' => array( 'is_active', false )
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

		$per_page     = $this->get_items_per_page( 'customers_per_page', 20 );
		$current_page = $this->get_pagenum();
		$total_items  = self::record_count();

		$this->set_pagination_args( [
			'total_items' => $total_items, //WE have to calculate the total number of items
			'per_page'    => $per_page //WE have to determine how many items to show on a page
		] );

		$this->items = self::get_customers( $per_page, $current_page );
	}

	// public function process_bulk_action() {

	// 	//Detect when a bulk action is being triggered...
	// 	if ( 'delete' === $this->current_action() ) {

	// 		// In our file that handles the request, verify the nonce.
	// 		$nonce = esc_attr( $_REQUEST['_wpnonce'] );

	// 		if ( ! wp_verify_nonce( $nonce, 'sp_delete_customer' ) ) {
	// 			die( 'Go get a life script kiddies' );
	// 		}
	// 		else {
	// 			self::delete_customer( absint( $_GET['customer'] ) );

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
	// 			self::delete_customer( $id );

	// 		}

	// 		// esc_url_raw() is used to prevent converting ampersand in url to "#038;"
	// 	        // add_query_arg() return the current url
	// 	        wp_redirect( esc_url_raw(add_query_arg()) );
	// 		exit;
	// 	}
	// }

	public function get_customer($id){
		global $wpdb;
		return $wpdb->get_row( "SELECT * FROM Customers WHERE CustomerID = $id" );
	}

	public static function save_customer($data){
		global $wpdb;
		$wpdb->update( 
			'Customers', 
			array( 
				'Code' => $data["customer-code"],
				'Name' => $data["customer-name"],
				'Address1' => $data["customer-address1"],
				'Address2' => $data["customer-address2"],
				'City' => $data["customer-city"],
				'PostCode' => $data["customer-postcode"],
				'Telephone' => $data["customer-telephone"],
				'Mobile' => $data["customer-mobile"],
				'Comments' => $data["customer-comments"],
				'Currency' => $data["customer-currency"],
				'PaymentType' => $data["customer-paymenttype"],
				'PaymentTerm' => $data["customer-paymentterm"],
				'DeliveryTime1' => $data["customer-deliverytime1"],
				'DeliveryTime2' => $data["customer-deliverytime2"],
				'PriceCode1' => $data["customer-pricecode1"],
				'PriceCode2' => $data["customer-pricecode2"],
				'PriceCode3' => $data["customer-pricecode3"],
				'CreditLimit' => $data["customer-creditlimit"],
				'Balance' => $data["customer-balance"],
				'ClearBalance' => $data["customer-clearbalance"],
				'InRoute' => $data["customer-inroute"],
				'is_active' => $data["customer-isactive"],
			), 
			array( 'CustomerID' => $data["customer-id"] ), 
			array( 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			), 
			array( '%d' ) 
		);
		
	}

	public static function register_customer($data){
		global $wpdb;

		$wpdb->insert( 
			'Customers', 
			array( 
				'Name' => $data["customer-name"],
				'Address1' => $data["customer-address1"],
				'Address2' => $data["customer-address2"],
				'City' => $data["customer-city"],
				'PostCode' => $data["customer-postcode"],
				'Telephone' => $data["customer-telephone"],
				'Mobile' => $data["customer-mobile"],
				'Comments' => $data["customer-comments"],
				'is_active' => 0,
				'created_at' => date("Y-m-d H:i:s")
			), 
			array( 
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s',
				'%s'
			) 
		);
		
		print_r($data);

		// save customer data to database set it as pending
	}

	public static function login($data){
		// check if customer exists then save details to cookies
	}

	
}
