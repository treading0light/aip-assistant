<template>
	<div class="flex flex-col items-center bg-gray-200 gap-1">
		<h1 class="text-2xl">{{ recipe.name }}</h1>
		<img :src="recipe.photo">
		<Button :text="buttonText" />

	</div>
	<!-- <h1>Goodbye World</h1> -->

</template>

<script>

	import Button from './Button.vue'

	export default {
		name: 'RecipeCardSmall',
		props: {
			recipe: Object,
		},
		data() {
			return {
				buttonText: 'view',
			}
		},
		components: {
			Button,
		},



	} 
	
</script>