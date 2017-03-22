<template>
	<div>
		<div class="panel panel-default" id="custom_fileds_panel">
		    <div class="panel-heading">
		        <h3 class="panel-title"> 
		        	
		        	Dynamic Content Form Builder
		        
		        	</h3>
		    </div>
		     <div class="panel-body " id="custom_fileds_panel_body">
				 <p><button type="button" class="btn btn-default" data-toggle="modal" data-target="#addFieldModal"><i class="fa fa-fw fa-plus" ></i>Add</button></p>
				 <table id="custom_fileds_list" class="table table-bordered table-striped ">
		         		<thead>
		         		<tr>
		         			<th>Description</th>
		         			<th>Key</th>
		         			<th>Type</th>
		         			<th>Delete</th>
		         			<th>Sort</th>
		         		</tr>
						</thead>
						<tbody>
		         			<tr v-show="list.length==0">
		         				<td colspan="5">No results.</td>
		         			</tr>
		         		</tbody>
		         </table>  	
		     </div>
		     
		</div>
		<modal id="addFieldModal">
          <h4 class="modal-title" slot="header">Add Field</h4>
          <form slot="body">
              <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:255" v-model="item.name">Name / Description</tbvue-input>
			  <tbvue-input name="key" id="in_key" placeholder="Key" rules="required|max:100" v-model="item.key">JSON Key</tbvue-input>
		      <tbvue-input name="help_text" id="in_help" placeholder="Help Text" rules="max:255" v-model="item.help_text">Help Text</tbvue-input>
		      <app-customtypeselector></app-customtypeselector>
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
  			item:{

  			},
  			list:[]
  		}
  	},
  	computed: {
        hasValidateErrors() {
            return this.errors.count() > 0;
        }
    },
    methods:{
    	validate(){
    		
    	}
    }
  }
</script>