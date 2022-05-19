<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Example Component for demo 2</div>

          <div class="card-body">
            I'm an example component.
            <Link href="/">Home</Link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'

export default {
  components: {
    Link,
  },
  name: 'Demo2',
  mounted() {
    console.log('Component mounted.')
  },
}
</script>
