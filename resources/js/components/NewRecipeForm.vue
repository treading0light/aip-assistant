<template>

	<input type="text" v-model="title" placeholder="title">

	<input type="text" v-model="description" placeholder="description">

	<div class="flex gap-5 mb-10">

		<ingredient-tray :ingredients="dynamicIngredients"></ingredient-tray>

		<input class="border-black text-center" type="text" @keyup.enter="addIngredient" v-model="newIngredient">

		<button class="bg-gray-500 h-fit py-1 px-2 rounded self-center" @click="addIngredient">Add</button>

	</div>
	
</template>

<script>
	import IngredientTray from './IngredientTray'

	export default {
		data() {
			return {
				title: '',
				description: '',
				dynamicIngredients: [
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

			fetchIngredients: async function () {
				const response = {}

				await fetch('./api/ingredients')
				.then(res => res.json())
				.then(json => response = json)

				console.log(response)
			}

		},

		mounted() {
			this.fetchIngredients()
		},

		components: {
			IngredientTray
		},
	}
	
</script>