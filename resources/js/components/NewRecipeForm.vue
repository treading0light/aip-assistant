<template>

	<input type="text" v-model="title" placeholder="title" class="input input-bordered input-primary w-full max-w-xs">

	<input type="text" v-model="description" placeholder="description" class="input input-bordered input-primary w-full max-w-xs">

	<div class="w-full flex justify-around mb-10">

		<ingredient-tray @remove-ingredient="removeIngredient(index)" :ingredients="computedChosenIngredients"></ingredient-tray>

		<pantry @choose-ingredient="chooseIngredient(id)" :ingredients="computedPantryIngredients"></pantry>

	</div>

	<div class="w-1/4 flex flex-col items-center">
		<input class="input input-bordered input-primary w-full max-w-xs" type="text" @keyup.enter="addIngredient" v-model="newIngredient" placeholder="Create new">

		<button class="btn btn-secondary btn-primary-focus" @click="addIngredient">Add</button>
	</div>
	
</template>

<script>
	import IngredientTray from './IngredientTray'
	import Pantry from './Pantry.vue'

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

		computed: {
			computedChosenIngredients() {
				return this.chosenIngredients
			},

			computedPantryIngredients() {
				return this.pantryIngredients
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

			chooseIngredient: function (id) {
				let index = this.pantryIngredients.findIndex(object => {
					return object.id === id
				})

				const ingredient = this.pantryIngredients.splice(index, 1)

				this.chosenIngredients.push(ingredient[0])
				console.log('chooseIngredient ' + this.chosenIngredients + ingredientId)
			},

			removeIngredient: function (index) {
				const ingredient = this.chosenIngredients.splice(index, 1)
				this.pantryIngredients.push(ingredient[0])
				console.log('removeIngredient ' + this.pantryIngredients)
			},

			fetchIngredients: async function () {

				await fetch('./api/ingredients')
				.then(res => res.json())
				.then(json => this.pantryIngredients = json)

				console.log(this.pantryIngredients)
			},

		},

		mounted() {
			this.fetchIngredients()
			// console.log('vm ingredients ' + app.pantryIngredients)
		},

		components: {
			IngredientTray,
			Pantry
		},
	}
	
</script>