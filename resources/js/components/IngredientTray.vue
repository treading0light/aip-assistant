<template>
	<!-- component intended for two uses, one to display
	all available ingredients, and one to display chosen ingredients
	for newly created recipe -->

	<div class="relative rounded">

		<h2 class="font-bold pb-3">Ingredients:</h2>

		<ul>
			<li v-for="ingredient in ingredients" :key="ingredient.id" class="flex gap-5">
				<p class="hover:cursor-pointer" @click="remove(ingredient.id)">{{ ingredient.name }}
				</p>

				<info-modal v-if="ingredient.description" :title="ingredient.name" :info="ingredient.description" ></info-modal>

				<input type="text" placeholder="Qty" v-model="ingredient.qty" class="input input-bordered w-1/3 text-2xl">
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
			remove: function (id) {
				this.$emit('ingredient-to-pantry', id)
				console.log('tray: ' + id)
			}
		},

		components: {
			InfoModal
		},

		mounted() {
			// console.log('tray array: ' + this.ingredients)
		},
	}
</script>

<style scoped>
</style>