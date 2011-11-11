<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OrderController
 *
 * @author VARELA
 */
require_once '/../model/Order.php';
class OrderController {
    public function getAll() {
        try {
            $obj = new Order();
            $list = $obj->getAll();
            return $list;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function insert($_id, $_orderDate)
    {
        $_id=null;
        $obj = new Order();
        $obj->insert($_orderDate);
    }

    public function delete($id)
    {
        $obj = new Order();
        $obj->delete($id);
    }
    
    public function searchById($id){
        try {
            $obj = new Order();
            $list = $obj->getAll();
            $array=array();
            foreach($list as $row){
                if($row->get_id() == $id){
                    $array[]=$row;
                }
            }
            return $array[0];
        } catch (Exception $exc) {
            throw $e;
        }
    }
}

?>
