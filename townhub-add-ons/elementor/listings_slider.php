<?php
/* add_ons_php */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

class CTH_Listings_Slider extends Widget_Base {

    /**
    * Get widget name.
    *
    * Retrieve alert widget name.
    *
    * 
    * @access public
    *
    * @return string Widget name.
    */
    public function get_name() {
        return 'listings_slider';
    }

    // public function get_id() {
    //    	return 'header-search';
    // }

    public function get_title() {
        return __( 'Listings Slider', 'townhub-add-ons' );
    }

    public function get_icon() {
        // Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
        return 'cth-elementor-icon';
    }

    /**
    * Get widget categories.
    *
    * Retrieve the widget categories.
    *
    * 
    * @access public
    *
    * @return array Widget categories.
    */
    public function get_categories() {
        return [ 'townhub-elements' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __( 'Posts Query', 'townhub-add-ons' ),
            ]
        );

        $this->add_control(
            'cat_ids',
            [
                'label' => __( 'Categories to get listings', 'townhub-add-ons' ),
                'type' => Controls_Manager::SELECT2,
                'options' => townhub_addons_get_listing_categories_select2(),
                'multiple' => true,
                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                // 'description' => esc_html__("Select how to sort retrieved posts. More at ", 'townhub-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );


        $this->add_control(
            'tag_ids',
            [
                'label' => __( 'Listing Tags', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter listing tag's ids to get listings from, separated by a comma.", 'townhub-add-ons')
                
            ]
        );

        $this->add_control(
            'ids',
            [
                'label' => __( 'Enter Post IDs', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'townhub-add-ons')
                
            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label' => __( 'Or Post IDs to Exclude', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'townhub-add-ons')
                
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __( 'Order by', 'townhub-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => esc_html__('Date', 'townhub-add-ons'), 
                    'ID' => esc_html__('ID', 'townhub-add-ons'), 
                    'author' => esc_html__('Author', 'townhub-add-ons'), 
                    'title' => esc_html__('Title', 'townhub-add-ons'), 
                    'modified' => esc_html__('Modified', 'townhub-add-ons'),
                    'rand' => esc_html__('Random', 'townhub-add-ons'),
                    'comment_count' => esc_html__('Comment Count', 'townhub-add-ons'),
                    'menu_order' => esc_html__('Menu Order', 'townhub-add-ons'),
                    'post__in' => esc_html__('ID order given (post__in)', 'townhub-add-ons'),
                ],
                'default' => 'date',
                'separator' => 'before',
                'description' => esc_html__("Select how to sort retrieved posts. More at ", 'townhub-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __( 'Sort Order', 'townhub-add-ons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('Ascending', 'townhub-add-ons'), 
                    'DESC' => esc_html__('Descending', 'townhub-add-ons'), 
                ],
                'default' => 'DESC',
                'separator' => 'before',
                'description' => esc_html__("Select Ascending or Descending order. More at", 'townhub-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.', 
            ]
        );

        $this->add_control(
            'featured_only',
            [
                'label' => __( 'Show featured listings only?', 'townhub-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Yes', 'townhub-add-ons' ),
                'label_off' => __( 'No', 'townhub-add-ons' ),
                'return_value' => 'yes',
                
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __( 'Posts to show', 'townhub-add-ons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => '12',
                'description' => esc_html__("Number of posts to show (-1 for all).", 'townhub-add-ons'),
                
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __( 'Posts Layout', 'townhub-add-ons' ),
            ]
        );

        $this->add_control(
            'hide_status',
            [
                'label' => __( 'Hide Open/Closed status', 'townhub-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Yes', 'townhub-add-ons' ),
                'label_off' => __( 'No', 'townhub-add-ons' ),
                'return_value' => 'yes',
            ]
        );

        // $this->add_control(
        //     'columns_grid',
        //     [
        //         'label' => __( 'Columns Grid', 'townhub-add-ons' ),
        //         'type' => Controls_Manager::SELECT,
        //         'options' => [
        //             'one' => esc_html__('One Column', 'townhub-add-ons'), 
        //             'two' => esc_html__('Two Columns', 'townhub-add-ons'), 
        //             'three' => esc_html__('Three Columns', 'townhub-add-ons'), 
        //             'four' => esc_html__('Four Columns', 'townhub-add-ons'), 
        //             'five' => esc_html__('Five Columns', 'townhub-add-ons'), 
        //             'six' => esc_html__('Six Columns', 'townhub-add-ons'), 
        //         ],
        //         'default' => 'three',
        //         // 'description' => esc_html__("Number of posts to show (-1 for all).", 'townhub-add-ons'),
                
        //     ]
        // );

        $this->add_control(
            'responsive',
            [
                'label' => __( 'Responsive', 'townhub-add-ons' ),
                'type' => Controls_Manager::TEXT,
                'default' => '850:1,1270:2,1650:3,2560:4',
                'label_block' => true,
                'description' => __("The format is: screen-size:number-items-display,larger-screen-size:number-items-display. Ex: 850:1,1270:2,1650:3,2560:4", 'townhub-add-ons')
                
            ]
        );
        

        $this->add_control(
            'read_all_link',
            [
                'label' => __( 'Read All URL', 'townhub-add-ons' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                    'is_external' => '',
                ],
                'show_external' => true, // Show the 'open in new tab' button.
            ]
        );


        $this->add_control(
            'show_pagination',
            [
                'label' => __( 'Show Pagination', 'townhub-add-ons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'Show', 'townhub-add-ons' ),
                'label_off' => __( 'Hide', 'townhub-add-ons' ),
                'return_value' => 'yes',
            ]
        );


        


        $this->end_controls_section();

    }

    protected function render( ) {

        $settings = $this->get_settings();

        if(is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        if(!empty($settings['ids'])){
            $ids = explode(",", $settings['ids']);
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__in' => $ids,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],
                'post_status' => 'publish'
            );
        }elseif(!empty($settings['ids_not'])){
            $ids_not = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'post__not_in' => $ids_not,
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }else{
            $post_args = array(
                'post_type' => 'listing',
                'paged' => $paged,
                'posts_per_page'=> $settings['posts_per_page'],
                'orderby'=> $settings['order_by'],
                'order'=> $settings['order'],

                'post_status' => 'publish'
            );
        }





        $tax_queries = array();

        if(!empty($settings['cat_ids'])){
            $tax_queries[] =    array(
                                    'taxonomy' => 'listing_cat',
                                    'field'    => 'term_id',
                                    'terms'    => $settings['cat_ids'],
                                );

        }
        
        if(!empty($settings['tag_ids'])){
            $tax_queries[] =    array(
                                    'taxonomy' => 'listing_tag',
                                    'field'    => 'term_id',
                                    'terms'    => explode( ",", $settings['tag_ids'] ),
                                );
        }

        if(!empty($tax_queries)){
            // if( count($tax_queries) > 1 ) $tax_queries['relation'] = 'AND';
            $post_args['tax_query'] = $tax_queries;
        } 
        // listing meta search
        $meta_queries = array();
        // check for membership expired
        // if(townhub_addons_get_option('membership_package_expired_hide') == 'yes'){
        //     $meta_queries['relation'] = 'OR';
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => current_time('mysql', 1),
        //         'compare' => '>=',
        //         'type'    => 'DATETIME',
        //     );
        //     $meta_queries[] = array(
        //         'key'     => ESB_META_PREFIX.'expire_date',
        //         'value'   => 'NEVER',
        //         'compare' => '=',
        //     );

        // }

        if( $settings['featured_only'] == 'yes'){
            $meta_queries[] =   array(
                                    'key'     => ESB_META_PREFIX .'featured',
                                    'value'   => '1',
                                    'type'      => 'NUMERIC'
                                );
        }

        if(!empty($meta_queries)) $post_args['meta_query'] = $meta_queries;


        $css_classes = array(
            'listing-slider-wrap fl-wrap',
            // 'posts-grid-',//.$settings['columns_grid']
        );

        $css_class = preg_replace( '/\s+/', ' ', implode( ' ', array_filter( $css_classes ) ) );

        ?>
        <!-- carousel -->
        <div class="<?php echo esc_attr( $css_class );?>">
            
            <?php 
            $slider_args = array();
            $breakpoints = array();
            $slidesPerView = array();
            $responsive = explode( ",", trim( $settings['responsive'] ) );
            $editor_col = 4;
            if( !empty($responsive) ){
                foreach ($responsive as $breakpoint) {
                    $breakpoint = explode( ":", trim($breakpoint) );
                    if( count($breakpoint) === 2 ){
                        $breakpoints[$breakpoint[0]] = array( 'slidesPerView'=>intval($breakpoint[1]) );
                        $slidesPerView[] = intval($breakpoint[1]);
                    }
                }
            }
            if( !empty($breakpoints) ){
                $slider_args['slidesPerView'] = max($slidesPerView);
                $editor_col = $slider_args['slidesPerView'];
                $slider_args['breakpoints'] = $breakpoints;
            }

            ?>
            
            <div class="listing-slider fl-wrap listing-slider-editor-col-<?php echo esc_attr( $editor_col ); ?>">
                <div class="swiper-container" data-options='<?php echo json_encode($slider_args); ?>'>
                    <div class="swiper-wrapper">

                        <?php 
                        do_action( 'townhub_addons_elementor_listing_slider_before', $settings );
                        $posts_query = new \WP_Query($post_args);
                        if($posts_query->have_posts()) : ?>
                            <?php 
                            while($posts_query->have_posts()) : $posts_query->the_post(); 
                                townhub_addons_get_template_part( 'template-parts/listing-slider', false, array( 'for_slider'=>true, 'hide_status'=>$settings['hide_status'] ) );
                            endwhile; ?>
                        <?php endif; ?> 
                                                             
                    </div>
                </div>
                <div class="listing-carousel-button listing-carousel-button-next2"><i class="fas fa-caret-right"></i></div>
                <div class="listing-carousel-button listing-carousel-button-prev2"><i class="fas fa-caret-left"></i></div>
            </div>
            <div class="tc-pagination_wrap">
                <div class="tc-pagination2"></div>
            </div>
            

        </div>
        <!--  carousel end-->
        <?php 
        wp_reset_postdata();

    }


}
