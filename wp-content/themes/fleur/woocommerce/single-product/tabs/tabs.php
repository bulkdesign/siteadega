<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if(!defined('ABSPATH')) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

$tabs_icons['description']['icon'] = fleur_mikado_icon_collections()->renderIcon('lnr-eye', 'linear_icons');
$tabs_icons['additional_information']['icon'] = fleur_mikado_icon_collections()->renderIcon('lnr-file-empty', 'linear_icons');
$tabs_icons['reviews']['icon'] = fleur_mikado_icon_collections()->renderIcon('lnr-users', 'linear_icons');

$tabs_titles = array();
foreach($tabs as $key => $value){
	$tabs[$key]['icon'] = $tabs_icons[$key]['icon'];
}

if(!empty($tabs)) : ?>

	<div class="mkd-tabs woocommerce-tabs wc-tabs-wrapper mkd-horizontal">
		<ul class="mkd-tabs-nav tabs wc-tabs">
			<?php foreach($tabs as $key => $tab) : ?>
			<?php if(isset($tab['title'])) { ?>
				<li class="<?php echo esc_attr($key); ?>_tab">
					<a href="#tab-<?php echo esc_attr($key); ?>">
						<span class="mkd-woocommerce-tab-icon"><?php if(isset($tab['icon'])) print $tab['icon'];?></span>
						<?php echo apply_filters('woocommerce_product_'.$key.'_tab_title', esc_html($tab['title']), $key); ?>
					</a>
				</li>
			<?php } ?>
			<?php endforeach; ?>
		</ul>
		<?php foreach($tabs as $key => $tab) : ?>
			<div class="mkd-tab-container woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr($key); ?>">
				<?php call_user_func($tab['callback'], $key, $tab); ?>
			</div>
		<?php endforeach; ?>
	</div>

<?php endif; ?>
