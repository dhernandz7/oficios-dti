<template>
  <div>
    <input type="hidden" id="ultimo" value="nada">
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Memorándum</h1>
    <div class="shadow-lg p-4 mb-5 bg-white rounded">
      <button v-if="showBotonReservar" v-on:click="reservarAutomaticamente" id="reservar-memorandum" class="btn btn-primary mb-3">
        <i class="fa fa-bell fa-lg mr-2"></i>
        Reservar memorándum
      </button>
      <div class="table-responsive">
        <table class="table table-hover border" id="datatable">
          <thead class="bg-dark text-white">
            <tr>
              <th>Asignacion id</th>
              <th>Memorandum id</th>
              <th>Memorandum anio</th>
              <th>Número de oficio</th>
              <th>Reservado por</th>
              <th>Fecha y hora de reservación</th>
              <th>Estado del memorándum</th>
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
              Memorándum DTI-ME-{{data.oficio_id}}-{{data.oficio_anio}}
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
        showBotonReservar: true,
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
    updated() {
      this.mostrarBotonReservar();
    },
    methods: {
      inicializarTabla() {
        this.datatable = $('#datatable').DataTable({
          ajax: '/api/memorandum',
          order: [[2,'desc'], [1, 'desc']],
          lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
          info: true,
          paging: true,
          autoWidth: false,
          columns: [
          {'data': 'asignacion_id', 'name': 'asignacion_id', 'visible': false},
          {'data': 'oficio_id', 'name': 'oficio_id', 'visible': false},
          {'data': 'oficio_anio', 'name': 'oficio_anio', 'visible': false},
          {'render': function(data, type, row) {
            return `<span class="font-weight-bold">DTI-ME-${row.oficio_id}-${row.oficio_anio}</span>`;
          }},
          {'data': 'name', 'name': 'name'},
          {'data': 'created_at', 'name': 'created_at', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('LLL') : '';
          }},
          {'render': function(data, type, row) {
            if(row.name == null && $("#ultimo").val() == "nada"){
              return '<i class="fa fa-bell mr-2 text-primary"></i>Disponible para reservar';
            } else if(row.name == localStorage.getItem('nombre') && row.path == null) {
              return '<i class="fa fa-bell mr-2 text-danger"></i>Tengo pendiente de subir documento';
            } else if(row.name != null && row.path == null) {
              return '<i class="fa fa-bell mr-2 text-danger"></i>Pendiente de subir documento';
            } else if(row.path != null) {
              return '<i class="fa fa-bell mr-2 text-success"></i>Documento cargado';
            } else {
              return '<i class="fa fa-bell mr-2 text-info"></i>Sin asignar';
            }
          }},
          {'render': function(data, type, row) {
            let opciones = ``;
            if(row.name == null && $("#ultimo").val() == "nada") {
              opciones += `
              <button class="asignar dropdown-item"><i class="fa fa-bell mr-2"></i>Reservar memorándum</button>
              `;
              $("#ultimo").val(row.id);
            } else if(row.name == localStorage.getItem('nombre') && row.path == null) {
              opciones += `
              <button class="adjuntar dropdown-item"><i class="fa fa-upload mr-2"></i>Subir documento</button>
              `;
            } else if(row.name != localStorage.getItem('nombre') && row.path == null) {
              return '';
            } else if(row.name == null && row.path == null) {
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
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data();
          this.idRow = this.datatable.row( $(e.target).parents("tr")[0] ).index();
          Swal.fire({
            title: 'Reservar memorándum',
            html: `
            ¿Está seguro de reservar el memorándum <span class="font-weight-bold">DTI-ME-${this.data.oficio_id}-${this.data.oficio_anio}</span>?
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
              formulario.append('oficio_id', this.data.oficio_id);
              formulario.append('oficio_anio', this.data.oficio_anio);
              formulario.append('tipo_documento_id', 3);
              formulario.append('user_id', localStorage.getItem("id"));
              formulario.append('name', localStorage.getItem("nombre"));
              axios.post(`/api/memorandum/reservar`, formulario)
              .then(response => {
                Swal.fire({
                  title: "Memorándum reservado",
                  type: "info",
                  html: `Se reservó correctamente el memorándum <span class="font-weight-bold">DTI-ME-${this.data.oficio_id}-${this.data.oficio_anio}</span>`
                }).then((result) => {
                  this.data.asignacion_id = response.data.asignacion_id;
                  this.data.name = response.data.name;
                  this.data.created_at = response.data.created_at.date;
                  this.datatable.row(this.idRow).data(this.data);
                  $("#ultimo").val("nada");
                  this.datatable.row(this.idRow+1).data(this.datatable.row(this.idRow+1).data());
                  this.mostrarBotonReservar();
                });
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
            let formulario = new FormData();
            formulario.append('name', localStorage.getItem("nombre"));
            formulario.append('tipo_documento_id', 3);
            formulario.append('user_id', localStorage.getItem("id"));
            axios.post("/api/memorandum", formulario)
            .then(response => {
              Swal.fire({
                title: "Memorándum reservado",
                type: "info",
                html: `Se reservó correctamente el memorándum <span class="font-weight-bold">DTI-ME-${response.data.oficio_id}-${response.data.oficio_anio}</span>`
              }).then((result) => {
                this.data = response.data;
                this.data.created_at = this.data.created_at.date;
                this.datatable.row.add(this.data).draw(false);
              });
            })
            .catch(error => {
              this.mostrarErrores(error, "Error al reservar un memorándum", "No pudimos reservar el memorándum por los siguientes motivos:<br><br>");
            });
            // para agregar fila a datatable
            //this.datatable.fnAddData(this.data);
          }
        });
      },

      mostrarModalPdf() {
        $("#datatable tbody").on("click", "button.adjuntar", function(e){
          this.mostrarInputFile = true;
          this.showEmbed = false;
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data();
          this.idRow = this.datatable.row( $(e.target).parents("tr")[0] ).index();
          $("#formulario")[0].reset();
          $("#adjuntarModal").modal("show");
        }.bind(this));
      },

      subirPdf() {
        let formulario = new FormData();
        formulario.append("pdf", this.pdf);
        formulario.append("oficio_id", this.data.oficio_id);
        formulario.append("oficio_anio", this.data.oficio_anio);
        axios.post(`api/memorandum/${this.data.asignacion_id}/pdf`, formulario).then(response => {
          $("#adjuntarModal").modal("toggle");
          Swal.fire({
            title: 'Pdf cargado',
            type: 'success',
            html: `
            Se adjuntó correctamente el pdf al memorándum <span class="font-weight-bold">DTI-ME-${this.data.oficio_id}-${this.data.oficio_anio}</span>
            `
          }).then((result) => {
            $("#formulario")[0].reset();
            this.showEmbed = false;
            this.data.path = response.data.path;
            this.datatable.row(this.idRow).data(this.data);
          });
        }).catch(error => {
          this.mostrarErrores(error, "Error al subir el pdf", "No pudimos cargar el archivo por los siguientes motivos:<br><br>");
        });

      },

      mostrarDocumento() {
        $("#datatable tbody").on("click", "button.mostrar", function(e){
          this.mostrarInputFile = false;
          this.showEmbed = true;
          this.btnSubmit = false;
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data();
          this.idRow = this.datatable.row( $(e.target).parents("tr")[0] ).index();
          this.src = this.data.path.replace("public", "storage");
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
      },

      mostrarBotonReservar() {
        if($("#ultimo").val() == "nada") {
          this.showBotonReservar = true;
        } else {
          this.showBotonReservar = false;
        }
      }

    }
  }
</script>
