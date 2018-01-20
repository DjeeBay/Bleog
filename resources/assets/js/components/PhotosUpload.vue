<template>
    <div>
        <div class="form-group">
            <label for="photos">Sélectionnez les photos</label>
            <input type="file" id="photos" v-on:change="getPhotos" accept=".jpg,.png" multiple>
            <p class="help-block">jpg, png, 5Mo max.</p>
        </div>

        <div v-if="showPhotos" class="row">
            <div class="row">
                <div v-for="photo in photos" class="col-md-2">
                    <img :src="photo" alt="photo" class="img-responsive">
                </div>
            </div>
        </div>
        <br>
        <div v-if="photos.length" class="row">
            <div class="col-md-3">
                <button v-on:click="send()" v-show="!hideSendBtn" type="button" class="btn btn-primary">Envoyer</button>
            </div>
            <div class="col-md-9">
                <div v-if="showProgress" class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" :style="{width: progress+'%'}">
                        {{progress}}%
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'photos-upload',
        props: {
            showPhotos: {
                type: Boolean,
                required: false
            }
        },
        methods: {
            getPhotos(e) {
                this.photos = []
                this.progress = 0
                this.showProgress = false
                this.hideSendBtn = false
                let files = e.target.files || e.dataTransfer.files
                if (!files.length) {
                    return
                }
                this.files = files
                this.createPhotos(files)
            },
            createPhotos(files) {
                for (let i = 0; i < files.length; i++) {
                    let reader = new FileReader()
                    reader.onload = (e) => {
                        this.photos.push(e.target.result)
                    }
                    reader.readAsDataURL(files[i]);
                }
            },
            send() {
                const vm = this
                this.showProgress = true
                let form = new FormData();
                for (let i = 0; i < this.files.length; i++) {
                    form.append('photos[]', this.files[i])
                }
                this.hideSendBtn = true
                axios.post('/add/upload_photos', form, {
                    headers: {'Content-Type': 'multipart/form-data'},
                    onUploadProgress: function(e) {
                        vm.progress = Math.round((e.loaded * 100) / e.total)
                    }
                }).then((res) => {
                    this.$store.dispatch('showAlert', {message: res.data.message, status: res.data.success ? 'success' : 'danger'})
                }).catch((error) => {
                    this.$store.dispatch('showAlert', {message: error.response.data.message, status: 'danger'})
                })
            }
        },
        data() {
            return {
                photos: [],
                files: [],
                progress: 0,
                showProgress: false,
                hideSendBtn: false
            }
        }
    }
</script>

<style scoped>

</style>