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
              return '<i class="fa fa-bell mr-2 text-success"></i>Disponible para reservar';
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

          Swal.fire({
            title: 'Reservar memorándum',
            type: 'question',
            html: `
            ¿Está seguro de reservar el memorándum <span class="font-weight-bold">DTI-ME-${this.data.id}-${this.data.anio}</span>?
            `
          }).then( (result) => {
            if( result.value) {
              //axios.put
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
          cancelButtonText: '<i class="fa fa-close fa-lg mr-2"></i>Cancelar'
        }).then( (result) => {
          if( result.value) {
            //
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
