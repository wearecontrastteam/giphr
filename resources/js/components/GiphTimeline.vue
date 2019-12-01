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

        <div v-if="showPagination" class="col-12">
            <nav>
                <ul class="pagination">
                    <li :class="{'page-item': true, 'disabled': isFirstPage}"><a class="page-link"  href="#" @click.prevent="goToPage(getPreviousPageNumber)">Previous</a></li>

                    <li v-for="page in pagination" :class="page.item_classes">
                        <a :class="page.link_classes" href="#" @click.prevent="goToPage(page.number)">{{ page.number }}</a>
                    </li>

                    <li :class="{'page-item': true, 'disabled': isLastPage}"><a class="page-link" href="#" @click.prevent="goToPage(getNextPageNumber)">Next</a></li>
                </ul>
            </nav>
        </div>

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
                params: {
                    page: 1,
                },
                api: {
                    current_page: 1,
                    last_page: 1,
                    path: '',
                    per_page: 50,
                    from: 1,
                    to: 2,
                    total: 2,
                },
                giphs: []
            };
        },
        created(){
            this.getLatestGiphs();
            this.$bus.on('new-giph', this.getLatestGiphs);
            this.$bus.on('giph-deleted', this.getLatestGiphs);
        },
        beforeDestroy() {
            this.$bus.off('new-giph', this.getLatestGiphs);
            this.$bus.off('giph-deleted', this.getLatestGiphs);
        },
        computed: {
            isLoading(){
                return this.loading;
            },
            isLoaded(){
                return this.loading === false;
            },
            showPagination(){
                return this.isLoaded && this.api.last_page > 1
            },
            pagination(){
                let pagination = [];
                for(var i = 1; i <= this.api.last_page; i++){
                    let page = {
                        item_classes: 'page-item',
                        link_classes: 'page-link',
                        number: i
                    };

                    if(this.api.current_page === i){
                        page.item_classes += ' active'
                    }

                    pagination.push(page);
                }
                return pagination;
            },
            isFirstPage(){
                return this.api.current_page === 1
            },
            isLastPage(){
                return this.api.current_page === this.api.last_page;
            },
            getPreviousPageNumber(){
                if(this.isFirstPage){
                    return 1;
                }
                return this.api.current_page - 1;
            },
            getNextPageNumber(){
                if(this.isLastPage){
                    return this.api.last_page;
                }
                return this.api.current_page + 1;
            },
        },
        methods: {
            getLatestGiphs(){
                this.loading = true;
                axios.get(this.getLatestGiphsUrl())
                    .then(response => {
                        this.giphs = response.data.data;
                        this.api = response.data.meta;
                        this.loading = false;
                    });
            },
            getLatestGiphsUrl(){
                return this.userHandle === null
                    ? '/api/giphs?page='+this.params.page
                    : '/api/users/@'+this.userHandle+'/giphs?page='+this.params.page
            },
            handleGiphUpdated(giph, updatedGiph){
                giph.likes_count = updatedGiph.likes_count;
                giph.likes = updatedGiph.likes;
            },
            goToPage(page){
                this.params.page = page;
                this.getLatestGiphs();
            }
        }
    }
</script>

<style scoped>

</style>
