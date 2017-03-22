<template>
	<div>
		<div class="panel panel-default" id="custom_fileds_panel">
		    <div class="panel-heading">
		        <h3 class="panel-title">Dynamic Content Form Builder</h3>
		    </div>
		     <div class="panel-body " id="custom_fileds_panel_body">
  				 <p><button type="button" class="btn btn-default" @click="add"><i class="fa fa-fw fa-plus" ></i>Add</button></p>
  				 <table id="custom_fileds_list" class="table table-bordered table-striped ">
  		        <thead>
  		         		<tr>
  		         			<th>Description</th>
  		         			<th>Key</th>
  		         			<th>Type</th>
  		         			<th>Actions</th>
  		         			<th>Sort</th>
  		         		</tr>
  						</thead>
  						<tbody>
		         			<tr v-show="hasCustoms">
		         				<td colspan="5">No results.</td>
		         			</tr>
                  <tr v-for="item in value">
                    <td>{{item.name}}</td>
                    <td>{{item.key}}</td>
                    <td>{{item.component.name}}</td>
                    <td>
                      <div class="btn-group btn-group-xs" role="group" aria-label="...">
                        <button type="button" class="btn btn-default btn-xs" @click="edit(item)"><i class="fa fa-fw fa-edit"></i> Edit</button>
                        <button type="button" class="btn btn-default btn-xs" @click="remove(item)"><i class="fa fa-fw fa-trash"></i> Remove</button>
                      </div>
                    </td>
                    <td></td>
                  </tr>  
  		        </tbody>
  		    </table>  	
		     </div>
		     
		</div>
		
      <app-customaddfield :deliveryId="delivery_id" ref="addform"></app-customaddfield>
      <app-customeditfield  ref="editform"></app-customeditfield>
	</div>
</template>
<script>
  export default {
  	validator:null,
  	provider:null,
  	data(){
  		return{
  			delivery_id:null,
  			errors:[],
        toRemove:null
  		}
  	},
    props:['value'], 
  	created(){
  		this.provider = this.$resource("ajax/customs{/id}");  	
      this.$on("OK_TO_REMOVE_FIELD",function(){
        if(this.toRemove!=null){
          this.delete(this.toRemove.id);
          this.toRemove = null;
        }
      }.bind(this));
  	},
  	computed: {
        hasValidateErrors() {
        	this.validator.validateAll(this.item).then(() => {}).catch(() => {});
            return this.errors.count() > 0;
        },
        getDeliveryId(){
        	return this.$parent.$data.delivery.id;
        },
        hasCustoms(){
          if(Array.isArray(this.value)){
            return this.value.length==0;
          }else{
            return true;
          }
          
        }
    },
    watch:{
    	value:{
        	handler: function() {
              this.delivery_id=this.getDeliveryId;
          },
          deep: true
    	}
    },
    methods:{
    	add(){
         this.$refs.addform.show();
  		 
    	},
    	validate(){
    		this.validator.validateAll(this.item).then(() => {
    			this.add();
    		}).catch(() => {});
    	},
      remove(item){
        this.toRemove=item;
        
        this.$root.$emit("CONFIRM", "Attention!", "Are you sure you want to remove the field: <strong>" + item.name + "</strong>?", this, "OK_TO_REMOVE_FIELD");
      },
      delete(id){
        this.$root.$emit("SHOW_PRELOADER");
        this.provider.delete({ id: id }).then(response => {
            this.$root.$emit("HIDE_PRELOADER");
            var newList=this.value.filter(function( obj ) {
              return obj.id != id;
            });
            
            this.$emit("input",newList);
            this.$root.$emit("ALERT", "Ok!", "The Field has been deleted successfully", "warning", 3);
            
        }, response => {
            console.log("errorDeleting");
        });
      },
      edit(item){
        this.$refs.editform.show(item);
      },
    	
    }
  }
</script>