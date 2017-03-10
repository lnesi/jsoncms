<template>
    <div id="preloader" :class="displayClass" >
        <i class="fa fa-spinner fa-pulse fa-4x fa-fw"></i>
        <span class="sr-only">Loading...</span>
    </div>
</template>

<script>
    export default {
        mounted() {
            $("#preloader").find("i").css("margin-top",($(window).height()/2)-($("#preloader").find("i").outerHeight()/2));
            this.$parent.$on("SHOW_PRELOADER",function(){
                this.visible=true;
            }.bind(this));

            this.$parent.$on("HIDE_PRELOADER",function(){
                this.visible=false;
            }.bind(this));
        },
        data:function(){
            return{
                visible:true
            }
        },
        computed:{
            displayClass(){
                if(this.visible){
                    return "fadeIn";
                }else{
                    return "fadeOut";
                }
            }
        }
    }
</script>

<style lang="scss" >
    $duration:0.5s;
    #preloader{
        position: absolute;
        width: 100%;
        top: 0;
        height: 100%;
        left: 0;
        background: rgba(0,0,0,.75);
        z-index: 1000;
        color:#fff;
        text-align: center;
        &.fadeOut{
            pointer-events: none;
            opacity: 0;
            -transition: opacity $duration ease-in-out;
            -webkit-transition: opacity $duration ease-in-out;
            -moz-transition: opacity $duration ease-in-out;
            -ms-transition: opacity $duration ease-in-out;
            -o-transition: opacity $duration ease-in-out;
        }

        &.fadeIn{
            pointer-events: auto;
            opacity: 1;
            -transition: opacity $duration ease-in-out;
            -webkit-transition: opacity $duration ease-in-out;
            -moz-transition: opacity $duration ease-in-out;
            -ms-transition: opacity $duration ease-in-out;
            -o-transition: opacity $duration ease-in-out;
        }
    }
</style>