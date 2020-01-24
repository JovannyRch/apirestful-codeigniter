<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CursosModel;

class Clientes extends Controller{
    
    public function Index(){
        $json = array('detail'=> 'Detalle no encontrado');
        echo json_encode($json,true);
    }

    public function Create(Request $request){
        $data = array(
            'titulo' => 'titulo',
            'descripcion' => 'descripcion',
            'instructor' => 'instructor',
            'imagen' => 'img',
            'precio' => 'precio'
        );

        $cursosModel = new CursosModel();
        $cursosModel->save($data);

        $json = array(
            'status' => 200,
            'detail' => 'Registro exitoso, su curso ha sido guardado'
        );

        return json_encode($json,true);
    }
}