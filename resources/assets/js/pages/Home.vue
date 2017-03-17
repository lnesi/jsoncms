<template>
    <div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 ">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                      <h2><i class="lnr lnr-code"></i>  JSON<small>Deliverys<a type="button" class="btn btn-default pull-right" href="#/delivery/new"><i class="fa fa-fw fa-plus"></i> New</a></small></h2>
                      
                      </div>

                      <div class="panel-body">
                       
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                              <th>Partner</th>
                              <th>Campaign</th>
                              <th>Audience</th>
                              <th>Region</th>
                              <th>Name</th>
                             
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in list.data">
                                <td>{{item.partner.abbr|uppercase}}</td>
                                <td>{{item.campaign.abbr|uppercase}}</td>
                                <td>{{item.audience.abbr|uppercase}}</td>
                                <td>{{item.region.abbr|uppercase}}</td>

                                <td>{{item.name}}</td>
                               
                                <td>
                                     <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                        <a class="btn btn-default" :href="'#deliveries/'+item.id" ><i class="fa fa-fw fa-edit"></i> Edit</a>
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
     
</div>
    
</template>

<script>
  var list_mix = require('../mixins/list.js').default;
    export default {
      mixins: [list_mix],
        created() {
          this.resource_url="ajax/deliveries{/id}";
          
       },

        data: function() {
            return {
                toDelete: null,
            }
        },
        
        
    }
</script>