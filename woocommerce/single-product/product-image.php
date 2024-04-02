<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

// main image ID
$post_thumbnail_id = $product->get_image_id();
// gallery images IDs
$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="product__gallery">
	<!-- Main slider images-->
	<?php if ( ! empty( $attachment_ids ) && count( $attachment_ids ) > 0 ) : ?>
		<div class="product__gallery-main-slider-wrap">
			<div class="product__gallery-main-slider js-product-main">
				<div class="swiper-wrapper">
					<?php foreach ( $attachment_ids as $attachment_id ) : ?>
						<div class="swiper-slide product__gallery-main-slider-img">
							<?php echo wp_get_attachment_image( $attachment_id, 'woocommerce_single' ); ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="swiper-button-prev js-product-main-prev-btn"></div>
			<div class="swiper-button-next product__main-next-btn js-product-main-next-btn"></div>
		</div>
    <?php else: ?>
        <!-- Main product image if gallery is empty -->
        <div class="product__gallery-main-img">
            <?php echo wp_get_attachment_image( $post_thumbnail_id, 'woocommerce_single' ); ?>
        </div>
    <?php endif; ?>

	<?php do_action( 'woocommerce_product_thumbnails' ); ?>
</div>

<!-- Modal za prikazivanje velikih slika -->
<?php if ( ! empty( $attachment_ids ) && count( $attachment_ids ) > 0 ) : ?>
<div id="galleryModal">
    <div class="gallery-modal-content">
        <div class="swiper-container gallery-top">
            <!-- Mesto za slider slike -->
            <div class="swiper-wrapper">
				<?php foreach ( $attachment_ids as $attachment_id ) : ?>
					<div class="swiper-slide product__gallery-modal-slider-img">
						<?php echo wp_get_attachment_image( $attachment_id, 'woocommerce_single' ); ?>
					</div>
				<?php endforeach; ?>
            </div>
            <!-- Add Arrows -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</div>
<?php endif; ?>

