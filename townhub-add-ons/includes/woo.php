<?php 
/* add_ons_php */


/**
 * Woocommerce support
 *
 */

function townhub_addons_is_woocommerce_activated() {
    if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }   

    // return in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ;
}

// for woo
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
// if(townhub_addons_is_woocommerce_activated()){
    // Put your plugin code here

    add_action( 'esb_payment_method_texts', function ($payments){
        $payments['woo']     = __( 'WooCommerce', 'townhub-add-ons' );
        return $payments;
    } );

}

add_action('woocommerce_loaded' , function (){
    //Put your code here that needs any woocommerce class
    //You can also Instantiate your main plugin file here

    /**
     * WC_Product_Data_Store_CPT class file.
     *
     * @package WooCommerce/Classes
     * @path woocommerce/includes/data-stores/class-wc-product-data-store-cpt.php
     */

    class CTH_WC_Product_Data_Store_CPT extends WC_Product_Data_Store_CPT{

        /**
         * Method to read a product from the database.
         *
         * @param WC_Product $product Product object.
         * @throws Exception If invalid product.
         * 
         */
        public function read( &$product ) {
            /** 
            * Default 
            */
            // $product->set_defaults();
            // $post_object = get_post( $product->get_id() );

            // if ( ! $product->get_id() || ! $post_object || 'product' !== $post_object->post_type ) {
            //     throw new Exception( __( 'Invalid product.', 'townhub-add-ons' ) );
            // }

            $product->set_defaults();

            $post_object = get_post($product->get_id());

            if (!$product->get_id() || !$post_object || !in_array($post_object->post_type, array('listing', 'lplan', 'lbooking', 'cthclaim', 'product', 'cthads'))) { // change birds with your post type
                throw new Exception(__('Invalid product.', 'townhub-add-ons'));
            }

            // $id = $product->get_id();

            $product->set_props(
                array(
                    'name'              => $post_object->post_title,
                    'slug'              => $post_object->post_name,
                    'date_created'      => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
                    'date_modified'     => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
                    'status'            => $post_object->post_status,
                    'description'       => $post_object->post_content,
                    'short_description' => $post_object->post_excerpt,
                    'parent_id'         => $post_object->post_parent,
                    'menu_order'        => $post_object->menu_order,
                    'reviews_allowed'   => 'open' === $post_object->comment_status,

                    // '_stock'        => $post_object->post_type == 'lbooking' ? 1 : null,
                )
            );

            $this->read_attributes( $product );
            $this->read_downloads( $product );
            $this->read_visibility( $product );
            $this->read_product_data( $product );
            $this->read_extra_data( $product );
            $product->set_object_read( true );
        }



        /**
         * Get the product type based on product ID.
         *
         * @param int $product_id
         * @return bool|string
         */
        public function get_product_type($product_id)
        {

            $post_type = get_post_type($product_id);
            if ('product_variation' === $post_type) {
                return 'variation';
            } elseif (in_array($post_type, array('listing', 'lplan', 'lbooking', 'cthclaim', 'product', 'cthads'))) { // change birds with your post type
                $terms = get_the_terms($product_id, 'product_type');
                return !empty($terms) ? sanitize_title(current($terms)->name) : 'simple';
            } else {
                return false;
            }
        }

        /** 
        * Default 
        */
        // public function get_product_type( $product_id ) {
        //     $post_type = get_post_type( $product_id );
        //     if ( 'product_variation' === $post_type ) {
        //         return 'variation';
        //     } elseif ( 'product' === $post_type ) {
        //         $terms = get_the_terms( $product_id, 'product_type' );
        //         return ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
        //     } else {
        //         return false;
        //     }
        // }
    }

    // custom product for lplan

    class CTH_WC_Product_Plan extends WC_Product_Simple{
        /**
        * Set if should be sold individually.
        *
        * @param bool $sold_individually Whether or not product is sold individually.
        */
        public function set_sold_individually( $sold_individually ) {
            $this->set_prop( 'sold_individually', true );
        }
    }

    class CTH_WC_Product_LBooking extends CTH_WC_Product_Plan{}

    // extend WC_Order_Item_Product class
    class CTH_WC_Order_Item_Product extends WC_Order_Item_Product {
        /**
         * Set Product ID
         *
         * @param int $value
         * @throws WC_Data_Exception
         */
        public function set_product_id( $value ) {
            // if ( $value > 0 && !in_array( get_post_type( absint( $value ) ) , array('product','listing','lplan') ) ) {
            //     $this->error( 'order_item_product_invalid_product_id', __( 'Invalid product ID', 'townhub-add-ons' ) );
            // }
            $this->set_prop( 'product_id', absint( $value ) );
        }
    }


    class WC_Product_Listing_Cpt extends WC_Product_Simple {
        public function __construct( $product ) {
            // $this->product_type = 'listing_cpt';
            parent::__construct( $product );
        }

        /**
         * Get internal type.
         *
         * @return string
         */
        public function get_type() {
            return 'listing_cpt';
        }

        public function get_catalog_visibility( $context = 'view' ) {
            // return $this->get_prop( 'catalog_visibility', $context );
            return $this->get_prop( 'catalog_visibility', $context );
            // return 'hidden';
        }
    }
}
);

