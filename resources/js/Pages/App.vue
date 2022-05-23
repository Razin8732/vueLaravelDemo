<template>
  <main>
    <nav
      class="navbar navbar-expand navbar-dark bg-dark"
      aria-label="Second navbar example"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Laravel Demo</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarsExample02"
          aria-controls="navbarsExample02"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
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
    <div
      class="loader-container align-items-center justify-content-center"
      v-show="this.loading"
    >
      <div class="loader"></div>
    </div>
  </main>
</template>
<style>
.loader-container {
  position: fixed;
  height: 100%;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
  top: 0;
  right: 0;
  display: flex;
}
.loader {
  border: 10px solid #f3f3f3;
  border-radius: 50%;
  border-top: 10px solid #3498db;
  width: 100px;
  height: 100px;
  -webkit-animation: spin 0.8s linear infinite; /* Safari */
  animation: spin 0.8s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<script>
import { Link } from '@inertiajs/inertia-vue'
export default {
  name: 'App',
  components: {
    Link,
  },
  data() {
    return {
      loading: false,
    }
  },
  methods: {
    isLoading(data = false) {
      this.loading = data
    },
  },
}
</script>
