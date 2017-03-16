<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form  @submit="validateForm()" onsubmit="return false;">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Audience</div>

                    <div class="panel-body">
                           <div  class="form-group">
                            <label for="partner_id" class="control-label">Partner</label>
                            <p>{{item.partner.name}}</p>
                          </div>
                           <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="item.name">Name</tbvue-input>
                           <tbvue-input name="name" id="in_abbr"  placeholder="abbr" rules="required|max:10" v-model="item.abbr">Abbreviation</tbvue-input>
                    
                    </div>
                    <div class="panel-footer">
                        <a  class="btn btn-default" href="#/audiences" ><i class="fa fa-fw fa-chevron-left"></i> Back</a>
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
          this.resource_url="ajax/audiences{/id}";
          this.singular="Audience";

       },
        data:function(){
            return {
                item:{id:null,name:null,abbr:null,partner:{id:null}}
            }
        },
        
    }
</script>