// https://github.com/woocommerce/woocommerce/wiki/Data-Stores
add_filter( 'woocommerce_data_stores', 'townhub_addons_woo_data_stores' );

function townhub_addons_woo_data_stores ( $stores ) {
    $stores['product'] = 'CTH_WC_Product_Data_Store_CPT';
    return $stores;
}

// filter custom product
// $classname = apply_filters( 'woocommerce_product_class', self::get_classname_from_product_type( $product_type ), $product_type, 'variation' === $product_type ? 'product_variation' : 'product', $product_id );
add_filter( 'woocommerce_product_class', 'townhub_addons_woo_product_class', 10, 4 );
function townhub_addons_woo_product_class($classname, $product_type, $variation, $product_id){
    $product_posttype = get_post_type( $product_id );
    if( 'lplan' == $product_posttype ){
        $classname = 'CTH_WC_Product_Plan';
    }elseif( 'lbooking' == $product_posttype ){
        $classname = 'CTH_WC_Product_LBooking';
    }elseif( 'cthads' == $product_posttype ){
        $classname = 'CTH_WC_Product_LBooking';
    }

    return $classname;
}



// $item = apply_filters( 'woocommerce_checkout_create_order_line_item_object', new WC_Order_Item_Product(), $cart_item_key, $values, $order );
add_filter( 'woocommerce_checkout_create_order_line_item_object', 'townhub_addons_woo_checkout_create_order_line_item_object', 10, 4 );
function townhub_addons_woo_checkout_create_order_line_item_object($item, $cart_item_key, $values, $order){
    $product = $values['data'];
    if ( $product ) {
        $post_type = get_post_type($product->get_id());
        if(in_array($post_type, array( 'listing','lplan','lbooking','cthclaim', 'cthads' ))){
            return new CTH_WC_Order_Item_Product();
        }
    }

    // return default
    return $item;
}

// $classname = apply_filters( 'woocommerce_get_order_item_classname', $classname, $item_type, $id );
add_filter( 'woocommerce_get_order_item_classname', 'townhub_addons_woo_get_order_item_classname', 10, 3 );
function townhub_addons_woo_get_order_item_classname($classname, $item_type, $id){

    $item = new CTH_WC_Order_Item_Product($id);
    $product_id = $item->get_product_id();

    // error_log(date('[Y-m-d H:i e] '). "woocommerce_get_order_item_classname: Product ID " . $product_id . PHP_EOL, 3, "./woo.log");
    // error_log(date('[Y-m-d H:i e] '). "woocommerce_get_order_item_classname: Product post type " . get_post_type($product_id) . PHP_EOL, 3, "./woo.log");

    if  (in_array(get_post_type($product_id), array( 'listing','lplan','lbooking','cthclaim', 'cthads' ))) {
        return 'CTH_WC_Order_Item_Product';
    } else {
        return $classname;
    }


    // if($item_type == 'line_item' || $item_type == 'product')
    //     $classname = 'CTH_WC_Order_Item_Product';

    // return $classname;
}


// add_filter('woocommerce_product_get_price', 'townhub_addons_woo_product_get_price', 10, 2 );
// function townhub_addons_woo_product_get_price( $price, $product ) {
//     // global $post;
//     var_dump($product);
//     if ($product->post->post_type === 'listing') // change birds with your post type
//         $price = get_post_meta($post->id, "_cth_price_from", true);
//     return $price;
// }

