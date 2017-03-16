<template>
    <div :class="{'form-group': true, 'has-error': errors.has(this.name) }">
        <label :for="id" class="control-label"><slot></slot></label>
        <select class="form-control"   :name="name"  :id="id" v-model="inputmodel" @blur="validate">
            <option value="">Select...</option>
            <option v-for="item in list" :value="item.id" >{{item.name}}</option>
        </select>
        <p class="help-block">{{ errors.first(this.name) }}</p>
    </div>
</template>

<script>
    export default {
        validator: null,
        created(){
            this.validator=new VeeValidate.Validator();
            var prettyName=this.name;
            if(this.$slots.default){
                prettyName=this.$slots.default[0].text;
            }
            this.validator.attach(this.name, this.rules , {prettyName:prettyName});
            this.$set(this, 'errors', this.validator.errorBag);
            if(this.dataUrl!=""){
               this.load();
            }
            
           // this.validate();

        },
        mounted() {
            this.inputmodel=this.value;  
        },

        data(){
            return {
                inputmodel:'',
                errors:null,
                list:[]
            }
        },
        
        watch:{
          inputmodel(value){
        
            this.validator.validate(this.name, value).then(() => {
                // success
            }).catch(() => {
                // failed
            });;
            this.$emit('input', value);
            
          },
          value(value){

             this.inputmodel=value;
          },
          dataUrl(value){
            this.inputmodel="";
            this.load();
          }
       },
        props:['data-url','value','name','rules','id'],
        methods:{
            load(){
                this.$http.get(this.dataUrl).then(response => {
                    this.list=response.body;
                    
                }, response => {
                    // error callback
                }); 
            },
            validate(){
                this.validator.validate(this.name, this.value).then(() => {
                    // success
                }).catch(() => {
                    // failed
                });;
              }
        }

    }
</script>
