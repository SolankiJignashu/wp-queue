<?php
$base_dir = plugin_dir_path(__FILE__) . 'Exceptions/';
$exceptions_files = ['http'=> 'class-http-exception.php'];
$exceptions_files = apply_filters( 'add_whj_queue_exception', $exceptions_files );
foreach( $exceptions_files as $file ) {
    require_once $base_dir.$file;
}
