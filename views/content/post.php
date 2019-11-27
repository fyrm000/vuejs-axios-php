<div class="container mt-5">



    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mt-5" v-for="tarjeta in tarjetas">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" v-text="tarjeta.title"></h5>
                    <p class="card-text" v-text="tarjeta.header"></p>
                    <span class="fechaEdit" v-text="tarjeta.dateEdit"></span>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-text="tarjeta.body"></li>
                </ul>
                <div class="card-footer">
                    <button type="button" class="btn btn-info btn-block" @click="openModal('edit', tarjeta)">Editar</button>

                    <button type="button" class="btn btn-warning btn-block" @click="notificacionDelete(tarjeta.id)">Borrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>