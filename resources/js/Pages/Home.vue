<template>
  <div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <Link href="/demo2">Demo2</Link>
        </div>
      <!-- <div class="col-md-3" v-for="product in this.products" :key="product.index">
        {{ product.name }} ==> {{ product.price }}
      </div> -->
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
  components: {
    Link,
  },
  data() {
    return {
      products: [
        {
          name: 'Product 1',
          price: '$10',
        },
        {
          name: 'Product 2',
          price: '$20',
        },
        {
          name: 'Product 3',
          price: '$30',
        },
      ],
    }
  },
  name: 'Home',
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
