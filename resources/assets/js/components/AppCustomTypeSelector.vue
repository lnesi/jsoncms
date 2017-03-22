<template>
	<div>
		<tbvue-ajax-dropdown data-url="ajax/components?paginate=false" name="input_type_id" rules="required" id="input_type_id" v-model="typeselected">Input Type</tbvue-ajax-dropdown>
	</div>
</template>
<script>
	export default{
		data(){
			return{
				typeselected:''
			}
		}
	}
</script>