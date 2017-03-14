<template>
    <div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 ">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                      <h2>Audiences <small><button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target="#addPartnerModal"><i class="fa fa-fw fa-plus"></i> Add</button></small></h2>
                      
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
                                <td>{{item.partner.abbr}}</td>
                                <td>{{item.name}}</td>
                                <td>{{item.abbr}}</td>
                                <td>
                                     <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                        <a class="btn btn-default" :href="'#audiences/'+item.id" ><i class="fa fa-fw fa-edit"></i> Edit</a>
                                        <button type="button" class="btn btn-default" @click="deleteAudience(item)"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
      
</div>
    
</template>

<script>
    var crud_mix = require('../../mixins/crd.js');
    export default {
       mixins: [crud_mix.default],
       created: function () {
          this.resource_url="api/audiences{/id}";
          this.singular="Audience";
       },
       mounted() {
         
       },
       methods:{
          deleteAudience(item){
            this.toDelete=item;
            this.$parent.$emit("CONFIRM","Attention!","Are you sure you want to delete the audience: <strong>"+item.name+"</strong>?",this,"OK_TO_DELETE");
          }
       }
        
    }
</script>
