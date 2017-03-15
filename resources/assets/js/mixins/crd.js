export default {
    mounted() {
            this.provider = this.$resource(this.resource_url);
            this.$on('OK_TO_DELETE', function() {
                if (this.toDelete != null) {
                    this.delete(this.toDelete.id);
                    this.toDelete = null;
                }
            }.bind(this));
            this.load();
        },
        data: function() {
            return {
                list: [],
                addObject: {},
                toDelete: null,
                singular: "entity",
            }
        },
        filters:{
            uppercase:function(value){
                if (!value) return '';
                value = value.toString();
                return value.toUpperCase();
            }
        },
        methods: {
            load() {
                this.$parent.$emit("SHOW_PRELOADER");
                this.provider.get().then(response => {
                    this.list = response.body.data;
                    this.$parent.$emit("HIDE_PRELOADER");
                });
            },
            delete(id) {
                this.$parent.$emit("SHOW_PRELOADER");
                this.provider.delete({ id: id }).then(response => {
                    this.$parent.$emit("HIDE_PRELOADER");
                    this.$parent.$emit("ALERT", "Ok!", "The " + this.singular + " has been deleted successfully", "warning", 3);
                    this.load();
                }, response => {
                    console.log("errorAdding");
                });
            },
            add() {
                this.$parent.$emit("SHOW_PRELOADER");
                this.provider.save(this.addObject).then(response => {
                    this.$parent.$emit("HIDE_PRELOADER");
                    this.load();
                    this.$parent.$emit("ALERT", "Ok!", "The " + this.singular + " has been created successfully", "success", 3);
                }, response => {
                    console.log("errorAdding");
                });
            },
            trash(item) {
                this.toDelete = item;
                this.$parent.$emit("CONFIRM", "Attention!", "Are you sure you want to delete the "+this.singular+": <strong>" + item.name + "</strong>?", this, "OK_TO_DELETE");
            },
        }
}