// new processing 
// do_action( 'woocommerce_payment_complete_order_status_' . $this->get_status(), $this->get_id() );
// add_action( 'woocommerce_payment_complete_order_status_processing', 'townhub_addons_woo_payment_complete_order_status_processing', 10, 1 );
function townhub_addons_woo_payment_complete_order_status_processing($order_id){
    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "woocommerce_payment_complete_order_status_processing action. Order id: $order_id" . PHP_EOL, 3, ESB_LOG_FILE);
}
// mark woo order status to completed for membership subscription - default value if woo product is Digital and Downloadable.
// $this->set_status( apply_filters( 'woocommerce_payment_complete_order_status', $this->needs_processing() ? 'processing' : 'completed', $this->get_id(), $this ) ); this filter doesn't fire with cod, bacs and cheque
add_filter( 'woocommerce_payment_complete_order_status', 'townhub_addons_woo_payment_complete_order_status', 10, 2 );
// add_filter( 'woocommerce_bacs_process_payment_order_status', 'townhub_addons_woo_payment_complete_order_status', 10, 2 ); // for bacs
// add_filter( 'woocommerce_cod_process_payment_order_status', 'townhub_addons_woo_payment_complete_order_status', 10, 2 ); // for cod
function townhub_addons_woo_payment_complete_order_status($status, $order_id){
    $lplan_items = array();
    $listing_items = array();
    $lbooking_items = array();
    $cthclaim_items = array();
    $cthads_items = array();
    $woo_order  = new WC_Order( $order_id );

    if ( count( $woo_order->get_items() ) > 0 ) {

        foreach( $woo_order->get_items() as $item ) {
            // $item - CTH_WC_Order_Item_Product
            $product_id = $item->get_product_id();
            if($product_id > 0){
                switch (get_post_type( absint( $product_id ) )) {
                    case 'listing':
                        $listing_items[] = $product_id;
                        break;
                    
                    case 'lplan':
                        $lplan_items[] = $product_id;
                        break;
                    case 'lbooking':
                        $lbooking_items[] = $product_id;
                    case 'cthclaim':
                        $cthclaim_items[] = $product_id;
                        break;
                    case 'cthads':
                        $cthads_items[] = $product_id;
                }
            }
        }
    }
    // if there is membership item
    if( count($lplan_items) > 0 || count($cthclaim_items) > 0 || count($cthads_items) > 0 ){
        $status = 'completed';
    }
    return $status;
}

