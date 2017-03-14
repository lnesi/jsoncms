export default {
	mounted(){
		
		this.provider = this.$resource(this.resource_url);		
		this.load(this.$route.params.id);
	},

 	methods:{
 		load(id){
          this.$parent.$emit("SHOW_PRELOADER");
          this.provider.get({id:id}).then(response=>{
              this.$parent.$emit("HIDE_PRELOADER");
              this.item=response.body;    
          },response=>{
              this.$router.push('/400');
          });
      },
      save(){
          this.$parent.$emit("SHOW_PRELOADER");
          this.provider.update({id:this.item.id},this.item).then(response=>{
              this.$parent.$emit("HIDE_PRELOADER");
              this.$parent.$emit("ALERT","Ok!","The "+this.singular+" has been updated successfully","success",3);
          });
      },
      validateForm(){
          this.$validator.validateAll().then(result=>{
              this.save();
          }).catch(()=>null);
      }
}
}