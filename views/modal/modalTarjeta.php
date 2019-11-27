<div class="modal fade mt-5" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
     style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-primary modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" v-text="modalTitle"></h4>
                <button type="button" class="close" @click="closeModal()" aria-label="Close">
                    <span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Título</label>
                        <div class="col-md-9">
                            <input type="text" v-model="tarjetasPost.title" class="form-control"
                                   placeholder="Título de la Tarjeta" autofocus>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="text-input">Descripción Corta</label>
                        <div class="col-md-9">
                            <input type="text" v-model="tarjetasPost.header" class="form-control"
                                   placeholder="Agrega una descripcion para la tarjeta" autofocus>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 form-control-label" for="email-input">Mensaje</label>
                        <div class="col-md-9">
                            <textarea type="text" v-model="tarjetasPost.body" class="form-control"
                                      placeholder="Ingrese el cuerpo del mensaje"></textarea>
                        </div>
                    </div>
                    <div v-show="errorTarjeta" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMessageTarjeta" :key="error" v-text="error">

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="closeModal()">Cerrar</button>
                <button type="button" v-if="typeAction==1" class="btn btn-primary" @click="saveTarjeta()">Enviar
                </button>
                <button type="button" v-if="typeAction==2" class="btn btn-primary" @click="editTarjeta()">Modificar
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>