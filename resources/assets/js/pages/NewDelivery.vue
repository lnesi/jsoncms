<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
              <form  @submit="validate()" onsubmit="return false;">
                <div class="panel panel-default">
                    <div class="panel-heading">New Delivery</div>

                    <div class="panel-body">
                          <tbvue-ajax-dropdown data-url="ajax/partners?paginate=false" name="partner_id" rules="required" id="partner_id" v-model="delivery.partner_id">Partner</tbvue-ajax-dropdown>
                          <div class="row">
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown :data-url="campaignURL" name="campaign_id" rules="required" id="campaign_id" v-model="delivery.campaign_id">Campaign</tbvue-ajax-dropdown>
                            </div>
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown :data-url="audienceURL" name="audience_id" rules="required" id="audience_id" v-model="delivery.audience_id">Audience</tbvue-ajax-dropdown>
                            </div>
                          </div>
                          <tbvue-ajax-dropdown :data-url="regionURL" name="region_id" rules="required" id="region_id" v-model="delivery.region_id">Region</tbvue-ajax-dropdown>
                          <div class="row">
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown data-url="ajax/countries?paginate=false" name="country_id" rules="required" id="country_id" v-model="delivery.country_id">Country</tbvue-ajax-dropdown>
                            </div>
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown data-url="ajax/languages?paginate=false" name="language_id" rules="required" id="language_id" v-model="delivery.language_id">Language</tbvue-ajax-dropdown>
                            </div>
                          </div>
                          <tbvue-input name="name" id="in_name" placeholder="Name" rules="required|max:100" v-model="delivery.name" >Name</tbvue-input>
                           <div class="row">
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown data-url="ajax/types?paginate=false" name="type_id" rules="required" id="type_id" v-model="delivery.type_id">Delivery Type</tbvue-ajax-dropdown>
                            </div>
                            <div class="col col-md-6">
                              <tbvue-ajax-dropdown data-url="ajax/sizes?paginate=false" name="size_id" rules="required" id="size_id" v-model="delivery.size_id">Delivery Size</tbvue-ajax-dropdown>
                            </div>
                          </div>
                          <br>
                         
                     
                    </div>
                    <div class="panel-footer">
                        <a  class="btn btn-default" href="#/" ><i class="fa fa-fw fa-chevron-left"></i> Cancel</a>
                        <button type="submit"   :class="{'btn btn-success pull-right': true, 'disabled': hasValidateErrors }"><i class="fa fa-fw fa-floppy-o" ></i> Save</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        validator: null,
        data() {
            return {
                delivery: {
                    partner_id: "",
                    name: "",
                    campaign_id: "",
                    audience_id: "",
                    region_id: "",
                    type_id: "",
                    size_id: "",
                    country_id: "",
                    language_id: ""
                },
                errors: null
            }
        },
        created() {
            this.createValidator();
            this.$set(this, 'errors', this.validator.errorBag);


        },
        computed: {
            campaignURL() {
                if (this.delivery.partner_id != "") {
                    this.delivery.campaign_id = null;
                    return "ajax/campaigns?filter=partner_id," + this.delivery.partner_id + "&paginate=false";
                }
                return '';
            },
            audienceURL() {
                if (this.delivery.partner_id != "") {
                    this.delivery.audience_id = null;
                    return "ajax/audiences?filter=partner_id," + this.delivery.partner_id + "&paginate=false";
                }
                return '';
            },
            regionURL() {
                if (this.delivery.partner_id != "") {
                    this.delivery.region_id = null;
                    return "ajax/regions?filter=partner_id," + this.delivery.partner_id + "&paginate=false";
                }
                return '';
            },
            hasValidateErrors() {

                return this.errors.count() > 0;
            }
        },

        methods: {
            validate() {
                this.validator.validateAll(this.delivery).then(() => {

                    this.$http.post('/ajax/deliveries', this.delivery).then(response => {
                        this.$parent.$emit("ALERT", "Ok!", "The Delivery has been created successfully", "success", 3);
                        this.$parent.$router.push('/deliveries/'+response.body.id);
                    }, response => {
                        console.log("error", response);
                        this.$parent.$emit("ALERT", "Error!", "Internal server error", "danger", 3);
                    });

                }).catch(() => {
                    console.log("errores")
                });
                this.$set(this, 'errors', this.validator.errorBag);
                console.log(this.errors);
            },
            createValidator() {

                this.validator = new VeeValidate.Validator();
                this.validator.attach('partner_id', 'required|numeric', { prettyName: 'Partner' });
                this.validator.attach('campaign_id', 'required|numeric', { prettyName: 'Campaign' });
                this.validator.attach('audience_id', 'required|numeric', { prettyName: 'Audience' });
                this.validator.attach('region_id', 'required|numeric', { prettyName: 'Region' });
                this.validator.attach('country_id', 'required|numeric', { prettyName: 'Country' });
                this.validator.attach('language_id', 'required|numeric', { prettyName: 'Language' });
                this.validator.attach('type_id', 'required|numeric', { prettyName: 'Type' });
                this.validator.attach('size_id', 'required|numeric', { prettyName: 'Size' });
                this.validator.attach('name', 'required|max:255', { prettyName: 'Name' });
                this.validator.validateAll(this.delivery).then(() => {}).catch(() => {});
                this.$set(this, 'errors', this.validator.errorBag);

            },
            clearErrors() {
                this.errors.clear();
            }
        }
    }

</script>
