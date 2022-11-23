<?php
/**
 * Class Whj_Http_Requests
 * It is used for doing post request to third party API.
 * 
 * @package Whj_Http_Requests
 *
 */
use WP_Queue\Job;
use WHJ_Queue\Exceptions\Http_Exception;

/**
 *
 */
class Whj_Http_Requests extends Job {

	public $url;
	public $user_id;
	public $user_meta;
	public $args;

	/**
	 * Subscribe_User_Job constructor.
	 *
	 * @param int $user_id
	 */
	public function __construct( $url, $args = array(), $user_id = 0, $user_meta = '' ) {
		$this->url       = $url;
		$this->args      = $args;
		$this->user_id   = $user_id;
		$this->user_meta = $user_meta;
	}

	/**
	 * Handle job logic.
	 */
	public function handle() {
		$this->faill_status = false;
		$start_time         = time();
		$called_at 			= current_time('d-m-Y h:i:sa');
		$user_id            = $this->user_id;
		$user_meta          = $this->user_meta;
		$response           = wp_remote_post( $this->url, $this->args );
		$end_time           = time();
		$exec_time          = $end_time - $start_time;
		$response_code      = $response['response']['code'];
		if ( $user_id ) {
			update_user_meta( $user_id, "http_queue_{$user_meta}_req", wp_json_encode( $this->args ) );
			update_user_meta( $user_id, "http_queue_{$user_meta}_res", wp_json_encode( $response ) );
			$attempts = get_user_meta( $user_id, "http_queue_{$user_meta}_attempts", true );
			update_user_meta( $user_id, "http_queue_{$user_meta}_attempts", ( (int) $attempts + 1 ) );
			$status = ( $response_code == 200 ) ? 'success' : 'failure';
			update_user_meta( $user_id, "http_queue_{$user_meta}_status", $status );
			update_user_meta( $user_id, "http_queue_{$user_meta}_last_called_at", $called_at );
			update_user_meta( $user_id, "http_queue_{$user_meta}_last_exec_time", $exec_time );
		}
		if ( $response_code != 200 ) {
			throw new Http_Exception();
		}
	}
}
