<?php
/* add_ons_php */

namespace Elementor;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class CTH_Listings_Grid_New extends Widget_Base
{

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
    public function get_name()
    {
        return 'listings_grid_new';
    }

    // public function get_id() {
    //        return 'header-search';
    // }

    public function get_title()
    {
        return __('Listings Grid', 'townhub-add-ons');
    }

    public function get_icon()
    {
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
    public function get_categories()
    {
        return ['townhub-elements'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Listings Query', 'townhub-add-ons'),
            ]
        );

        $this->add_control(
            'cat_ids',
            [
                'label'       => __('Categories to get listings', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => townhub_addons_get_listing_categories_select2(),
                'multiple'    => true,
                'label_block' => true,
                // 'default' => 'date',
                // 'separator' => 'before',
                // 'description' => esc_html__("Select how to sort retrieved posts. More at ", 'townhub-add-ons').'<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
            ]
        );

        $this->add_control(
            'loc_ids',
            [
                'label'       => __('Locations to get listings', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => townhub_addons_get_listing_locations_hierarchy_select2(),
                'multiple'    => true,
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

        // $this->add_control(
        //     'cat_ids',
        //     [
        //         'label' => __( 'Post Category IDs to include', 'townhub-add-ons' ),
        //         'type' => Controls_Manager::TEXT,
        //         'default' => '',
        //         'label_block' => true,
        //         'description' => __("Enter post category ids to include, separated by a comma. Leave empty to get posts from all categories.", 'townhub-add-ons')

        //     ]
        // );

        $this->add_control(
            'ids',
            [
                'label'       => __('Enter Post IDs', 'townhub-add-ons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'description' => __("Enter Post ids to show, separated by a comma. Leave empty to show all.", 'townhub-add-ons'),

            ]
        );
        $this->add_control(
            'ids_not',
            [
                'label'       => __('Or Post IDs to Exclude', 'townhub-add-ons'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'description' => __("Enter post ids to exclude, separated by a comma (,). Use if the field above is empty.", 'townhub-add-ons'),

            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'       => __('Order by', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'date'             => esc_html__('Date', 'townhub-add-ons'),
                    'ID'               => esc_html__('ID', 'townhub-add-ons'),
                    'author'           => esc_html__('Author', 'townhub-add-ons'),
                    'title'            => esc_html__('Title', 'townhub-add-ons'),
                    'modified'         => esc_html__('Modified', 'townhub-add-ons'),
                    'rand'             => esc_html__('Random', 'townhub-add-ons'),
                    'comment_count'    => esc_html__('Comment Count', 'townhub-add-ons'),
                    'menu_order'       => esc_html__('Menu Order', 'townhub-add-ons'),
                    'post__in'         => esc_html__('ID order given (post__in)', 'townhub-add-ons'),
                    'listing_featured' => esc_html__('Listing Featured', 'townhub-add-ons'),

                ],
                'default'     => 'date',
                'separator'   => 'before',
                'description' => esc_html__("Select how to sort retrieved posts. More at ", 'townhub-add-ons') . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
            ]
        );

        $this->add_control(
            'order',
            [
                'label'       => __('Sort Order', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ASC'  => esc_html__('Ascending', 'townhub-add-ons'),
                    'DESC' => esc_html__('Descending', 'townhub-add-ons'),
                ],
                'default'     => 'DESC',
                'separator'   => 'before',
                'description' => esc_html__("Select Ascending or Descending order. More at", 'townhub-add-ons') . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
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
                'label'       => __('Posts to show', 'townhub-add-ons'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '6',
                'min'         => -1,
                'description' => esc_html__("Number of posts to show (-1 for all).", 'townhub-add-ons'),

            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'filter_sec',
            [
                'label' => __('Filter', 'townhub-add-ons'),
            ]
        );

        $this->add_control(
            'show_filter',
            [
                'label'        => __('Show Cats Filter', 'townhub-add-ons'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('Show', 'townhub-add-ons'),
                'label_off'    => __('Hide', 'townhub-add-ons'),
                'return_value' => 'yes',
            ]
        );
        $this->add_control(
            'finclude',
            [
                'label'       => __('Cats Include', 'townhub-add-ons'),
                'type'        => Controls_Manager::TEXT,

                'label_block' => true,
                'default'     => '',
                // 'separator' => 'before',
                'description' => __('Comma/space-separated string of term ids to include. Leave empty to use default.', 'townhub-add-ons'),
            ]
        );

        $this->add_control(
            'fnumber',
            [
                'label'       => __('No of Cats', 'townhub-add-ons'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => '4',
                'min'         => -1,
                'description' => '',

            ]
        );
        $this->add_control(
            'forderby',
            [
                'label'       => __('Order by', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'name'        => esc_html__('Name', 'townhub-add-ons'),
                    'slug'        => esc_html__('Slug', 'townhub-add-ons'),
                    'term_group'  => esc_html__('Term Group', 'townhub-add-ons'),
                    'term_id'     => esc_html__('Term ID', 'townhub-add-ons'),
                    'id'          => esc_html__('ID', 'townhub-add-ons'),
                    'description' => esc_html__('Description', 'townhub-add-ons'),
                    'parent'      => esc_html__('Parent', 'townhub-add-ons'),
                    'count'       => esc_html__('Count', 'townhub-add-ons'),
                    'include'     => esc_html__('Include', 'townhub-add-ons'),

                ],
                'default'     => 'slug',
                'separator'   => 'before',
                'description' => '',
            ]
        );

        $this->add_control(
            'forder',
            [
                'label'       => __('Sort Order', 'townhub-add-ons'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    'ASC'  => esc_html__('Ascending', 'townhub-add-ons'),
                    'DESC' => esc_html__('Descending', 'townhub-add-ons'),
                ],
                'default'     => 'ASC',
                'separator'   => 'before',
                'description' => '',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => __('Listings Layout', 'townhub-add-ons'),
            ]
        );

        $this->add_control(
            'columns_grid',
            [
                'label'   => __('Columns Grid', 'townhub-add-ons'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'one'   => esc_html__('One Column', 'townhub-add-ons'),
                    'two'   => esc_html__('Two Columns', 'townhub-add-ons'),
                    'three' => esc_html__('Three Columns', 'townhub-add-ons'),
                    'four'  => esc_html__('Four Columns', 'townhub-add-ons'),
                    'five'  => esc_html__('Five Columns', 'townhub-add-ons'),
                    'six'   => esc_html__('Six Columns', 'townhub-add-ons'),
                ],
                'default' => 'three',
                // 'description' => esc_html__("Number of posts to show (-1 for all).", 'townhub-add-ons'),

            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'        => __('Show Pagination', 'townhub-add-ons'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => __('Show', 'townhub-add-ons'),
                'label_off'    => __('Hide', 'townhub-add-ons'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'view_all_link',
            [
                'label'         => __('View All Link', 'townhub-add-ons'),
                'type'          => Controls_Manager::URL,
                'default'       => [
                    'url'         => get_post_type_archive_link('listing'),
                    'is_external' => '',
                ],
                'description'   => __('Listing archive page: ', 'townhub-add-ons') . get_post_type_archive_link('listing'),
                'show_external' => true, // Show the 'open in new tab' button.
            ]
        );

        $this->add_control(
            'view_all_text',
            [
                'label'       => __('View all Text', 'townhub-add-ons'),
                'type'        => Controls_Manager::TEXT,

                'label_block' => true,
                'default'     => 'Check Out All Listings',
                // 'separator' => 'before',
                'description' => '',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {

        $settings = $this->get_settings();

        if (is_front_page()) {
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        } else {
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        }

        if (!empty($settings['ids'])) {
            $ids       = explode(",", $settings['ids']);
            $post_args = array(
                'post_type'      => 'listing',
                'paged'          => $paged,
                'posts_per_page' => $settings['posts_per_page'],
                'post__in'       => $ids,
                'orderby'        => $settings['order_by'],
                'order'          => $settings['order'],
                'post_status'    => 'publish',
            );
        } elseif (!empty($settings['ids_not'])) {
            $ids_not   = explode(",", $settings['ids_not']);
            $post_args = array(
                'post_type'      => 'listing',
                'paged'          => $paged,
                'posts_per_page' => $settings['posts_per_page'],
                'post__not_in'   => $ids_not,
                'orderby'        => $settings['order_by'],
                'order'          => $settings['order'],

                'post_status'    => 'publish',
            );
        } else {
            $post_args = array(
                'post_type'      => 'listing',
                'paged'          => $paged,
                'posts_per_page' => $settings['posts_per_page'],
                'orderby'        => $settings['order_by'],
                'order'          => $settings['order'],

                'post_status'    => 'publish',
            );
        }

        $filter_args = array(
            'posts_per_page' => $settings['posts_per_page'],
            'orderby'        => $settings['order_by'],
            'order'          => $settings['order'],
        );

        if ($settings['order_by'] == 'listing_featured') {
            $post_args['meta_key'] = ESB_META_PREFIX . 'featured';
            $post_args['orderby']  = 'meta_value_num';

            $filter_args['meta_key'] = ESB_META_PREFIX . 'featured';
            $filter_args['orderby']  = 'meta_value_num';
        }

        $tax_queries = array();

        if (!empty($settings['cat_ids'])) {
            $tax_queries[] = array(
                'taxonomy' => 'listing_cat',
                'field'    => 'term_id',
                'terms'    => $settings['cat_ids'],
            );
        }
        if (!empty($settings['loc_ids'])) {
            $tax_queries[] = array(
                'taxonomy' => 'listing_location',
                'field'    => 'term_id',
                'terms'    => $settings['loc_ids'],
            );
        }
        if(!empty($settings['tag_ids'])){
            $tax_queries[] =    array(
                                    'taxonomy' => 'listing_tag',
                                    'field'    => 'term_id',
                                    'terms'    => explode( ",", $settings['tag_ids'] ),
                                );
        }

        if (!empty($tax_queries)) {
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


        if (!empty($meta_queries)) {
            $post_args['meta_query'] = $meta_queries;
        }

        $css_classes = array(
            'listings-grid-wrap clearfix',
            $settings['columns_grid'] . '-cols',
        );

        $css_class = preg_replace('/\s+/', ' ', implode(' ', array_filter($css_classes)));

        ?>
        <!-- carousel -->
        <div class="<?php echo esc_attr($css_class); ?>">


                <!-- list-main-wrap-->
                <div class="list-main-wrap fl-wrap card-listing cthiso-isotope-wrapper">

                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">

                                <?php
                            if( $settings['show_filter'] == 'yes') :
                            $term_args = array(
                                'taxonomy' => 'listing_cat',
                                'orderby'  => $settings['forderby'], //id, count, name, slug, none
                                'order'    => $settings['forder'],
                                'include'  => $settings['finclude'],
                                'number'   => $settings['fnumber'],
                            );

                            $cat_terms = get_terms( $term_args );

                            ?>
                            <?php if ( ! empty( $cat_terms ) && ! is_wp_error( $cat_terms ) ): ?>
                                <!-- filter  -->
                                <div class="cthiso-filters fl-wrap">
                                    <a href="#" class="cthiso-filter cthiso-filter-active" data-filter="*"><?php _e('All Categories', 'townhub-add-ons');?></a>
                                    <?php foreach ($cat_terms as $cterm) {?>
                                    <a href="#" class="cthiso-filter" data-filter=".listing_cat-<?php echo esc_attr($cterm->slug); ?>"><?php echo esc_html($cterm->name); ?></a>
                                    <?php }?>
                                </div>



                                    <!-- filter end -->
                            <?php endif;
                            endif; //end showfillter
                            ?>

                                <div class="cthiso-items cthiso-small-pad cthiso-<?php echo esc_attr($settings['columns_grid']);?>-cols clearfix cthiso-flex">
                                    <div class="cthiso-sizer"></div>
                                    <?php
$action_args = array(
            'listings' => array(),
        );
        // https://codex.wordpress.org/Function_Reference/do_action_ref_array
        do_action_ref_array('townhub_addons_elementor_listings_grid_before', array(&$action_args));

        $posts_query = new \WP_Query($post_args);
        if ($posts_query->have_posts()):
            /* Start the Loop */
            while ($posts_query->have_posts()): $posts_query->the_post();
                townhub_addons_get_template_part('template-parts/listing', false, array('for_grid' => true));
                $action_args['listings'][] = get_the_ID();

            endwhile;

        elseif (empty($action_args['listings'])):

            townhub_addons_get_template_part('template-parts/search-no');

        endif;
        ?>
                                </div>
                                <?php
if ($settings['show_pagination'] == 'yes') {
            ?>
                                <div class="listings-pagination-wrap">
                                    <?php
townhub_addons_custom_pagination($posts_query->max_num_pages, $range = 2, $posts_query);
            ?>
                                </div>
                                <?php
}
        // end if has_posts
        // wp_localize_script( 'townhub-addons', '_townhub_add_ons_locs', $action_args);
        // wp_localize_script( 'townhub-addons', '_townhub_add_ons_eqv', $posts_query->query_vars);

        ?>
                                <?php
$url    = $settings['view_all_link']['url'];
        $target = $settings['view_all_link']['is_external'] ? 'target="_blank"' : '';
        if ($url != '') {
            echo '<div class="view-all-listings"><a href="' . $url . '" ' . $target . ' class="btn  dec_btn  color2-bg">' . $settings['view_all_text'] . '<i class="fal fa-arrow-alt-right"></i></a></div>';
        }

        ?>

                            </div>
                            <!-- end col-md-12 -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- list-main-wrap end-->

        </div>
        <!--  listings-grid-wrap end-->

        <?php
// townhub_addons_get_template_part('templates/tmpls');
        ?>

        <?php wp_reset_postdata();?>
        <?php

    }

    // protected function _content_template() {}

}
