<template>

	<div tabindex="0" class="absolute h-1/3 w-1/2 card compact shadow bg-base-100 rounded-box w-64">
		<button class="btn btn-circle absolute right-2 top-2">
			  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
			</button>
	    <div class="card-body relative m-auto max-w-1/4 h-1/4">

	    	

	    	<h2 class="card-title">Create New Ingredient</h2>

	    	<p>Name:</p>
	        <input type="text" v-model="ingredient.name" class="input input-bordered input-primary"
	        value="{{ searchText }}">
	        <p>Details:</p>
		    <textarea class="textarea textarea-bordered textarea-primary" v-model="ingredient.description" placeholder="Optional"> 
	    	</textarea>
		    <button class="btn btn-primary" @click="postIngredient">Submit</button>
	    </div>
	</div>


	<!-- <div class="absolute rounded-xl p-16 m-auto bg-base-200">

		<input type="text" v-model="ingredient.name" placeholder="Name">
		<input type="text" v-model="ingredient.description" placeholder="Details">
		<button @click="postIngredient">Submit</button>

		
	</div> -->
	
</template>

<script>
	export default {
		props: {
			searchText: String,
		},

		data() {
			return {
				ingredient: {},
			}
		},

		methods: {
			postIngredient: async function() {
				let url = './api/ingredients/create'


				const ingredient = await fetch(url, {

					method: 'POST',

					headers: {
						'Content-Type': 'application/json'
					},

					body: JSON.stringify(this.ingredient)
				})
				.then(res => res.json())
				.then(data => console.log('data: ' + data))
				.catch(error => console.log(error))

				console.log('postIngredient ' + ingredient)
				
				this.$emit('ingredient-created', ingredient)

				this.ingredient = {}

				
			}
		}
	}
	
</script>