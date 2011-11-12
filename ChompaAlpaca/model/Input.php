<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Input
 *
 * @author VARELA
 */
require_once '/../persistence/Persistence.php';
class Input {
    private $_id;
    private $_name;
    
    function __construct($_id="", $_name="") {
        $this->_id = $_id;
        $this->_name = $_name;
    }
    
    public function get_id() {
        return $this->_id;
    }

    public function get_name() {
        return $this->_name;
    }
    
    public function executeQuery($sql,$tipo){
        $db= Persistence::getInstance();
        $select = $db->executeQuery($sql, $tipo);
        if($tipo==1){
            $list = array();
            foreach($select as $value){
                $_id = $value['id'];
                $_name= $value['name'];
                $list[]= new Input($_id, $_name);
            }
            return $list;
        }
    }
    
    public function getAll(){
        $sql = "SELECT * FROM  `inputs`";
        $list = $this->executeQuery($sql, 1);
        return $list;
    }
    
    public function insert($_name){
        $sql = "INSERT INTO  `chompaalpaca`.`inputs` (`id` ,`name`)
        VALUES (null,  '".$_name."')";
        $this->executeQuery($sql, 0);
    }
    
    public function delete($_id){
        $sql="DELETE FROM `chompaalpaca`.`inputs` WHERE `inputs`.`id`= '".$_id."' ";
        $this->executeQuery($sql, 0);
    }

}

?>
