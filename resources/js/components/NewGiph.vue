<template>
    <div class="row row-cols-1">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend mr-4">
                            <span class="input-group-img">
                                <img :src="profileUrl" class="rounded-circle profile">
                            </span>
                        </div>
                        <input type="text" class="form-control" placeholder="What's Giphening?" v-model="giphy_id">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" @click.prevent="createGiph">Giph</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "new-giph",
        props: ['avatarGiphyId'],
        data() {
            return {
                saving: false,
                giphy_id: '',
            };
        },
        computed: {
            profileUrl(){
                return 'https://i.giphy.com/media/'+this.avatarGiphyId+'/giphy.webp';
            }
        },
        methods: {
            createGiph(){
                this.saving = true;
                axios.post('/api/giphs', {giphy_id: this.giphy_id})
                .then(response => {
                    this.giphy_id = '';
                    if(response.data.hasOwnProperty('status') && response.data.status === 'ok'){
                        this.$bus.emit('new-giph');
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
