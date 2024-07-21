<?php

//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}
$loader_svg= SYNKWOO_POP_URL . '/assets/images/bars.svg';
?>

<div class="synk-pop-opac"></div>
<div class="synk-pop-modal">
	<div class="synk-pop-container">
<!--		<div class="synk-pop-outer">-->
<!--			<div class="synk-pop-cont-opac"></div>-->
<!--			<span class="synk-pop-preloader synk-pop-icon-spinner"></span>-->
<!--           <span class="synk-pop-preloader synk-pop-icon-spinner"</span>-->
<!--		</div>-->
        <div class="synk-pop-outer">
            <div class="synk-pop-cont-opac"></div>
            <span class="synk-pop-preloader"><img src="<?php echo esc_url($loader_svg); ?>" width="40" alt="" fill="#000000"></span>
        </div>
		<span class="synk-pop-close synk-pop-icon-cross"></span>

		<div class="synk-pop-content"></div>

		<?php do_action('synk_pop_before_btns'); ?>
		<div class="synk-pop-btns">
			<a class="synk-pop-btn-vc synk-btn" href="<?php echo wc_get_cart_url(); ?>"><?php _e('View Cart','synkwoopop'); ?></a>
			<a class="synk-pop-btn-ch synk-btn" href="<?php echo wc_get_checkout_url(); ?>"><?php _e('Checkout','synkwoopop'); ?></a>
			<a class="synk-pop-close synk-btn"><?php _e('Continue Shopping','synkwoopop'); ?></a>
		</div>
		<?php do_action('synk_pop_after_btns'); ?>
	</div>
</div>


<div class="synk-pop-notice-box" style="display: none;">
	<div>
	  <span class="synk-pop-notice"></span>
	</div>
</div>