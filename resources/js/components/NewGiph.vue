<template>
    <giphy-search :avatar-giphy-id="avatarGiphyId" placeholder-text="What's giphening?" button-text="Giph"></giphy-search>
</template>

<script>
    export default {
        name: "new-giph",
        props: ['avatarGiphyId'],
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
                        }
                    });
            },
        }
    }
</script>