<?php
require('lib/smarty/Smarty.class.php');
/**
 * @access public
 * @package View
 */

class VBaseView extends Smarty {
    public function __construct() {
        parent::__construct();

        $this->setTemplateDir('smarty/templates');
        $this->setCompileDir('smarty/templates_c');
        $this->setCacheDir('smarty/cache');
        $this->setConfigDir('smarty/configs');

        $this->assign('app_name', 'RunMe.');

        $u = USession::get('user');
        $this->assign('user',$u);
    }
}