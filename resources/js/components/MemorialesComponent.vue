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
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
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
              <div v-if="mostrarInputFile" class="form-group">
                <label for="pdf">Seleccione un documento pdf</label><br>
                <input v-on:change="mostrarEmbed" type="file" id="pdf" name="pdf" accept="application/pdf" required>
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
      }
    },
    mounted() {
      this.inicializarTabla();
      this.reservar();
      this.mostrarModalPdf();
      this.mostrarDocumento();
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