// add woo_order to booking
// do_action( 'woocommerce_payment_complete', $this->get_id() ); doesn't work with BACS and COD methods
// add_action( 'woocommerce_payment_complete', 'townhub_addons_woo_payment_complete' );
function townhub_addons_woo_payment_complete($order_id){
    die('lbooking is paid');
    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "woocommerce_payment_complete - Order ID: $order_id" . PHP_EOL, 3, ESB_LOG_FILE);
    $woo_order  = new WC_Order( $order_id );
    if ( count( $woo_order->get_items() ) > 0 ) {
        foreach( $woo_order->get_items() as $item ) {
            // $item - CTH_WC_Order_Item_Product
            $product_id = $item->get_product_id();
            if($product_id > 0 && 'lbooking' == get_post_type( absint( $product_id ) ) ){
                if( !update_post_meta( $product_id, ESB_META_PREFIX.'woo_order',  $order_id  ) ){
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). 'Insert lbooking woo_order value failed.' . PHP_EOL, 3, ESB_LOG_FILE);
                }

                
            }
        }
    }
}
// add woo_order to booking
// do_action( 'woocommerce_order_status_' . $status_transition['to'], $this->get_id(), $this );
// do_action( 'woocommerce_order_status_changed', $this->get_id(), $status_transition['from'], $status_transition['to'], $this );
add_action( 'woocommerce_order_status_changed', 'townhub_addons_woo_order_status_changed', 10, 3 );
function townhub_addons_woo_order_status_changed($order_id, $from_status, $to_status){
    // error_log('woocommerce_order_status_changed');
    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "woocommerce_order_status_changed action" . PHP_EOL, 3, ESB_LOG_FILE);
    
    $woo_order  = new WC_Order( $order_id );
    if ( count( $woo_order->get_items() ) > 0 ) {
        $check_completed = get_post_meta( $order_id, '_cth_check_earning', true );
        
        if( $check_completed == 'completed' ) return;
        update_post_meta( $order_id, '_cth_check_earning', $to_status );
        foreach( $woo_order->get_items() as $item ) {
            // $item - CTH_WC_Order_Item_Product
            $product_id = $item->get_product_id();
            if( $product_id > 0 && 'lbooking' == get_post_type( $product_id ) ){ 
                if( $order_id != get_post_meta( $product_id, ESB_META_PREFIX.'woo_order', true ) ){
                    update_post_meta( $product_id, ESB_META_PREFIX.'woo_order',  $order_id  );
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). 'Insert lbooking woo_order value success.' . PHP_EOL, 3, ESB_LOG_FILE);
                }

                // check if order is completed
                if($to_status == 'completed'){
                    update_post_meta( $product_id, ESB_META_PREFIX.'lb_status',  'completed'  );
                    update_post_meta( $product_id, ESB_META_PREFIX.'payment_method',  'woo'  );                    
                    $listing_id = get_post_meta( $product_id, ESB_META_PREFIX.'listing_id', true );
                    // update author earning
                    $listing_author_id = get_post_field( 'post_author', $listing_id );
                    if($listing_author_id){
                        $inserted_earning = Esb_Class_Earning::insert($product_id, $listing_author_id, $listing_id);
                    }
                    
                    // push customer notification
                    $customer = get_user_by( 'email', get_post_meta( $product_id, ESB_META_PREFIX.'lb_email', true ) );
                    if ( ! empty( $customer ) ) {
                        if( townhub_addons_get_option('db_hide_bookings') != 'yes' ){
                            
                            // townhub_addons_user_add_notification($customer->ID, array(
                            //     'type' => 'booking_approved',
                            //     'message' => sprintf(__( 'Your booking for <strong>%s</strong> listing has been approved.', 'townhub-add-ons' ), get_post_field('post_title', $listing_id) )
                            // ));
                        }
                    }
                    do_action( 'townhub_addons_edit_booking_approved', $product_id );

                }

                    

                
            }

            // woo product
            if( $product_id > 0 && 'product' == get_post_type( $product_id ) ){ 
                
                // check if order is completed
                if($to_status == 'completed'){                   
                    $listing_id = get_post_meta( $product_id, ESB_META_PREFIX.'for_listing_id', true );
                    // update author earning
                    $listing_author_id = get_post_field( 'post_author', $listing_id );
                    if($listing_author_id){
                        $inserted_earning = Esb_Class_Earning::insert($product_id, $listing_author_id, $listing_id, true);
                    }
                }

            }

            // claim listing order
            if( $product_id > 0 && 'cthclaim' == get_post_type( $product_id ) ){ 
                if( $order_id != get_post_meta( $product_id, ESB_META_PREFIX.'woo_order', true ) ){
                    update_post_meta( $product_id, ESB_META_PREFIX.'woo_order',  $order_id  );
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). 'Insert cthclaim woo_order value success.' . PHP_EOL, 3, ESB_LOG_FILE);
                }
                // check if order is completed
                if($to_status == 'completed'){
                    if(townhub_addons_get_option('approve_claim_after_paid') == 'yes'){
                        update_post_meta( $product_id, ESB_META_PREFIX.'claim_status',  'approved' );
                        do_action( 'townhub_addons_lclaim_change_status_to_approved', $product_id );
                    }else{
                        update_post_meta( $product_id, ESB_META_PREFIX.'claim_status',  'paid' );
                    }
                    

                    // push customer notification
                    // $customer = get_user_by( 'email', get_post_meta( $product_id, ESB_META_PREFIX.'lb_email', true ) );
                    // if ( ! empty( $customer ) ) {
                    //     if( townhub_addons_get_option('db_hide_bookings') != 'yes' ){
                    //         $listing_id = get_post_meta( $product_id, ESB_META_PREFIX.'listing_id', true );
                    //         townhub_addons_user_add_notification($customer->ID, array(
                    //             'type' => 'booking_approved',
                    //             'message' => sprintf(__( 'Your booking for <strong>%s</strong> listing has been approved.', 'townhub-add-ons' ), get_post_field('post_title', $listing_id) )
                    //         ));
                    //     }
                    // }

                    do_action( 'townhub_addons_edit_booking_approved', $product_id );

                }
            }// end claim listing order
        }
    }
}
// order status change to completed - only create listing membership subscription/order upon woo order is marked as completed
add_action( 'woocommerce_order_status_completed', 'townhub_addons_woo_order_status_completed', 10, 2 );
function townhub_addons_woo_order_status_completed($woo_order_id, $order_obj){

    // error_log('woocommerce_order_status_completed');
    // var_dump($woo_order_id);

    // die('woocommerce_order_status_completed');


    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "woocommerce_order_status_completed action" . PHP_EOL, 3, ESB_LOG_FILE);
    // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order ID: $woo_order_id" . PHP_EOL, 3, ESB_LOG_FILE);
    // if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order Object: $order_obj" . PHP_EOL, 3, ESB_LOG_FILE);

    $lplan_items = array();
    $listing_items = array();
    $cthads_items = array();
    $woo_order  = new WC_Order( $woo_order_id );

    if ( count( $woo_order->get_items() ) > 0 ) {

        foreach( $woo_order->get_items() as $item ) {
            // $item - CTH_WC_Order_Item_Product
            $product_id = $item->get_product_id();
            if($product_id > 0){
                switch (get_post_type( absint( $product_id ) )) {
                    case 'listing':
                        $listing_items[] = $product_id;
                        break;
                    
                    case 'lplan':
                        $lplan_items[] = $product_id;
                        break;
                    case 'cthads':
                        $cthads_items[] = $product_id;
                        break;
                }
            }

            // var_dump('ORDER ITEM');
            // var_dump($item);
            // var_dump($item['type']);
            // $product = $item->get_product();
            // var_dump($product);
        }
    }
    // if there is membership item
    if( count($lplan_items) > 0 ){
        $plan_id = end($lplan_items);
        // create new membership subscription/lorder post
        $listing_id = 0;
        $current_user = $woo_order->get_user(); //wp_get_current_user(); 
        // plan post
        $plan_post = get_post($plan_id);
        // display none on incorrect plan
        if(null == $plan_post ) return;
        $prices = townhub_addons_get_plan_prices($plan_post->ID);

        // add new order to back-end
        $order_datas = array();
        $order_datas['post_title'] = $current_user->display_name;
        $order_datas['post_content'] = '';
        $order_datas['post_author'] = $current_user->ID;
        $order_datas['post_status'] = 'publish';
        $order_datas['post_type'] = 'lorder';

        do_action( 'townhub_addons_insert_order_before', $order_datas );

        $lorder_id = wp_insert_post($order_datas ,true );

        if (!is_wp_error($lorder_id)) {
            // add listing order to woocommerce order
            add_post_meta( $woo_order_id, ESB_META_PREFIX.'lorder', $lorder_id );
            // increase plan pm_count - payment count
            $plan_pm_count = get_post_meta( $plan_post->ID , ESB_META_PREFIX.'pm_count', true );
            $plan_pm_count += 1;
            update_post_meta( $plan_post->ID , ESB_META_PREFIX.'pm_count', $plan_pm_count );

            $is_recurring_plan = get_post_meta( $plan_post->ID , ESB_META_PREFIX.'is_recurring', true );
           
            $order_metas = array(
                // 'listing_id'                    => $listing_post->ID, // listing id
                'listing_id'                    => $listing_id, // listing id
                'plan_id'                       => $plan_post->ID, // plan id
                'amount'                        => $prices['total'],
                'quantity'                      => 1,
                'currency_code'                 => townhub_addons_get_option('currency','USD'),
                'custom'                        => $lorder_id .'|'. $listing_id .'|'. $current_user->ID .'|'. $current_user->user_email .'|renew_no',
                'user_id'                       => $current_user->ID,
                'email'                         => $current_user->user_email,
                'first_name'                    => $current_user->user_firstname,
                'last_name'                     => $current_user->user_lastname,
                'display_name'                  => $current_user->display_name,



                'payment_method'                => 'woo', // banktransfer - paypal - stripe - woo


                'is_recurring_plan'             => $is_recurring_plan, // is recurring plan



                'is_per_listing_sub'            => 'no', // is per listing subscription

                'end_date'                      => townhub_add_ons_cal_next_date('', 'day', townhub_addons_get_option('listing_expire_days') ),
            );
            $order_metas['status'] = 'pending'; // pending - completed - failed - refunded
            $order_metas['payment_count'] = '0';

            $order_metas['woo_order'] = $woo_order_id;

            $trial_interval = get_post_meta( $plan_post->ID , ESB_META_PREFIX.'trial_interval', true );
            $trial_period = get_post_meta( $plan_post->ID , ESB_META_PREFIX.'trial_period', true );
            if(!empty($trial_interval) && !empty($trial_period)){
                $order_metas['trial_interval'] = $trial_interval;
                $order_metas['trial_period'] = $trial_period;

                // update trialling
                $order_metas['status'] = 'trialing'; // pending - completed - failed - refunded
            }


            // $cmb_prefix = '_cth_';
            foreach ($order_metas as $key => $value) {
                // https://codex.wordpress.org/Function_Reference/update_post_meta
                // Returns meta_id if the meta doesn't exist, otherwise returns true on success and false on failure. 
                // NOTE: If the meta_value passed to this function is the same as the value that is already in the database, this function returns false.
                if ( !update_post_meta( $lorder_id, ESB_META_PREFIX.$key,  $value  ) ) {
                    // $json['data'][] = sprintf(__('Insert order %s meta failure or existing meta value','townhub-add-ons'),$key);
                    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). sprintf(__('Insert order %s meta failure or existing meta value','townhub-add-ons'),$key) . PHP_EOL, 3, ESB_LOG_FILE);
                    // wp_send_json($json );
                }
            }


            do_action( 'townhub_addons_insert_order_after', $lorder_id, $plan_id, $listing_id );


            if($woo_order->get_total() == 0 && townhub_addons_get_option('auto_active_free_sub') != 'yes') return;
            // active membership subscription if order is completed
            $data = array(
                'pm_status'                 => 'completed',
                'user_id'                   => $current_user->ID,
                'item_number'               => $plan_post->ID, // this is listing plan id
                'pm_date'                   => current_time('mysql', 1), // Time at which the object was created. Measured in seconds since the Unix epoch.
                'order_id'                  => $lorder_id,
                'recurring_subscription'    => $is_recurring_plan,

                'txn_id'                    => uniqid('woo_integration'), // invoice id

                // for stripe period
                // 'payment_method'            => __( 'Free Subscription', 'townhub-add-ons' ),
                // 'period_start'              => current_time('mysql', 1),
                // 'period_end'                => $expire,

            );
            if(get_post_meta( $woo_order_id, '_cth_trialing', true ) == 'yes') 
                $data['pm_status'] = 'trialing';

            

            Esb_Class_Membership::active_membership($data);
            
        }
        // end create new membership subscription/lorder post
    }
    // if there is ad campaign items
    if( count($cthads_items) > 0 ){
        $ad_item = reset($cthads_items);
        Esb_Class_ADs::active_ad($ad_item);

    }// end ad campaign items
}

