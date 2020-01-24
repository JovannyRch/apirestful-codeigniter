<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ClientesModel;


class Registro extends Controller{
    
    public function Index(){
        echo "Bienvenido a Registro";
    }
    //Crear un registro
    public function Create(){
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        //Obtención de datos
        $datos = array(
            'nombre' => $request->getVar('nombre'),
            'apellido' => $request->getVar('apellido'),
            'email' => $request->getVar('email')
        );
        $datos['id_cliente'] = crypt($datos['nombre'].$datos['apellido'].$datos['email'], '$2a$07$holaatodos$');
        $datos['llave_secreta'] = crypt($datos['email'].$datos['apellido'].$datos['nombre'], '$2a$07$holaatodos$');
        $datos['id_cliente'] = str_replace('$','a',$datos['id_cliente']);
        $datos['llave_secreta'] = str_replace('$','o',$datos['llave_secreta']);
        
        $clientesModel = new ClientesModel();
        $clientesModel->save($datos);
        $json = array(
            'status' => 200,
            'datail' => 'Se ha creado con exito el registro del usuario',
            'credenciasles'=> array('id_cliente' => $datos['id_cliente'], 'llave_secreta' => $datos['llave_secreta'])
        );
        return json_encode($json,true);
    }
}