export default {
	mounted(){
		this.provider = this.$resource(this.resource_url);
		this.load();
	},

	data(){
			return {
				resource_url:"",
				list: {data:[]},
			}
	},
	filters: {
        uppercase: function(value) {
            if (!value) return '';
            value = value.toString();
            return value.toUpperCase();
        }
    },
	methods:{
		

		load() {
            this.$root.$emit("SHOW_PRELOADER");
            this.provider.get().then(response => {
                this.list = response.body;
                this.$root.$emit("HIDE_PRELOADER");
            });
        },


		
	}
}