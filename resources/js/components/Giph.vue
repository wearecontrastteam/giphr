<template>
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <img :src="profileUrl" class="rounded-circle profile mr-4">

                <img :src="giphUrl">

                <div class="row mt-2 ml-4">
                    <button type="submit" class="btn btn-default" @click.prevent="like">
                        <i class="fa fa-thumbs-o-up"></i>
                    </button>
                    <a href="btn btn-outline-default" @click.prevent="showLikes = true">{{ getLikeCount }}</a>
                </div>

                <div class="row mt-2 ml-4">
                    <img v-for="like in giph.likes" :key="like.id" :src="getGiphyUrl(like.giphy_id)" style="height: 50px; margin-bottom: 10px;">
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
                showLikes: false
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
            }
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
