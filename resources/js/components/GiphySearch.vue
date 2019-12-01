<template>
    <div class="row row-cols-1">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="input-group">
                        <div v-if="avatarGiphyId" class="input-group-prepend mr-4">
                            <span class="input-group-img">
                                <img :src="profileUrl" class="rounded-circle profile">
                            </span>
                        </div>
                        <input type="text" class="form-control" :placeholder="placeholderText" v-model="search_query">
                        <div v-if="buttonText" class="input-group-append">
                            <button class="btn btn-outline-primary" @click.prevent="buttonClicked">{{buttonText}}</button>
                        </div>
                    </div>

                    <span class="status" v-if="status">{{status}}</span>

                    <div class="results" v-if="search_results.length > 0" style="margin-top:2em; overflow-y:scroll; max-height:270px">
                        <img-result v-for="entry in search_results"
                                    :key="entry.giphy_id"
                                    :imgwidth="entry.width"
                                    :imgheight="entry.height"
                                    :imgsrc="entry.src"
                                    :bgcolor="dd_sticker_bg"
                                    :giphy_id="entry.giphy_id"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "giphy-search",
        props: [
            'placeholderText',
            'buttonText',
            'avatarGiphyId'
        ],
        data() {
            return {
                saving: false,
                giphy_id: '',

                search_query: '',
                search_results: [],
                status: "",
                count: 25, // 25 seems to be the maximum allowed by the API
                cb_sticker: false,
                dd_sticker_bg: "white"
            };
        },
        created(){
            // axios.get('/api/user').then(response => console.log(response));
            this.$bus.on('select-giph', this.setSelectedGiph);
            this.$bus.on('clear-search', this.clearSearch);
        },
        beforeDestroy() {
            this.$bus.off('select-giph', this.setSelectedGiph);
            this.$bus.off('clear-search', this.clearSearch);
        },
        watch: {
            cb_sticker(val) { this.process(val); },
            dd_sticker_bg(val) { this.process(val); },
            count(val) { this.process(val); },
            search_query(val) { this.process(val); }
        },
        computed: {
            profileUrl(){
                return 'https://i.giphy.com/media/'+this.avatarGiphyId+'/giphy.webp';
            }
        },
        methods: {
            setSelectedGiph(data){
                console.log("selected giph: ", data.giphy_id);
                this.giphy_id = data.giphy_id;
            },

            process(val) {
                console.log('process');
                this.doTheSearch();
            },

            doTheSearch: _.debounce(function() {
                //console.log("_.debounce'd: ", this.search_query);
                if (this.search_query !== '') {
                    //console.log('searching for ' + this.search_query);
                    this.status = "Searching for "+this.search_query+"...";
                    axios.get("https://api.giphy.com/v1/"+(this.cb_sticker?"stickers":"gifs")+"/search?api_key=5bknz8GPVSWCaiMGxx51ojMqRLK963LJ&limit=" + this.count + "&q=" + this.search_query)
                        .then(response => {
                            //console.log(res);
                            //console.log("OK", res);
                            this.search_results = [];
                            console.log(response.data.data);
                            for (var entry_i in response.data.data) {

                                var entry = response.data.data[entry_i];
                                console.log(entry);

                                this.search_results.push({
                                    width: entry.images.fixed_height_small.width,
                                    height: entry.images.fixed_height_small.height,
                                    src: entry.images.fixed_height_small.webp,
                                    giphy_id: entry.id
                                })
                            }
                            this.status = (this.search_results.length == 0) ? "No results for " +  this.search_query: "";
                        }).catch((error) => {
                        console.log(error);
                    });
                } else {

                    this.search_results = [];
                    this.status = "";
                }
            }, 750),
            clearSearch() {
                this.search_query = '';
                this.search_results = [];
                this.status = "";
            },
            buttonClicked() {
                this.$bus.emit('giphy-search-button-clicked', {
                    "giphy_id": this.giphy_id
                });
            }
        }
    }
</script>

<style scoped>
    .results {
        padding: 1em;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
        justify-content: center;
    }
</style>
