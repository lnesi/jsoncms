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
            this.$parent.$emit("SHOW_PRELOADER");
            this.provider.get().then(response => {
                this.list = response.body;
                this.$parent.$emit("HIDE_PRELOADER");
            });
        },


		
	}
}