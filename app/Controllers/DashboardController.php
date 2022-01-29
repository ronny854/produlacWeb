<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    
    public function index()
    {
        $session = \Config\Services::session();
        $data = ['inicio' => 'active', 'produccionG' => '', 'reportes' => ''];
        if ($session->get("datosU") != null && $session->get("token") != null) {
            echo view('dashboard/header');
            echo view('dashboard/sidebar', $data);
            echo view('dashboard/dashboardPage');
            echo view('dashboard/footer');
        } else {
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

                    $arrayDatos = $resp['dato'][0];
                    $session->set('datosU', $arrayDatos);
                    $session->set('token', $resp['token']);
                    $fin_id= $this->apiFinId();
                    $session->set('fin_id', $fin_id['fin_id']);
                    $session->set('DatosFinca', $fin_id);
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


    public function cerrar_sesion(){
        $session = \Config\Services::session();
        $session->destroy();
        $session->set("datosU",null);
        $session->set("token",null);
        return redirect()->to(base_url());
    }

    public function apiFinId()
    {
        //$session = \Config\Services::session();
        $fincas = $this->apiFincas();
        $listaFincas = [];
        foreach ($fincas as $finca) {
            if ($finca['tbl_finca'] != null) {
                array_push($listaFincas, $finca['tbl_finca']);
            }
        }

        //print_r($listaFincas[0]['fin_id']);
        //return;
        if ($listaFincas[0]['fin_id'] != 0 && $listaFincas[0]['fin_id'] != null) {
            return $listaFincas[0];
        } else {
            return 0;
        }
    }

    public function apiFincas()
    {
        $session = \Config\Services::session();
        $opciones = array(
            'http' =>
            array(
                'method'  => 'GET',
                'header'  => array(
                    'Content-type: application/json',
                    'x-token: ' . $session->get('token')
                ),
                'ignore_errors' => true,
                // 'content' => json_encode($data)
            )
        );
        $datosU = $session->get('datosU');
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://backend-produlac.herokuapp.com/api/fincaPersona/fincasPorPersona/' . $datosU['per_id'], false, $contexto);
        $status_line = $http_response_header[0];

        preg_match('{HTTP/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        // print_r($status);
        //print_r($resultado);
        $resultado = json_decode($resultado, true);

        if ($status == 200) {
            if (count($resultado['dato']) >= 1) {
                return $resultado['dato'];
            } else {
                return [];
            }
        } else {
            return [];
        }
    }
}
