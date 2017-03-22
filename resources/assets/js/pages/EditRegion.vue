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
                           
                           <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="item.name">Name</tbvue-input>
                           <tbvue-input name="name" id="in_abbr"  placeholder="abbr" rules="required|max:10" v-model="item.abbr">Abbreviation</tbvue-input>
                            
                           
                            <hr>
                            <form >
                                <tbvue-ajax-dropdown data-url="ajax/countries?paginate=false" name="country_id"  id="country_id" v-model="countryToAdd">Countries</tbvue-ajax-dropdown>
                                <button type="button" class="btn btn-default" :disabled="checkSelectedCountry" @click="addCountry()"><i class="fa fa-fw fa-plus"></i>Add</button>
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
          this.resource_url="ajax/regions{/id}";
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
              this.$http.get("ajax/regions/"+this.item.id+"/add/"+this.countryToAdd).then(response => {
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
              this.$http.get("ajax/regions/"+this.item.id+"/remove/"+id).then(response => {
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
