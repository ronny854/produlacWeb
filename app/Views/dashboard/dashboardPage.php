<div class="col-sm-8 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Inicio</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bienvenido a Produlac</h1>
        </div>
    </div>
    <!--/.row-->

    <div class="panel panel-container">
        <div class="row">            
            
            <div class="col-xs-6 col-md-6 col-lg-6 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding">                    
                        <img src="<?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_imagen']; ?>" alt="">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding">
                        <div style="color:skyblue" >Nombre Finca:</div>
                        <div ><?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_nombre']; ?></div>
                        <div style="color:skyblue">Nombre Pais:</div>
                        <div ><?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_pais']; ?></div>
                        <div style="color:skyblue">Nombre Provincia:</div>
                        <div ><?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_provincia']; ?></div>
                        <div style="color:skyblue">Nombre Extension:</div>
                        <div ><?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_extension']; ?> m^2</div>
                        <div style="color:skyblue">Nombre Telefono:</div>
                        <div ><?php $session = \Config\Services::session(); $datos_finca=$session->get("DatosFinca"); echo $datos_finca['fin_telefono']; ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
