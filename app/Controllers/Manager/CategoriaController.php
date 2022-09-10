<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Services\CategoriaService;
use CodeIgniter\Config\Factories;


class CategoriaController extends BaseController
{
    
    private $categoriaService;

    public function __construct(){
        $this->categoriaService = Factories::class(CategoriaService::class);
    }
    
    public function index()
    {
        $data = [
            'title' => 'Categorias'
        ];
        return view('Manager/Categorias/index', $data);
    }

    public function getAllCategorias(){
        if (!$this->request->isAJAX()){
            return rediret()->back();
        }

        return $this->response->setJSON(['data'=> $this->categoriaService->getAllCategorias()]);
    }

    public function getCategoriasInfo(){
        if (!$this->request->isAJAX()){
            return rediret()->back();
        }

        $options = [
            'class' => 'form-control',
            'placeholder' => 'Escolha...',
            'selected' => !(empty($categoria->categoria_id))
        ];
        //exit($this->request->getGet('id'));
        //return $this->response->setJSON(['data'=> $this->categoriaService->getAllCategorias()]);
        $categoria = $this->categoriaService->getCategoria($this->request->getGetPost('id'));
        $response = [
            'categoria' => $categoria,
            'parents' => $this->categoriaService->getMultinivel('categoria_id', $options)
        ];
        return $this->response->setJSON($response);
    }

    public function update(){
        /**
         * @todo validar form
         */
        
        $categoria = $this->categoriaService->getCategoria($this->request->getGetPost('id'));
        $categoria->fill($this->removeSpoofingFromRequest());
        $this->categoriaService->trySaveCategoria($categoria);
        return $this->response->setJSON(['success' => true, 'token' => csrf_hash()]);
    }
}
