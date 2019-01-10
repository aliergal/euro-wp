<?php

function render_product_list(){

    global $wpdb;

    
    $query = "SELECT * FROM Products";
    $total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
    $total = $wpdb->get_var( $total_query );
    $items_per_page = 16;
    $page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;
    $offset = ( $page * $items_per_page ) - $items_per_page;
    $result = $wpdb->get_results( $query . " ORDER BY ProductID DESC LIMIT ${offset}, ${items_per_page}" );
    $totalPage = ceil($total / $items_per_page);
    
    //print_r($result);
    if($totalPage > 1){
        $productList = '<div class="row text-center">';
        foreach($result as $res){
            $productList .= '<div class="col-sm-3 col-6 thumbs">';
                $productList .= '<div class="thumb">';
                $productList .= '<img src="' . get_site_url() . '/wp-content/product-pics/'.$res->Code.'.jpg" class="img img-thumbnail" />';
                $productList .= '</div>';
                $productList .= '<p class="prod-title">' . $res->Description1 .'</p>';
                $productList .= '<p class="prod-price">£99.99</p>';
                $productList .= '<button class="add-to-cart btn btn-primary">Add to orders</button>';
            $productList .= '</div>';
        }
        $productList .= '</div>';
        $r = $productList . '<br>';

        $pagination = paginate_links(
            array(
                'base' => add_query_arg( 'cpage', '%#%' ),
                'format' => '',
                'type' => 'array',
                'prev_text' => __('&laquo;'),
                'next_text' => __('&raquo;'),
                'total' => $totalPage,
                'current' => $page
            )
        );

        $paginationHtml = '';
        if ( ! empty( $pagination ) ){
            $paginationHtml .= '<ul class="pagination pagination-lg wpse64458_pagination">';
            foreach ( $pagination as $key => $page_link ){
                $active = '';
                if ( strpos( $page_link, 'current' ) !== false ) { 
                    $active = ' active'; 
                }
                $paginationHtml .= '<li class="page-item'.$active.'">' . str_replace( 'page-numbers', 'page-link', $page_link ) . '</li>';
            }
            $paginationHtml .= '</ul>';
        }

        $r .= $paginationHtml;
    }

    return $r;
}



