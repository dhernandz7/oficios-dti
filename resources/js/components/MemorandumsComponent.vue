<template>
  <div>
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-users mr-2"></i>Oficios</h1>
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
        <tbody></tbody>
      </table>
    </div>
  </div>
</template>

<script>
  export default {
    data() {
      return {
        datatable: []
      }
    },
    mounted() {
      this.datatable = $('#datatable').DataTable({
        ajax: '/api/memorandum',
        lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
        info: true,
        paging: true,
        autoWidth: false,
        columns: [
        {'data': 'id', 'name': 'id'},
        {'data': 'anio', 'name': 'anio'},
        {'render': function(data, type, row) {
          return `DTI-ME-${row.id}-${row.anio}`;
        }},
        {'data': 'fecha_asignacion', 'name': 'fecha_asignacion'},
        {'data': 'nombre', 'name': 'nombre'},
        {'render': function(data, type, row) {
          return `
            <div class="dropdown dropleft text-right">
              <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Opciones
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <a href="" target="_blank" class="dropdown-item"><i class="fa fa-file-pdf mr-2"></i>Mostrar documento adjunto</a>
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
      console.log('Component mounted.');
    }
  }
</script>
