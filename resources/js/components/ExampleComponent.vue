<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
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
                datatable
            }
        },
        created() {
            this.datatable = $('#datatable').DataTable({
                autoWidth: false
            });
            console.log('Component mounted.')
            console.log(this.datatable.fnGetData()[0]);
        }
    }
</script>
