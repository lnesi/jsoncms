<template>
  <div :class="{'form-group': true, 'has-error': errors.has(this.name) }">
    <label :for="id" class="control-label"><slot></slot></label>
    <div class="tbvue_input_holder">
      <input v-model="inputmodel" type="text" :name="name" class="form-control" :id="id" @blur="validate" :placeholder="placeholder" >
      <i class="fa fa-fw fa-exclamation-triangle text-danger" v-show="errors.has(this.name) " ></i>
    </div>
    <p class="help-block">{{ errors.first(this.name) }}</p>
  </div>
</template>
<style lang="scss">
    .tbvue_input_holder{
        position:relative;
        i{
            position: absolute;
            top: 0.34em;
            right: 1em;
            font-size: 1.5em;
            opacity: 0.5;
        }
    }
</style>
<script>
    export default {
      validator: null,
       created(){

        this.validator=new VeeValidate.Validator();
        this.validator.attach(this.name, this.rules , {prettyName:this.$slots.default[0].text});
        this.$set(this, 'errors', this.validator.errorBag);
        //this.validate();
       
       },
       mounted(){
          this.inputmodel=this.value;
       },
       data(){
        return {
          inputmodel:null,
          errors:null
        }
       },
       watch:{
          inputmodel(value){
        
            // this.validator.validate(this.name, value).then(() => {
            //     // success
            // }).catch(() => {
            //     // failed
            // });
            this.$emit('input', value);
            
          },
          value(value){
             this.inputmodel=value;
          }
       },
      
       
       methods:{
          validate(){
            this.validator.validate(this.name, this.inputmodel).then(() => {
                // success
            }).catch(() => {
                // failed
            });;
          },
          // updateValue(value){
          //   console.log("change",value)
          //   this.$emit('input', value);
          // }
       },
       props:["value","id","name","placeholder","rules"]
    }
</script>
