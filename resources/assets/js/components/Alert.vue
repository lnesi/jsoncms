<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
               <div :class="typeClass" role="alert" v-show="visible">
                  <button type="button" class="close"  aria-label="Close"><span aria-hidden="true" @click="hide()">&times;</span></button>
                  
                  <strong><i :class="iconClass"></i><span v-html="title"></span></strong> 
                  <div v-html="message"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
  
        mounted(){
            this.$parent.$on('ALERT', function (title,message,type="info",hideDelay="0") {
                this.type=type;
                this.title=title;
                this.message=message;
                this.hideDelay=hideDelay;
                this.show();
            }.bind(this));
        },
         data(){
                return {
                    visible:false,
                    type:"warning",
                    title:"Info!",
                    message:"This is the message <strong>body</stong>",
                    hideDelay:0
                }
          },
          
          methods:{
            hide(){
                this.visible=false;
            },
            show(){
                 this.visible=true;
                 if(this.hideDelay>0){
                    setTimeout(function(){
                        this.hide();
                    }.bind(this),this.hideDelay*1000)
                 }
            }
          },

          computed:{
            typeClass(){
                switch(this.type){
                    case "success":
                        return "alert alert-success";
                        break;
                    case "danger":
                        return "alert alert-danger";
                        break;
                    case "warning":
                        return "alert alert-warning";
                        break;
                    default:
                        return "alert alert-info";
                        break;
                }
            },

            iconClass(){
                switch(this.type){
                    case "success":
                        return "fa fa-fw fa-check";
                        break;
                    case "danger":
                        return "fa fa-fw fa-exclamation-triangle";
                        break;
                    case "warning":
                        return "fa fa-fw fa-exclamation-circle";
                        break;
                    default:
                        return "fa fa-fw fa-exclamation";
                        break;
                }
            }

          }
    }
</script>
