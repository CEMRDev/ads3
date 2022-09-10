<?php

namespace App\Services;
use App\Models\CategoriaModel;
use CodeIgniter\Config\Factories;


class CategoriaService{
    private $categoriaModel;
    
    public function __construct(){
        $this->categoriaModel = Factories::models(CategoriaModel::class);
    }

    public function getAllCategorias():array{
        $categorias = $this->categoriaModel->asObject()->orderBy('id','DESC')->findAll();
    
        $data = [];

        foreach($categorias as $categoria){

            $btnEdit = form_button(
                [
                    'data-id' => $categoria->id,
                    'id' => 'updateCategoryBtn', //id eelemento html
                    'class' => 'btn btn-primary btn-sm'
                ],
                'Editar'
            );

            $btnArchive = form_button(
                [
                    'data-id' => $categoria->id,
                    'id' => 'archiveCategoryBtn', //id eelemento html
                    'class' => 'btn btn-info btn-sm'
                ],
                'Arquivar'
        );

            $data[] = [
                'id' => $categoria->id,
                'name' => $categoria->name,
                'slug' => $categoria->slug,
                'action' => $btnEdit. ' ' .$btnArchive,
            ];
    }

    return $data;
    }

    public function getCategoria(int $id, bool $withDeleted = false){
        $categoria = $this->categoriaModel->withDeleted($withDeleted)->find($id);
        if (is_null($categoria)){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Categoria não encontrada');
        }

        return $categoria;
    }


    public function getMultinivel(string $name, $options = [])
    {

        $array = $this->categoriaModel->asArray()->orderBy('id', 'DESC')->findAll();

        $class_form = "";
        if (isset($options['class'])) {
            $class_form = $options['class'];
        }

        $selected = [];


        if (isset($options['selected'])) {
            $selected = is_array($options['selected']) ? $options['selected'] : [$options['selected']];
        }

        if (isset($options['placeholder'])) {
            $placeholder = [
                'id' => '',
                'name' => $options['placeholder'],
                'parent_id' => 0
            ];
            $array[] = $placeholder;
        }

        $multiple = '';
        if (isset($options['multiple'])) {
            $multiple = 'multiple';
        }

        $select = '<select class="' . $class_form . '" name="' . $name . '" ' . $multiple . '>';
        $select .= $this->getMultiLevelOptions($array, 0, [], $selected);
        $select .= '</select>';

        return $select;
    }


    public function getMultiLevelOptions(array $array, $parent_id = 0, $parents = [], $selected = [])
    {
        static $i = 0;
        if ($parent_id == 0) {
            foreach ($array as $element) {
                if (($element['parent_id'] != 0) && !in_array($element['parent_id'], $parents)) {
                    $parents[] = $element['parent_id'];
                }
            }
        }

        $menu_html = '';
        foreach ($array as $element) {
            $selected_item = '';
            if ($element['parent_id'] == $parent_id) {
                if (in_array($element['id'], $selected)) {
                    $selected_item = 'selected';
                }
                $menu_html .= '<option value="' . $element['id'] . '" ' . $selected_item . '>';
                for ($j = 0; $j < $i; $j++) {
                    $menu_html .= '&mdash; ';
                }
                $menu_html .= $element['name'] . '</option>';
                if (in_array($element['id'], $parents)) {
                    $i++;
                    $menu_html .= $this->getMultilevelOptions($array, $element['id'], $parents, $selected);
                }
            }
        }

        $i--;
        return $menu_html;
    }

    public function trySaveCategoria(Categoria $categoria, bool $protected = true)
    {
        try{
            if($categoria->hasChanged()){
                $this->categoriaModel->protected($protected)->save($categoria);
                
            }
        } catch (\Exception $e){
            die($e->getMessage());

        }
    }

}