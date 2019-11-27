const vue = new Vue({
    el: '#app',
    data: {
        tarjetas: {},
        tarjetasPost: {
            id: 0,
            title: '',
            header: '',
            body: ''
        },
        accionSave: 'guardar',
        accionMostrar: 'mostrar',
        modal: 0,
        modalTitle: '',
        idUser: 1,
        idCategory: 1,
        errorTarjeta: 0,
        errorMessageTarjeta: [],
        errorMessage: '',
        successMessage: '',
        typeAction: 0,
        messageCreate: {
            title: 'Tarjeta creada',
            text: 'La tarjeta fue creada con éxito!',
            icon: 'success'
        },
        messageEdit: {
            title: 'Tarjeta modificada',
            text: 'La tarjeta fue modificada con éxito!',
            icon: 'success'
        }

    },
    methods: {
        getTarjetas() {
            axios.get('./api/api-v1.php?action=read'
            ).then((response) => {
                this.tarjetas = response.data.cards
                // console.log(this.tarjetas = response.data.cards);
            }).catch((error) => {
                console.log(error.response);
            })
        },
        saveTarjeta() {
            if (this.validateModal()) {
                return;
            }

            let dataCard = this.toFormData(this.tarjetasPost);

            axios.post('./api/api-v1.php?action=create', dataCard)
                .then((response) => {
                    console.log(response);
                    this.notificacion(1, response.data.error, response.data.message);
                    this.closeModal();
                    this.getTarjetas();
                }).catch((error) => {
                    this.closeModal();

                })
        },
        editTarjeta() {
            console.log(this.tarjetasPost);
            let formData = this.toFormData(this.tarjetasPost);
            axios.post('./api/api-v1.php?action=edit', formData)
                .then(response => {
                    console.log(response);
                    this.notificacion(2, response.data.error, response.data.message);
                    this.closeModal();
                    this.getTarjetas();
                })
                .catch(error => {
                    console.error(error);
                })
        },
        deleteTarjeta(id) {
            let formData = new FormData();
            formData.append('id', id);
            axios.post('./api/api-v1.php?action=delete', formData)
                .then((response) => {
                    this.notificacion(3, response.data.error, response.data.message);
                    this.getTarjetas();
                }).catch((error) => {
                    console.log(error);
                })
        },
        notificacion(option, state, message) {
            console.log(option, state, message);
            switch (option) {
                case 1:
                    switch (state) {
                        case false:
                            Swal.fire({
                                icon: 'success',
                                title: 'Tarjeta creada',
                                text: message,
                            })

                            break;
                        case true:
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message,
                            })
                            break;
                    }
                    break;
                case 2:
                    switch (state) {
                        case false:
                            Swal.fire({
                                icon: 'success',
                                title: 'Tarjeta modificada',
                                text: message,
                            })
                            break;
                        case true:
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message,
                            })
                            break;
                    }
                    break;
                case 3:
                    switch (state) {             
                        case true:
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: message,
                            })
                            break;
                    }
            }
        },
        notificacionDelete(id) {
            Swal.fire({
                title: 'Quieres borrar la tarjeta?',
                text: "No podrás revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Si, quiero Borrarla!'
            }).then((result) => {
                if (result.value) {
                    this.deleteTarjeta(id);
                    Swal.fire(
                        'Tarjeta Borrada!',
                        'La tarjeta a sido eliminada.',
                        'success'
                    )
                }
            })
        },
        openModal(action, data = []) {
            switch (action) {
                case 'create':
                    this.typeAction = 1;
                    this.modal = 1;
                    this.modalTitle = 'Crear Nueva Tarjeta';
                    this.tarjetasPost.title = '';
                    this.tarjetasPost.header = '';
                    this.tarjetasPost.body = '';
                    break;
                case 'edit':
                    console.log(this.tarjetasPost);
                    this.typeAction = 2;
                    this.modal = 1;
                    this.modalTitle = 'Editar Tarjeta';
                    this.tarjetasPost.id = data['id'];
                    this.tarjetasPost.title = data['title'];
                    this.tarjetasPost.header = data['header'];
                    this.tarjetasPost.body = data['body'];
                    break;
                default:
                    break;
            }
        },
        closeModal() {
            this.modal = 0;
            this.tarjetasPost.title = '';
            this.tarjetasPost.header = '';
            this.tarjetasPost.body = '';
        },
        validateModal() {
            this.errorTarjeta = 0;
            this.errorMessageTarjeta = [];

            if (!this.tarjetasPost.title) this.errorMessageTarjeta.push('*Ingrese un titulo para la tarjeta');
            if (!this.tarjetasPost.header) this.errorMessageTarjeta.push('*Ingrese una descripción para la tarjeta');
            if (!this.tarjetasPost.body) this.errorMessageTarjeta.push('*Ingrese un mensaje');

            if (this.errorMessageTarjeta.length) this.errorTarjeta = 1;

            return this.errorTarjeta;
        },
        toFormData(obj) {
            let form_data = new FormData();
            for (let key in obj) {
                form_data.append(key, obj[key]);
            }
            return form_data;
        }

    },
    mounted() {
        this.getTarjetas();
    },
})