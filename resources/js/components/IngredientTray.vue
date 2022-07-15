<template>
	<div class="border-black border-dashed border-2 rounded p-5">
		<h2 class="font-bold pb-3">Ingredients:</h2>
		<ul>
			<li v-for="ingredient in ingredients" :key="ingredient.id">
				{{ ingredient.name }}
				<!-- <div class="modal"></div> -->
			</li>
		</ul>
	</div>
</template>

<script>
	export default {
		props: {
			ingredients: Array,
		},
		
		methods: {
			// function renderModal(text)
		},
	}
</script>