<?php

namespace App\Controllers;

class ProduccionGController extends BaseController
{
    
    public function index()
    {
        $session = \Config\Services::session();
        if (empty($session->get("datosU"))  || empty($session->get("token") )) {
            return redirect()->to(base_url());
        }
        $data = ['inicio' => '', 'produccionG' => 'active', 'reportes' => ''];
        echo view('dashboard/header');
        echo view('dashboard/sidebar', $data);
        echo view('produccionGlobal/produccionGlobalPage');
        echo view('dashboard/footer');
    }

    public function apiFincaEstadisticas()
    {
        $session = \Config\Services::session();
        if (empty($session->get("datosU"))  || empty($session->get("token") )) {
            return redirect()->to(base_url());
        }

        $fechaInicio = $this->request->getPost('inicioFecha');
        $fechaFin = $this->request->getPost('finFecha');

        if(empty($fechaInicio)||empty($fechaFin)){
            return redirect()->to(base_url("/ProduccionGController"));
        }

        if ($fechaInicio != "" && $fechaFin != "") {
            $fechaInicio = date("Y-m-d", strtotime($fechaInicio));
            $fechaFin = date("Y-m-d", strtotime($fechaFin));
            if ($fechaInicio > $fechaFin) {
                $fecha_aux = $fechaInicio;
                $fechaInicio = $fechaFin;
                $fechaFin = $fecha_aux;
            }
        }

        $finId = $session->get('fin_id');
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
                $datosEnv =$this->cargar_arrays($fechaInicio, $fechaFin, $resultado['dato']);               
                echo view('dashboard/header');
                echo view('dashboard/sidebar', $data);
                echo view('produccionGlobal/produccionGCuadro', $datosEnv);
                echo view('dashboard/footer');
            } else {
                $session->setFlashdata('mensaje', 'No hay datos en las fechas seleccionadas Inicio: '.$fechaInicio."   Fin: ".$fechaFin);
                return redirect()->to(base_url("/ProduccionGController"));
            }
        } else {
            return redirect()->to(base_url("/ProduccionGController"));
        }
    }

    public function cargar_arrays($fecha_inicio, $fecha_fin, $array)
    {
        
        $array_fechas = [];
        $array_litros = [];
        $cantidad_total_litros = 0;
        while ($fecha_inicio <= $fecha_fin) {
            array_push($array_fechas, $fecha_inicio);
            $fecha_inicio = date("Y-m-d", strtotime($fecha_inicio . "+ 1 days"));
        }
        
        $agregar_litros_array = 0;
        foreach ($array_fechas as $value) {
            $agregar_litros_array = 0;
            foreach ($array as $item) {
                if ($value == $item['pglo_fecha']) {
                    $agregar_litros_array = $item['sum_pglo_litros'];
                    $cantidad_total_litros=$cantidad_total_litros+$item['sum_pglo_litros'];
                    break;
                } else{
                    $agregar_litros_array = 0;
                }
            }
            array_push($array_litros, $agregar_litros_array);
        }        
        
        $retornar_valores=array(
            "fechas"=>json_encode($array_fechas),
            "litros"=>json_encode($array_litros),
            "total"=>json_encode($cantidad_total_litros),
        );
        return $retornar_valores;
    }
}
