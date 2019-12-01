<template>
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <img :src="profileUrl" class="rounded-circle profile">
                    </div>
                    <div class="col">
                        <img :src="giphUrl">
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-1 text-center">
                        <a class="btn btn-outline-secondary" href="#" @click.prevent="like">
                            {{ getLikeCount }} <i class="fa fa-thumbs-o-up"></i>
                        </a>
                    </div>
                    <div class="col">
                        <img v-for="like in giph.likes" :key="like.id" :src="getGiphyUrl(like.giphy_id)" style="height: 50px; margin-bottom: 5px; margin-right: 5px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "giph",
        props: ['giph'],
        data() {
            return {

            };
        },
        computed: {
            profileUrl(){
                return this.getGiphyUrl(this.giph.user.avatar_giphy_id);
            },
            giphUrl(){
                return this.getGiphyUrl(this.giph.giphy_id);
            },
            getLikeCount(){
                return this.giph.likes_count || 0;
            },
        },
        methods: {
            like(){
                axios.post('/api/giphs/'+this.giph.id+'/likes')
                    .then(response => {
                        this.$emit('giphupdated', response.data.data);
                    });
            },
            getGiphyUrl(id){
                return 'https://i.giphy.com/media/'+id+'/giphy.webp';
            },
        }
    }
</script>

<style scoped>

</style>
