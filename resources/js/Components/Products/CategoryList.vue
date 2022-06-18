<template>
    <div class="col-md-12 col-lg-2" v-loading="loading">
        <div class="list-group">
            <label class="list-group-item" v-for="category in categories" :key="category.id">
                <input class="form-check-input me-1" type="checkbox" v-model="selected" :value="category.id">
                {{category.name}}
            </label>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    emits: ['categoriesUpdated'],
    data() {
        return {
            loading: true,
            categories: [],
            selected: [],
        }
    },
    async mounted() {
        this.getCategories();
    },
    methods: {
        getCategories() {
            this.loading = true;
            axios.get('/api/categories')
                .then(response => {
                    this.loading = false;
                    this.categories = response.data.categories;
                })
                .catch(error => console.error(error))
        },
        reset() {
            this.selected = [];
        }
    },
    watch: {
        selected() {
            this.$emit('categoriesUpdated', this.selected);
        }
    }
}
</script>

<style scoped>

</style>
