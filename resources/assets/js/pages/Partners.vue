<template>
    <div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 ">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                      <h2><i class="lnr lnr-apartment"></i> Partners <small><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-fw fa-plus"></i> Add</button></small></h2>
                      
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
                            <tr v-for="item in list.data">
                                <td>{{item.name}}</td>
                                <td>{{item.abbr | uppercase}}</td>
                                <td>
                                     <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                        <a class="btn btn-default" :href="'#partners/'+item.id" ><i class="fa fa-fw fa-edit"></i> Edit</a>
                                        <button type="button" class="btn btn-default" @click="trash(item)"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
      
      <modal id="addModal">
          <h4 class="modal-title" slot="header">Add Partner</h4>
          <form slot="body">
              <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="addObject.name">Name</tbvue-input>
              <tbvue-input name="abbr" id="in_abbr"  placeholder="abbr" rules="required|max:10" v-model="addObject.abbr">Abbreviation</tbvue-input>
          </form>
          <button type="button" slot="footer" class="btn btn-default"  data-dismiss="modal">Cancel</button>
          <button type="button" slot="footer" class="btn btn-success" :class="{'btn btn-success': true, 'disabled': hasValidateErrors}" @click="validate"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
      </modal>
</div>
    
</template>

<script>
    var crud_mix = require('../mixins/crd.js').default;
    export default {
        mixins: [crud_mix],
        created: function () {
          this.resource_url="ajax/partners{/id}";
          this.singular="Partner";
          this.addObject={name:"",abbr:""}
          this.validator=new VeeValidate.Validator();
          this.validator.attach('name', 'required|max:100', { prettyName: 'Name' });
          this.validator.attach('abbr', 'required|max:10', { prettyName: 'Abbreviation' });
          
          this.validator.validateAll(this.addObject).then(() => {}).catch(() => {});
          this.$set(this, 'errors', this.validator.errorBag);
       },
       
        
        
    }
</script>
