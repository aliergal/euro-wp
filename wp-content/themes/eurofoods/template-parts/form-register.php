<section class="contact light-bg">
    <div class="container">
    <h2 class="title text-center">Register for an account</h2>
    <hr class="divider">
    <div class="row justify-content-center">
        <div class="col-sm-8">
        <p>Have a burning question? Looking to become a customer or a supplier? Whatever your query, fill in the contact form below and one of our advisers will be in touch shortly.</p>
        </div>
    </div>
    <div class="row">
    <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="nds_add_user_meta_form" style="width:100%;">
        <input type="hidden" name="action" value="register_customer" />
        
        <div class="row">
            <div class="form-group col-sm-6">
                <label>Email</label>
                <input type="email" class="form-control" name="customer-email" placeholder="Email" />
            </div>
            <div class="form-group col-sm-6">
                <label>Password</label>
                <input type="password" class="form-control" name="customer-password" placeholder="Password" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Business Name</label>
                <input type="text" class="form-control" name="customer-name" placeholder="Business Name" />
            </div>
            <div class="form-group col-sm-6">
                <label>Contact Name</label>
                <input type="text" class="form-control" name="customer-comments" placeholder="Contact Name" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Address Line 1</label>
                <input type="text" class="form-control" name="customer-address1" placeholder="Address Line 1" />
            </div>
            <div class="form-group col-sm-6">
                <label>Address Line 2</label>
                <input type="text" class="form-control" name="customer-address2" placeholder="Address Line 2" />
            </div>
        </div>
        
        <div class="row">
            <div class="form-group col-sm-6">
                <label>City</label>
                <input type="text" class="form-control" name="customer-city" placeholder="City" />
            </div>
            <div class="form-group col-sm-6">
                <label>Post Code</label>
                <input type="text" class="form-control" name="customer-postcode" placeholder="Post Code" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-sm-6">
                <label>Telephone</label>
                <input type="text" class="form-control" name="customer-telephone" placeholder="Telephone" />
            </div>
            <div class="form-group col-sm-6">
                <label>Mobile</label>
                <input type="text" class="form-control" name="customer-mobile" placeholder="Mobile" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
        </div>
    </form>
    </div>
    </div>
</section>