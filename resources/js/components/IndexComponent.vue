<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
		<h3 class="h3 mb-4 text-gray-800">Documentos pendientes de adjuntar</h3>
		<div class="row">
			<div class="col-xl-3 col-md-3 mb-3">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': oficiosPendientes == 0, 'border-left-danger shadow h-100 py-2': oficiosPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									<router-link :to="{name: 'oficios'}">Oficios</router-link>
								</div>
								<div class="h4 mb-0 font-weight-bold text-gray-800">{{oficiosPendientes}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': dictamenesPendientes == 0, 'border-left-danger shadow h-100 py-2': dictamenesPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									<router-link :to="{name: 'dictamenes'}">Dictámenes</router-link>
								</div>
								<div class="h4 mb-0 font-weight-bold text-gray-800">{{dictamenesPendientes}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': memorandumsPendientes == 0, 'border-left-danger shadow h-100 py-2': memorandumsPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'memorandums'}">Memorándum</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h4 mb-0 mr-3 font-weight-bold text-gray-800">{{memorandumsPendientes}}</div>
									</div>
									<!--div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div-->
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': providenciasPendientes == 0, 'border-left-danger shadow h-100 py-2': providenciasPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'providencias'}">Providencias</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h4 mb-0 mr-3 font-weight-bold text-gray-800">{{providenciasPendientes}}</div>
									</div>
									<!--div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div-->
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<h3 class="h3 mb-4 mt-5 text-gray-800">Documentos de este año ({{year}})</h3>
		<div class="row">
			<div class="col-xl-3 col-md-3 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									<router-link :to="{name: 'oficios'}">Oficios</router-link>
								</div>
								<div class="h4 mb-0 font-weight-bold text-gray-800">{{reporte.oficios}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									<router-link :to="{name: 'dictamenes'}">Dictámenes</router-link>
								</div>
								<div class="h4 mb-0 font-weight-bold text-gray-800">{{reporte.dictamenes}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'memorandums'}">Memorándum</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h4 mb-0 mr-3 font-weight-bold text-gray-800">{{reporte.memorandums}}</div>
									</div>
									<!--div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div-->
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-xl-3 col-md-3 mb-3">
				<div class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'providencias'}">Providencias</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h4 mb-0 mr-3 font-weight-bold text-gray-800">{{reporte.providencias}}</div>
									</div>
									<!--div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div-->
								</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--div class="row">
			<div class="col-xl-12 col-lg-12">
				<div class="card shadow mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-primary">
							Documentos reservados del año {{year}}
						</h6>
					</div>
					<div class="card-body">
						<div class="chart-area">
							<canvas id="myAreaChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div!-->
	</div>
</template>

<script>
	import Chart from '../../plugins/sbadmin2/vendor/chart.js/Chart.min.js'
	export default {
		data() {
			return {
				oficiosPendientes: 0,
				dictamenesPendientes: 0,
				memorandumsPendientes: 0,
				providenciasPendientes: 0,
				reporte: {},
				year: 0
			}
		},
		mounted() {
			this.year = new Date().getFullYear();
			this.getConteo('/api/oficio/get/pendientes',this.setOficiosPendientes);
			this.getConteo('/api/dictamen/get/pendientes',this.setDictamenesPendientes);
			this.getConteo('/api/memorandum/get/pendientes',this.setMemorandumsPendientes);
			this.getConteo('/api/providencias/get/pendientes',this.setProvidenciasPendientes);
			axios.get('/api/providencias/conteo')
			.then(response => {
				this.reporte = response.data
			})
		},
		updated() {
		},
		methods: {
			getConteo(url, callback) {
				
				/*if (url === 'nada') {
					callback();
				}*/
				
				let conteo = null;
				axios.get(url).then(response => {
					callback(response.data.conteo);
				})
				.catch(error => {
					this.mostrarErrores(error, "Error al obtener los oficios pendientes", "Ha ocurrido un error");
				});
				return conteo;
			},
			setOficiosPendientes(conteo) {
				this.oficiosPendientes = conteo;
			},
			setDictamenesPendientes(conteo) {
				this.dictamenesPendientes = conteo;
			},
			setMemorandumsPendientes(conteo) {
				this.memorandumsPendientes = conteo;
			},
			setProvidenciasPendientes(conteo) {
				this.providenciasPendientes = conteo;
			}/*,
			grafica() {
				var ctx = document.getElementById("myAreaChart");
				var myLineChart = new Chart(ctx, {
					 showTooltips: false,
					type: 'bar',
					data: {
						labels: ["Oficios", "Dictámenes", "Memorándum", "Providencias"],
						datasets: [{
							label: "Total",
							lineTension: 0.3,
							backgroundColor: "rgba(78, 115, 223, 1)",
							borderColor: "rgba(78, 115, 223, 1)",
							pointRadius: 3,
							pointBackgroundColor: "rgba(78, 115, 223, 1)",
							pointBorderColor: "rgba(78, 115, 223, 1)",
							pointHoverRadius: 3,
							pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
							pointHoverBorderColor: "rgba(78, 115, 223, 1)",
							pointHitRadius: 10,
							pointBorderWidth: 2,
							data: [
							this.reporte.oficios,
							this.reporte.dictamenes,
							this.reporte.memorandums,
							this.reporte.providencias,
							],
						}],
					},
					options: {
						maintainAspectRatio: false,
						layout: {
							padding: {
								left: 10,
								right: 25,
								top: 25,
								bottom: 0
							}
						},
						scales: {
							xAxes: [{
								time: {
									unit: 'date'
								},
								gridLines: {
									display: false,
									drawBorder: false
								},
								ticks: {
									maxTicksLimit: 7
								}
							}],
							yAxes: [{
								ticks: {
									maxTicksLimit: 5,
									padding: 10,
									callback: function(value, index, values) {
										return value;
									}
								},
								gridLines: {
									color: "rgb(234, 236, 244)",
									zeroLineColor: "rgb(234, 236, 244)",
									drawBorder: true,
									borderDash: [2],
									zeroLineBorderDash: [2]
								}
							}],
						},
						legend: {
							display: false
						},
						tooltips: {
							backgroundColor: "rgb(255,255,255)",
							bodyFontColor: "#858796",
							titleMarginBottom: 10,
							titleFontColor: '#6e707e',
							titleFontSize: 16,
							borderColor: '#dddfeb',
							borderWidth: 1,
							xPadding: 15,
							yPadding: 15,
							displayColors: false,
							intersect: true,
							mode: 'index',
							caretPadding: 10,
							callbacks: {
								label: function(tooltipItem, chart) {
									var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
									return datasetLabel + ': ' + tooltipItem.yLabel;
								}
							}
						}
					}
				});

			}*/,
			mostrarErrores(error, titulo, mensaje) {
				let cadena = '';
				if(error.response.status == 403) {
					cadena = 'No tiene permisos para realizar esta acción';
				} else if(error.response.status == 404) {
					cadena = 'No se encontró la ruta a la que intenta acceder';
				} else if(error.response.status == 500) {
					cadena = 'Ha ocurrido un error interno, por favor intente más tarde';
				} else if(error.response.status == 503){
					cadena = error.response.request.response;
				} else if (error.response.status == 422) {
					let response = JSON.parse(error.response.request.response);
					cadena = `${mensaje}`;
					cadena += '<ul class="list-group">';
					$.each(response.errors, function (i, field) {
						cadena +=`<li class="list-group-item"><span class="text-danger">${field}</span></li>`;
					});
					cadena += '</ul>';
				}
				Swal.fire(titulo, `${cadena}`, 'error');
			}
		}
	}
</script>
