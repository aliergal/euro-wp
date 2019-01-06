<?php
    $customer_id = $_GET['customer'];
    $customer = $this->customers_obj->get_customer($customer_id);

?>

<div class="wrap">

	<?php screen_icon(); ?>

	<h2><?php esc_html_e( 'Edit Customer' ); ?></h2>

	<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nds_add_user_meta_form" >
    <input type="hidden" name="action" value="save_customer">					
		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="customer-id">Customer ID</label>
					</th>
					<td>
						<input type="text" name="customer-id" placeholder="Text" readonly value="<?php _e($customer->CustomerID); ?>" />
					</td>
				</tr>
                <tr>
                    <th>
                        <label for="customer-code">Code</label>
                    </th>
                    <td>
                        <input type="text" name="customer-code" placeholder="Code" value="<?php _e($customer->Code); ?>" />
                    </td>
                </tr>
				<tr>
                    <th>
                        <label for="customer-name">Name</label>
                    </th>
                    <td>
                        <input type="text" name="customer-name" placeholder="Name" value="<?php _e($customer->Name); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-address1">Address1</label>
                    </th>
                    <td>
                        <input type="text" name="customer-address1" placeholder="Address1" value="<?php _e($customer->Address1); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-address2">Address2</label>
                    </th>
                    <td>
                        <input type="text" name="customer-address2" placeholder="Address2" value="<?php _e($customer->Address2); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-city">City</label>
                    </th>
                    <td>
                        <input type="text" name="customer-city" placeholder="City" value="<?php _e($customer->City); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-postcode">PostCode</label>
                    </th>
                    <td>
                        <input type="text" name="customer-postcode" placeholder="PostCode" value="<?php _e($customer->PostCode); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-telephone">Telephone</label>
                    </th>
                    <td>
                        <input type="text" name="customer-telephone" placeholder="Telephone" value="<?php _e($customer->Telephone); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-mobile">Mobile</label>
                    </th>
                    <td>
                        <input type="text" name="customer-mobile" placeholder="Mobile" value="<?php _e($customer->Mobile); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-comments">Comments</label>
                    </th>
                    <td>
                        <textarea name="customer-comments"><?php _e($customer->Comments); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-currency">Currency</label>
                    </th>
                    <td>
                        <input type="text" name="customer-currency" placeholder="Currency" value="<?php _e($customer->Currency); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-paymenttype">Payment Type</label>
                    </th>
                    <td>
                        <input type="text" name="customer-paymenttype" placeholder="Payment Type" value="<?php _e($customer->PaymentType); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-paymentterm">Payment Term</label>
                    </th>
                    <td>
                        <input type="text" name="customer-paymentterm" placeholder="Payment Term" value="<?php _e($customer->PaymentTerm); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-deliverytime1">Delivery Time 1</label>
                    </th>
                    <td>
                        <input type="text" name="customer-deliverytime1" placeholder="Delivery Time 1" value="<?php _e($customer->DeliveryTime1); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-deliverytime2">Delivery Time 2</label>
                    </th>
                    <td>
                        <input type="text" name="customer-deliverytime2" placeholder="Delivery Time 2" value="<?php _e($customer->DeliveryTime2); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-pricecode1">Price Code 1</label>
                    </th>
                    <td>
                        <input type="text" name="customer-pricecode1" placeholder="Price Code 1" value="<?php _e($customer->PriceCode1); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-pricecode2">Price Code 2</label>
                    </th>
                    <td>
                        <input type="text" name="customer-pricecode2" placeholder="Price Code 2" value="<?php _e($customer->PriceCode2); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-pricecode3">Price Code 3</label>
                    </th>
                    <td>
                        <input type="text" name="customer-pricecode3" placeholder="Price Code 3" value="<?php _e($customer->PriceCode3); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-creditlimit">Credit Limit</label>
                    </th>
                    <td>
                        <input type="text" name="customer-creditlimit" placeholder="Credit Limit" value="<?php _e($customer->CreditLimit); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-balance">Balance</label>
                    </th>
                    <td>
                        <input type="text" name="customer-balance" placeholder="Balance" value="<?php _e($customer->Balance); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-clearbalance">Clear Balance</label>
                    </th>
                    <td>
                        <input type="text" name="customer-clearbalance" placeholder="Clear Balance" value="<?php _e($customer->ClearBalance); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-inroute">In Route</label>
                    </th>
                    <td>
                        <input type="text" name="customer-inroute" placeholder="In Route" value="<?php _e($customer->InRoute); ?>" />
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="customer-isactive">Is Active</label>
                    </th>
                    <td>
                        <input type="text" name="customer-isactive" placeholder="Is Active" value="<?php _e($customer->is_active); ?>" />
                    </td>
                </tr>
			</tbody>
		</table>
        		<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Customer"></p>

	</form>
<br/><br/>
	<div id="nds_form_feedback"></div>
	<br/><br/>
</div><!-- .wrap -->