<div class="col-sm-8 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-5"></div>
            <div class="panel panel-default">
                <?php $session = \Config\Services::session();
                if (!empty($session->getFlashdata('mensaje'))) :           ?>
                    <div class="alert alert-info" role="alert">
                        <?php echo  $session->getFlashdata('mensaje');       ?>
                    </div>
                <?php endif;  ?>
                <form action="<?php echo base_url('ProduccionGController/apiFincaEstadisticas') ?>" method="post">

                    <div class="row align-items-end">
                        <div class="col-md-12">
                            <label for="start">Inicio:</label><br>
                            <input class="form-control" type="date" name="inicioFecha" id="inicioFecha"><br>
                            <label for="start">Fin:</label><br>
                            <input class="form-control" type="date" name="finFecha" id="finFecha"><br><br>
                            <div class="col-md-5"></div>
                            <button type="submit" class="btn btn-primary">Generar Cuadro</button>
                        </div>
                    </div>
                </form>

                <!--                 <div class="panel-heading">
                    Producción Global de litros de leche

                    <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
                </div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>