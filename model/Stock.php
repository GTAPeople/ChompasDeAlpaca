<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock
 *
 * @author VARELA
 */
require_once '/../persistence/Persistence.php';
class Stock {
    private $_id;
    private $_quantity;
    private $_minimum;
    private $_unit;
    
    function __construct($_id="", $_quantity="", $_minimum="", $_unit="") {
        $this->_id = $_id;
        $this->_quantity = $_quantity;
        $this->_minimum = $_minimum;
        $this->_unit = $_unit;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_quantity() {
        return $this->_quantity;
    }

    public function get_minimum() {
        return $this->_minimum;
    }

    public function get_unit() {
        return $this->_unit;
    }

    public function executeQuery($sql,$tipo){
        $db= Persistence::getInstance();
        $select = $db->executeQuery($sql, $tipo);
        if($tipo==1){
            $list = array();
            foreach($select as $value){
                $_id = $value['id'];
                $_quantity= $value['quantity'];
                $_minimum = $value['minimum'];
                $_unit = $value['unit'];
                $list[]= new Stock($_id, $_quantity, $_minimum, $_unit);
            }
            return $list;
        }
    }
    
    public function getAll(){
        $sql = "SELECT * FROM  `stocks`";
        $list = $this->executeQuery($sql, 1);
        return $list;
    }
    
    public function insert($_quantity="", $_minimum="", $_unit=""){
        $sql = "INSERT INTO  `chompaalpaca`.`stocks` (`id` ,`quantity` ,`minimum` ,`unit`)
        VALUES (null,  '".$_quantity."',  '".$_minimum."',  '".$_unit."')";
        $this->executeQuery($sql, 0);
    }
    
    public function delete($_id){
        $sql="DELETE FROM `chompaalpaca`.`stocks` WHERE `stocks`.`id`= '".$_id."' ";
        $this->executeQuery($sql, 0);
    }

}

?>
