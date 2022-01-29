<div class="col-sm-8 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="panel panel-container">
            <h1>Reportes</h1>

            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Litros</th>
                        <th>N° Vacas</th>
                        <th>Horario</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($lista)) : ?>
                        <?php foreach ($lista as $item) : ?>
                            <tr>
                                <td>
                                    <?php echo $item['pglo_fecha'] ?>
                                </td>
                                <td>
                                    <?php echo $item['pglo_litros'] ?>
                                </td>
                                <td>
                                    <?php echo $item['pglo_numvacas'] ?>
                                </td>
                                <td>
                                    <?php echo $item['tbl_item']['ite_nombre'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Litros</th>
                        <th>N° Vacas</th>
                        <th>Horario</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>