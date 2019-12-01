<template>
    <div>
        <div v-if="userPostCount === 0 && !posted" class="alert alert-primary" role="alert">
            You've not posted any giphs yet. Click <a href="#" @click="giphJayZ($event)">here</a> to post one...
        </div>
        <giphy-search :avatar-giphy-id="avatarGiphyId" placeholder-text="What's giphening?" button-text="Giph"></giphy-search>
    </div>
</template>

<script>
    export default {
        name: "new-giph",
        props: [
            'avatarGiphyId',
            'userPostCount'
        ],
        data() {
            return {
                'posted': false
            }
        },
        created(){
            this.$bus.on('giphy-search-button-clicked', this.createGiph);
        },
        beforeDestroy() {
            this.$bus.off('giphy-search-button-clicked', this.createGiph);
        },
        methods: {
            createGiph(data){
                console.log("Creating new giph: ", data.giphy_id);
                this.saving = true;
                axios.post('/api/giphs', {giphy_id: data.giphy_id})
                    .then(response => {
                        if(response.data.hasOwnProperty('status') && response.data.status === 'ok'){
                            this.$bus.emit('clear-search');
                            this.$bus.emit('new-giph');
                            this.posted = true;
                        }
                    });
            },
            giphJayZ(event) {
                event.preventDefault();
                this.createGiph({
                    'giphy_id': 'cYJgsdeB6VThe'
                })
            }
        }
    }
</script>