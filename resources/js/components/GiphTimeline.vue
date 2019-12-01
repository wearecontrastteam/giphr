<template>
    <div class="row">
        <div class="col-12 text-center" v-show="isLoading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="mt-1">Loading...</div>
        </div>

        <giph v-for="giph in giphs"
              :key="giph.id"
              :giph="giph"
              :logged-in-user-id="loggedInUserId"
              v-show="isLoaded"
              @giphupdated="handleGiphUpdated(giph, $event)"
        />
    </div>
</template>

<script>
    export default {
        name: "giph-timeline",
        props: {
            "loggedInUserId": {

            },
            "userHandle": {
                default: null
            }
        },
        data() {
            return {
                loading: true,
                giphs: []
            };
        },
        created(){
            console.log("Logged in user ID: ", this.loggedInUserId);
            this.getLatestGiphs();
            this.$bus.on('new-giph', this.getLatestGiphs);
        },
        beforeDestroy() {
            this.$bus.off('new-giph', this.getLatestGiphs);
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
                axios.get(this.getLatestGiphsUrl())
                    .then(response => {
                        this.giphs = response.data.data;
                        this.loading = false;
                    });
            },
            getLatestGiphsUrl(){
                return this.userHandle === null
                    ? '/api/giphs'
                    : '/api/users/@'+this.userHandle+'/giphs'
            },
            handleGiphUpdated(giph, updatedGiph){
                giph.likes_count = updatedGiph.likes_count;
                giph.likes = updatedGiph.likes;
            }
        }
    }
</script>

<style scoped>

</style>
