<?php get_header(); ?>
    <body class="page">
        <?php get_template_part( 'template-parts/navbar' ); ?>
        <?php get_template_part( 'template-parts/content-header' ); ?>
        <div class="container">
            <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        the_content();
                    endwhile;
                endif;
            ?>
            
        </div>
        <div class="container">
            <section class="products">
                <?php print render_product_list(); ?>
            </section>
        </div>
        <?php get_template_part( 'template-parts/form-contact' ); ?>
        <div class="modal fade" id="addtocart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="add-to-cart-form">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-5 col-4">
                                    <img class="img img-responsive prodImg" />
                                </div>
                                <div class="col-sm-7 col-8">
                                    <ul class="prodcart">
                                        <li><b>Name: </b><span id="prodName"></span></li>
                                        <li><b>Size: </b><span id="prodSize"></span></li>
                                        <li><b>Unit Rate: </b><span id="prodUnitRate"></span></li>
                                        <li><b>Price: </b><span id="prodPrice"></span></li>
                                    </ul>
                                    
                                    <input type="hidden" class="form-control prodCode" id="prodCode">
                                    <div class="form-group">
                                        <label for="quantity" class="col-form-label">Quantity</label>
                                        <select id="cart-quantity" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                        </select>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add to orders</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php get_footer(); ?>
