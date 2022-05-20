<template>
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-md-12">
        <div class="row justify-content-center">
          <div
            class="col-md-4 p-3"
            v-for="bouquet in this.bouquets"
            :key="bouquet.index"
          >
            <div class="border text-center">
              <img :src="bouquet.image" class="w-75 img-fluid" />
              <!-- {{ bouquet.name }} -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
import Layout from './App'
export default {
  components: {
    Link,
  },
  layout: Layout,
  name: 'Demo2',
  props: {
    bouquets: Array | Object,
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
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
