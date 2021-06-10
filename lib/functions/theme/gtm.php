<?php
/**
 * KabelStar
 *
 * This file adds the Customizer additions to the KabelStar Theme.
 *
 * @package KabelStar
 * @author  Valentin Zmaranda
 * @license GPL-2.0+
 * @link    https://www.cloudweb.ch/
 */

namespace CloudWeb\KabelStar;

add_action( 'wp_head', __NAMESPACE__ . '\push_b2b_price_to_datalayer', 1, 0 );
function push_b2b_price_to_datalayer() {

    if( is_product() ) {

        global $post;
        $prod_id = $post->ID;

        $b2b_price = get_post_meta( $prod_id, '_vdl_B2B_price', true );
        if( $b2b_price ) {
        ?>
        <script type="text/javascript">
            if( b2b !== undefined ) {
                b2b.push({b2b: "<?php echo $b2b_price; ?>"});
            }
        </script>
        <?php
        }

    }

}

add_filter( 'woocommerce_gpf_prepopulate_options', __NAMESPACE__ . '\add_ean_to_product_feeds_prepopulate_options', 10, 2 );
function add_ean_to_product_feeds_prepopulate_options( $options, $key ) {

    if( ! isset( $options['meta:_vdl_ean'] ) ) {
        $options['meta:_vdl_ean'] = 'vidaXL EAN code';
    }

    return $options;

}
?>
