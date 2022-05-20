<template>
  <div class="container-fluid">
    <div class="container-fluid p-2 border-bottom rounded mt-2">
      <h1>Products</h1>
      <div class="row">
        <div
          class="col-md-4 p-3"
          v-for="product in this.products"
          :key="product.index"
        >
          <div
            class="border text-center rounded bouquets p-3"
            @mouseenter="addClass"
            @mouseleave="removeClass"
          >
            <div class="border-bottom mb-2 pb-2">
              <img :src="product.image" class="w-75 img-fluid" />
            </div>
            <div class="text-start" style="z-index: 3; position: relative;">
              <h3 class="text-truncate">{{ product.name }}</h3>
              <button
                class="btn btn-primary btn-sm float-end"
                @click="addToCart(product)"
              >
                Add To Cart
              </button>
              <span class="fs-4 fw-normal">€{{ product.price }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      class="container-fluid p-2 border-bottom rounded mt-2"
      v-if="this.cart.products.length > 0"
    >
      <h1>Cart</h1>
      <table class="table table-striped">
        <thead>
          <th>Item</th>
          <th>Price</th>
          <th>Total</th>
          <th>Quantity</th>
          <th>Remove All</th>
        </thead>
        <tbody>
          <tr v-for="item in this.cart.products" :key="item.id">
            <td>
              <h3>{{ item.product.name }}</h3>
            </td>
            <td class="" style="width: 10%;">
              <span class="fs-4 fw-normal">€{{ item.product.price }}</span>
            </td>
            <td class="" style="width: 10%;">
              <span class="fs-4 fw-normal">
                €{{ parseInt(item.quantity) * parseInt(item.product.price) }}
              </span>
            </td>
            <td class="" style="width: 10%;">
              <div class="d-flex flex-row justify-content-around">
                <button
                  class="btn btn-primary btn-sm rounded"
                  @click="addToCart(item.product)"
                >
                  <i class="fa fa-plus"></i>
                </button>
                <span class="fs-4 fw-normal">{{ item.quantity }}</span>
                <button
                  class="btn btn-danger btn-sm rounded"
                  @click="removeFromCartQuantity(item.product.id)"
                >
                  <i class="fa fa-minus"></i>
                </button>
              </div>
            </td>
            <td class="" style="width: 10%;">
              <button
                class="btn btn-danger btn-sm float-end"
                @click="removeFromCart(item.product.id)"
              >
                Remove
              </button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <td colspan="3" class="p-3">
            <span class="fs-5 fw-bold">Apply Voucher</span>
            <table class="table w-50">
              <tbody>
                <tr>
                  <td class="d-flex flex-column">
                    <span class="fs-5">Voucher 1</span>
                    <span class="fs-6">
                      10% off discount voucher for the second unit applying only
                      to Product A
                    </span>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm">Apply</button>
                  </td>
                </tr>
                <tr>
                  <td class="d-flex flex-column">
                    <span class="fs-5">Voucher 2</span>
                    <span class="fs-6">
                      5€ off discount on product type B
                    </span>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm">Apply</button>
                  </td>
                </tr>
                <tr>
                  <td class="d-flex flex-column">
                    <span class="fs-5">Voucher 3</span>
                    <span class="fs-6">
                      5% discount on a cart value over 40€
                    </span>
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm">Apply</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
          <td colspan="2">
            <h3>Total €{{ this.cart.total }}</h3>
          </td>
        </tfoot>
      </table>
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
  data() {
    return {
      cart: {
        products: [],
        total: 0,
      },
      products: [
        {
          id: 1,
          name: 'White Lilies (Product A)',
          price: 10,
          image:
            'https://d1mxm3s28igxxe.cloudfront.net/480x480/5cdd463408a93217111334.png',
        },
        {
          id: 2,
          name: 'Lilies and Roses (Product B)',
          price: 8,
          image:
            'https://d1mxm3s28igxxe.cloudfront.net/480x480/5d84d413616d7421246578.png',
        },
        {
          id: 3,
          name: 'Pink Roses (Product C)',
          price: 12,
          image:
            'https://d1mxm3s28igxxe.cloudfront.net/480x480/5d88ba27a40fa820506277.png',
        },
      ],
    }
  },
  name: 'Home',
  mounted() {
    let storageCart = JSON.parse(localStorage.getItem('cart'))
    if (storageCart !== null) {
      this.cart = storageCart
    }
  },
  updated() {
    window.addEventListener('beforeunload', this.updateLocalStorage)
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
    addToCart(product) {
      var valObj = this.cart.products.find(function (elem, index) {
        return elem.product.id == product.id
      })
      if (valObj == undefined) {
        this.cart.products.push({
          product,
          quantity: 1,
        })
      } else {
        let indexOfId = this.cart.products.indexOf(valObj)
        this.cart.products[indexOfId].quantity++
      }
      this.cart.total += product.price
      this.updateLocalStorage()
    },
    removeFromCart(productId) {
      var valObj = this.cart.products.find(function (elem, index) {
        return elem.product.id == productId
      })
      if (valObj == undefined) {
        return
      } else {
        let indexOfId = this.cart.products.indexOf(valObj)
        this.cart.products.splice(indexOfId, 1)
        this.cart.total -= valObj.product.price * valObj.quantity
      }
      this.updateLocalStorage()
    },
    removeFromCartQuantity(productId) {
      var valObj = this.cart.products.find(function (elem, index) {
        return elem.product.id == productId
      })
      if (valObj != undefined) {
        let indexOfId = this.cart.products.indexOf(valObj)
        if (this.cart.products[indexOfId].quantity > 1) {
          this.cart.products[indexOfId].quantity--
        } else {
          this.cart.products.splice(indexOfId, 1)
        }
        this.cart.total -= valObj.product.price
      }
      this.updateLocalStorage()
    },
    updateLocalStorage() {
      localStorage.setItem('cart', JSON.stringify(this.cart))
    },
  },
}
</script>
