<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800"><i class="fa fa-user mr-2"></i>Mi perfil</h1>
		<div class="row">
			<div class="col-md-12">
				<!--button class="btn btn-outline-secondary float-right">
					<i class="fa fa-edit fa-lg mr-2"></i>
					Modificar perfil
				</button-->
				<h3 class="">{{user.name}}</h3>
				<h4 class="text-info">{{user.departamento}}</h4>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Perfil</a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
						<div class="form-group mt-3">
							<label for="dpi">Documento personal de identificación</label>
							<input v-model="user.dpi" class="form-control" type="text">
						</div>
						<div class="form-group mt-3">
							<label for="fecha_nacimiento">Fecha de nacimiento</label>
							<input v-model="user.fecha_nacimiento" class="form-control" type="date">
						</div>
						<div class="form-group mt-3">
							<label for="genero_id">Género</label>
							<select v-model="user.genero_id" class="form-control">
								<option value="">Seleccione un género</option>
								<option value="1">Masculino</option>
								<option value="2">Femenino</option>
							</select>
						</div>
						<div class="alert alert-info">
							Ested módulo se encuentra en desarrollo.
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
				user_id: localStorage.getItem('id'),
				user: {},
				edit: false
			}
		},
		mounted() {
			this.getUser(this.user_id);

		},
		methods: {
			getUser(user_id) {
				axios.get(`/api/user/${user_id}`)
				.then(response => {
					this.user = response.data;
				})
				.catch(error => {

				});
			}
		}
	}
</script>