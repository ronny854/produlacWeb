<div class="col-sm-8 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <label for="start">Inicio:</label>
                 <form action="<?php echo base_url('ProduccionGController/apiFincaEstadisticas')?>" method="post">

                 <input type="date" name="inicioFecha" id="inicioFecha">
                <label for="start">Fin:</label>
                <input type="date" name="finFecha" id="finFecha">
                <button type="submit">Generar Cuadro</button>
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