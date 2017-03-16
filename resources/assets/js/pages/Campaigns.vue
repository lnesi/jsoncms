<template>
    <div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 ">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                      <h2><i class="lnr lnr-pushpin"></i>  Campaigns <small><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addAudienceModal"><i class="fa fa-fw fa-plus"></i> Add</button></small></h2>
                      
                      </div>

                      <div class="panel-body">
                       
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                              <th>Partner</th>
                              <th>Name</th>
                              <th>Abbr</th>
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in list">
                                <td>{{item.partner.abbr | uppercase}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.abbr | uppercase}}</td>
                                <td>
                                     <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                        <a class="btn btn-default" :href="'#campaings/'+item.id" ><i class="fa fa-fw fa-edit"></i> Edit</a>
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
      <modal id="addAudienceModal">
          <h4 class="modal-title" slot="header">Add Campaing</h4>
          <form slot="body">
              <div  :class="{'form-group': true, 'has-error': checkPartner }">
                <label for="partner_id" class="control-label">Partner</label>
                <ajax-dropdown data-url="ajax/partners?paginate=false" name="partner_id"  id="partner_id" v-model="addObject.partner_id"></ajax-dropdown>
                
              </div>
              <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="addObject.name">Name</tbvue-input>
              <tbvue-input name="abbr" id="in_abbr"  placeholder="abbr" rules="required|max:10" v-model="addObject.abbr">Abbreviation</tbvue-input>
              
          </form>
          <button type="button" slot="footer" class="btn btn-default"  data-dismiss="modal">Cancel</button>
          <button type="button" slot="footer" class="btn btn-success" :class="{'btn btn-success': true, 'disabled': errors.has('name') || errors.has('abbr') }" @click="validateAddForm"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
      </modal>
</div>
    
</template>

<script>
    var crud_mix = require('../mixins/crd.js');

    export default {
        mixins: [crud_mix.default],
        created: function() {
            this.resource_url = "ajax/campaings{/id}";
            this.singular = "Campaign";
            this.addObject = { name: "", abbr: "", partner_id: "" }
        },
        computed: {
            checkPartner() {
                return this.addObject.partner_id == "";
            }
        },
        methods: {
            validateAddForm() {
                this.$validator.validateAll().then(result => {
                    if (this.addObject.partner_id != "") {
                        this.add();
                        $('#addAudienceModal').modal('hide');
                        this.resetAdd();
                    }
                }).catch(() => null);
            },
            resetAdd() {
                this.addObject = { name: "", abbr: "", partner_id: "" }
            }
        }

    }

</script>
