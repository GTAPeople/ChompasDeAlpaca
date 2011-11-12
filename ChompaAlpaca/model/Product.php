<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Product
 *
 * @author VARELA
 */
require_once '/../persistence/Persistence.php';
class Product {
    private $_id;
    private $_name;
    private $_idInput;
    private $_idStock;
    
    function __construct($_id="", $_name="", $_idInput="", $_idStock="") {
        $this->_id = $_id;
        $this->_name = $_name;
        $this->_idInput = $_idInput;
        $this->_idStock = $_idStock;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_name() {
        return $this->_name;
    }

    public function get_idInput() {
        return $this->_idInput;
    }

    public function get_idStock() {
        return $this->_idStock;
    }
  
    public function executeQuery($sql,$tipo){
        $db= Persistence::getInstance();
        $select = $db->executeQuery($sql, $tipo);
        if($tipo==1){
            $list = array();
            foreach($select as $value){
                $_id = $value['id'];
                $_name= $value['name'];
                $_idInput = $value['idInput'];
                $_idStock = $value['idStock'];
                $list[]= new Product($_id, $_name, $_idInput, $_idStock);
            }
            return $list;
        }
    }
    
    public function getAll(){
        $sql = "SELECT * FROM  `products`";
        $list = $this->executeQuery($sql, 1);
        return $list;
    }
    
    public function insert($_name, $_idInput, $_idStock){
        $sql = "INSERT INTO  `chompaalpaca`.`products` (`id` ,`name` ,`idInput` ,`idStock`)
        VALUES (null,  '".$_name."',  '".$_idInput."',  '".$_idStock."')";
        $this->executeQuery($sql, 0);
    }
    
    public function delete($_id){
        $sql="DELETE FROM `chompaalpaca`.`products` WHERE `products`.`id`= '".$_id."' ";
        $this->executeQuery($sql, 0);
    }
}

?>
