<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800"><i class="fa fa-users mr-2"></i>Usuarios</h1>
		<div class="shadow-lg p-4 mb-5 bg-white rounded">
			<div class="table-responsive">
				<table class="table table-hover border" id="usuarios">
					<thead class="bg-dark text-white">
						<tr>
							<th>id</th>
							<th>Dpi</th>
							<th>Nombre completo</th>
							<th>Genero</th>
							<th>Correo institucional</th>
							<th>Usuario de red</th>
							<th>Departamento</th>
							<th>Estado del usuario</th>
							<th class="text-right">Acciones</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				usuarios: [],
				usuario: {},
				idRow: null
			}
		},
		mounted() {
			this.inicializarTabla();
		},
		methods: {
			inicializarTabla() {
				this.usuarios = $('#usuarios').DataTable({
					ajax: '/api/usuarios',
					order: [[2,'asc']],
					lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
					info: true,
					paging: true,
					autoWidth: false,
					columns: [
					{'data': 'id', 'name': 'id', 'visible': false},
					{'data': 'dpi', 'name': 'dpi', 'visible': false},
					{'data': 'name', 'name': 'name'},
					{'data': 'genero_id', 'name': 'genero_id', "render": function(data) {
						if(data == 1) {
							return "Masculino";
						} else {
							return "Femenino";
						}
					}},
					{'data': 'email', 'name': 'email'},
					{'data': 'username', 'name': 'username'},
					{'data': 'departamento_id', 'name': 'departamento_id'},
					{"render": function(data, type, row) {
						if(row.deleted_at != null) {
							return '<i class="fa fa-ban mr-2 text-info"></i>Inactivo';
						} else{
							return '<i class="fa fa-check-circle mr-2 text-success"></i>Activo';
						}
					}},
					{"render": function(data, type, row) {
						return `
						<div class="dropdown dropleft text-right">
						<button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Opciones
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						<router-link :to="{name: 'oficios'}" class="dropdown-item"><i class="fa fa-book mr-2"></i>Oficios</router-link>
						</div>
						</div>
						`
					}}
					],
					language: {
						"sProcessing": "Procesando...",
						"sLengthMenu": "Mostrar _MENU_ registros",
						"sZeroRecords": "No se encontraron resultados",
						"sEmptyTable": "Ningún dato disponible en esta tabla",
						"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
						"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
						"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
						"sInfoPostFix": "",
						"sSearch": "Búsqueda general:",
						"sUrl": "",
						"sInfoThousands": ",",
						"sLoadingRecords": "Cargando...",
						"oPaginate": {
							"sFirst": "Primero",
							"sLast": "Último",
							"sNext": "Siguiente",
							"sPrevious": "Anterior"
						}
					}
				});
			},
		}
	}
</script>