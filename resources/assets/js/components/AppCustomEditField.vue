<template>
    <div>
        <modal id="editFieldModal" ref="modal">
            <h4 class="modal-title" slot="header">Edit Field</h4>
              <form slot="body">
                  <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:255" v-model="item.name">Name / Description</tbvue-input>
                  <tbvue-input name="key" id="in_key" placeholder="Key" rules="required|max:100" v-model="item.key">JSON Key</tbvue-input>
                  <tbvue-input name="help_text" id="in_help" placeholder="Help Text" rules="max:255" v-model="item.help_text">Help Text</tbvue-input>
              </form>
              <button type="button" slot="footer" class="btn btn-default"  data-dismiss="modal">Cancel</button>
              <button type="button" slot="footer" class="btn btn-success" :class="{'btn btn-success': true, 'disabled': hasValidateErrors}" @click="validate"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
        </modal>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                item:{}
            }
        },
       props:['value'],
       computed:{
        hasValidateErrors(){
            return false;
        }
       },
       methods:{
        validate(){

        },
        show(item){
            this.item=item;
            this.$refs.modal.show();
        }
       }
    }
</script>
