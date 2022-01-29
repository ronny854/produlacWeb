<?php

namespace App\Controllers;

class ReportesController extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();
        if (empty($session->get("datosU"))  || empty($session->get("token") )) {
            return redirect()->to(base_url());
        }
        $data = ['inicio' => '', 'produccionG' => '', 'reportes' => 'active'];

        $listaProduccionG= $this->apiReportes();
        //print_r($listaProduccionG);
        //return;
        $datosAEnviar= array('lista' => $listaProduccionG);
        echo view('dashboard/header');
        echo view('dashboard/sidebar', $data);
        echo view('reportes/reportePage',$datosAEnviar);
        echo view('dashboard/footer');
    }


    public function apiReportes()
    {
        $session = \Config\Services::session();
        if (empty($session->get("datosU"))  || empty($session->get("token") )) {
            return redirect()->to(base_url());
        }
        $fincas = $this->apiFincas();
        $listaFincas = [];
        foreach ($fincas as $finca) {
            if ($finca['tbl_finca'] != null) {
                array_push($listaFincas, $finca['tbl_finca']);
            }
        }

        //print_r($listaFincas[0]['fin_id']);
        //return;
        if ($listaFincas[0]['fin_id']!=0 && $listaFincas[0]['fin_id']!=null) {
            $opciones = array(
                'http' =>
                array(
                    'method'  => 'GET',
                    'header'  => array(
                        'Content-type: application/json',
                        'x-token: ' . $session->get('token')
                    ),
                    'ignore_errors' => true,
                    //'content' => json_encode($data)
                )
            );
    
            $contexto = stream_context_create($opciones);
            $resultado = file_get_contents('https://backend-produlac.herokuapp.com/api/prodGlobal/editar/'.$listaFincas[0]['fin_id'], false, $contexto);
            $status_line = $http_response_header[0];
    
            preg_match('{HTTP/\S*\s(\d{3})}', $status_line, $match);
            $status = $match[1];
            /*         print_r($status);
            print_r($resultado); */
            $resultado = json_decode($resultado, true);
    
            if ($status == 200) {
                return $resultado['dato'];
            } else {
                return $status;
            }
        }else{
            return [];
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
