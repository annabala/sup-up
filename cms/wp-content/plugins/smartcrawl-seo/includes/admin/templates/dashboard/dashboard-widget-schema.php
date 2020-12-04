<?php
if ( ! smartcrawl_subsite_setting_page_enabled( Smartcrawl_Settings::TAB_SCHEMA ) ) {
	return;
}

$page_url = Smartcrawl_Settings_Admin::admin_url( Smartcrawl_Settings::TAB_SCHEMA );
$social_option_name = Smartcrawl_Settings::TAB_SOCIAL . '_options';
$social_options = Smartcrawl_Settings::get_specific_options( $social_option_name );
$schema_enabled = ! smartcrawl_get_array_value( $social_options, 'disable-schema' );
?>

<section id="<?php echo esc_attr( Smartcrawl_Settings_Dashboard::BOX_SCHEMA ); ?>"
         class="sui-box wds-dashboard-widget">

	<div class="sui-box-header">
		<h3 class="sui-box-title">
			<i class="sui-icon-code" aria-hidden="true"></i> <?php esc_html_e( 'Schema', 'wds' ); ?>
		</h3>
	</div>

	<div class="sui-box-body">
		<p><?php esc_html_e( 'Quickly add Schema to your pages to help Search Engines understand and show your content better.', 'wds' ); ?></p>

		<?php if ( $schema_enabled ): ?>
			<div class="wds-separator-top wds-separator-bottom wds-draw-left-padded">
				<small><strong><?php esc_html_e( 'Default Markup', 'wds' ); ?></strong></small>
				<span class="wds-right">
					<small><?php esc_html_e( 'Active', 'wds' ); ?></small>
				</span>
			</div>

			<a href="<?php echo esc_attr( $page_url ); ?>"
			   class="sui-button sui-button-ghost">
				<i class="sui-icon-wrench-tool" aria-hidden="true"></i> <?php esc_html_e( 'Configure', 'wds' ); ?>
			</a>
		<?php else: ?>
			<br/>
			<button type="button"
			        data-option-id="<?php echo esc_attr( $social_option_name ); ?>"
			        data-flag="disable-schema"
			        data-value="0"
			        class="wds-activate-component wds-disabled-during-request sui-button sui-button-blue">

				<span class="sui-loading-text"><?php esc_html_e( 'Activate', 'wds' ); ?></span>
				<i class="sui-icon-loader sui-loading" aria-hidden="true"></i>
			</button>
		<?php endif; ?>
	</div>
</section>