// only work with manual status change

// add_action( 'woocommerce_order_edit_status', 'townhub_addons_woo_order_edit_status', 10, 2 );
function townhub_addons_woo_order_edit_status($order_id, $status){
    echo '<pre>';
    var_dump('woocommerce_order_edit_status');
    var_dump($order_id);
    var_dump($status);

    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "woocommerce_order_edit_status action" . PHP_EOL, 3, ESB_LOG_FILE);
    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order ID: $order_id" . PHP_EOL, 3, ESB_LOG_FILE);
    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "New status: $status" . PHP_EOL, 3, ESB_LOG_FILE);

    $order_obj  = new WC_Order( $order_id );

    if ( count( $order_obj->get_items() ) > 0 ) {

        foreach( $order_obj->get_items() as $item ) {
            var_dump('ORDER ITEM');
            var_dump($item);
            var_dump($item['type']);
            $product = $item->get_product();
            var_dump($product);
        }
    }

    die;


    if(ESB_DEBUG) error_log(date('[Y-m-d H:i e] '). "Order Object: " . json_encode($order_obj) . PHP_EOL, 3, ESB_LOG_FILE);
}

// limit membership package quantity - only 1 membership package product in cart
// Checking and validating when products are added to cart
add_filter( 'woocommerce_add_to_cart_validation', 'townhub_addons_woo_add_to_cart_validation', 10, 3 );
function townhub_addons_woo_add_to_cart_validation( $passed, $product_id, $quantity ) {
    $product_posttype = get_post_type( $product_id );
    // check if adding product is membership package
    if( 'lplan' == $product_posttype ){
        if( !empty( WC()->cart->get_cart() ) ){
            // Display a message
            wc_add_notice( __( "You can’t order a product along with membership package.", 'townhub-add-ons' ), "error" );
            return false;
        }
    }elseif( 'lbooking' == $product_posttype ){
        $cart_items = WC()->cart->get_cart();
        if( !empty($cart_items) ){
            foreach ($cart_items as $cart_item_key => $values) {
                $product = isset($values['data']) ? $values['data'] : false;
                if( $product && $product->get_id() == $product_id ){
                    wc_add_notice( __( "You can only buy booking individually", 'townhub-add-ons' ), "error" );
                    return false;
                }
            }
        }
    }elseif( 'cthads' == $product_posttype ){
        $cart_items = WC()->cart->get_cart();
        if( !empty($cart_items) ){
            foreach ($cart_items as $cart_item_key => $values) {
                $product = isset($values['data']) ? $values['data'] : false;
                if( $product && $product->get_id() == $product_id ){
                    wc_add_notice( __( "You can only buy AD individually", 'townhub-add-ons' ), "error" );
                    return false;
                }
            }
        }
    }else{
        // check if there is exist membership package in cart
        foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
            $product = $values['data'];
            if ( $product ) {
                if( 'lplan' == get_post_type($product->get_id()) ){
                    // Display a message
                    wc_add_notice( __( "You can’t order a product along with membership package.", 'townhub-add-ons' ), "error" );
                    return false;
                }
            }
        }
    }
    return $passed;
}
// https://docs.woocommerce.com/document/payment-gateway-api/
// add woocommerce payment gateways
// add_action( 'plugins_loaded', 'townhub_addons_woo_init_gateway_classes' );
// function townhub_addons_woo_init_gateway_classes(){
//     if(!class_exists('WC_Payment_Gateway')) return;
    
