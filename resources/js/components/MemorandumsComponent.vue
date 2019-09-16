<template>
  <div>
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-users mr-2"></i>Memorándum</h1>
    <div class="shadow-lg p-4 mb-5 bg-white rounded">
      <button v-on:click="reservarAutomaticamente" id="reservar-memorandum" class="btn btn-primary mb-3">
        <i class="fa fa-bell fa-lg mr-2"></i>
        Reservar memorándum
      </button>
      <div class="table-responsive">
        <table class="table table-hover border" id="datatable">
          <thead class="bg-dark text-white">
            <tr>
              <th>id</th>
              <th>anio</th>
              <th>Número de oficio</th>
              <th>Reservado por</th>
              <th>Fecha y hora de reservación</th>
              <th>Estado del memorandum</th>
              <th class="text-right">Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="adjuntarModal" tabindex="-1" role="dialog" aria-labelledby="adjuntarModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="adjuntarModalLabel"><i class="fa fa-file-pdf fa-lg mr-2"></i>
              Memorándum DTI-ME-{{data.id}}-{{data.anio}}
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
                <embed class="embed-responsive-item" v-bind:src="src"></embed>
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
        src: null
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
        let ultimo = null;
        this.datatable = $('#datatable').DataTable({
          ajax: '/api/memorandum',
          order: [[1,'desc'], [0, 'desc']],
          lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
          info: true,
          paging: true,
          autoWidth: false,
          columns: [
          {'data': 'id', 'name': 'id', 'visible': false},
          {'data': 'anio', 'name': 'anio', 'visible': false},
          {'render': function(data, type, row) {
            return `<span class="font-weight-bold">DTI-ME-${row.id}-${row.anio}</span>`;
          }},
          {'data': 'nombre', 'name': 'nombre'},
          {'data': 'fecha_asignacion', 'name': 'fecha_asignacion', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('LLL') : '';
          }},
          {'render': function(data, type, row) {
            if(row.nombre == null && ultimo == null){
              return '<i class="fa fa-bell mr-2 text-primary"></i>Disponible para reservar';
            } else if(row.nombre == localStorage.getItem('nombre') && row.direccion_server == null) {
              return '<i class="fa fa-bell mr-2 text-danger"></i>Tengo pendiente de subir documento';
            } else if(row.nombre != null && row.direccion_server == null) {
              return '<i class="fa fa-bell mr-2 text-danger"></i>Pendiente de subir documento';
            } else if(row.direccion_server != null) {
              return '<i class="fa fa-bell mr-2 text-success"></i>Documento cargado';
            } else {
              return '<i class="fa fa-bell mr-2 text-info"></i>Sin asignar';
            }
          }},
          {'render': function(data, type, row) {
            let opciones = ``;
            if(row.nombre == null && ultimo == null) {
              opciones += `
              <button class="asignar dropdown-item"><i class="fa fa-bell mr-2"></i>Reservar memorandum</button>
              `;
              ultimo = row.id;
            } else if(row.nombre == localStorage.getItem('nombre') && row.direccion_server == null) {
              opciones += `
              <button class="adjuntar dropdown-item"><i class="fa fa-upload mr-2"></i>Subir documento</button>
              `;
            } else if(row.nombre == null && row.direccion_server == null) {
              return '';
            } else {
              opciones += `
              <button class="mostrar dropdown-item"><i class="fa fa-file-pdf mr-2"></i>Mostrar documento</button>
              `;
            }
            return `
            <div class="dropdown dropleft text-right">
            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            ${opciones}
            </div>
            </div>
            `;
          }}],
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

      reservar() {
        $("#datatable tbody").on("click", "button.asignar", function(e){
          this.data = this.datatable.fnGetData( this.datatable.fnGetPosition( $(e.target).parents("tr")[0] ) );
          this.idRow = this.datatable.fnGetPosition( $(e.target).parents("tr")[0] );
          Swal.fire({
            title: 'Reservar memorándum',
            html: `
            ¿Está seguro de reservar el memorándum <span class="font-weight-bold">DTI-ME-${this.data.id}-${this.data.anio}</span>?
            `,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-bell fa-lg mr-2"></i>Reservar memorándum',
            cancelButtonText: '<i class="fa fa-times fa-lg mr-2"></i>Cancelar'
          }).then( (result) => {
            if( result.value) {
              let formulario = new FormData();
              formulario.append('oficio_id', this.data.id);
              formulario.append('oficio_anio', this.data.anio);
              formulario.append('personal', localStorage.getItem("nombre"));
              formulario.append('tipo_documento_id', 3);
              formulario.append('user_id', localStorage.getItem("id"));
              axios.post(`/api/memorandum/${this.data.id}/${this.data.anio}`, formulario)
              .then(response => {
                Swal.fire({
                  title: "Oficio actualizado",
                  type: "info",
                  html: `Se actualizó correctamente el memorándum <span class="font-weight-bold">DTI-ME-${this.data.id}-${this.data.anio}</span>`
                });
                this.data.nombre = response.data.nombre;
                this.data.fecha_asignacion = response.data.fecha_asignacion;
                this.datatable.fnUpdate(this.data, this.idRow);
                this.datatable.fnUpdate('1111', 1, 5);
              }).catch( error => {
                this.mostrarErrores(error, "Error reservar el memorándum", "No pudimos asignar el memorándum por los siguientes motivos:<br><br>");
              });
            }
          });
        }.bind(this));
      },

      reservarAutomaticamente() {
        Swal.fire({
          title: 'Reservar memorándum',
          html: `
          ¿Está seguro de reservar un memorándum?
          `,
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: '<i class="fa fa-bell fa-lg mr-2"></i>Reservar memorándum',
          cancelButtonText: '<i class="fa fa-times fa-lg mr-2"></i>Cancelar'
        }).then( (result) => {
          if( result.value) {
            // para agregar fila a datatable
            //this.datatable.fnAddData(this.data);
          } else {
            //this.mostrarBotonReservar == true;
          }
          this.mostrarBotonReservar = true;
        });
      },

      mostrarModalPdf() {
        $("#datatable tbody").on("click", "button.adjuntar", function(e){
          this.mostrarInputFile = true;
          this.showEmbed = false;
          this.data = this.datatable.fnGetData( this.datatable.fnGetPosition( $(e.target).parents("tr")[0] ) );
          this.idRow = this.datatable.fnGetPosition( $(e.target).parents("tr")[0] );
          $("#adjuntarModal").modal("show");
        }.bind(this));
      },

      subirPdf() {
        let formulario = new FormData();
        formulario.append("pdf", this.pdf);
        axios.post(`api/memorandum/${this.data.id}/${this.data.anio}/pdf`, formulario).then(response => {
          Swal.fire({
            title: 'Pdf cargado',
            type: 'success',
            html: `
            Se adjuntó correctamente el pdf al memorándum <span class="font-weight-bold">DTI-ME-${this.data.id}-${this.data.anio}</span>
            `
          });
          console.log(response);
          $("#formulario")[0].reset();
          this.showEmbed = false;
          $("#adjuntarModal").modal("toggle");
          this.data.direccion_server = response.data.direccion_server;
          this.datatable.fnUpdate(this.data, this.idRow);
        }).catch(error => {
          this.mostrarErrores(error, "Error al subir el pdf", "No pudimos cargar el archivo por los siguientes motivos:<br><br>");
        });

      },

      mostrarDocumento() {
        $("#datatable tbody").on("click", "button.mostrar", function(e){
          this.mostrarInputFile = false;
          this.showEmbed = true;
          this.btnSubmit = false;
          this.data = this.datatable.fnGetData( this.datatable.fnGetPosition( $(e.target).parents("tr")[0] ) );
          this.idRow = this.datatable.fnGetPosition( $(e.target).parents("tr")[0] );
          this.src = this.data.direccion_server;
          $("#adjuntarModal").modal("show");
        }.bind(this));
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
