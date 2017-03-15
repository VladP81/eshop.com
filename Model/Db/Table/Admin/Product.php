<?php

class Model_Db_Table_Admin_Product extends System_Db_Table{

    protected $_name = 'product';

    public function getAll()
    {

        $sql    = 'select * from ' . $this->getName();

        $sth = $this->getConnection()->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $result;



    }


    public function create(){
//        $sql    = 'INSERT * INTO ' . $this->getName();
//
//        $sth = $this->getConnection()->prepare($sql);
//        $sth->execute();
//
//        $result = $sth->fetchAll(PDO::FETCH_OBJ);
//
//        return $result;
    }

    public function update($id) {
        $sql = 'UPDATE'.$this->getName().'WHERE id = '.$id;
        $sth = $this->getConnection()->prepare($sql);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    public function delete($id) {
        $sql = 'DELETE FROM'.$this->getName().'WHERE id = '.$id;
    }

}