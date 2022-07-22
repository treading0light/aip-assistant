<template>

	<input type="text" v-model="title" placeholder="title" class="input input-bordered input-primary w-full max-w-xs">

	<input type="text" v-model="description" placeholder="description" class="input input-bordered input-primary w-full max-w-xs">

	<div class="w-1/3">    
    <picture-input 
      ref="pictureInput" 
      margin="16" 
      accept="image/jpeg,image/png" 
      size="10" 
      button-class="btn"
      :custom-strings="{
        upload: '',
        drag: ''
      }"
      @change="onChange">
    </picture-input>
  </div>

	<div class="w-full flex justify-around mb-10">

		<ingredient-tray @ingredient-to-pantry="ingredientToPantry" :ingredients="computedChosenIngredients"></ingredient-tray>

		<pantry @ingredient-to-recipe="ingredientToRecipe" :ingredients="computedPantryIngredients"></pantry>

	</div>

	<div class="w-1/4 flex flex-col items-center gap-5 mb-10">
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

			ingredientToRecipe: function (id) {

				const ingredient = this.pantryIngredients.filter(obj => obj.id == id)

				this.removeIngredient(id, this.pantryIngredients)

				this.chosenIngredients.push(ingredient[0])

				console.log('choose ingredient: ' + ingredient[0])
			},

			ingredientToPantry: function (id) {
				const ingredient = this.chosenIngredients.filter(obj => obj.id == id)

				this.removeIngredient(id, this.chosenIngredients)

				this.pantryIngredients.push(ingredient[0])
				
				console.log('removeIngredient ' + this.pantryIngredients)
			},

			removeIngredient: function (id, arr) {
				let index = arr.findIndex(object => 
					object.id === id
				)

				arr.splice(index, 1)
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