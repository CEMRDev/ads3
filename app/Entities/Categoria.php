<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Categoria extends Entity
{
    protected $datamap = [];
    //protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $dates   = ['dt_criacao', 'dt_atualiza', 'dt_delete'];
    protected $casts   = [];
}
