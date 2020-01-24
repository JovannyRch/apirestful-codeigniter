<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CursosModel;




class Cursos extends Controller{
    
    public function Index(){
        $cursosModel = new CursosModel();
        $cursos = $cursosModel->findAll();

        //Usando querys normales
        /*
        $db = \Config\Database::connect();
        $query = $db->query('sql');
        $results = $query->getResult();
        */  

        $pager = \Config\Services::pager();
      
        if(sizeof($cursos) > 0){
            $json = array(
                'status' => 200,
                'cantidad' => sizeof($cursos),
                'data' => $cursosModel->paginate(2),
                'pager' => $cursosModel->pager
            );
        }else{
            $json = array(
                'status' => 400,
                'cantidad' => 0,
                'detail' => 'Ningun mensaje cargado'
            );
            
        }

        return json_encode($json,true);
    }

    public function Create(){
        $request = \Config\Services::request();
        $data = array(
            'titulo' => $request->getVar('titulo'),
            'descripcion' => $request->getVar('descripcion'),
            'instructor' => $request->getVar('instructor'),
            'imagen' => $request->getVar('imagen'),
            'precio' => $request->getVar('precio')
        );
        try {
        $cursosModel = new CursosModel();
        $cursosModel->save($data);
        $json = array(
            'status' => 200,
            'detail' => 'Registro exitoso, su curso ha sido guardado'
        );
        return json_encode($json,true);
       } catch (\Throwable $th) {
           echo "error";
       }

    }

    //Mostrar un registro
    public function show($id){
        
        $cursosModel = new CursosModel();
        $curso = $cursosModel->find($id);

        $json = array(
            'status' => 200,
            'data' => $curso
        );

        return json_encode($json,true);
    }

    //Editar un registrp
    public function update($id){
        $request = \Config\Services::request();
        $cursosModel = new CursosModel();
        $data = $this->request->getRawInput();
        $cursosModel->update($id,$data);
        $json = array(
            'status' => 200,
            'detail' => 'Su curso ha sido actualizado'
        );

        echo json_encode($json,true);
    }


    //Borrar registro
    public function delete($id){
        $cursosModel = new CursosModel();
        $curso = $cursosModel->find($id);
     
        if(!empty($curso)){
            $cursosModel->delete($id);
            $json = array(
                'status' => 200,
                'El registro ha sido eliminado con exito'
            );
        }else{
            $json = array(
                'status' => 400,
                'El registro no existe'
            );
        }

        echo json_encode($json,true);
    }
}