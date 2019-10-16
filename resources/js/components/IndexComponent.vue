<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
		<h3 class="h4 mb-4 text-gray-800">Documentos pendientes de adjuntar</h3>
		<div class="row">
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-3 mb-4">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': oficiosPendientes == 0, 'border-left-danger shadow h-100 py-2': oficiosPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									<router-link :to="{name: 'oficios'}">Oficios</router-link>
								</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{oficiosPendientes}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-3 mb-4">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': dictamenesPendientes == 0, 'border-left-danger shadow h-100 py-2': dictamenesPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
									<router-link :to="{name: 'dictamenes'}">Dictámenes</router-link>
								</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800">{{dictamenesPendientes}}</div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-3 mb-4">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': memorandumsPendientes == 0, 'border-left-danger shadow h-100 py-2': memorandumsPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'memorandums'}">Memorándum</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{memorandumsPendientes}}</div>
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

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-3 col-md-3 mb-4">
				<div v-bind:class="{ 'border-left-success shadow h-100 py-2': providenciasPendientes == 0, 'border-left-danger shadow h-100 py-2': providenciasPendientes > 0 }" class="card">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<router-link :to="{name: 'providencias'}">Providencias</router-link>
								</div>
								<div class="row no-gutters align-items-center">
									<div class="col-auto">
										<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{providenciasPendientes}}</div>
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
	</div>
</template>

<script>
	export default {
		data() {
			return {
				oficiosPendientes: 0,
				dictamenesPendientes: 0,
				memorandumsPendientes: 0,
				providenciasPendientes: 0
			}
		},
		mounted() {
			this.getConteo('/api/oficio/get/pendientes',this.setOficiosPendientes);
			this.getConteo('/api/dictamen/get/pendientes',this.setDictamenesPendientes);
			this.getConteo('/api/memorandum/get/pendientes',this.setMemorandumsPendientes);
			this.getConteo('/api/providencia/get/pendientes',this.setProvicenciasPendientes);

		},
		methods: {
			getConteo(url, callback) {
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
			},
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
