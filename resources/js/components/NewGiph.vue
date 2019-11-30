<template>
    <div class="row row-cols-1">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend mr-4">
                                        <span class="input-group-img">
                                            <img src="https://i.giphy.com/media/YsTs5ltWtEhnq/giphy.webp" class="rounded-circle profile">
                                        </span>
                        </div>
                        <input type="text" class="form-control" placeholder="What's Giphening?">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">Giph</button>
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
        props: [],
        data() {
            return {};
        },
        computed: {},
        methods: {}
    }
</script>

<style scoped>

</style>
