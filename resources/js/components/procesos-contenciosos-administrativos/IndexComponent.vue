<template>
	<div>
		<h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Procesos Contenciosos Administrativos</h1>
		<div class="shadow-lg p-4 mb-5 bg-white rounded">
			<button class="btn btn-primary mb-3" v-on:click="crearProcesoContenciosoAdministrativo">
				<i class="fa fa-plus-square fa-lg mr-2"></i>
				Registrar proceso
			</button>
			<div class="table-responsive">
				<table class="table table-hover border">
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
						<pre>{{proceso}}</pre>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="fecha">
									Fecha de proceso
									<span class="text-danger">*</span>
								</label>
								<input class="form-control" id="fecha" name="fecha" type="date" v-model="proceso.fecha" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('fecha')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="numero_de_proceso">
									Número de proceso
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" type="text" v-model="proceso.numero_de_proceso" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('numero_de_proceso')}}</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="proveniente_id">
									Proveniente de
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="proveniente_id" name="proveniente_id" v-model="proceso.proveniente_id" v-validate="'required'">
									<option value="">Seleccione una opción</option>
									<option value="1">Corte de Constitucionalidad</option>
									<option value="2">Corte Suprema de Justicia</option>
									<option value="3">Juzgado</option>
									<option value="4">Sala</option>
								</select>
								<div class="invalid-feedback">{{errors.first('proveniente_id')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="fecha_de_notificacion">
									Fecha de notificación
									<span class="text-danger">*</span>
								</label>
								<input class="form-control" id="fecha_de_notificacion" name="fecha_de_notificacion" type="date" v-model="proceso.fecha_de_notificacion" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('fecha_de_notificacion')}}</div>
							</div>
						</div>
						<div class="form-group">
							<label for="objeto_litis_id">
								Objeto de Litis
								<span class="text-danger">*</span>
							</label>
							<select class="form-control" id="objeto_litis_id" name="objeto_litis_id" v-model="proceso.objeto_litis_id" v-validate="'required'">
								<option value="">Seleccione una opción</option>
								<option value="1">Aclaración y/o Ampliación</option>
								<option value="2">Amparo</option>
								<option value="3">Casación</option>
								<option value="4">Contencioso Administrativo</option>
								<option value="5">Inconstitucionalidad</option>
								<option value="6">Otro</option>
							</select>
							<div class="invalid-feedback">{{errors.first('objeto_litis_id')}}</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="nombre_de_entidad_demandante">
									Entidad demandante
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" id="nombre_de_entidad_demandante" name="nombre_de_entidad_demandante" type="text" v-model="proceso.nombre_de_entidad_demandante" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('nombre_de_entidad_demandante')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="nombre_de_demandado">
									Demandado
									<span class="text-danger">*</span>
								</label>
								<input autocomplete="off" class="form-control" id="nombre_de_demandado" name="nombre_de_demandado" type="text" v-model="proceso.nombre_de_demandado" v-validate="'required'">
								<div class="invalid-feedback">{{errors.first('nombre_de_demandado')}}</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="tipo_evacuacion_id">
									Tipo de evacuación
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="tipo_evacuacion_id" name="tipo_evacuacion_id" v-model="proceso.tipo_evacuacion_id" v-validate="'required'">
									<option value="">Selecciona una opción</option>
									<option value="1">Contestación de demanda</option>
									<option value="2">Día para la vista</option>
									<option value="3">Evacuación de audiencia 48 hora</option>
									<option value="4">Otro</option>
								</select>
								<div class="invalid-feedback">{{errors.first('tipo_evacuacion_id')}}</div>
							</div>
							<div class="form-group col-md-6">
								<label for="estado_proceso_id">
									Estado del proceso
									<span class="text-danger">*</span>
								</label>
								<select class="form-control" id="estado_proceso_id" name="estado_proceso_id" v-model="proceso.estado_proceso_id" v-validate="'required'">
									<option value="">Seleccione una opción</option>
									<option value="1">En proceso</option>
									<option value="2">Finalizado</option>
								</select>
								<div class="invalid-feedback">{{errors.first('estado_proceso_id')}}</div>
							</div>
						</div>
						<div class="custom-control custom-checkbox">
							<input class="custom-control-input" type="checkbox" id="agregarAnotacion" name="agregarAnotacion" v-model.boolean="agregarAnotacion">
							<label class="custom-control-label" for="agregarAnotacion" v-text="agregarOQuitarAnotacion"></label>
						</div>
						<div class="form-group" v-show="agregarAnotacion">
							<label for="anotacion">
								Anotación
								<span class="text-danger">*</span>
							</label>
							<textarea class="form-control" id="anotacion" name="anotacion" v-model="proceso.anotacion" v-validate="`${agregarAnotacion ? 'required': ''}`"></textarea>
							<div class="invalid-feedback">{{errors.first('anotacion')}}</div>
						</div>
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
				agregarAnotacion: false
			}
		},

		computed: {
			agregarOQuitarAnotacion: function() {
				return this.agregarAnotacion ? 'Quitar anotación' :'Agregar anotación'
			}
		},

		mounted() {
			console.log('Index component')
		},

		methods: {
			crearProcesoContenciosoAdministrativo() {
				this.limpiarFormulario()
				this.mostrarModal()
			},

			limpiarFormulario() {
				this.proceso = {}
			},

			mostrarModal() {
				$('#procesoModal').modal('show')
			},

			registrarProcesoContenciosoAdministrativo() {
				this.$validator.validate()
				.then(esValido => {
					if (esValido) {
						alert("OK, se envía el formulario ;)")
					} else {

					}
				})
			},

			toggleAnotacion() {
				this.agregarAnotacion = !this.agregarAnotacion
			}
		}
	}
</script>