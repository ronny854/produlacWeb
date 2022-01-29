<?php

namespace App\Controllers;

class ProduccionGController extends BaseController
{
    public function index()
    {
        $data = ['inicio' => '', 'produccionG' => 'active', 'reportes' => ''];
        echo view('dashboard/header');
        echo view('dashboard/sidebar', $data);
        echo view('produccionGlobal/produccionGlobalPage');
        echo view('dashboard/footer');
    }

    public function apiFincaEstadisticas()
    {
        $session = \Config\Services::session();

        $fechaInicio = $this->request->getPost('inicioFecha');
        $fechaFin = $this->request->getPost('finFecha');
        $finId = $this->apiFinId();
        $enviarDatos = array(
            'fin_id' => $finId,
            'fecha_inicio' => $fechaInicio,
            'fecha_fin' => $fechaFin,
        );
        $opciones = array(
            'http' =>
            array(
                'method'  => 'POST',
                'header'  => array(
                    'Content-type: application/json',
                    'x-token: ' . $session->get('token')
                ),
                'ignore_errors' => true,
                'content' => json_encode($enviarDatos)
            )
        );
        //$datosU = $session->get('datosU');
        $contexto = stream_context_create($opciones);
        $resultado = file_get_contents('https://backend-produlac.herokuapp.com/api/prodGlobal/fechas', false, $contexto);
        $status_line = $http_response_header[0];

        preg_match('{HTTP/\S*\s(\d{3})}', $status_line, $match);
        $status = $match[1];
        // print_r($status);
        
        $resultado = json_decode($resultado, true);
        //print_r($resultado);
        
        $data = ['inicio' => '', 'produccionG' => 'active', 'reportes' => ''];
        if ($status == 200) {
            if (count($resultado['dato']) >= 1) {
                //return json_encode($resultado['dato']);
                $datosEnv = array('lista'=> $resultado['dato']);
                echo view('dashboard/header');
                echo view('dashboard/sidebar', $data);
                echo view('produccionGlobal/produccionGCuadro',$datosEnv);
                echo view('dashboard/footer');
            } else {
                //return json_encode([]);
                echo view('dashboard/header');
                echo view('dashboard/sidebar', $data);
                echo view('produccionGlobal/produccionGlobalPage');
                echo view('dashboard/footer');
            }
        } else {
            //return json_encode([]);
            echo view('dashboard/header');
            echo view('dashboard/sidebar', $data);
            echo view('produccionGlobal/produccionGlobalPage');
            echo view('dashboard/footer');
        }
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
            return $listaFincas[0]['fin_id'];
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
