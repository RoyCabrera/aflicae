<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$hook['post_controller_constructor'] = array(
    'class'    => 'Acl',
    'function' => 'auth',
    'filename' => 'Acl.php',
    'filepath' => 'hooks'
    );
