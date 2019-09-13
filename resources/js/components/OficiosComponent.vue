<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Oficios</h1>
		<div class="table-responsive">
			<table class="table table-hover border" id="datatable">
				<thead class="bg-dark text-white">
					<tr>
						<th>id</th>
						<th>anio</th>
						<th>Número de oficio</th>
						<th>Fecha de asignación</th>
						<th>Usuario asignado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>2019</td>
						<td>OF-DTI-1-2019</td>
						<td>13/09/2019</td>
						<td>Elmer Danilo Hernandez</td>
						<td>
							<div class="dropdown dropleft text-right">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opciones
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<button type="button" class="edit dropdown-item" data-toggle="modal" data-target="#exampleModal">
										<i class="fa fa-edit mr-2"></i>Actualizar oficio
									</button>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>2</td>
						<td>2019</td>
						<td>OF-DTI-2-2019</td>
						<td>13/09/2019</td>
						<td>Elmer Danilo Hernandez</td>
						<td>
							<div class="dropdown dropleft text-right">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opciones
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<button type="button" class="edit dropdown-item" data-toggle="modal" data-target="#exampleModal">
										<i class="fa fa-edit mr-2"></i>Actualizar oficio
									</button>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>3</td>
						<td>2019</td>
						<td>OF-DTI-3-2019</td>
						<td>13/09/2019</td>
						<td>Elmer Danilo Hernandez</td>
						<td>
							<div class="dropdown dropleft text-right">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opciones
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<button type="button" class="edit dropdown-item" data-toggle="modal" data-target="#exampleModal">
										<i class="fa fa-edit mr-2"></i>Actualizar oficio
									</button>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>4</td>
						<td>2019</td>
						<td>OF-DTI-4-2019</td>
						<td>13/09/2019</td>
						<td>Elmer Danilo Hernandez</td>
						<td>
							<div class="dropdown dropleft text-right">
								<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Opciones
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
									<button type="button" class="edit dropdown-item" data-toggle="modal" data-target="#exampleModal">
										<i class="fa fa-edit mr-2"></i>Actualizar oficio
									</button>
								</div>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-edit fa-lg mr-2"></i>Actualizar oficio</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form v-on:submit.prevent="actualizar">
						<div class="modal-body">
							<input type="text" id="nombre" value="nombre">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save fa-lg mr-2"></i>Actualizar oficio</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close fa-lg mr-2"></i>Cerrar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<div>
			Objeto a editar
			<br>
			<pre>{{data}}</pre>
			<br>
			Id row
			<pre>{{idRow}}</pre>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				datatable: [],
				data: {},
				idRow:0
			}
		},
		mounted(){
			this.datatable = $("#datatable").DataTable();
			this.editar();
		},
		methods: {
			editar() {
				$("#datatable tbody").on("click", "button.edit", function(e){
					console.log(this.datatable.api)
					this.data = this.datatable.fnGetData( this.datatable.fnGetPosition( $(e.target).parents("tr")[0] ) );
					this.idRow = this.datatable.fnGetPosition( $(e.target).parents("tr")[0] );

					$("#nombre").val("hola");
				}.bind(this));

			},
			actualizar() {
				$("#exampleModal").modal('toggle');
				axios.put(`/api/memorandum/${this.data[0]}`, {
					params: {
						id: this.data[0]
					}
				}).then(response => {
					Swal.fire({
						title: "Oficio actualizado",
						type: "info",
						html: `Se actualizó correctamente el oficio ${this.data[0]}`
					});
					console.log(response);
				}).catch( e => {
					console.log(e);
				});
			},
			eliminar() {

			}
		}
	}
</script>
