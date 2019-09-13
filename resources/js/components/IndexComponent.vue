<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
		<h3 class="h4 mb-4 text-gray-800">Documentos pendientes de adjuntar</h3>
		<div class="row">
			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-4 col-md-6 mb-4">
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
								<i class="fas fa-calendar fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-4 col-md-6 mb-4">
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
								<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Earnings (Monthly) Card Example -->
			<div class="col-xl-4 col-md-6 mb-4">
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
									<div class="col">
										<div class="progress progress-sm mr-2">
											<div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
									</div>
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
				memorandumsPendientes: 0
			}
		},
		methods: {
			getOficiosPendientes() {
				return 35;
			},
			getDictamenesPendientes() {
				return 1;
			},
			getMemorandumsPendientes() {
				return 25;
			}
		},
		mounted() {
			this.oficiosPendientes = this.getOficiosPendientes();
			this.dictamenesPendientes = this.getDictamenesPendientes();
			this.memorandumsPendientes = this.getMemorandumsPendientes();

		}
	}
</script>
