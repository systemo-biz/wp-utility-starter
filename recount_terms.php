<?php
/**
 * Plugin Name: Recount Product Category
 * Description:  Recounter counts products categories for WooCommerce (trg_wc_recount_term)
 */



class trg_wc_recount_term {
    public function __construct() {

        add_action('admin_menu', function () {
            add_management_page(
                $page_title = 'Recount Product Category',
                $menu_title = 'Recount Product Category',
                $capability = 'manage_options',
                $menu_slug = 'trg_wc_recount_term_ui',
                $function = [$this, 'admin_ui_callback']
            );
        });
    }



    public function admin_ui_callback(){


        $args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
        );

        $terms = get_terms( $args );

        //var_dump($terms);

        foreach ($terms as $term) {
            echo '<pre>';
            //var_dump($term);
            echo 'slug: ' . $term->slug . '<br/>';
            echo 'term_id: ' . $term->term_id . '<br/>';
            echo 'term_taxonomy_id: ' . $term->term_taxonomy_id . '<br/>';
            echo 'count: ' . $term->count . '<br/>';
            echo '</pre>';

            //_wc_term_recount($term, $taxonomy = 'product_cat', $callback = true, false);

            $args_new = [
                'slug' => $term->slug,
                'count' => "33",
            ];

            $tn = wp_update_term( $term->term_id, $taxonomy = product_cat, $args_new );

            echo 'Обновлен тремин: ' . $tn['term_id'] . '<br/>';
            //var_dump($tn);

            echo '<hr>';

        }

        ?>

        <div class="trg_wc_recount_term_wrapper">

        </div>

        <?php
    }
}
$the_trg_wc_recount_term = new trg_wc_recount_term;
