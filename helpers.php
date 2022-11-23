<?php

function whj_remote_post_job( $url, $args = array(), $user_id = 0, $user_meta = '', $attempts = WHJ_DEFAULT_ATTEMPTS ) {
	$job = new Whj_Http_Requests( $url, $args, $user_id, $user_meta );
	$job->set_attempts( $attempts );
	wp_queue()->push( $job, '-36000' ); // to change the priority which is executed 1st.
	return true;
}