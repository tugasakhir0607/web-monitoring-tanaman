<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template {
    protected $_CI;

    function __construct() {
        $this->_CI = &get_instance();
    }

    function template_admin($template, $data = null) {
        $data['content'] = $this->_CI->load->view($template, $data, true);
        $this->_CI->load->view('admin/template_admin', $data);
    }
}
