<template>
    <div class="col-md-12 col-lg-2">
        <div class="list-group">
            <label class="list-group-item" v-for="category in categories" :key="category.id">
                <input class="form-check-input me-1" type="checkbox" :value="category.id">
                {{category.name}}
            </label>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            categories: [],
            selected: [],
        }
    },
    mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            axios.get('/api/categories')
                .then(response => {
                    console.log(response.data.categories);
                    this.categories = response.data.categories;
                })
                .catch(error => {})
        }
    }
}
</script>

<style scoped>

</style>
