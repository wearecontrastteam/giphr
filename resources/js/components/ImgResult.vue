<template>
    <div class="imgresult-entry" @click="onClick" v-bind:class="{ selected: is_selected }" v-bind:style="{width: imgwidth + 'px', height: imgheight + 'px', backgroundImage: 'url('+imgsrc+')', backgroundColor:bgcolor}">&nbsp;</div>
</template>

<script>

    export default {
        name: "img-result",

        props: {
            imgwidth: 0,
            imgheight: 0,
            imgsrc: '',
            giphy_id: '',
            bgcolor: '',
        },
        data() {
            return {
                is_selected: null
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
            onClick: function() {
                //window.open(this.giphy_id, '_blank');

                this.is_selected = true;
                this.$bus.emit('select-giph', {
                    "giphy_id": this.giphy_id
                });
            },
            setSelectedGiph(data) { // there's probably a more concise / more declarative way to do this
                if(data.giphy_id !== this.giphy_id) {
                    this.is_selected = false;
                }
            }
        }
    };
</script>

<style scoped>
    .imgresult-entry {
        opacity: 0;
        box-shadow: 0 0 0px rgba(255, 0, 255, 0);
        transition: all 0.25s;
        left: -1em;
        position: relative;
        background: white;
        background-image: initial;
    }

    .imgresult-entry:not(:empty) {
        box-shadow: 0 0 10px rgba(255, 0, 255, 0.25);
        margin: 0.25em;
        transition: all 1s;
        opacity: 1;
        background: black;
        z-index: 0;
    }

    .imgresult-entry:hover {
        /*box-shadow: 0 0 100px black;*/
        border:5px solid black;
        transition: 0.25s;
        z-index: 999;
        cursor: pointer;
    }

    .imgresult-entry.selected {
        /*box-shadow: 0 0 100px black;*/
        border:5px solid black;
        transition: 0.25s;
        z-index: 999;
        cursor: pointer;
    }
</style>