//     include_once ESB_ABSPATH . 'includes/payments/paypal/paypal.php';

// }
// add_filter( 'woocommerce_payment_gateways', 'townhub_addons_woo_add_gateway_classes' );
// function townhub_addons_woo_add_gateway_classes( $methods ) {
//     $methods[] = 'CTH_WC_Gateway_Paypal'; 
//     return $methods;
// }
// return available payment depends on membership package - one-time/recurring
// return apply_filters( 'woocommerce_available_payment_gateways', $_available_gateways );

// filter woocommerce_available_payment_gateways for membership package recurring
// add_filter( 'woocommerce_available_payment_gateways', 'townhub_addons_woo_available_payment_gateways' );
// function townhub_addons_woo_available_payment_gateways($_available_gateways){
//     if(WC()->cart){
//         // check if there is exist membership package in cart
//         foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {
//             $product = $values['data'];
//             if ( $product ) {
//                 if( 'lplan' == get_post_type($product->get_id()) && get_post_meta( $product->get_id() , ESB_META_PREFIX.'is_recurring', true ) ){
//                     $new_gateways = array();
//                     if(isset($_available_gateways['cth_paypal'])) $new_gateways['cth_paypal'] = $_available_gateways['cth_paypal'];
//                     if(isset($_available_gateways['cth_stripe'])) $new_gateways['cth_stripe'] = $_available_gateways['cth_stripe'];
//                     return $new_gateways;
//                 }
//             }
//         }
//     }
//     return $_available_gateways;
// }


