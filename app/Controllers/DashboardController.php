<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    public function index()
    {
        $data = ['inicio' => 'active', 'produccionG' => '', 'reportes' => ''];
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('pass');
        //echo ($usuario . "" . $password);
        $datosUser = array(
            'per_usuario' => $usuario,
            'per_contraseña' => $password
        );
        $resp = $this->apiLogin($datosUser);


        if ($resp == 401 || $resp == 400) {
            return redirect()->to(base_url());
        } else {
            if ($resp['dato'][0]['rol_id'] == 3 || $resp['dato'][0]['rol_id'] == 1) {
                return redirect()->to(base_url());
            } else {
                $session = \Config\Services::session();
                $arrayDatos = $resp['dato'][0];
                $session->set('datosU', $arrayDatos);
                $session->set('token', $resp['token']);
                //$datosU = $session->get('token');
                //print_r($datosU);
                //return;
                echo view('dashboard/header');
                echo view('dashboard/sidebar', $data);
                echo view('dashboard/dashboardPage');
                echo view('dashboard/footer');
            }
        }
    }


    public function apiLogin($data)
    {

        $opciones = array(
            'http' =>
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
        $status_line = $http_response_header[0];

        preg_match('{HTTP/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        /*         print_r($status);
        print_r($resultado); */
        $resultado = json_decode($resultado, true);

        if ($status == 200) {
            return $resultado;
        } else {
            return $status;
        }
    }
}
