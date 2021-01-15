<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'] = array(
    'class'     => 'Log',
    'function'  => 'checkPermission',
    'filename'  => 'Log.php',
    'filepath'  => 'hooks'
);