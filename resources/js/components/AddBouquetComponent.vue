<template>
  <div>
    <div
      class="modal fade"
      data-bs-backdrop="static"
      id="addBouquetModal"
      tabindex="-1"
      aria-labelledby="addBouquetModal"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <form
          class="row g-3 needs-validation"
          @submit.prevent="addBouquet"
          novalidate
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addBouquetModal">
                Add Bouquet
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <div class="col-md-12">
                <label for="validationCustom01" class="form-label">
                  Bouquet Name
                </label>
                <input
                  type="text"
                  class="form-control"
                  name="name"
                  id="validationCustom01"
                  value="Mark"
                  v-model="bouquet.name"
                  required
                />
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="
                    this.errors.length != 0 &&
                    this.errors.hasOwnProperty('name')
                  "
                >
                  <ul class="mb-1">
                    <li v-for="(error, index) in this.errors.name" :key="index">
                      {{ error }}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-12">
                <label for="validationCustom02" class="form-label">
                  Price
                </label>
                <input
                  type="text"
                  class="form-control"
                  name="price"
                  id="validationCustom02"
                  value="Otto"
                  v-model="bouquet.price"
                  required
                />
                <div class="valid-feedback">
                  Looks good!
                </div>
                <div
                  class="invalid-feedback d-block"
                  v-if="
                    this.errors.length != 0 &&
                    this.errors.hasOwnProperty('price')
                  "
                >
                  <ul class="mb-1">
                    <li
                      v-for="(error, index) in this.errors.price"
                      :key="index"
                    >
                      {{ error }}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="col-md-12">
                <label for="validationCustomUsername" class="form-label">
                  Image Url
                </label>
                <div class="input-group has-validation">
                  <span class="input-group-text" id="inputGroupPrepend">
                    <i class="fa fa-globe"></i>
                  </span>
                  <input
                    type="text"
                    class="form-control"
                    name="image"
                    id="validationCustomUsername"
                    aria-describedby="inputGroupPrepend"
                    v-model="bouquet.image"
                    required
                  />
                  <div
                    class="invalid-feedback d-block"
                    v-if="
                      this.errors.length != 0 &&
                      this.errors.hasOwnProperty('image')
                    "
                  >
                    <ul class="mb-1">
                      <li
                        v-for="(error, index) in this.errors.image"
                        :key="index"
                      >
                        {{ error }}
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button
                type="submit"
                class="btn btn-primary"
                :class="{ disabled: isLoading == true }"
                :disabled="isLoading == true ? true : false"
              >
                <i
                  class="fas fa-spinner fa-spin"
                  v-if="isLoading == true ? true : false"
                ></i>
                Add Bouquet
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { Inertia } from '@inertiajs/inertia'
export default {
  name: 'AddBouquetComponent',
  data() {
    return {
      bouquet: {
        name: '',
        price: '',
        image: '',
      },
      errors: [],
      isLoading: false,
    }
  },
  methods: {
    closeModal() {
      $('#addBouquetModal').modal('hide')
    },
    addBouquet() {
      this.isLoading = true
      window.axios
        .post('/bouquets', this.bouquet)
        .then((response) => {
          if (response.data.success == true) {
            this.closeModal()
            Inertia.reload({
              preserveState: false,
            })
            Swal.fire('Created!', response.data.msg, 'success')
            this.bouquet = ''
            this.errors = []
          } else {
            Swal.fire('Error!', response.data.msg, 'error')
          }
        })
        .catch((errorRsp) => {
          this.errors = []
          if (errorRsp.response.hasOwnProperty('data')) {
            if (errorRsp.response.data.hasOwnProperty('errors')) {
              this.errors = errorRsp.response.data.errors
            } else {
              Swal.fire('Error!', 'Something went wrong.', 'error')
            }
          }
        })
      setTimeout(() => {
        this.isLoading = false
      }, 800)
    },
  },
}
</script>
