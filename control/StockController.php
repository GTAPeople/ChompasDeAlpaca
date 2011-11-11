<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StockController
 *
 * @author VARELA
 */
require_once '/../model/Stock.php';
class StockController {
    public function getAll() {
        try {
            $obj = new Stock();
            $list = $obj->getAll();
            return $list;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function insert($_id, $_quantity, $_minimum, $_unit)
    {
        $_id=null;
        $obj = new Stock();
        $obj->insert($_quantity, $_minimum, $_unit);
    }

    public function delete($id)
    {
        $obj = new Stock();
        $obj->delete($id);
    }
    
    public function update($_id, $_quantity, $_minimum, $_unit){
        $obj = new Stock();
        $obj->update($_id, $_quantity, $_minimum, $_unit);
    }

    public function searchById($id){
        try {
            $obj = new Stock();
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
