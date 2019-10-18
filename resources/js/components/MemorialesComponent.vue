<template>
  <div>
    <input type="hidden" id="ultimo" value="nada">
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Memoriales</h1>
    <div class="shadow-lg p-4 mb-5 bg-white rounded">
      <button v-on:click="memorial" id="registrar-memorial" class="btn btn-primary mb-3">
        <i class="fa fa-plus-circle fa-lg mr-2"></i>
        Registrar memorial
      </button>
      <div class="table-responsive">
        <table class="table table-hover border" id="datatable">
          <thead class="bg-dark text-white">
            <tr>
              <th>id</th>
              <th>Fecha notificacion</th>
              <th>Fecha evaluacion de audiencia</th>
              <th>Número de proceso</th>
              <th>Tipo de proceso</th>
              <th>Plazo de audiencia</th>
              <th>Usuario que registró el memorial</th>
              <th>Fecha de creación</th>
              <th class="text-right">Opciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="memorialRegistrarModal" tabindex="-1" role="dialog" aria-labelledby="memorialRegistrarModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="memorialRegistrarModalLabel"><i class="fa fa-file-pdf fa-lg mr-2"></i>
              Memorial {{data.numero_proceso}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form v-on:submit.prevent="subirPdf" id="formulario">
            <div class="modal-body">
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="numero_proceso">Número de proceso<span class="text-danger ml-2">*</span></label>
                  <input class="form-control" type="text" name="numero_proceso" id="numero_proceso" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="fecha_notificacion">Fecha de notificación<span class="text-danger ml-2">*</span></label>
                  <input class="form-control" type="date" name="fecha_notificacion" id="fecha_notificacion" required>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="fecha_evaluacion_audiencia">Fecha evaluación audiencia<span class="text-danger ml-2">*</span></label>
                  <input class="form-control" type="date" name="fecha_evaluacion_audiencia" id="fecha_evaluacion_audiencia" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3">
                  <label for="plazo_audiencia_id">Plazo de audiencia<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.plazo_audiencia_id' class="form-control" name="plazo_audiencia_id" id="plazo_audiencia_id" required>
                    <option value="">Seleccione plazo de audiencia</option>
                    <option v-bind:value="plazoAudiencia.id" v-for="plazoAudiencia in plazosDeAudiencias">
                      {{plazoAudiencia.plazo_audiencia}}
                    </option>
                  </select>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="tipo_proceso_id">Tipo de proceso<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.tipo_proceso_id' class="form-control" name="tipo_proceso_id" id="tipo_proceso_id" required>
                    <option value="">Seleccione tipo de proceso</option>
                    <option v-bind:value="tipoDeProceso.id" v-for="tipoDeProceso in tipoDeProcesos">
                      {{tipoDeProceso.tipo_proceso}}
                    </option>
                  </select>
                </div>
                <div v-if="mostrarInputFile" class="col-md-4 mb-3">
                  <label for="pdf">Seleccione documento pdf</label><br>
                  <input v-on:change="mostrarEmbed" type="file" id="pdf" name="pdf" accept="application/pdf" required>
                </div>
              </div>
              <div v-if="showEmbed" class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" v-bind:src="src"></iframe>
              </div>
            </div>
            <div class="modal-footer">
              <button v-if="btnSubmit" type="submit" class="btn btn-primary"><i class="fa fa-upload fa-lg mr-2"></i>Adjuntar documento</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-lg mr-2"></i>Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        datatable: [],
        data: {},
        idRow:0,
        showEmbed: false,
        btnSubmit: false,
        mostrarInputFile: true,
        pdf: null,
        src: null,
        tipoDeProcesos: [],
        plazosDeAudiencias: []
      }
    },
    mounted() {
      this.inicializarTabla()
      this.obtenerCatalogos()
    },
    methods: {
      inicializarTabla() {
        this.datatable = $('#datatable').DataTable({
          ajax: '/api/memorial',
          order: [[2,'desc'], [1, 'desc']],
          lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
          info: true,
          paging: true,
          autoWidth: false,
          columns: [
          {'data': 'id', 'name': 'id'},
          {'data': 'fecha_notificacion', 'name': 'oficio_id'},
          {'data': 'fecha_evaluacion_audiencia', 'name': 'oficio_anio'},
          {'data': 'numero_proceso', 'name': 'numero_proceso'},
          {'data': 'tipo_proceso_id', 'name': 'numero_proceso'},
          {'data': 'plazo_audiencia_id', 'name': 'numero_proceso'},
          {'data': 'user_id', 'name': 'numero_proceso'},
          {'data': 'created_at', 'name': 'created_at', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('LLL') : '';
          }},
          {'data': 'user_id', 'name': 'numero_proceso'},
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

      memorial() {
        $("#memorialRegistrarModal").modal("show");
      },

      obtenerCatalogos() {
        this.data.tipo_proceso_id = ''
        this.data.plazo_audiencia_id = ''
        axios.get('/api/catalogos/tipos-de-procesos')
        .then(response => {
          this.tipoDeProcesos = response.data
        }).catch( error => {
          Swal.fire({
            title: 'Error al obtener el catálogos',
            html: 'No pudimos obtener el catálogos "tipos de procesos"',
            type: 'error'
          });
        });

        axios.get('/api/catalogos/plazos-de-audiencias')
        .then(response => {
          this.plazosDeAudiencias = response.data
        }).catch( error => {
          Swal.fire({
            title: 'Error al obtener el catálogos',
            html: 'No pudimos obtener el catálogos "plazos de audiencias"',
            type: 'error'
          });
        });
      },

      mostrarEmbed() {
        this.showEmbed = true;
        this.btnSubmit = true;
        this.pdf = document.getElementById("pdf").files[0];
        this.src = URL.createObjectURL(this.pdf);
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
