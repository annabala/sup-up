<?php
$dismissed_messages = get_user_meta( get_current_user_id(), 'wds_dismissed_messages', true );
$is_message_dismissed = smartcrawl_get_array_value( $dismissed_messages, 'black-friday-2020-notice' ) === true;
$friday = SmartCrawl_Controller_Black_Friday::get();
$time_left = $friday->get_time_left();
$print_numbers = function ( $number ) {
	if ( $number < 10 ) {
		$first = 0;
		$second = $number;
	} else {
		$second = $number % 10;
		$first = ( $number - $second ) / 10;
	}

	printf( '<div><span>%s</span><span>%s</span></div>', (int) $first, (int) $second );
};
$service = Smartcrawl_Service::get( Smartcrawl_Service::SERVICE_SITE );
if ( ! is_admin() || $is_message_dismissed || $service->is_member() ) {
	return;
}
?>

<div id="wds-black-notice-content" class="notice">

	<div class="sui-wrap">

		<div class="wds-black-notice-header">

			<span class="wds-black-ribbon"><?php esc_html_e( '60% OFF', 'wds' ); ?></span>

			<h3 class="wds-black-title"><?php esc_html_e( 'Black Friday 60% OFF SmartCrawl Pro!', 'wds' ); ?></h3>

			<?php if ( $time_left ): ?>
				<div class="wds-black-timer-container">
					<p class="wds-black-timer-slogan"><?php esc_html_e( 'Limited Black Friday offer!', 'wds' ); ?></p>

					<div class="wds-black-timer">

						<div class="wds-black-time">

							<p><?php esc_html_e( 'Days', 'wds' ); ?></p>

							<?php $print_numbers( $time_left->d ); ?>
						</div>

						<span class="wds-black-timer-dots" aria-hidden="true"></span>

						<div class="wds-black-time">

							<p><?php esc_html_e( 'Hours', 'wds' ); ?></p>

							<?php $print_numbers( $time_left->h ); ?>
						</div>

						<span class="wds-black-timer-dots" aria-hidden="true"></span>

						<div class="wds-black-time">

							<p><?php esc_html_e( 'Minutes', 'wds' ); ?></p>

							<?php $print_numbers( $time_left->i ); ?>

						</div>

					</div>
				</div>
			<?php endif; ?>

		</div>

		<div class="wds-black-notice-body">

			<div class="wds-black-notice-content">

				<p><?php esc_html_e( 'Get SmartCrawl Pro for the lowest price you will ever see and improve your SEO!', 'wds' ); ?></p>

				<p class="wds-black-notice-statement"><?php esc_html_e( '*Only admin users can see this message', 'wds' ); ?></p>

			</div>

			<a href="https://premium.wpmudev.org/project/smartcrawl-wordpress-seo/?coupon=BF2020SMARTCRAWL&checkout=0&utm_source=smartcrawl&utm_medium=plugin&utm_campaign=smartcrawl_bf2020banner"
			   class="sui-button sui-button-blue" target="_blank">
				<?php esc_html_e( 'Get 60% OFF SmartCrawl Pro', 'wds' ); ?>
			</a>

			<button class="wds-black-notice-dismiss">
				<?php esc_html_e( 'Dismiss', 'wds' ); ?>
			</button>

		</div>
	</div>
</div>
