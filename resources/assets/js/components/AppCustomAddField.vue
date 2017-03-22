<template>
  <div>
    <modal id="addFieldModal" ref="modal">
          <h4 class="modal-title" slot="header">Add Field</h4>
          <form slot="body">
              <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:255" v-model="item.name">Name / Description</tbvue-input>
			        <tbvue-input name="key" id="in_key" placeholder="Key" rules="required|max:100" v-model="item.key">JSON Key</tbvue-input>
		          <tbvue-input name="help_text" id="in_help" placeholder="Help Text" rules="max:255" v-model="item.help_text">Help Text</tbvue-input>
		          <tbvue-ajax-dropdown data-url="ajax/components?paginate=false" name="input_type_id" rules="required" id="input_type_id" v-model="item.component_id">Input Type</tbvue-ajax-dropdown>
          </form>
          <button type="button" slot="footer" class="btn btn-default"  data-dismiss="modal">Cancel</button>
          <button type="button" slot="footer" class="btn btn-success" :class="{'btn btn-success': true, 'disabled': hasValidateErrors}" @click="validate"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
      </modal>
  </div>
</template>
<script>
  export default {
      validator:null,
      provider:null,
      mounted(){
        this.item.delivery_id=this.deliveryId
      },
      created(){
        this.provider = this.$resource("ajax/customs{/id}");
        this.createValidator();
       
      },
      data(){
        return {
          item:{
              delivery_id:'',
              name:'',
              key:'',
              help_text:'',
              component_id:'',
            },
          errors:null
        }
      },
      methods:{
        add(){

          this.provider.save(this.item).then(response => {
              this.$parent.value.push(response.body);
              this.$refs.modal.hide();
              this.reset();
          }, response => {
              console.log("errorAdding");
          });
        },
        validate(){
          this.validator.validateAll(this.item).then(() => {
            this.add();
          }).catch(() => {});
        },
        show(){
          this.$refs.modal.show();
        },
        createValidator() {
            this.validator = new VeeValidate.Validator();
            this.validator.attach('delivery_id', 'required|numeric', { prettyName: 'Delivery' });
            this.validator.attach('name', 'required', { prettyName: 'Name' });
            this.validator.attach('key', 'required', { prettyName: 'Key' });
            this.validator.attach('help_text', '', { prettyName: 'Help Text' });
            this.validator.attach('component_id', 'required|numeric', { prettyName: 'Input Type' });
            this.validator.validateAll(this.item).then(() => {}).catch(() => {});
            this.$set(this, 'errors', this.validator.errorBag);
        },
        reset(){
            this.item.name="";
            this.item.key="";
            this.item.help_text="";
            this.item.component_id="";
        }
      },
      watch:{
        deliveryId(value){
          this.item.delivery_id=value;
        }
      },
      props:["deliveryId"],
      computed:{
        hasValidateErrors(){
          this.validator.validateAll(this.item).then(() => {}).catch(() => {});
          return this.errors.count() > 0;
        }
      }

    }
</script>