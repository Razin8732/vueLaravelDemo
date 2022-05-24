<template>
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-md-12">
        <span class="fs-3">Bouquets</span>
        <button
          class="btn btn-primary float-end"
          data-bs-toggle="modal"
          data-bs-target="#addBouquetModal"
        >
          Add New Bouquets
        </button>
      </div>
      <div class="col-md-12">
        <div class="row justify-content-center">
          <div class="col-md-12 p-3" v-if="this.bouquets.length == 0">
            <div class="alert alert-info text-center">
              <h4>No Records Found</h4>
            </div>
          </div>
          <div
            class="col-md-4 p-3"
            v-for="bouquet in this.bouquets"
            :key="bouquet.index"
          >
            <div
              class="border text-center rounded bouquets p-3"
              @mouseenter="addClass"
              @mouseleave="removeClass"
            >
              <div class="border-bottom mb-2 pb-2">
                <img :src="bouquet.image" class="w-75 img-fluid" />
              </div>
              <div class="text-start" style="z-index: 3; position: relative;">
                <a
                  href="#"
                  class="stretched-link text-decoration-none"
                  @click.prevent="viewBouquet(bouquet.id)"
                >
                  <h3 class="text-truncate">{{ bouquet.name }}</h3>
                </a>
                <span class="fs-4 fw-normal">
                  €{{ (bouquet.price.split('.')[0].includes('€')) ? bouquet.price.split('.')[0].split('€')[1] : bouquet.price.split('.')[0] }}
                  <sup>{{ bouquet.price.split('.')[1] }}</sup>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="modal fade"
      data-bs-backdrop="static"
      id="viewBouquetsModal"
      tabindex="-1"
      aria-labelledby="viewBouquetsModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="viewBouquetsModalLabel">
              {{ bouquet.name }} -
              <span v-if="bouquet.price != undefined">
                {{ bouquet.price.split('.')[0] }}
                <sup>{{ bouquet.price.split('.')[1] }}</sup>
              </span>
            </h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              @click="closeModal"
            ></button>
          </div>
          <div class="modal-body">
            <div class="border-bottom mb-2 pb-2 text-center">
              <img :src="bouquet.image" class="w-75 img-fluid" />
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-bs-dismiss="modal"
              @click="closeModal"
            >
              Close
            </button>
            <button
              type="button"
              class="btn btn-danger"
              @click="deleteBouquet(bouquet.id)"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>

    <AddBouquetComponent />
  </div>
</template>
<style>
.text-truncate {
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}
</style>
<script>
import Layout from './App'
import { Inertia } from '@inertiajs/inertia'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import AddBouquetComponent from '../components/AddBouquetComponent.vue'
export default {
  components: {
    AddBouquetComponent,
  },
  layout: Layout,
  name: 'Bouquets',
  props: {
    bouquets: Object | Array,
  },
  data() {
    return {
      bouquet: Object, // this will be used while viewing a bouquet (fetched from api)
    }
  },
  methods: {
    addClass(e) {
      if (!e.target.classList.contains('shadow')) {
        e.target.classList.add('shadow')
      }
    },
    removeClass(e) {
      if (e.target.classList.contains('shadow')) {
        e.target.classList.remove('shadow')
      }
    },
    viewBouquet(bouquetId) {
      window.axios
        .get('/bouquets/' + bouquetId)
        .then((response) => {
          this.bouquet = response.data
        })
        .catch((error) => {
          console.log(error)
        })
      $('#viewBouquetsModal').modal('show')
    },
    closeModal() {
      $('#viewBouquetsModal').modal('hide')
      this.bouquet = []
    },
    deleteBouquet(bouquetId) {
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
      }).then((result) => {
        if (result.isConfirmed) {
          window.axios
            .delete(`/bouquets/${bouquetId}`)
            .then((response) => {
              if (response.data.success) {
                this.closeModal()
                Inertia.reload({
                  preserveState: false,
                })
                Swal.fire('Deleted!', response.data.msg, 'success')
              } else {
                Swal.fire('Error!', response.data.msg, 'error')
              }
            })
            .catch((error) => {
              console.log(error)
            })
        }
      })
    },
  },
}
</script>
