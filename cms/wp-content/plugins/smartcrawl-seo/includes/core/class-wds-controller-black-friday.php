<?php

class SmartCrawl_Controller_Black_Friday extends Smartcrawl_Base_Controller {
	const BLACK_FRIDAY_DISSMISS_KEY = 'black-friday-2020-modal';
	const BLACK_FRIDAY_DISSMISS_NOTICE_KEY = 'black-friday-2020-notice';
	/**
	 * Static instance
	 *
	 * @var self
	 */
	private static $_instance;

	/**
	 * Static instance getter
	 */
	public static function get() {
		if ( empty( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	protected function init() {
		add_action( 'wp_ajax_wds-black-friday-skip', array( $this, 'process_black_friday_skip' ) );
		add_action( 'wp_ajax_wds-black-friday-skip-notice', array( $this, 'process_black_friday_notice_skip' ) );
	}

	public function process_black_friday_skip() {
		$this->dismiss_notice( self::BLACK_FRIDAY_DISSMISS_KEY );
		wp_send_json_success();
	}

	public function process_black_friday_notice_skip() {
		$this->dismiss_notice( self::BLACK_FRIDAY_DISSMISS_NOTICE_KEY );
		wp_send_json_success();
	}

	public function dismiss_notice( $key ) {
		$dismissed_messages = get_user_meta( get_current_user_id(), 'wds_dismissed_messages', true );
		$dismissed_messages = empty( $dismissed_messages ) ? array() : $dismissed_messages;
		$dismissed_messages[ $key ] = true;
		update_user_meta( get_current_user_id(), 'wds_dismissed_messages', $dismissed_messages );
	}

	public function get_black_friday_modal() {
		$onboarding_done = Smartcrawl_Controller_Onboard::get()->onboarding_done();
		$service = Smartcrawl_Service::get( Smartcrawl_Service::SERVICE_SITE );
		if ( ! $onboarding_done || ! is_admin() || $service->is_member() ) {
			return '';
		}

		$dismissed_messages = get_user_meta( get_current_user_id(), 'wds_dismissed_messages', true );
		$is_message_dismissed = smartcrawl_get_array_value( $dismissed_messages, self::BLACK_FRIDAY_DISSMISS_KEY ) === true;
		if ( $is_message_dismissed ) {
			return '';
		}

		return Smartcrawl_Simple_Renderer::load( 'black-friday/black-friday-modal' );
	}

	public function get_time_left() {
		$deadline_date = date_create( '2020-11-28T00:00:00', new DateTimeZone( '-0400' ) );
		$current_date = date_create( date( 'Y-m-d H:i:s' ), new DateTimeZone( '-0000' ) );

		return $deadline_date > $current_date
			? $deadline_date->diff( $current_date )
			: false;
	}
}
