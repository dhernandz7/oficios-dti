<template>
  <div>
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-users mr-2"></i>Memorándum</h1>
    <div class="shadow-lg p-4 mb-5 bg-white rounded">
      <button v-if="mostrarBotonReservar" v-on:click="reservarAutomaticamente" id="reservar-memorandum" class="btn btn-primary mb-3">
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
              <th>Fecha de reservación</th>
              <th>Estado del memorandum</th>
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
        datatable: [],
        data: {},
        idRow:0,
        ultimoPorAsignar: null,
        mostrarBotonReservar: true
      }
    },
    mounted() {
      this.inicializarTabla();
      this.reservar();
    },
    methods: {
      inicializarTabla() {
        let ultimoPorAsignar = null;
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
            return data != null ? moment(data.substring(0,10)).locale('es').format('DD MMMM YYYY') : '';
          }},
          {'render': function(data, type, row) {
            if(row.nombre == null && ultimoPorAsignar == null){
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
            if(row.nombre == null && ultimoPorAsignar == null) {
              opciones += `
              <button class="asignar dropdown-item"><i class="fa fa-bell mr-2"></i>Reservar memorandum</button>
              `;
              ultimoPorAsignar = row.id;
            } else if(row.nombre == localStorage.getItem('nombre') && row.direccion_server == null) {
              opciones += `
              <button class="dropdown-item"><i class="fa fa-upload mr-2"></i>Subir documento</button>
              `;
            } else if(ultimoPorAsignar != null) {
              return '';
            } else {
              opciones += `
              <button class="dropdown-item"><i class="fa fa-file-pdf mr-2"></i>Mostrar documento</button>
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
          }}
          ],
          "language": {
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
        this.ultimoPorAsignar = ultimoPorAsignar;
      },

      reservar() {
        $("#datatable tbody").on("click", "button.asignar", function(e){
          this.data = this.datatable.fnGetData( this.datatable.fnGetPosition( $(e.target).parents("tr")[0] ) );
          this.idRow = this.datatable.fnGetPosition( $(e.target).parents("tr")[0] );

          this.data.nombre = "Yesenia Bravo";
          console.log(this.datatable)
          console.log(this.idRow)

          this.datatable.fnUpdate(this.data, this.idRow);

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
              axios.put(`/api/memorandum/${this.data.id}/${this.data.anio}`, this.data).then(response => {
                Swal.fire({
                  title: "Oficio actualizado",
                  type: "info",
                  html: `Se actualizó correctamente el memorándum <span class="font-weight-bold">DTI-ME-${this.data.id}-${this.data.anio}</span>`
                });
                this.datatable
              }).catch( error => {
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
                  cadena = `No pudimos asignar el memorándum por los siguientes errores:<br><br>`;
                  cadena += '<ul class="list-group">';
                  $.each(response.errors, function (i, field) {
                    cadena +=`<li class="list-group-item"><span class="text-danger">${field}</span></li>`;
                  });
                  cadena += '</ul>';
                }
                Swal.fire(`Error al reservar el memorándum`, `${cadena}`, 'error');                
              });
            }
          });
        }.bind(this));
      },

      reservarAutomaticamente() {
        this.mostrarBotonReservar = false;
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

      subirDocumento() {

      },

      mostrarDocumento() {

      },

      confirmacion (titulo, mensaje) {
        Swal.fire({

        });
      }

    }
  }
</script>
