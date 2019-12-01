<template>
    <div class="text-center">
        <img :src="'https://i.giphy.com/media/' + giphy_id + '/giphy.webp'" style="max-width: 100%">
        <input type="hidden" name="avatar_giphy_id" :value="giphy_id">
    </div>
</template>

<script>

    export default {
        name: "profile-settings-avatar",

        props: {
            giphy_id: ''
        },
        data() {
            return {
            }
        },
        created(){
            // axios.get('/api/user').then(response => console.log(response));
            this.$bus.on('select-giph', this.setSelectedGiph);
        },
        beforeDestroy() {
            this.$bus.off('select-giph', this.setSelectedGiph);
        },
        methods: {
            setSelectedGiph(data) { // there's probably a more concise / more declarative way to do this
                this.giphy_id = data.giphy_id;
                this.$bus.emit('clear-search');
            }
        }
    };
</script>

<style scoped>

</style>
