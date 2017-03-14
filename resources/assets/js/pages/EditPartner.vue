<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form  @submit="validateForm()" onsubmit="return false;">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Partner</div>

                    <div class="panel-body">
                     
                            <div  :class="{'form-group': true, 'has-error': errors.has('name') }">
                                <label for="InputAddPartnerName" class="control-label">Name</label>
                                <input type="text" v-model="item.name" v-validate="'required|max:100'" name="name" class="form-control" id="InputAddPartnerName" placeholder="Name">
                                <p class="help-block">{{ errors.first('name') }}</p>
                              </div>
                              <div :class="{'form-group': true, 'has-error': errors.has('abbr') }">
                                <label for="InputAddPartnerAbbr" class="control-label">Abbreviation</label>
                                <input type="text" v-model="item.abbr" name="abbr" v-validate="'required|max:5'" class="form-control" id="InputAddPartnerAbbr" placeholder="abbr" >
                                <p class="help-block">{{ errors.first('abbr') }}</p>
                              </div>
                    
                    </div>
                    <div class="panel-footer">
                        <a  class="btn btn-default" href="#/partners" ><i class="fa fa-fw fa-chevron-left"></i> Back</a>
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
          this.resource_url="api/partners{/id}";
          this.singular="Partner";

       },
        data:function(){
            return {
                item:{id:null,name:null,abbr:null}
            }
        },

        
    }
</script>
