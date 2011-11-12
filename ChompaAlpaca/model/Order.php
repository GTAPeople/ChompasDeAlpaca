<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Orders
 *
 * @author VARELA
 */
require_once '/../persistence/Persistence.php';
class Order {
    private $_id;
    private $_orderDate;
    private $_detail;
    
    function __construct($_id="", $_orderDate="",$_detail="") {
        $this->_id = $_id;
        $this->_orderDate = $_orderDate;
        $this->_detail=$_detail;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_orderDate() {
        return $this->_orderDate;
    }
    
    public function get_detail() {
        return $this->_detail;
    }

    public function executeQuery($sql,$tipo){
        $db= Persistence::getInstance();
        $select = $db->executeQuery($sql, $tipo);
        if($tipo==1){
            $list = array();
            foreach($select as $value){
                $_id = $value['id'];
                $_orderDate= $value['orderDate'];
                $_detail=$value['detail'];
                $list[]= new Order($_id, $_orderDate, $_detail);
            }
            return $list;
        }
    }
    
    public function getAll(){
        $sql = "SELECT * FROM  `orders`";
        $list = $this->executeQuery($sql, 1);
        return $list;
    }
    
    public function insert($_orderDate, $_detail){
        $sql = "INSERT INTO  `chompaalpaca`.`orders` (`id` ,`orderDate`,`detail`)
        VALUES (null,  '".$_orderDate."','". $_detail."')";
        $this->executeQuery($sql, 0);
    }
    
    public function delete($_id){
        $sql="DELETE FROM `chompaalpaca`.`orders` WHERE `orders`.`id`= '".$_id."' ";
        $this->executeQuery($sql, 0);
    }

}

?>
