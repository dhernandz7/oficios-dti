<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Procesos Contenciosos Administrativos</h1>
		<div class="shadow-lg p-4 mb-5 bg-white rounded">
			<button class="btn btn-primary mb-3" v-on:click="crearProcesoContenciosoAdministrativo">
				<i class="fa fa-plus-square fa-lg mr-2"></i>
				Registrar proceso
			</button>
			<div class="table-responsive">
				<table class="table table-hover border" id="procesos">
					<thead class="thead-dark">
						<tr>
							<th>id</th>
							<th>Fecha de proceso</th>
							<th>Número de proceso</th>
							<th>Proveniente de</th>
							<th>Fecha de notificación</th>
							<th>Objeto de Litis</th>
							<th>Entidad demandante</th>
							<th>Demandado</th>
							<th>Tipo de evacuación</th>
							<th>Estado</th>
							<th>Anotación</th>
							<th></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="modal fade" id="procesoModal" tabindex="-1" role="dialog" aria-labelledby="procesoModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title font-weight-bold" id="adjuntarModalLabel"><i class="fa fa-file-pdf fa-lg mr-2"></i>
							Nuevo Proceso Contencioso Administrativo
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="fecha de proceso">
									Fecha de proceso
									<span class="text-danger">*</span>
								</label>
								<input class="form-control" id="fecha de proceso" name="fecha de proceso" type="date" v-model="proceso.fecha" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('fecha de proceso')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="número de proceso">
									Número de proceso
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" id="número de proceso" name="número de proceso" type="text" v-model="proceso.numero_de_proceso" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('número de proceso')}}</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="proveniente de">
									Proveniente de
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="proveniente de" name="proveniente de" v-model="proceso.proveniente_id" v-validate="'required'">
									<option value="">Seleccione una opción</option>
									<option value="1">Corte de Constitucionalidad</option>
									<option value="2">Corte Suprema de Justicia</option>
									<option value="3">Juzgado</option>
									<option value="4">Sala</option>
								</select>
								<div class="invalid-feedback">{{errors.first('proveniente de')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="fecha de notificación">
									Fecha de notificación
									<span class="text-danger">*</span>
								</label>
								<input class="form-control" id="fecha de notificación" name="fecha de notificación" type="date" v-model="proceso.fecha_de_notificacion" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('fecha de notificación')}}</div>
							</div>
						</div>
						<div class="form-group">
							<label for="objeto de litis">
								Objeto de Litis
								<span class="text-danger">*</span>
							</label>
							<select class="form-control" id="objeto de litis" name="objeto de litis" v-model="proceso.objeto_litis_id" v-validate="'required'">
								<option value="">Seleccione una opción</option>
								<option value="1">Aclaración y/o Ampliación</option>
								<option value="2">Amparo</option>
								<option value="3">Casación</option>
								<option value="4">Contencioso Administrativo</option>
								<option value="5">Inconstitucionalidad</option>
								<option value="6">Otro</option>
							</select>
							<div class="invalid-feedback">{{errors.first('objeto de litis')}}</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nombre de la entidad demandante">
									Entidad demandante
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" id="nombre de la entidad demandante" name="nombre de la entidad demandante" type="text" v-model="proceso.nombre_de_entidad_demandante" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('nombre de la entidad demandante')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="nombre del demandado">
									Demandado
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" id="nombre del demandado" name="nombre del demandado" type="text" v-model="proceso.nombre_de_demandado" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('nombre del demandado')}}</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="tipo de evacuación">
									Tipo de evacuación
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="tipo de evacuación" name="tipo de evacuación" v-model="proceso.tipo_evacuacion_id" v-validate="'required'">
									<option value="">Selecciona una opción</option>
									<option value="1">Contestación de demanda</option>
									<option value="2">Día para la vista</option>
									<option value="3">Evacuación de audiencia 48 hora</option>
									<option value="4">Otro</option>
								</select>
								<div class="invalid-feedback">{{errors.first('tipo de evacuación')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="estado del proceso">
									Estado del proceso
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="estado del proceso" name="estado del proceso" v-model="proceso.estado_proceso_id" v-validate="'required'">
									<option value="">Seleccione una opción</option>
									<option value="1">En proceso</option>
									<option value="2">Finalizado</option>
								</select>
								<div class="invalid-feedback">{{errors.first('estado del proceso')}}</div>
							</div>
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="agregarAnotacion" name="agregarAnotacion" v-model.boolean="agregarAnotacion">
							<label class="custom-control-label" for="agregarAnotacion" v-text="agregarOQuitarAnotacion"></label>
						</div>
						<div class="form-group" v-show="agregarAnotacion">
							<label for="anotación">
								Anotación
								<span class="text-danger">*</span>
							</label>
							<textarea class="form-control" id="anotación" name="anotación" v-model="proceso.anotacion" v-validate="`${agregarAnotacion ? 'required': ''}`"></textarea>
							<div class="invalid-feedback">{{errors.first('anotación')}}</div>
						</div>
						<div class="alert alert-danger" role="alert" v-show="errorsServer.length > 0">
							<p class="mb-0">
								<strong>Error</strong>
							</p>
							<ul>
								<li v-for="error in errorsServer">{{error}}</li>
							</ul>
						</div>
						<pre>{{errors}}</pre>
					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary" v-on:click="registrarProcesoContenciosoAdministrativo">
							<i class="fa fa-save fa-lg mr-2"></i>
							Registrar proceso
						</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-lg mr-2"></i>Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import Vue from 'vue';
	import es from 'vee-validate/dist/locale/es';

	import VeeValidate, { Validator } from "vee-validate";
	
	Vue.use(VeeValidate, {
		classes: true,
		classNames: {
			valid: '',
			invalid: 'is-invalid'
		}
	});

	Validator.localize('es', es);

	export default {
		data() {
			return {
				procesos: [],
				proceso: {},
				idRow: null,
				agregarAnotacion: false,
				errorsServer: []
			}
		},

		computed: {
			agregarOQuitarAnotacion: function() {
				return this.agregarAnotacion ? 'Quitar anotación' :'Agregar anotación'
			}
		},

		mounted() {
			this.inicializarTabla()
		},

		methods: {
			inicializarTabla() {
				this.procesos = $('#procesos').DataTable({
					ajax: '/api/procesos-contenciosos-administrativos',
					order: [[0,'asc'], [1,'asc']],
					lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, 'todos']],
					info: true,
					paging: true,
					autoWidth: false,
					columns: [
					{data: 'title', name: 'title'},
					{data: 'body', name: 'body', searchable: false},
					{render: function(data, type, row){
						return `
						<div class="dropleft">
						<a href="#" class="badge badge-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						opciones
						</a>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="/productos/${row.id}/show">Mostrar</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						</div>
						</div>
						`
					}, searchable: false, orderable: false}
					],
					language: {
						sProcessing: 'Procesando...',
						sLengthMenu: 'Mostrar _MENU_ registros',
						sZeroRecords: 'No se encontraron resultados',
						sEmptyTable: 'Ningún dato disponible en esta tabla',
						sInfo: 'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
						sInfoEmpty: 'Mostrando registros del 0 al 0 de un total de 0 registros',
						sInfoFiltered: '(filtrado de un total de _MAX_ registros)',
						sInfoPostFix: '',
						sSearch: 'Buscar:',
						sUrl: '',
						sInfoThousands: ',',
						sLoadingRecords: 'Cargando...',
						oPaginate: {
							sFirst: 'Primero',
							sLast: 'Último',
							sNext: 'Siguiente',
							sPrevious: 'Anterior'
						},
						oAria: {
							sSortAscending: ': Activar para ordenar la columna de manera ascendente',
							sSortDescending: ': Activar para ordenar la columna de manera descendente'
						},
						buttons: {
							copy: 'Copiar',
							colvis: 'Visibilidad'
						}
					}
				})
				.on('tbody click', 'button.editar', function(event) {
					this.setProceso(event)
				}.bind(this))
			},

			crearProcesoContenciosoAdministrativo() {
				this.limpiarFormulario()
				this.toggleModal('#procesoModal', 'show')
			},

			registrarProcesoContenciosoAdministrativo() {
				this.$validator.validate()
				.then(esValido => {
					if (esValido) {
						axios.post('/api/procesos-contenciosos-administrativos', this.proceso)
						.then(response => {
							Swal.fire({
								title: 'Registro exitoso',
								type: 'success',
								html: 'El proceso contencioso administrativo fue registrado correctamente'
							}).then(result => {
								this.insertarProcesoEnTabla(response.data)
								this.toggleModal('#procesoModal', 'toggle')
								this.limpiarFormulario()
							})
						})
						.catch(error => {
							if (typeof error.response.data === 'object') {
								this.errorsServer = _.flatten(_.toArray(error.response.data.errors))
							} else {
								this.errorsServer = [error.response.data]
							}
						})
					}
				})
			},

			insertarProcesoEnTabla(data) {
				this.procesos.row.add(data).draw(false)
			},

			setProceso(event) {
				this.proceso = this.procesos.row($(event.target).parents("tr")[0]).data()
				this.idRow = this.procesos.row( $(event.target).parents("tr")[0] ).index()
			},

			limpiarFormulario() {
				this.proceso = {}
			},

			toggleModal(idModal, action) {
				$(idModal).modal(action)
			},

			toggleAnotacion() {
				this.agregarAnotacion = !this.agregarAnotacion
			},

			mostrarAlerta(title, icon, html) {
				Swal.fire({
					title: title,
					type: icon,
					html: html
				})
			}
		}
	}
</script>