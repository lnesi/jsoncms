<template>
    <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="ConfirmModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="ConfirmModalLabel" v-html="title"></h4>
          </div>
          <div class="modal-body" v-html="body">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> No</button>
            <button type="button" class="btn btn-success" @click="confirm()"><i class="fa fa-fw fa-check"></i> Yes</button>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            
            this.target=this.$parent;

            this.$parent.$on("CONFIRM",function(title,body,target,returnEvent){
                this.title=title;
                this.body=body;
                this.returnEvent=returnEvent;
                this.target=target;
                this.show();
            }.bind(this));
        },

        data(){
            return {
                title:"Title",
                body:"HTML body",
                returnEvent:"CONFIRM_OK",
                target:null
            }
        },

        methods:{
            show(){
                $("#ConfirmModal").modal("show");
            },

            hide(){
             $("#ConfirmModal").modal("hide");   
            },

            confirm(){
                this.target.$emit(this.returnEvent);
                this.hide();
            }
        }


    }
</script>
