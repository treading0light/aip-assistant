<template>
	<div class="navbar bg-primary">
  <div class="flex-1 px-2 lg:flex-none">
    <a class="text-2xl font-bold text-secondary">AIP <span class="text-primary-content">Assistant</span></a>
  </div> 
  <div class="flex justify-end flex-1 px-2">
    <div class="flex items-stretch">

      <a @click="toHome" class="btn btn-ghost rounded-btn text-primary-content">Home</a>

      <div id="dropdown" class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost rounded-btn text-primary-content"
        >Recipes</label>
        <ul tabindex="0" class="menu dropdown-content p-2 shadow bg-base-100 rounded-box w-52 mt-4 text-base">
          <li @click="toList"><a>View All</a></li>
          <li @click="toCreate"><a>Make New</a></li>
        </ul>
      </div>

    </div>
  </div>
</div>
	
</template>

<script>
	export default {
		name: 'HeaderNav',

    methods: {
      toList: function () {
        this.$emit('change-location', 'recipe-list')
        this.toggleDropdown()
      },

      toCreate: function () {
        this.$emit('change-location', 'new-recipe')
        this.toggleDropdown()
      },

      toHome: function () {
        this.$emit('change-location', 'home')
      },

      toggleDropdown: function () {

        document.activeElement.blur()
        // const el = document.getElementById('dropdown')
        // console.log(el)
        // el.blur()

        // if (el === document.activeElement) {
        //   el.blur()
        // }

      },

    },

	}
</script>