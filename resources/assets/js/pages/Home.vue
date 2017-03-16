<template>
    <div>
      <div class="container">
          <div class="row">
              <div class="col-md-12 ">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                      <h2><i class="lnr lnr-code"></i>  JSON<small>Deliverys<a type="button" class="btn btn-default pull-right" href="#/new"><i class="fa fa-fw fa-plus"></i> New</a></small></h2>
                      
                      </div>

                      <div class="panel-body">
                       
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                              <th>Name</th>
                            
                              <th>Actions</th>
                              </tr>
                            </thead>
                            <tbody>
                            <tr v-for="item in list">
                                <td>{{item.name}}</td>
                               
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
     
</div>
    
</template>

<script>
    export default {
      
        created() {
          
          this.provider = this.$resource("ajax/banners{/id}");
          this.load();
       },

        data: function() {
            return {
                list: [],
                toDelete: null,
            }
        },
        
        methods:{
             load() {
                this.$parent.$emit("SHOW_PRELOADER");
                this.provider.get().then(response => {
                    this.list = response.body.data;
                    this.$parent.$emit("HIDE_PRELOADER");
                });
            }, 
          
        }
    }
</script>