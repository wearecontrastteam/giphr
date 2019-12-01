<template>
    <div class="col-12 mb-2">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto text-center">
                        <img :src="avatarUrl" class="rounded-circle profile">
                        <span v-if="canDelete" class="mt-4">
                            <br><br>
                            <a href="#" class="btn btn-sm btn-outline-danger" @click.prevent="deleteGiph">Delete</a>
                        </span>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <a :href="profileUrl" class="text-dark font-weight-bold">{{ name }}</a>
                                <a :href="profileUrl" class="text-muted">{{ username }}</a>
                                <span class="text-muted"> · {{ getDate }}</span>
                            </div>
                            <div class="col-12 mt-2">

                                <picture>
                                    <source :srcset="getWebpGiphyUrl(giph.giphy_id)" type="image/webp">
                                    <img class="img-fluid" :src="giphUrl">
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-auto text-center">
                        <a :class="{'btn': true, 'btn-primary': alreadyLiked(), 'btn-outline-secondary': !alreadyLiked()}" href="#" @click.prevent="like" style="width: 80px;">
                            <i class="fa fa-thumbs-o-up mr-1"></i> {{ getLikeCount }}
                        </a>
                    </div>
                    <div class="col">
                        <img :src="getSmallGiphyUrl(like.giphy_id)" v-for="like in giph.likes" :key="like.id" v-tooltip.top-center="likeTooltipText(like)" style="height: 50px; margin-bottom: 5px; margin-right: 5px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "giph",
        props: [
            'giph',
            'loggedInUserId'
        ],
        data() {
            return {
                liking: false,
            };
        },
        computed: {
            avatarUrl(){
                return 'https://media1.giphy.com/media/'+this.giph.user.avatar_giphy_id+'/100w.gif';
            },
            giphUrl(){
                return this.getGiphyUrl(this.giph.giphy_id);
            },
            getLikeCount(){
                return this.giph.likes_count || 0;
            },
            profileUrl(){
                return this.giph.user.profile_url;
            },
            name(){
                return this.giph.user.name;
            },
            username(){
                return '@'+this.giph.user.handle;
            },
            getDate(){
                return window.moment(this.giph.created_at).fromNow();
            },
            canDelete(){
                return this.loggedInUserId === this.giph.user.id && !this.isAJayZGiphyId(this.giph.giphy_id);
            }
        },
        methods: {
            alreadyLiked() {
                return this.giph.likes.some(like => like.user.id === this.loggedInUserId);
            },
            like(){
                if(this.liking === false) {
                    this.liking = true;
                    axios.post('/api/giphs/' + this.giph.id + '/likes')
                        .then(response => {
                            this.$emit('giphupdated', response.data.data);
                            this.liking = false;
                        });
                }
            },
            likeTooltipText(like) {
                if(like.user.id === this.loggedInUserId) {
                    return this.isAJayZGiphyId(like.giphy_id)
                        ? 'You & Jay-Z like this'
                        : 'You like this';
                }

                return this.isAJayZGiphyId(like.giphy_id)
                    ? ('Jay-Z & ' + like.user.name + ' like this')
                    : (like.user.name + ' (@' + like.user.handle + ') likes this');
            },
            getGiphyUrl(id){
                return 'https://i.giphy.com/'+id+'.gif';
            },
            getWebpGiphyUrl(id){
                return 'https://i.giphy.com/media/'+id+'/giphy.webp';
            },
            getSmallGiphyUrl(id){
                return 'https://i.giphy.com/media/'+id+'/100h.gif';
            },
            deleteGiph(){
                if(confirm('Are you sure you want to delete this Giph?')){
                    axios.delete('/api/giphs/'+this.giph.id)
                        .then(response => {
                            if(response.data.deleted === true){
                                this.$bus.emit('giph-deleted', this.giph);
                            }
                        });
                }
            },
            isAJayZGiphyId(giphy_id) {
                return ['cYJgsdeB6VThe','hiLLD9o1wTB3a','zGQHs1NVHgsbm','D2LrM215q3V3W','zCIhx4xzAPn0s'].indexOf(giphy_id) !== -1;
            }
        }
    }
</script>

<style scoped>

</style>
