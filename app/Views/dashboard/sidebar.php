<?php
$session = \Config\Services::session(); 
$datosU= $session->get('datosU');
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="<?php echo $datosU['per_imagen'] ?>" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo($datosU['per_nombre']." ".$datosU['per_apellido'])?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
        <li class="<?php echo $inicio ?>"><a href="<?php echo base_url()?>/DashboardController"><em class="fa fa-dashboard">&nbsp;</em> Inicio</a></li>
        <li class="<?php echo $produccionG ?>"><a href="<?php echo base_url()?>/ProduccionGController"><em class="fa fa-line-chart">&nbsp;</em> Producción Global</a></li>
        <li class="<?php echo $reportes ?>"><a href="<?php echo base_url()?>/ReportesController"><em class="fa fa-file-text">&nbsp;</em> Reportes</a></li>
<!--         <li><a href="#"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
        <li><a href="#"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                <em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
                    </a></li>
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
                    </a></li>
                <li><a class="" href="#">
                        <span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
                    </a></li>
            </ul>
        </li> -->
        <li><a href="<?php echo base_url()?>/DashboardController/cerrar_sesion"><em class="fa fa-power-off">&nbsp;</em> Cerrar Sesión</a></li>
    </ul>
</div>
<!--/.sidebar-->