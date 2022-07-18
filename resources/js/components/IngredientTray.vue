<template>
	<div class="rounded ">
		<h2 v-if="!pantry" class="font-bold pb-3">Ingredients:</h2>
		<h2 v-else>Pantry:</h2>
		<ul>
			<li v-if="pantry" v-for="ingredient in ingredients" :key="ingredient.id" class="relative flex">
				<p class="hover:cursor-pointer" @click="choose(ingredient)">{{ ingredient.name }}</p>
				

				<div class="dropdown dropdown-end">
				  <label tabindex="0" class="btn btn-circle btn-ghost btn-xs text-info">
				    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
				  </label>
				  <div tabindex="0" class="card compact dropdown-content shadow bg-base-100 rounded-box w-64">
				    <div class="card-body">
				      <h2 class="card-title">{{ ingredient.name }}</h2> 
				      <p class="text-base" v-if="ingredient.description">{{ ingredient.description }}</p>
				    </div>
				  </div>
				</div>
			</li>

			<li v-else v-for="ingredient in ingredients" :key="ingredient.id" class="relative flex">
				<p class="hover:cursor-pointer" @click="remove(ingredient)">{{ ingredient.name }}</p>
				<input type="text" v-model="ingredient.qty" class="input input-bordered max-w-xs">

				<div class="dropdown dropdown-end">
				  <label tabindex="0" class="btn btn-circle btn-ghost btn-xs text-info">
				    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
				  </label>
				  <div tabindex="0" class="card compact dropdown-content shadow bg-base-100 rounded-box w-64">
				    <div class="card-body">
				      <h2 class="card-title">{{ ingredient.name }}</h2> 
				      <p class="text-base" v-if="ingredient.description">{{ ingredient.description }}</p>
				    </div>
				  </div>
				</div>
			</li>

		</ul>
	</div>
</template>

<script>
	export default {
		props: {
			ingredients: Array,
			pantry: {
				default: false,
				type: boolean 
			}
		},

		data() {		
		},
		
		methods: {
			choose: function (ingredient) {
				this.$emit('chooseIngredient(ingredient)')
				console.log('choose')
			},

			remove: function (ingredient) {
				this.$emit('removeIngredient(ingredient)')
				console.log('remove' + this.pantry)
			}
		},
	}
</script>

<style scoped>
	.off {
		display: none;
	}

	.modal {
		position: absolute;
		left: ;
	}
</style>