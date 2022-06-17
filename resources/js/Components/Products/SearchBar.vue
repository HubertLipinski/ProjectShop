<template>
    <div class="input-group mb-3">
        <input type="text" class="form-control form-control-lg"
               placeholder="Wyszukaj..."
               aria-label="Wyszukaj..."
               aria-describedby="btn-search"
               v-model.trim="query"
        >
        <el-button class="px-3" type="primary" icon="el-icon-search" @click="search">Wyszukaj</el-button>
    </div>
</template>

<script>
export default {
    emits: ['search'],
    data() {
        return {
            query: null,
        }
    },
    methods: {
        search() {
            this.$emit('search', this.query);
        },
        reset() {
            this.query = null;
        }
    }
}
</script>

<style scoped>

</style>
