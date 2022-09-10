<?php

namespace App\Models;

use App\Entities\Categoria;

class CategoriaModel extends MyBaseModel
{
    protected $DBGroup          = 'default';
    protected $table            = 'categorias';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = Categoria::class;
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'parent_id',
        'name',
        'slug',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'dt_criacao';
    protected $updatedField  = 'dt_atualiza';
    protected $deletedField  = 'dt_delete';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['escapeDataXSS'];
    protected $beforeUpdate   = ['escapeDataXSS'];
    
}
