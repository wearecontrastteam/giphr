<template>
    <div class="imgresult-wrapper" v-bind:style="{width: getImgWidth + 'px', height: getImgHeight + 'px'}">
        <img :src="imgsrc" class="imgresult-image" @click="onClick" :class="{ selected: is_selected }"  v-bind:style="{width: imgwidth + 'px', height: imgheight + 'px'}">
    </div>
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
        computed: {
            getImgWidth(){
                return parseInt(this.imgwidth) + 5;
            },
            getImgHeight(){
                return parseInt(this.imgheight) + 5;
            },
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
    .imgresult-wrapper {
        position: relative;
        background: white;
    }

    .imgresult-wrapper:not(:empty) {
        z-index: 0;
    }

    .imgresult-image {
        border: 5px solid transparent;
        transition: all 0.25s;
    }

    .imgresult-image:hover, .imgresult-image.selected {
        border:5px solid #007bff;

        z-index: 999;
        cursor: pointer;

        transition: all 0.25s;
    }


</style>
