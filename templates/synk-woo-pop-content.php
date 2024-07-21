<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
    return;
}
//global $synk_pop_gl_qtyen_value;
$synk_pop_gl_qtyen_value = sanitize_text_field(get_option('synk-pop-gl-qtyen','true'));


$cart = WC()->cart->get_cart();

$cart_item = $cart[$cart_item_key];
$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

$thumbnail 		= apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

$product_name 	=  apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';

$product_price 	= apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

$product_subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

// Meta data
$attributes = '';

//Variation
$attributes .= $_product->is_type('variable') || $_product->is_type('variation')  ? wc_get_formatted_variation($_product) : '';
// Meta data
if(version_compare( WC()->version , '3.3.0' , "<" )){
    $attributes .=  WC()->cart->get_item_data( $cart_item );
}
else{
    $attributes .=  wc_get_formatted_cart_item_data( $cart_item );
}

//Quantity input
$max_value = apply_filters( 'woocommerce_quantity_input_max', $_product->get_max_purchase_quantity(), $_product );
$min_value = apply_filters( 'woocommerce_quantity_input_min', $_product->get_min_purchase_quantity(), $_product );
$step      = apply_filters( 'woocommerce_quantity_input_step', 1, $_product );
$pattern   = apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' );

?>

<table class="synk-pop-pdetails clearfix">
    <tr data-synk_pop_key="<?php echo $cart_item_key; ?>">
        <td class="synk-pop-remove"><span class="synk-pop-icon-cross synk_pop-remove-pd"></span></td>
        <td class="synk-pop-pimg"><a href="<?php echo  $product_permalink; ?>"><?php echo $thumbnail; ?></a></td>
        <td class="synk-pop-ptitle"><a href="<?php echo  $product_permalink; ?>"><?php echo $product_name; ?></a>
      <td class="synk-pop-variations"><?php echo $attributes; ?></td>
<!--            --><?php //if($attributes): ?>
<!--                <div class="synk-pop-variations">--><?php //echo $attributes; ?><!--</div>-->
<!--            --><?php //endif; ?>
        <td class="synk-pop-pprice"><?php echo  $product_price; ?></td>
        <td class="synk-pop-pqty">
            <?php if ( $_product->is_sold_individually() || !$synk_pop_gl_qtyen_value ): ?>
                <span><?php echo $cart_item['quantity']; ?></span>
            <?php else: ?>
                <div class="synk-pop-qtybox">
                    <span class="synk-pop-minus synk-chng">-</span>
                    <input type="number" class="synk-pop-qty" max="<?php esc_attr_e( 0 < $max_value ? $max_value : '' ); ?>" min="<?php esc_attr_e($min_value); ?>" step="<?php echo esc_attr_e($step); ?>" value="<?php echo $cart_item['quantity']; ?>" pattern="<?php esc_attr_e( $pattern ); ?>">
                    <span class="synk-plus synk-chng">+</span></div>
            <?php endif; ?>
        </td>
    </tr>
</table>
<div class="synk-pop-ptotal"><span class="synk-totxt"><?php _e('Total','synkwoopop');?> : </span><span class="synk-ptotal"><?php echo $product_subtotal; ?></span></div>