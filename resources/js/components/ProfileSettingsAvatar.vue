<template>
    <div>
        <div v-if="id" class="text-center">
            <img :src="'https://i.giphy.com/media/' + id + '/giphy.gih'" style="max-width: 100%">
            <input type="hidden" name="avatar_giphy_id" :value="id">
        </div>
        <giphy-search :placeholder-text="getPlaceholder" :showGiphButton="false" />
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
                id: ''
            }
        },
        created(){
            this.id = this.giphy_id;
            this.$bus.on('select-giph', this.setSelectedGiph);
        },
        beforeDestroy() {
            this.$bus.off('select-giph', this.setSelectedGiph);
        },
        computed: {
            getPlaceholder(){
                return this.id
                    ? 'Find a new avatar...'
                    : 'Choose your avatar...'
            }
        },
        methods: {
            setSelectedGiph(data) { // there's probably a more concise / more declarative way to do this
                this.id = data.giphy_id;
                this.$bus.emit('clear-search');
            }
        },
        watch: {
            giphy_id(newValue, oldValue){
                this.id = newValue;
            }
        }
    };
</script>

<style scoped>

</style>
