<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = ['inicio' => 'active', 'produccionG' => '', 'reportes' => ''];
        $usuario=$this -> request -> getPost('usuario');
        $password=$this -> request -> getPost('pass');
        echo($usuario."".$password);
        $datosUser= array(
            'per_usuario' => $usuario,
            'per_contraseña' => $password
        );
        $resp= $this -> apiLogin($datosUser);


        if ($resp == null) {
            return redirect()->to(base_url());
        }else{
            $session = \Config\Services::session();
            $session -> set($resp);
        }
        print_r($resp);
        return ;
        echo view('dashboard/header');
        echo view('dashboard/sidebar',$data);
        echo view('dashboard/dashboardPage');
        echo view('dashboard/footer');
    }


    public function apiLogin($data){

        $opciones = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => array(
                    'Content-type: application/json',
                ),
        'ignore_errors' => true,
                'content' => json_encode($data)
            )
        );

        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://backend-produlac.herokuapp.com/api/login', false, $contexto);

        print_r($resultado);
        $resultado=json_decode($resultado,true); 
        
        if(!empty($resultado)){
            return $resultado;
        }else{
            return null;
        }
    }
}
