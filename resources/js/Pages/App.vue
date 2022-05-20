<template>
  <main>
    <nav class="navbar navbar-expand navbar-dark bg-dark" aria-label="Second navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Laravel Demo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <Link class="nav-link" href="/">Home</Link>
          </li>
          <li class="nav-item">
            <Link class="nav-link" href="/bouquets">Bouquets</Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="container-fluid">
      <slot />
    </div>
  </main>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue'
export default {
  name: 'App',
  components: {
    Link,
  },
}
</script>
