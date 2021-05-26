<div class="details-wrapper">
    <div class="details-wrapper-details">
		<?php do_action( 'details_wrapper_info' ); ?>
    </div>
	<?php if ( $average !== '0' ) { ?>
        <div class="details-wrapper-ratings">
			<?php do_action( 'details_wrapper_ratings' ); ?>
        </div>
	<?php } ?>
    <div class="details-wrapper-cart">
		<?php do_action( 'details_wrapper_cart' ); ?>
    </div>
</div>


