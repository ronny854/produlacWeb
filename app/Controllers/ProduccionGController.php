<?php

namespace App\Controllers;

class ProduccionGController extends BaseController
{
    public function index()
    {
        $data = ['inicio' => '', 'produccionG' => 'active', 'reportes' => ''];
        echo view('dashboard/header');
        echo view('dashboard/sidebar',$data);
        echo view('produccionGlobal/produccionGlobalPage');
        echo view('dashboard/footer');
    }
}