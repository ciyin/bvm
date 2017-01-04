<?php
/**
 * Created by PhpStorm.
 * User: liudanxia
 * Date: 2016/12/17
 * Time: 14:08
 */
require_once 'model/dml.php';
require_once 'configs/config.php';
class Action{
    public $model;
    public $smarty;
    function __construct(){
        $this->model = new DataModel(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        $this->model->setCharset();
        require_once 'libs/Smarty.class.php';
        $this->smarty= new Smarty();
        $this->smarty->setTemplateDir('templates/');
        $this->smarty->setCompileDir('templates_c/');
        $this->smarty->setConfigDir('configs/');
        $this->smarty->setCacheDir('cache/');
        $this->smarty->left_delimiter = '<{';
        $this->smarty->right_delimiter = '}>';
    }
}