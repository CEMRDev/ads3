<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableCategorias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            
            'categoria_id' =>[
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],

            'nome' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'slug' =>[
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],

            'dt_criacao' =>[
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],

            'dt_atualiza' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],

            'dt_delete' =>[
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
        ]);

        $this->forge->addKey('id', true); //primary key
        $this->forge->addKey('slug');
        $this->forge->addKey('categoria_id');
        $this->forge->createTable('categorias');
    }

    public function down()
    {
        $this_forge->dropTable('categorias');
    }
}
