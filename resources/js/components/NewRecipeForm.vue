<template>

	<div class="absolute right-1 left-1">
		<button class="btn btn-primary">Reset Form</button>
	</div>

	<input type="text" v-model="title" placeholder="title" class="input input-bordered input-primary w-full max-w-xs text-2xl">

	<input type="text" v-model="description" placeholder="description" class="input input-bordered input-primary w-full max-w-xs text-2xl">

	<input type="text" v-model="srcURL" placeholder="Source URL" class="input input-bordered input-primary w-full max-w-xs text-2xl">

	<picture-input 
      width="300" 
      height="300" 
      margin="16" 
      accept="image/jpeg,image/png" 
      size="10" 
      button-class="btn"
      :custom-strings="{
        upload: '<h1>Bummer!</h1>',
        drag: 'Click or drag photo here'
      }"
      @change="onChange">
    </picture-input>

	<div class="w-full flex justify-around mb-10">

		<ingredient-tray @ingredient-to-pantry="ingredientToPantry" :ingredients="computedChosenIngredients"></ingredient-tray>

		<pantry @ingredient-to-recipe="ingredientToRecipe"
		@create-ingredient-modal="createIngredientModal"
		:ingredients="computedPantryIngredients"
		></pantry>

	</div>

	<div class="w-1/2">
		<textarea 
		class="textarea textarea-primary w-full text-2xl" rows="10" 
		placeholder="Directions"
		v-model="directions"></textarea>
	</div>

	<button @click="postRecipe" class="btn btn-primary">Submit Recipe</button>

	<button @click="testRequest" class="btn btn-primary">Test</button>

	<ingredient-modal
	v-if="ingredientModal"
	@ingredient-created="ingredientCreated"
	@cancel-ingredient="cancelIngredient"
	:searchText="searchText">	
	</ingredient-modal>

	<div v-if="message" class="alert alert-success shadow-lg">
	  <div>
	    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
	    <span>{{ message }}</span>
	  </div>
	</div>
	
</template>

<script>
	import IngredientTray from './IngredientTray'
	import Pantry from './Pantry.vue'
	import IngredientModal from './IngredientModal'

	import PictureInput from './PictureInput.vue'

	export default {
		data() {
			return {
				// data to be used in creating new recipe
				
				title: '',
				description: '',
				chosenIngredients: [],
				image: null,
				directions: '',
				srcURL: '',

				// component dependency data
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

				searchText: null,

				ingredientModal: false,

				message: null,

				csrf: document.querySelector("meta[name='csrf-token']").getAttribute('content')
			}
		},

		computed: {
			computedChosenIngredients() {
				return this.chosenIngredients
			},

			computedPantryIngredients() {
				return this.pantryIngredients
			},

			computedMessage() {
				return this.message
			}
		},

		methods: {

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

				// console.log(this.pantryIngredients)
			},

			createIngredientModal: function (search) {
				this.searchText = search

				this.ingredientModal = true
			},

			ingredientCreated: function (ingredient) {
				this.pantryIngredients.unshift(ingredient)
				this.ingredientModal = false
			},

			cancelIngredient: function () {
				this.ingredientModal = false
			},

			onChange: function (image) {
		    	console.log('New picture selected!')
		        if (image) {
		        console.log('Picture loaded.')
		        this.image = image
		        } else {
		        console.log('FileReader API not supported: use the <form>, Luke!')
		      }
		    },

		    postRecipe: async function () {

		    	// console.log('no json')
		    	const recipe = {
		    		'title': this.title,
		    		'description': this.description,
		    		'image': this.image,
		    		'directions': this.directions,
		    		'ingredients': this.getReqIngredients()
		    	}

		    	console.log(this.csrf)

		    	const response = await fetch('./api/recipe/create', {

					method: 'POST',

					headers: {
						'Content-Type': 'application/json',
						 'Accept': 'application/json',
						'X-CSRF-Token': this.csrf
					},

					body: JSON.stringify(recipe)
				})
				.then(res => res.json())
				.catch(error => console.error('error: ' + error))

				// console.log(message)

				// const message = await response.json()
				
				console.log(response)

				
		    },

		    getReqIngredients: function () {
		    	return this.chosenIngredients.map(i => {

		    		return {
		    			id: i.id,
		    			qty: i.qty,
		    			unit: i.unit
		    		}
	    		})
		    },

		    testRequest: function () {
		    	const recipe = {
		    		'title': this.title,
		    		'description': this.description,
		    		'image': this.image,
		    		'directions': this.directions,
		    		'ingredients': this.getReqIngredients()
		    	}

		    	console.log('test request: ' + JSON.stringify(recipe))
		    },

		    alert: function () {
		    	alert('no json')
		    }
		},

		mounted() {
			this.fetchIngredients()
			// console.log('vm ingredients ' + app.pantryIngredients)
		},

		components: {
			IngredientTray,
			Pantry,
			PictureInput,
			IngredientModal
		},
	}
	
</script>