<?php

namespace App\Controllers;

class ReportesController extends BaseController
{
    public function index()
    {
        $data = ['inicio' => '', 'produccionG' => '', 'reportes' => 'active'];
        echo view('dashboard/header');
        echo view('dashboard/sidebar',$data);
        echo view('reportes/reportePage');
        echo view('dashboard/footer');
    }
}