<template>
    <div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    <h2>Partners <small><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addPartnerModal"><i class="fa fa-fw fa-plus"></i> Add</button></small></h2>
                    
                    </div>

                    <div class="panel-body">
                     
                      <table class="table table-striped table-bordered">
                          <thead>
                          <tr>
                            <th>Name</th>
                            <th>Abbr</th>
                            <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          <tr v-for="item in list">
                              <td>{{item.name}}</td>
                              <td>{{item.abbr}}</td>
                              <td>
                                   <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                      <a class="btn btn-default" :href="'#partners/'+item.id" ><i class="fa fa-fw fa-edit"></i> Edit</a>
                                      <button type="button" class="btn btn-default" @click="deletePartner(item.id)"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                   </div>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <modal id="addPartnerModal">
        <h4 class="modal-title" slot="header">Add Partner</h4>
        <form slot="body">
            <div  :class="{'form-group': true, 'has-error': errors.has('name') }">
                <label for="InputAddPartnerName" class="control-label">Name</label>
                <input type="text" v-model="addObject.name" v-validate="'required|max:100'" name="name" class="form-control" id="InputAddPartnerName" placeholder="Name">
                <p class="help-block">{{ errors.first('name') }}</p>
              </div>
              <div :class="{'form-group': true, 'has-error': errors.has('abbr') }">
                <label for="InputAddPartnerAbbr" class="control-label">Abbreviation</label>
                <input type="text" v-model="addObject.abbr" name="abbr" v-validate="'required|max:5'" class="form-control" id="InputAddPartnerAbbr" placeholder="abbr" >
                <p class="help-block">{{ errors.first('abbr') }}</p>
              </div>
        </form>
        <button type="button" slot="footer" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="button" slot="footer" class="btn btn-success" :class="{'btn btn-success': true, 'disabled': errors.has('name') || errors.has('abbr') }" @click="validateAddForm"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
    </modal>

    
</div>
    
</template>

<script>
    export default {

        mounted() {
            this.provider = this.$resource('api/partners{/id}');
            this.load();
            console.log('Partners');
        },
        
        data:function(){
            return {
                list:[],
                addObject:{
                    name:"",
                    abbr:""
                }
            }
        },

        methods:{
            
            load(){
                this.provider.get().then(response=>{
                    this.list=response.body.data;
                });
            },

            add(){
                this.provider.save(this.addObject).then(response=>{
                    this.load();
                },response=>{
                    console.log("errorAdding");
                });
            },
            
            deletePartner(id){
                this.provider.delete({id:id}).then(response=>{
                     this.load();
                },response=>{
                    console.log("errorAdding");
                });
            },

            editPartner(item){
                
            },

            validateAddForm(){
                
                this.$validator.validateAll().then(result => {
                  this.add();
                  $('#addPartnerModal').modal('hide');
                  this.resetAdd();
                    
                }).catch(() => null);
            },
            resetAdd(){
                this.addObject={name:"",abbr:""};
            }
        }
    }
</script>
