<script src=<?php echo base_url() . "/public/assets2/js/jquery-1.11.1.min.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/bootstrap.min.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/chart.min.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/chart-data.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/easypiechart.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/easypiechart-data.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/bootstrap-datepicker.js" ?>></script>
<script src=<?php echo base_url() . "/public/assets2/js/custom.js" ?>></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.bootstrap.min.js"></script> -->
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/vfs_fonts.js"></script> -->
<script src="<?php echo base_url() . "/public/assets3/script.js" ?>"></script>

<script>
	$(document).ready(function() {
		var lista_fechas = <?php
							if (!empty($fechas)) {
								echo $fechas;
							} else {
								echo json_encode([]);
							}
							?>;

		var lista_litros = <?php
							if (!empty($litros)) {
								echo $litros;
							} else {
								echo json_encode([]);
							}
							?>;
		var total = <?php
					if (!empty($total)) {
						echo $total;
					} else {
						echo json_encode(0);
					}
					?>;
		
		if(document.getElementById('totallitros')!=null){
			document.getElementById('totallitros').innerHTML=total;
		}
		var chartnuevo = {
			labels: lista_fechas,
			datasets: [{
					label: "Produccion de litros",
					fillColor: "rgba(48, 164, 255, 0.2)",
					strokeColor: "rgba(48, 164, 255, 1)",
					pointColor: "rgba(48, 164, 255, 1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(48, 164, 255, 1)",
					data: lista_litros
				}

			]

		}		

		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(chartnuevo, {
			responsive: true,
			scaleLineColor: "rgba(0,0,0,.2)",
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleFontColor: "#000000",

		});

	});
</script>

</body>

</html>