function townhub_addons_get_add_to_cart_url($postID = 0, $quantity = 1){
    $args = array(
        'add-to-cart' => $postID
    );
    if($quantity > 1) $args['quantity'] = $quantity;
    if(function_exists('wc_get_page_id')){
        $url = add_query_arg( $args, get_permalink( wc_get_page_id( 'cart' ) ) );
    }else{
        $url = add_query_arg( $args, home_url( '/cart/' ) );
    }

    return $url ; // do not esc_url because it's not working for quantity
}

add_filter('woocommerce_add_cart_item_data','esb_add_item_data',1,2);
 
if(!function_exists('esb_add_item_data'))
{
    function esb_add_item_data($cart_item_data,$product_id)
    {
        /*Here, We are adding item in WooCommerce session with, wdm_user_custom_data_value name*/
        global $woocommerce;
        $option = '';
        if(session_id() == '')
            session_start();   
        if (isset($_SESSION['esb_user_custom_data'])) {
            $option = $_SESSION['esb_user_custom_data'];       
            $new_value = array('esb_user_custom_data_value' => $option);
        }
        if(empty($option))
            return $cart_item_data;
        else
        {    
            if(empty($cart_item_data))
                return $new_value;
            else
                return array_merge($cart_item_data,$new_value);
        }
        unset($_SESSION['esb_user_custom_data']); 
        //Unset our custom session variable, as it is no longer needed.
    }
}
add_filter('woocommerce_get_cart_item_from_session', 'esb_get_cart_items_from_session', 1, 3 );
if(!function_exists('esb_get_cart_items_from_session'))
{
    function esb_get_cart_items_from_session($item,$values,$key)
    {
        if (array_key_exists( 'esb_user_custom_data_value', $values ) )
        {
            $item['esb_user_custom_data_value'] = $values['esb_user_custom_data_value'];
        }       
        return $item;
    }
}
// [10-Apr-2019 08:10:53 UTC] woocommerce_add_order_item_meta is deprecated since version 3.0.0! Use woocommerce_new_order_item instead.
// add_action('woocommerce_add_order_item_meta','esb_add_values_to_order_item_meta',1,2);
add_action('woocommerce_new_order_item','esb_add_values_to_order_item_meta',1,2);
if(!function_exists('esb_add_values_to_order_item_meta'))
{
  function esb_add_values_to_order_item_meta($item_id, $values)
  {

        if( isset( $values['esb_user_custom_data_value'] ) ){
            $user_custom_values = $values['esb_user_custom_data_value'];
            if(!empty($user_custom_values))
            {
                wc_add_order_item_meta($item_id,'esb_user_custom_data',$user_custom_values);  
            }
        }
  }
}
// add_action('woocommerce_before_cart_item_quantity_zero','esb_remove_user_custom_data_options_from_cart',1,1);
// if(!function_exists('esb_remove_user_custom_data_options_from_cart'))
// {
//     function esb_remove_user_custom_data_options_from_cart($cart_item_key)
//     {
//         global $woocommerce;
//         // Get cart
//         $cart = $woocommerce->cart->get_cart();
//         // For each item in cart, if item is upsell of deleted product, delete it
//         foreach( $cart as $key => $values)
//         {
//         if ( $values['esb_user_custom_data_value'] == $cart_item_key )
//             unset( $woocommerce->cart->cart_contents[ $key ] );
//         }
//     }
// }

