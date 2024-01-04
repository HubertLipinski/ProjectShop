<template>
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4 d-flex align-items-center justify-content-center p-2">
                <img :src="product.thumbnail" class="img-fluid rounded-start" :alt="product.title">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ product.title }}</h5>
                    <p class="card-text">{{ product.description }}</p>
                    <p class="card-text"><span class="fw-bold">Kategorie: </span>{{ product.categories.join(', ') }}</p>
                    <p class="card-text"><small class="text-muted">Ostatnia zmiana: {{ product.updated_at }}</small></p>
                    <div class="row w-100 pt-2">
                        <div class="col">
                            <p class="h5 mb-0">Cena: {{product.price}} zł</p>
                        </div>
                        <div class="col text-end p-0 m-0">
                            <div class="btn btn-sm btn-outline-success" @click="addToCart">Dodaj do koszyka</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        product: {type: Object, required: true}
    },
    methods: {
        addToCart() {
            axios.post('/cart/store', {
                id: this.product.id
            })
                .then(response => {
                    this.$notify({
                        title: 'Success',
                        message: 'Produkt został dodany do koszyka',
                        type: 'success',
                        duration: 2500,
                        offset: 55
                    });
                  this.$root.$emit('cart-updated', response.data.cartCount)
                })
                .catch(err => console.error(err))
        }
    }
}
</script>

<style scoped>

</style>
