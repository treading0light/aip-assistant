<template>
	<div class="min-h-full flex flex-col justify-center items-center gap-10 text-3xl bg-base-300">

		<header-nav @change-location="changeLocation"></header-nav>

		<home v-if="location === 'home'"></home>

		<new-recipe-form v-else-if="location === 'new-recipe'"></new-recipe-form>

		<recipe-list v-else-if="location === 'recipe-list'"></recipe-list>

	</div>
	

	
</template>

<script>
	import NewRecipeForm from './NewRecipeForm'
    import HeaderNav from './HeaderNav'
    import RecipeList from './RecipeList'
    import Home from './Home'


    export default {
    	data() {
    		return {
    			location: '',
    			home: 'home'
    		}
    	},

    	mounted() {
    		this.location = this.checkStorage()
    		this.storeLocation()

    	},

    	computed: {
    		// computedLocation: function () {
    		// 	if (localStorage.getItem('location')) {
    		// 		return localStorage.getItem('location')
    		// 	}
    		// },
    	},

    	methods: {
    		changeLocation: function (destination) {
    			this.location = destination
    			this.storeLocation()
    		},

    		storeLocation: function () {

    			localStorage.setItem('location', this.location)
    			localStorage.setItem('last-update', Date.now())
    		},

    		checkStorage: function () {
    			// check localStorage for location

    			if (!localStorage.getItem('location') || this.timeout()) {
    				return this.home

    			} else {
    				return localStorage.getItem('location')
    			}
    		},

    		timeout: function () {
    			// return true if last update is old enough

    			// last-update is saved to local storage in miliseconds
				const lastUpdate = localStorage.getItem('last-update')

				const timeDif = Date.now() - lastUpdate

				// 600,000ms == 10min
				if (timeDif >= 600000) {
					return true
				} else {
					return false
				}
    		},
    	},

    	components: {
    		NewRecipeForm,
    		HeaderNav,
    		RecipeList,
    		Home
    	}
    }


</script>