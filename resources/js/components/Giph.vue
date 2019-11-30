<template>
    <div class="col">
        <div class="card">
            <div class="card-body">
                <img :src="profileUrl" class="rounded-circle profile mr-4">

                <img :src="giphUrl">

                <div class="row mt-2 ml-4">
                    <button type="submit" class="btn btn-primary">
                        👍
                    </button>
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
            return {};
        },
        computed: {
            profileUrl(){
                return 'https://i.giphy.com/media/'+this.giph.user.giphy_id+'/giphy.webp';
            },
            giphUrl(){
                return 'https://i.giphy.com/media/'+this.giph.giphy_id+'/giphy.webp';
            }
        },
        methods: {}
    }
</script>

<style scoped>

</style>
