<template>
	<div class="min-h-full flex flex-col justify-center items-center gap-10 text-3xl bg-base-300">

		<header-nav @change-location="changeLocation"></header-nav>

		<new-recipe-form v-if="location === 'new-recipe'"></new-recipe-form>

		<recipe-list v-else-if="location === 'recipe-list'"></recipe-list>

	</div>
	

	
</template>

<script>
	import NewRecipeForm from './NewRecipeForm'
    import HeaderNav from './HeaderNav'
    import RecipeList from './RecipeList'


    export default {
    	data() {
    		return {
    			location: 'recipe-list'
    		}
    	},

    	methods: {
    		changeLocation: function (destination) {
    			this.location = destination
    		}
    	},

    	components: {
    		NewRecipeForm,
    		HeaderNav,
    		RecipeList
    	}
    }


</script>