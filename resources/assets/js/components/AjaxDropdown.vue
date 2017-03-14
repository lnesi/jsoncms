<template>
    <select class="form-control" v-on:change="updateValue($event.target.value)" v-model="checkValue">
        <option value="">Select...</option>
        <option v-for="item in list" :value="item.id" >{{item.name}}</option>
    </select>
</template>

<script>
    export default {
        mounted() {
            
            this.$http.get(this.dataUrl).then(response => {
            // get body data
            this.list=response.body;
            

          }, response => {
            // error callback
          });
            
        },
        data:function(){
            return {
                list:[]
            }
        },
        computed:{
            checkValue(){
                return this.value;
            }
        },
        props:['data-url','value'],
        methods:{
            updateValue(value){
            
              
                this.$emit('input', value);
            }
        }

    }
</script>
