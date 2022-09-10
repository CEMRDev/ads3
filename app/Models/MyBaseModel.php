<?php

namespace App\Models;
use CodeIgniter\Model;

class MyBaseModel extends Model{
    public function __construct(){
        parent::__construct(); //construtor do model
    }

    protected function escapeDataXSS(array $data){
        return esc($date);
    }

    protected function setSQLMode(){
        $this->db->simpleQuery("set session sql_mode=''");
    }
}