<template>
	<div class="relative rounded">
		<h2 class="font-bold pb-3">Pantry:</h2>
		<ul>
			<li v-for="ingredient in ingredients" :key="ingredient.id" class="relative flex">

				<p class="hover:cursor-pointer" @click="choose(ingredient.id)">{{ ingredient.name }}
					{{ ingredient.id }}
				</p>

				<info-modal v-if="ingredient.description" :title="ingredient.name" :info="ingredient.description" ></info-modal>
					}
				
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
			choose: function (id) {
				this.$emit('ingredient-to-recipe', id)
				console.log('Pantry choose by id: ' + id)
			},
		},

		components: {
			InfoModal
		},

		mounted() {
			console.log('pantry array: ' + this.ingredients)
		},
	}
</script>