add_action('woocommerce_after_cart_item_name','display_data_to_cart');
if(!function_exists('display_data_to_cart')){
    function display_data_to_cart($cart_item){
        if (!empty($cart_item['esb_user_custom_data_value']) && $cart_item['esb_user_custom_data_value'] !== '') {
       ?>
            <div class="woo-cart-content">
                <div class="cart-detal">
                    <span class="cart-title">Listing Item :</span>
                    <span class="cart-text"><?php echo get_the_title($cart_item['esb_user_custom_data_value']['listing_id']); ?></span>
                </div>
                <div class="cart-detal">
                    <span class="cart-title">From :</span>
                    <span class="cart-text"><?php echo $cart_item['esb_user_custom_data_value']['checkin']; ?></span>
                </div>
                <div class="cart-detal">
                    <span class="cart-title">To :</span>
                    <span class="cart-text"><?php echo $cart_item['esb_user_custom_data_value']['checkout']; ?></span>
                </div>
                <div class="cart-detal">
                    <span class="cart-title">Days :</span>
                    <span class="cart-text"><?php echo $cart_item['esb_user_custom_data_value']['nights']; ?></span>
                </div>
                <div class="cart-detal">
                    <span class="cart-title">Adults :</span>
                    <span class="cart-text"><?php echo $cart_item['esb_user_custom_data_value']['adults']; ?></span>
                </div>
                <div class="cart-detal">
                    <span class="cart-title">Childs :</span>
                    <span class="cart-text"><?php echo $cart_item['esb_user_custom_data_value']['children']; ?></span>
                </div>

            </div>
       <?php
        }

    }
}
add_action('woocommerce_cart_totals_before_order_total','display_total_to_cart');
if(!function_exists('display_total_to_cart')){
    function display_total_to_cart(){
        $posted_data =  WC()->cart->get_cart();
        foreach ($posted_data as $cart_item ) { 
            if (!empty($cart_item['esb_user_custom_data_value']['subtotal_fee']) && $cart_item['esb_user_custom_data_value']['subtotal_fee'] != '') {
            ?>
            <tr class="tax-sev">
                <th><?php _e( 'Service fee', 'townhub-add-ons' ); ?></th>
                <td><?php echo townhub_addons_get_price_formated($cart_item['esb_user_custom_data_value']['subtotal_fee']); ?></td>
            </tr>
            <tr class="tax-sev">
                <th><?php _e( 'VAT', 'townhub-add-ons' ); ?></th>
                <td><?php echo townhub_addons_get_price_formated($cart_item['esb_user_custom_data_value']['subtotal_vat']); ?></td>
            </tr>
       <?php
            }
        }
    }
}
add_action('woocommerce_checkout_order_processed','submit_data_cart_customer_details');
if(!function_exists('submit_data_cart_customer_details')){
    function submit_data_cart_customer_details(){
        $posted_data =  WC()->cart->get_cart();
        foreach ($posted_data as $cart_item ) {
            if ( !empty($cart_item['esb_user_custom_data_value']) && $cart_item['esb_user_custom_data_value'] != '') {
                 Esb_Class_Ajax_Handler::insert_booking_post($cart_item['esb_user_custom_data_value'], $cart_item['quantity']);
            }
           
        }
        // print_r($posted_data);
    }
}

add_filter( 'woocommerce_calculated_total',function($total,$cart){
    if (empty($total) ) return $total; 
    $posted_data =  WC()->cart->get_cart();

    foreach ($posted_data as $cart_item1 ) { 
        if(!empty($cart_item1['esb_user_custom_data_value']['subtotal_fee']) && $cart_item1['esb_user_custom_data_value']['subtotal_fee'] !== '') {
            $total += ($cart_item1['esb_user_custom_data_value']['subtotal_fee'] + $cart_item1['esb_user_custom_data_value']['subtotal_vat']);
        }
    }
    return $total;
}, 10, 2 );


add_action('woocommerce_review_order_before_order_total','product_oder_subtotal_fee');
if(!function_exists('product_oder_subtotal_fee')){
    function product_oder_subtotal_fee(){
         $posted_data =  WC()->cart->get_cart();
        foreach ($posted_data as $cart_item ) { 
            if(!empty($cart_item1['esb_user_custom_data_value']['subtotal_fee']) && $cart_item['esb_user_custom_data_value']['subtotal_fee'] != ''){
            ?>
            <tr class="tax-sev">
                <th><?php _e( 'Service fee', 'townhub-add-ons' ); ?></th>
                <td><?php echo townhub_addons_get_price_formated($cart_item['esb_user_custom_data_value']['subtotal_fee']); ?></td>
            </tr>
            <tr class="tax-sev">
                <th><?php _e( 'VAT', 'townhub-add-ons' ); ?></th>
                <td><?php echo townhub_addons_get_price_formated($cart_item['esb_user_custom_data_value']['subtotal_vat']); ?></td>
            </tr>
       <?php
            }
        }
    }
}

// modify product link
add_filter( 'woocommerce_cart_item_permalink', function($url,$cart_item){
    if( isset($cart_item['product_id']) ){
        $post_type = get_post_type( $cart_item['product_id'] );
        if( $post_type == 'lbooking' ){
            $url = get_the_permalink( get_post_meta( $cart_item['product_id'], '_cth_listing_id', true ) );
        }elseif( $post_type == 'cthads' ){
            $url = '#';
        }
    }
    return $url;
}, 10, 2 );
