<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainView
 *
 * @author VARELA
 */
require_once '../control/InputController.php';
require_once '../control/OrderController.php';
require_once '../control/ProductController.php';
require_once '../control/StockController.php';
abstract class MainView {
    public static function run(){
        if (!isset ($_POST['option'])) {
            self::_principalShow();
        }  else {
            $inputLogic= new InputController();
            $orderLogic= new OrderController();
            $productLogic= new ProductController();
            $stockLogic=new StockController();
            $option=$_POST['option'];
            switch ($option) {
                case '1':
                    $log=$productLogic->getAll();
                    foreach ($log as $value) {
                        $id1=$value->get_idInput();
                        $id2=$value->get_idStock();
                        $input=$inputLogic->searchById($id1);
                        $stock=$stockLogic->searchById($id2);
                        $list[]=array($value->get_name(),$input->get_name(),$stock->get_quantity(),$stock->get_minimum(),$stock->get_unit());
                    }
                    self::_stockListShow($list);
                    break;
                case '2':
                    self::_orderList($list);
                    break;
                case '3':
                    $i=0;
                    $error=null;
                    $list=$inputLogic->getAll();
                    self::_insertProduct($list,$i,$error);
                    break;
                case '4':
                    $i=0;
                    $log=$productLogic->getAll();
                    foreach ($log as $value) {
                        $id1=$value->get_idInput();
                        $id2=$value->get_idStock();
                        $input=$inputLogic->searchById($id1);
                        $stock=$stockLogic->searchById($id2);
                        $list[]=array($value->get_name(),$input->get_name(),$stock->get_quantity());
                    }
                    self::_shoppingList($list,$i);
                    break;
                case 'Volver':
                    self::_principalShow();
                    break;
                case 'Insertar':
                    $i=0;
                    $list=$inputLogic->getAll();
                    if(($_POST['name'])&&($_POST['quantity'])&&($_POST['minimum'])&&($_POST['unit'])){
                        $logS=$stockLogic->getAll();
                        $logP=$productLogic->getAll();
                        $_id=null;
                        $_name=$_POST['name'];
                        foreach ($logP as $value){
                            if($value->get_name()==$_name){
                                $rs[]=true;
                            }  else {
                                $rs[]=false;
                            }
                        }
                        if($rs[0]==false){
                            if (is_numeric($_POST['quantity'])&&is_numeric($_POST['minimum'])&&is_numeric($_POST['unit'])) {
                                    foreach ($logS as $value) {
                                        $idLastStock=$value->get_id();
                                    }
                                    $_idInput=$_POST['input'];
                                    $_idStock=$idLastStock+1;
                                    $_quantity=$_POST['quantity'];
                                    $_minimum=$_POST['minimum'];
                                    $_unit=$_POST['unit'];
                                    $productLogic->insert($_id, $_name, $_idInput, $_idStock);
                                    $stockLogic->insert($_id, $_quantity, $_minimum, $_unit);
                                    self::_insertMessage();
                                }  else {
                                $error='Los datos deben ser numericos';
                                self::_insertProduct($list,$i,$error);
                                }  
                        }else {
                            $error='El nombre de la chompa ya existe';
                            self::_insertProduct($list,$i,$error);                                
                        }                        
                    }  else {
                        $error='Falta llenar los datos';
                        self::_insertProduct($list,$i,$error);
                    }                    
                    break;
                case 'Comprar':
                    break;
                
            }
        }
    }
    private static function _principalShow(){
        require_once 'principal.html';
    }
    private static function _stockListShow($list){
        require_once 'stockList.html';
    }
    private static function _insertProduct($list,$i,$error){
        require_once 'insertProduct.html';
    }
    private static function _insertMessage(){
        require_once 'insertMessage.html';
    }
    private static function _orderList($list){
        require_once 'orderList.html';
    }
    private static function _shoppingList($list,$i){
        require_once 'shoppingList.html';
    }
}
MainView::run();
?>
