<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form  @submit="validateForm()" onsubmit="return false;">
                <div class="panel panel-default">
                    <div class="panel-heading">New Delivery</div>

                    <div class="panel-body">
                          <tbvue-ajax-dropdown data-url="ajax/partners?paginate=false" name="partner_id" rules="required" id="partner_id" v-model="delivery.partner_id">Partner</tbvue-ajax-dropdown>
                          <tbvue-ajax-dropdown :data-url="campaignURL" name="partner_id" rules="required" id="partner_id" v-model="delivery.campaign_id">Campaign</tbvue-ajax-dropdown>
                          <tbvue-ajax-dropdown :data-url="audienceURL" name="partner_id" rules="required" id="partner_id" v-model="delivery.audience_id">Audience</tbvue-ajax-dropdown>
                          <tbvue-ajax-dropdown :data-url="regionURL" name="partner_id" rules="required" id="partner_id" v-model="delivery.region_id">Region</tbvue-ajax-dropdown>
                          <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="delivery.name" >Name</tbvue-input>
                          

                     
                    </div>
                    <div class="panel-footer">
                        <a  class="btn btn-default" href="#/" ><i class="fa fa-fw fa-chevron-left"></i> Cancel</a>
                        <button type="submit"   :class="{'btn btn-success pull-right': true, 'disabled': errors.has('name') || errors.has('abbr') }"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
      data(){
        return {
          delivery:{
            partner_id:"",
            name:"",
            campaign_id:"",
            audience_id:"",
            region_id:"",
          }
          
        }
      },
      computed:{
        campaignURL(){
          if(this.delivery.partner_id!=""){
            return "ajax/campaigns?filter=partner_id,"+this.delivery.partner_id+"&paginate=false";
          }
          return '';
        },
        audienceURL(){
          if(this.delivery.partner_id!=""){
            return "ajax/audiences?filter=partner_id,"+this.delivery.partner_id+"&paginate=false";
          }
          return '';
        },
        regionURL(){
          if(this.delivery.partner_id!=""){
            return "ajax/regions?filter=partner_id,"+this.delivery.partner_id+"&paginate=false";
          }
          return '';
        },
      },
      mounted() {
            
      }
    }
</script>
