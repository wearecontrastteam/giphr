<template>
    <div>
        <div>
            <div class="search-box">
                <input id="search-entry" placeholder="Type search term" v-model="search_query" type="text" />
                <br/>

                <span class="status" v-if="status">{{status}}</span>
            </div>
            <div class="results">
                    <img-result v-for="entry in search_results"
                                :key="entry.giphy_link"
                               :imgwidth="entry.width"
                               :imgheight="entry.height"
                               :imgsrc="entry.src"
                               :bgcolor="dd_sticker_bg"
                               :giphy_link="entry.giphy_link"/>
            </div>
        </div>
    </div>
</template>

<script>
    // Vue.config.debug = true;
    // Vue.config.devtools = true;
    // Vue.config.silent = true;

    export default {
        name: "giphy-search",

        data() {
            return {
                search_query: '',
                search_results: [],
                status: "",
                count: 25, // 25 seems to be the maximum allowed by the API
                cb_sticker: false,
                dd_sticker_bg: "white"
            }
        },
        watch: {
            cb_sticker(val) { this.process(val); },
            dd_sticker_bg(val) { this.process(val); },
            count(val) { this.process(val); },
            search_query(val) { this.process(val); }
        },
        methods: {
            process(val) {
                console.log('process');
                this.doTheSearch();
            },

            //doTheSearch() {
            doTheSearch: _.debounce(function() {
                //console.log("_.debounce'd: ", this.search_query);
                if (this.search_query !== '') {
                    //console.log('searching for ' + this.search_query);
                    this.status = "Searching for "+this.search_query+"...";
                    axios.get("https://api.giphy.com/v1/"+(this.cb_sticker?"stickers":"gifs")+"/search?api_key=dc6zaTOxFJmzC&limit=" + this.count + "&q=" + this.search_query)
                        .then(res => {
                            //console.log(res);
                            //console.log("OK", res);
                            this.search_results = [];
                            console.log(res.data.data);
                            for (var entry in res.data.data) {

                                var e = res.data.data[entry];
                                //console.log(e);
                                //console.log(entry);

                                this.search_results.push({
                                    width: e.images.fixed_height.width,
                                    height: e.images.fixed_height.height,
                                    src: e.images.fixed_height.webp,
                                    giphy_link: e.url
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
            }, 750)
        }
    };
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