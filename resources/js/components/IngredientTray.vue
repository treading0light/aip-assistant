<template>
	<!-- component intended for two uses, one to display
	all available ingredients, and one to display chosen ingredients
	for newly created recipe -->

	<div class="rounded overflow-x-auto">

		<h2 class="font-bold pb-3">Ingredients:</h2>

		<ul>
			<li v-for="ingredient in ingredients" :key="ingredient.id" class="relative flex">
				<p class="hover:cursor-pointer" @click="remove(ingredient)">{{ ingredient.name }}
				</p>
				
				<info-modal v-if="ingredient.description" :title="ingredient.name" :info="ingredient.description" ></info-modal>

				<input type="text" v-model="ingredient.qty" class="input input-bordered max-w-xs">
			</li>

		</ul>
	</div>
</template>

<script>
	import InfoModal from './InfoModal.vue'

	export default {
		props: {
			ingredients: Array,
		},
		
		methods: {
			remove: function (ingredient) {
				this.$emit('remove-ingredient', this.ingredients.indexOf(ingredient))
				console.log(this.ingredients.indexOf(ingredient))
			}
		},

		components: {
			InfoModal
		},

		mounted() {
			console.log('tray array: ' + this.ingredients)
		},
	}
</script>

<style scoped>
	div::-webkit-scrollbar-thumb {
  background: #888;
}
</style>