<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InputController
 *
 * @author VARELA
 */
require_once '/../model/Input.php';
class InputController {
    public function getAll() {
        try {
            $obj = new Input();
            $list = $obj->getAll();
            return $list;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function insert($_id, $_name)
    {
        $_id=null;
        $obj = new Input();
        $obj->insert($_name);
    }

    public function delete($id)
    {
        $obj = new Input();
        $obj->delete($id);
    }
    
    public function searchById($id){
        try {
            $obj = new Input();
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
