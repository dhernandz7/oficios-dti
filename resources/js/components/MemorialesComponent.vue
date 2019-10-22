<template>
  <div>
    <input type="hidden" id="ultimo" value="nada">
    <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-book mr-2"></i>Memoriales</h1>
    <div class="shadow-lg p-4 mb-5 bg-white rounded">
      <button v-on:click="mostrarModalMemorial" id="registrar-memorial" class="btn btn-primary mb-3">
        <i class="fa fa-plus-circle fa-lg mr-2"></i>
        Registrar memorial
      </button>
      <div class="table-responsive">
        <table class="table table-hover border" id="datatable">
          <thead class="bg-dark text-white">
            <tr>
              <th>id</th>
              <th>Número proceso</th>
              <th>Tipo proceso</th>
              <th>Plazo audiencia</th>
              <th>Fecha de notificacion</th>
              <th>Fecha de evacuación de audiencia</th>
              <th>Asesor jurídico</th>
              <th>Fecha de registro</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </div>
    <div class="modal fade" id="registrarMemorialModal" tabindex="-1" role="dialog" aria-labelledby="registrarMemorialModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="registrarMemorialModalLabel"><i class="fa fa-file-pdf fa-lg mr-2"></i>
              Memorial {{data.numero_proceso}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form v-on:submit.prevent="registrarMemorial" id="formulario" autocomplete="off">
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="numero_proceso">Número de proceso<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.numero_proceso' class="form-control" type="text" name="numero_proceso" id="numero_proceso" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="plazo_audiencia_id">Plazo de audiencia<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.plazo_audiencia_id' class="form-control" name="plazo_audiencia_id" id="plazo_audiencia_id" required>
                    <option value=""></option>
                    <option v-bind:value="plazoAudiencia.id" v-for="plazoAudiencia in plazosDeAudiencias">{{plazoAudiencia.plazo_audiencia}}</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="fecha_evacuacion_audiencia">Fecha de evacuación de audiencia<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.fecha_evacuacion_audiencia' class="form-control" type="date" name="fecha_evacuacion_audiencia" id="fecha_evacuacion_audiencia" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="fecha_notificacion">Fecha de notificación<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.fecha_notificacion' class="form-control" type="date" name="fecha_notificacion" id="fecha_notificacion" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tipo_proceso_id">Tipo de proceso<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.tipo_proceso_id' class="form-control" name="tipo_proceso_id" id="tipo_proceso_id" required>
                    <option value=""></option>
                    <option v-bind:value="tipoDeProceso.id" v-for="tipoDeProceso in tipoDeProcesos">{{tipoDeProceso.tipo_proceso}}</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="pdf">Seleccione documento pdf</label><br>
                  <input v-on:change="mostrarEmbed('pdf', true)" class="form-control" type="file" id="pdf" name="pdf" accept="application/pdf" required>
                </div>
              </div>
              <div v-if="showEmbed" class="embed-responsive embed-responsive-21by9">
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

    <div class="modal fade" id="actualizarMemorialModal" tabindex="-1" role="dialog" aria-labelledby="actualizarMemorialModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="actualizarMemorialModalLabel"><i class="fa fa-file-pdf fa-lg mr-2"></i>
              Memorial {{data.numero_proceso}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form v-on:submit.prevent="actualizarMemorial" id="formularioActualizar" autocomplete="off">
            <div class="modal-body">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="numero_proceso">Número de proceso<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.numero_proceso' class="form-control" type="text" name="numero_proceso" id="numero_proceso" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="plazo_audiencia_id">Plazo de audiencia<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.plazo_audiencia_id' class="form-control" name="plazo_audiencia_id" id="plazo_audiencia_id" required>
                    <option value="">Seleccione plazo de audiencia</option>
                    <option v-bind:value="plazoAudiencia.id" v-for="plazoAudiencia in plazosDeAudiencias">{{plazoAudiencia.plazo_audiencia}}</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="fecha_evacuacion_audiencia">Fecha de evaluación de audiencia<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.fecha_evacuacion_audiencia' class="form-control" type="date" name="fecha_evacuacion_audiencia" id="fecha_evacuacion_audiencia" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="fecha_notificacion">Fecha de notificación<span class="text-danger ml-2">*</span></label>
                  <input v-model='data.fecha_notificacion' class="form-control" type="date" name="fecha_notificacion" id="fecha_notificacion" required>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tipo_proceso_id">Tipo de proceso<span class="text-danger ml-2">*</span></label>
                  <select v-model='data.tipo_proceso_id' class="form-control" name="tipo_proceso_id" id="tipo_proceso_id" required>
                    <option value="">Seleccione tipo de proceso</option>
                    <option v-bind:value="tipoDeProceso.id" v-for="tipoDeProceso in tipoDeProcesos">{{tipoDeProceso.tipo_proceso}}</option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="pdf">Seleccione documento pdf</label><br>
                  <input v-on:change="mostrarEmbed('pdf2', false)" class="form-control" type="file" id="pdf2" name="pdf" accept="application/pdf">
                </div>
              </div>
              <div v-if="showEmbed" class="embed-responsive embed-responsive-21by9">
                <iframe class="embed-responsive-item" v-bind:src="src"></iframe>
              </div>
            </div>
            <div class="modal-footer">
              <button v-if="btnSubmit" type="submit" class="btn btn-primary"><i class="fa fa-save fa-lg mr-2"></i>Registrar memorial</button>
              <button v-if="btnUpdateSubmit" type="submit" class="btn btn-primary"><i class="fa fa-edit fa-lg mr-2"></i>Actualizar memorial</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-lg mr-2"></i>Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="mostrarDocumento" tabindex="-1" role="dialog" aria-labelledby="adjuntarModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title font-weight-bold" id="adjuntarModalLabel">
              <i class="fa fa-file-pdf fa-lg mr-2"></i>
              Memorial {{data.numero_proceso}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="embed-responsive embed-responsive-4by3">
              <iframe class="embed-responsive-item" v-bind:src="src"></iframe>
            </div>
          </div>
          <div class="modal-footer">
            <button v-if="btnSubmit" type="submit" class="btn btn-primary"><i class="fa fa-upload fa-lg mr-2"></i>Adjuntar documento</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-lg mr-2"></i>Cancelar</button>
          </div>
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
        data: {
          'fecha_notificacion': '',
          'fecha_evacuacion_audiencia': '',
          'numero_proceso': '',
          'tipo_proceso_id': '',
          'plazo_audiencia_id': ''
        },
        miId: localStorage.getItem("id"),
        miNombre: localStorage.getItem("nombre"),
        idRow:0,
        showEmbed: false,
        btnSubmit: false,
        btnUpdateSubmit: false,
        pdf: '',
        src: null,
        tipoDeProcesos: [],
        plazosDeAudiencias: []
      }
    },
    mounted() {
      this.inicializarTabla()
      this.obtenerCatalogos()
      this.bloquearMemorial()
      this.eventoParaActualizarMemorial()
      this.mostrarDocumento()
    },
    methods: {
      inicializarTabla() {
        this.datatable = $('#datatable').DataTable({
          ajax: '/api/memorial',
          order: [[0,'desc']],
          lengthMenu: [[5, 10, 25, 50, 75, 100, -1], [5, 10, 25, 50, 75, 100, "todos"]],
          info: true,
          paging: true,
          autoWidth: false,
          columns: [
          {'data': 'id', 'name': 'id', 'visible': false},
          {'data': 'numero_proceso', 'name': 'numero_proceso'},
          {'data': 'tipo_proceso', 'name': 'tipo_proceso'},
          {'data': 'plazo_audiencia', 'name': 'plazo_audiencia'},
          {'data': 'fecha_notificacion', 'name': 'fecha_notificacion', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('L') : '';
          }},
          {'data': 'fecha_evacuacion_audiencia', 'name': 'fecha_evacuacion_audiencia', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('L') : '';
          }},
          {'data': 'name', 'name': 'name'},
          {'data': 'created_at', 'name': 'created_at', 'render': function(data) {
            return data != null ? moment(data).locale('es').format('LLL') : '';
          }},
          {'render': function(data, type, row) {
            let opciones = '';
            if (row.bloqueado == 0 && row.user_id == this.miId) {
              opciones = `
              <button class="mostrar dropdown-item"><i class="fa fa-file-pdf mr-2"></i>Mostrar documento</button>
              <button class="modificar dropdown-item"><i class="fa fa-edit mr-2"></i>Modificar</button>
              <button class="bloquear dropdown-item"><i class="fa fa-lock mr-2"></i>Bloquear</button>
              `
            } else {
              opciones = `
              <button class="mostrar dropdown-item"><i class="fa fa-file-pdf mr-2"></i>Mostrar documento</button>
              `
            }
            return `
            <div class="dropdown dropleft text-center">
            <button class="btn btn-outline-primary" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog fa-lg"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            ${opciones}
            </div>
            </div>
            `;
          }.bind(this)},
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

      mostrarModalMemorial() {
        $('#formulario')[0].reset();
        this.showEmbed = false;
        $("#registrarMemorialModal").modal("show");
      },

      registrarMemorial() {
        let formulario = new FormData();
        formulario.append('fecha_notificacion', this.data.fecha_notificacion)
        formulario.append('fecha_evacuacion_audiencia', this.data.fecha_evacuacion_audiencia)
        formulario.append('numero_proceso', this.data.numero_proceso)
        formulario.append('pdf', this.pdf)
        formulario.append('tipo_proceso_id', this.data.tipo_proceso_id)
        formulario.append('tipo_proceso', $('#tipo_proceso_id option:selected').html())
        formulario.append('plazo_audiencia_id', this.data.plazo_audiencia_id)
        formulario.append('plazo_audiencia', $('#plazo_audiencia_id option:selected').html())
        formulario.append('user_id', this.miId)
        formulario.append('name', this.miNombre)

        axios.post(`/api/memorial`, formulario)
        .then(response => {
          $("#registrarMemorialModal").modal("toggle")
          this.showEmbed = false
          response.data.created_at = response.data.created_at.date
          this.datatable.row.add(response.data).draw(false)
          Swal.fire({
            title: "Memorial registrado",
            type: "success",
            html: `Se registró correctamente el memorial <span class="font-weight-bold">${response.data.numero_proceso}</span>`
          }).then((result)=>{
            $("#formulario")[0].reset()
          })
        }).catch( error => {
          this.mostrarErrores(error, "Error al registrar el memorial", "No pudimos registrar el memorial por los siguientes motivos:<br><br>");
        });
      },

      bloquearMemorial() {
        $("#datatable tbody").on("click", "button.bloquear", function(e) {
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data()
          this.idRow = this.datatable.row( $(e.target).parents("tr")[0] ).index()
          Swal.fire({
            title: 'Bloquear memorial',
            html: `
            ¿Está seguro de bloquear el memorial <span class="font-weight-bold">${this.data.numero_proceso}</span>?
            <br><br>
            Esta acción hará que ya no se pueda modificar ningún dato
            `,
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<i class="fa fa-bell fa-lg mr-2"></i>Reservar oficio',
            cancelButtonText: '<i class="fa fa-times fa-lg mr-2"></i>Cancelar'
          }).then( (result) => {
            if( result.value) {
              let formulario = new FormData();
              formulario.append('fecha_notificacion', this.data.fecha_notificacion)
              formulario.append('fecha_evacuacion_audiencia', this.data.fecha_evacuacion_audiencia)
              formulario.append('numero_proceso', this.data.numero_proceso)
              formulario.append('pdf', this.pdf)
              formulario.append('tipo_proceso_id', this.data.tipo_proceso_id)
              formulario.append('tipo_proceso', $('#tipo_proceso_id option:selected').html())
              formulario.append('plazo_audiencia_id', this.data.plazo_audiencia_id)
              formulario.append('plazo_audiencia', $('#plazo_audiencia_id option:selected').html())
              formulario.append('user_id', this.miId)
              formulario.append('name', this.miNombre)
              formulario.append('_method', 'PUT')

              axios.post(`/api/memorial/${this.data.id}`, formulario)
              .then(response => {
                response.data.created_at = response.data.created_at.date
                this.datatable.row(this.idRow).data(response.data)
                Swal.fire({
                  title: "Memorial bloqueado",
                  type: "success",
                  html: `Se bloqueo correctamente el memorial <span class="font-weight-bold">${response.data.numero_proceso}</span>`
                }).then((result)=>{
                })
              }).catch( error => {
                this.mostrarErrores(error, "Error al bloquear el memorial", "No pudimos bloquear el memorial por los siguientes motivos:<br><br>");
              });
            }
          })
        }.bind(this))
      },

      eventoParaActualizarMemorial() {
        $("#datatable tbody").on("click", "button.modificar", function(e) {
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data()
          this.idRow = this.datatable.row( $(e.target).parents("tr")[0] ).index()
          $("#actualizarMemorialModal").modal("show")
          this.showEmbed = true
          this.btnUpdateSubmit = true
          this.src = this.obtenerUrl(this.data.path)
        }.bind(this))
      },

      actualizarMemorial() {
        let formulario = new FormData();
        formulario.append('fecha_notificacion', this.data.fecha_notificacion)
        formulario.append('fecha_evacuacion_audiencia', this.data.fecha_evacuacion_audiencia)
        formulario.append('numero_proceso', this.data.numero_proceso)
        formulario.append('pdf', this.pdf)
        formulario.append('tipo_proceso_id', this.data.tipo_proceso_id)
        formulario.append('tipo_proceso', $('#tipo_proceso_id option:selected').html())
        formulario.append('plazo_audiencia_id', this.data.plazo_audiencia_id)
        formulario.append('plazo_audiencia', $('#plazo_audiencia_id option:selected').html())
        formulario.append('user_id', this.miId)
        formulario.append('name', this.miNombre)
        formulario.append('_method', 'PUT')

        axios.post(`/api/memorial/${this.data.id}`, formulario)
        .then(response => {
          $("#actualizarMemorialModal").modal("toggle")
          this.showEmbed = false
          response.data.created_at = response.data.created_at.date
          this.datatable.row(this.idRow).data(response.data)
          Swal.fire({
            title: "Memorial actualizado",
            type: "success",
            html: `Se actualizó correctamente el memorial <span class="font-weight-bold">${response.data.numero_proceso}</span>`
          }).then((result)=>{
            $("#formularioActualizar")[0].reset()
          })
        }).catch( error => {
          this.mostrarErrores(error, "Error al actualizar el memorial", "No pudimos actualizar el memorial por los siguientes motivos:<br><br>");
        });
      },

      mostrarDocumento() {
        $("#datatable tbody").on("click", "button.mostrar", function(e){
          this.data = this.datatable.row($(e.target).parents("tr")[0]).data();
          this.src = this.obtenerUrl(this.data.path);
          $("#mostrarDocumento").modal("show");
        }.bind(this));
      },

      obtenerCatalogos() {
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

      mostrarEmbed(pdf, registrar) {
        this.showEmbed = true
        this.btnSubmit = registrar
        this.pdf = document.getElementById(pdf).files[0]
        this.src = URL.createObjectURL(this.pdf)
      },

      obtenerUrl(url) {
        if(url){
          return `${url.replace('public', 'storage')}#toolbar=0&navpanes=0&scrollbar=0`
        }
      },

      mostrarErrores(error, titulo, mensaje) {
        let cadena = '';
        if(error.response.status == 403) {
          cadena = `
          <ul class="list-group">
          <li class="list-group-item text-danger">No tiene permisos para realizar esta acción</li>
          </ul>
          `;
        } else if(error.response.status == 404) {
          cadena = `
          <ul class="list-group">
          <li class="list-group-item text-danger">No se encontró la ruta a la que intenta acceder</li>
          </ul>
          `;
        } else if(error.response.status == 500) {
          cadena = `
          <ul class="list-group">
          <li class="list-group-item text-danger">Ha ocurrido un error interno, por favor intente más tarde</li>
          </ul>
          `;
          cadena = '';
        } else if(error.response.status == 503){
          cadena = `
          <ul class="list-group">
          <li class="list-group-item text-danger">error.response.request.response</li>
          </ul>
          `;
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
