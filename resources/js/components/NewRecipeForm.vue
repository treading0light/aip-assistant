<template>

	<input type="text" v-model="title" placeholder="title" class="input input-bordered input-primary w-full max-w-xs">

	<input type="text" v-model="description" placeholder="description" class="input input-bordered input-primary w-full max-w-xs">

	<div class="flex gap-5 mb-10">

		<ingredient-tray :ingredients="chosenIngredients"></ingredient-tray>

		<ingredient-tray :ingredients="pantryIngredients" pantry ></ingredient-tray>

		<input class="input input-bordered input-primary w-full max-w-xs" type="text" @keyup.enter="addIngredient" v-model="newIngredient">

		<button class="btn btn-secondary btn-primary-focus" @click="addIngredient">Add</button>

	</div>
	
</template>

<script>
	import IngredientTray from './IngredientTray'

	export default {
		data() {
			return {
				title: '',
				description: '',
				pantryIngredients: [
					{
						'id': 1,
						'name': 'ground beef'
					},
					{
						'id': 2,
						'name': 'bread'
					},
					{
						'id': 3,
						'name': 'cheese'
					},
				],
				newIngredient: '',

				chosenIngredients: [],

			}
		},
		methods: {

			addIngredient: function () {
				let id = this.dynamicIngredients.length

				this.dynamicIngredients.push({
					'id': id,
					'name': this.newIngredient
				})

				this.newIngredient = ''
				console.log(this.dynamicIngredients)
			},

			chooseIngredient: function (ingredient) {
				this.chosenIngredients.push(ingredient)
				this.pantryIngredients.remove(ingredient)
			},

			removeIngredient: function (ingredient) {
				this.chosenIngredients.remove(ingredient)
				this.pantryIngredients.push(ingredient)
			},

			fetchIngredients: async function () {

				await fetch('./api/ingredients')
				.then(res => res.json())
				.then(json => this.dynamicIngredients = json)

				console.log(this.dynamicIngredients)
			},

		},

		mounted() {
			this.fetchIngredients()
		},

		components: {
			IngredientTray
		},
	}
	
</script>