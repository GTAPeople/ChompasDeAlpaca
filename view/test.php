<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../model/Stock.php';
require_once '../control/StockController.php';
require_once '../control/ProductController.php';
    $obj=new Stock();
    $sql = "SELECT * FROM  `stocks`";
    //$list=$obj->executeQuery($sql, 1);
    //$list=$obj->getAll();
    //$logic=new StockController();
    //$list=$logic->getAll();
    $logic=new ProductController();
    $list=$logic->getAll();
    echo var_dump($list);
?>
