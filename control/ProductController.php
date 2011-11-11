<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProductController
 *
 * @author VARELA
 */
require_once '/../model/Product.php';
class ProductController {
    public function getAll() {
        try {
            $obj = new Product();
            $list = $obj->getAll();
            return $list;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function insert($_id, $_name, $_idInput, $_idStock)
    {
        $_id=null;
        $obj = new Product();
        $obj->insert($_name, $_idInput, $_idStock);
    }

    public function delete($id)
    {
        $obj = new Product();
        $obj->delete($id);
    }
    
    public function searchById($id){
        try {
            $obj = new Product();
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
