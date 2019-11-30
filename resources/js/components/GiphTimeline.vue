<template>
    <div class="row">
        <div class="col-12 text-center" v-show="isLoading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="mt-1">Loading...</div>
        </div>

        <giph v-for="giph in giphs" :key="giph.id" :giph="giph" v-show="isLoaded" />
    </div>
</template>

<script>
    export default {
        name: "giph-timeline",
        props: [],
        data() {
            return {
                loading: true,
                giphs: [
                    {
                        "id": 1,
                        "giphy_id": "YsTs5ltWtEhnq",
                        "user": {
                            "id": 2,
                            "giphy_id": "hiLLD9o1wTB3a",
                            "user": {
                                "id": 2,
                                "name": "Not Andy",
                                "email": "andy@french-property.com",
                                "avatar_giphy_id": "not-andy-gif"
                            }
                        },
                        "likes": [
                            {
                                "id": 1,
                                "giphy_id": "kigfYxdEa5s1ziA2h1",
                                "user": {
                                    "id": 1,
                                    "name": "Andy Knight",
                                    "email": "theknight92@gmail.com",
                                    "avatar_giphy_id": "some-giphy-id"
                                }
                            },

                        ]
                    }
                ]
            };
        },

        computed: {
            isLoading(){
                return this.loading;
            },
            isLoaded(){
                return this.loading === false;
            }
        },
        methods: {
            getLatestGiphs(){
                this.loading = true;
                axios.get('/api/giphs')
                .then(response => {
                    this.giphs = response.data.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>
