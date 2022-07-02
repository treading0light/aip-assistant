<template>
    <div class="flex flex-col justify-center items-center mt-20 bg-slate-300">
        <h1 v-if="recipe" class="text-3xl">{{ recipe.name }}</h1>
        {{recipe.photo}}
        <img src="url(images/default-recipe-big.png)">
        <h1>Hello there</h1>

        <button @click="changeData">Change Recipe</button>
    </div>
</template>

<script>
    import { ref, computed, onMounted } from "vue"

    export default {
        name: 'recipe',
        props: {

        },
        setup() {

            // initialize reactive ref objects
            const id = ref(1)
            const recipe = ref(null)
            const loading = ref(true)
            const error = ref(null)
            const publicPath = process.env.BASE_URL

            // fetch a single recipe in json format
            const fetchData = async () => {

                const info = await fetch('./api/recipe/'+ id.value, {
                        method: 'get',
                        headers: {
                            'content-type': 'application/json'
                        }
                    })
                .then(res => res.json())
                .catch((error) => {
                    console.error('Error: ', error)
                })
                return info

                // console.log(recipe.value)

            }

            const changeData = () => {
                id.value++
                fetchData(id)
                .then(data => recipe.value = data)
                console.log(id.value)
            }



            fetchData(id)
            .then(data => recipe.value = data)
            .catch((error) => {
                console.error(error)
            })

            return {
                recipe,
                loading,
                error,
                fetchData,
                changeData,
                publicPath
            }

            // let recipe = async() => { await fetch('./api/recipe/first')
            // .then(res => res.json())
            // .then(data => return)
                
            // }


        }
    }
</script>
