<?php

class Model_Admin_Product{

    public $SKU;
    public $name;
    public $description;
    public $img;
    public $price;
    public $total;

    public static function getAll(){
        $dbproduct = new Model_Db_Table_Admin_Product();
        $productData = !empty($dbproduct->getAll())? $dbproduct->getAll() : '';
        if(!empty($productData)) {

            return $productData;
        }
        else {
            throw new Exception('Products not found', /*System_Exception::NOT_FOUND*/23);
        }
    }

}