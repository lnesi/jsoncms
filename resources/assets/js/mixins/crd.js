var list_mix = require('../mixins/list.js').default;
export default {
    mixins: [list_mix],
    mounted() {
        
        this.$on('OK_TO_DELETE', function() {
            if (this.toDelete != null) {
                this.delete(this.toDelete.id);
                this.toDelete = null;
            }
        }.bind(this));
      
    },

    data: function() {
        return {
            addObject: {},
            toDelete: null,
            singular: "entity",
            errors: [],
            validator: null
        }
    },

    watch: {
        addObject: {
            handler: function() {
                this.validator.validateAll(this.addObject).then(() => {}).catch(() => {});
                this.$set(this, 'errors', this.validator.errorBag);
            },
            deep: true
        }
    },


    computed: {
        hasValidateErrors() {
            return this.errors.count() > 0;
        }
    },

    methods: {
       

        delete(id) {
            this.$root.$emit("SHOW_PRELOADER");
            this.provider.delete({ id: id }).then(response => {
                this.$root.$emit("HIDE_PRELOADER");
                this.$root.$emit("ALERT", "Ok!", "The " + this.singular + " has been deleted successfully", "warning", 3);
                this.load();
            }, response => {
                console.log("errorDeleting");
            });
        },

        add() {
            this.$root.$emit("SHOW_PRELOADER");
            this.provider.save(this.addObject).then(response => {
                this.$root.$emit("HIDE_PRELOADER");
                this.load();
                this.$root.$emit("ALERT", "Ok!", "The " + this.singular + " has been created successfully", "success", 3);
            }, response => {
                console.log("errorAdding");
            });
        },

        trash(item) {
            this.toDelete = item;
            this.$root.$emit("CONFIRM", "Attention!", "Are you sure you want to delete the " + this.singular + ": <strong>" + item.name + "</strong>?", this, "OK_TO_DELETE");
        },

        validate() {
            this.validator.validateAll(this.addObject).then(result => {
                this.add();
                $('#addModal').modal('hide');
                this.reset();
            }).catch(() => null);
            this.$set(this, 'errors', this.validator.errorBag);
        },

        reset(){
            Object.keys(this.addObject).forEach(function(element){
                this.addObject[element]="";
            }.bind(this));
            
        }
    }
}
