<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form  @submit="validateForm()" onsubmit="return false;">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Region</div>

                    <div class="panel-body">
                           <div  class="form-group">
                            <label for="partner_id" class="control-label">Partner</label>
                            <p>{{item.partner.name}}</p>
                          </div>
                            <div  :class="{'form-group': true, 'has-error': errors.has('name') }">
                                <label for="InputAddPartnerName" class="control-label">Name</label>
                                <input type="text" v-model="item.name" v-validate="'required|max:100'" name="name" class="form-control" id="InputAddPartnerName" placeholder="Name">
                                <p class="help-block">{{ errors.first('name') }}</p>
                              </div>
                              <div :class="{'form-group': true, 'has-error': errors.has('abbr') }">
                                <label for="InputAddPartnerAbbr" class="control-label">Abbreviation</label>
                                <input type="text" v-model="item.abbr" name="abbr" v-validate="'required|max:10'" class="form-control" id="InputAddPartnerAbbr" placeholder="abbr" >
                                <p class="help-block">{{ errors.first('abbr') }}</p>
                              </div>
                            
                            <label for="" class="control-label">Countries</label>
                            <form class="form-inline">
                                <ajax-dropdown data-url="api/countries?paginate=false" name="country_id"  id="country_id" v-model="countryToAdd"></ajax-dropdown>
                                <button type="button" class="btn btn-default" :disabled="checkSelectedCountry" @click="addCountry()"><i class="fa fa-fw fa-plus"></i>Add Country</button>
                            </form>
                            <br>
                            <table class="table table-striped table-bordered">
                              <thead>
                              <tr>
                                <th>Abbr</th>
                                <th>Name</th>
                                <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody>
                              <tr v-for="country in item.countries">
                                <td>{{country.code}}</td>
                                <td>{{country.name}}</td>
                                <td><button type="button" class="btn btn-default btn-xs" @click="removeCountry(country)"><i class="fa fa-fw fa-trash"></i> Remove</button></td>
                              </tr>
                              </tbody>
                            </table>

                    </div>
                    <div class="panel-footer">
                        <a  class="btn btn-default" href="#/regions" ><i class="fa fa-fw fa-chevron-left"></i> Back</a>
                        <button type="submit"   :class="{'btn btn-success pull-right': true, 'disabled': errors.has('name') || errors.has('abbr') }"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    var edit_mix = require('../mixins/edit.js');
    export default {
        mixins: [edit_mix.default],
        created: function () {
          this.resource_url="api/regions{/id}";
          this.singular="Region";
          
       },
       mounted(){
        this.$on('OK_TO_REMOVE_COUNTRY', function() {
                if (this.toRemove != null) {
                    this.removeCountryApi(this.toRemove.id);
                    this.toRemove = null;
                }
            }.bind(this));
       },
        data:function(){
            return {
                item:{id:null,name:null,abbr:null,partner:{id:null}},
                toRemove:null,
                countryToAdd:''
            }
        },
        computed:{
          checkSelectedCountry(){
            if(this.countryToAdd!=""){
                return false;
            }
            return "disabled";
          }
        },
        methods:{
          removeCountry(item){
            this.toRemove=item;
            this.$parent.$emit("CONFIRM", "Attention!", "Are you sure you want to remove the country: <strong>" + item.name + "</strong>?", this, "OK_TO_REMOVE_COUNTRY");
          },
          addCountry(){
            if(this.countryToAdd!=""){
              this.$http.get("api/regions/"+this.item.id+"/add/"+this.countryToAdd).then(response => {
                // get body data
                 this.item=response.body;
                 this.$parent.$emit("ALERT", "Ok!", "The country has been added successfully", "success", 3);
                 this.countryToAdd="";
              }, response => {
                // error callback
              });
            }
          },
          removeCountryApi(id){
              this.$http.get("api/regions/"+this.item.id+"/remove/"+id).then(response => {
                // get body data
                 this.item=response.body;
                 this.$parent.$emit("ALERT", "Ok!", "The country has been removed successfully", "success", 3);
              }, response => {
                // error callback
              });
          }
        }
    }
</script>
