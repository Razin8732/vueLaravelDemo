<template>
  <div class="container-fluid">
    <div class="container-fluid p-2 border-bottom rounded mt-2" style="">
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
      style="height: 100vh !important;"
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
          <tr>
            <td colspan="2" rowspan="3" class="p-3">
              <span class="fs-5 fw-bold">
                Apply Voucher
                <button
                  class="btn btn-sm btn-danger"
                  v-if="this.cart.voucherApplied.id != ''"
                  @click="removeVoucher()"
                >
                  Remove Voucher
                </button>
              </span>
              <table class="table w-50 voucherTable">
                <tbody>
                  <tr v-for="voucher in this.vouchers" :key="voucher.id">
                    <td class="d-flex flex-column">
                      <span class="fs-5">{{ voucher.name }}</span>
                      <span class="fs-6">
                        {{ voucher.description }}
                      </span>
                    </td>
                    <td>
                      <button
                        class="btn btn-primary btn-sm"
                        @click="applyVoucher(voucher.id)"
                      >
                        Apply
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </td>
            <td class="fs-4 text-end">Total</td>
            <td class="fs-4">€{{ this.cart.total }}</td>
          </tr>
          <tr>
            <td class="fs-4 text-end">Discount</td>
            <td class="fs-4 d-flex align-items-center">
              €{{ this.cart.discount }}
              <span class="fs-6" v-if="this.cart.voucherApplied.name != ''">
                ({{ this.cart.voucherApplied.name }})
              </span>
            </td>
          </tr>
          <tr>
            <td class="fs-4 text-end">Grand Total</td>
            <td class="fs-4">€{{ this.cart.grandTotal }}</td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>
<style scoped>
.voucherTable {
  max-height: 100px;
  overflow-y: scroll;
  display: block;
}
</style>
<script>
import { Link } from '@inertiajs/inertia-vue'
import Layout from './App'
import Swal from 'sweetalert2/dist/sweetalert2.js'
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
        voucherApplied: {
          id: '',
          name: '',
        },
        grandTotal: 0,
        discount: 0,
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
      vouchers: [
        {
          id: 1,
          name: 'Voucher V',
          description:
            '10% off discount voucher for the second unit applying only to product A',
          condition: ['productID == 2'],
        },
        {
          id: 2,
          name: 'Voucher R',
          description: '5€ off discount on product B',
          condition: ['productID == 2'],
        },
        {
          id: 3,
          name: 'Voucher S',
          description: '5% discount on a cart value over 40€',
          condition: ['cartTotal > 40 '],
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
        if (this.cart.total > 0) {
          this.cart.total -= valObj.product.price
        }
      }
      this.updateLocalStorage()
    },
    updateLocalStorage() {
      localStorage.setItem('cart', JSON.stringify(this.cart))
      this.checkVoucherValidity()
    },
    applyVoucher(voucherId, showMsg = true) {
      this.$parent.isLoading(true)
      let success = false
      let msg = ''
      switch (voucherId) {
        case 1:
          success = false
          msg =
            'You need to buy at least 2 units of ' +
            this.products[0].name +
            ' to apply this voucher'
          let productID = 1
          let valObj = this.cart.products.find(function (elem, index) {
            return elem.product.id == productID
          })
          if (valObj != undefined) {
            let indexOf = this.cart.products.indexOf(valObj)
            if (indexOf > -1) {
              let productData = this.cart.products[indexOf]
              if (productData.quantity >= 2) {
                this.cart.voucherApplied.id = voucherId
                this.cart.discount =
                  productData.quantity * productData.product.price * 0.1
                this.cart.grandTotal = this.cart.total - this.cart.discount
                success = true
                msg = 'Voucher applied'
              }
            }
          }
          break
        case 2:
          success = false
          msg =
            'You need to buy at least 1 units of ' +
            this.products[1].name +
            ' to apply this voucher'
          productID = 2
          valObj = this.cart.products.find(function (elem, index) {
            return elem.product.id == productID
          })
          if (valObj != undefined) {
            let indexOf = this.cart.products.indexOf(valObj)
            if (indexOf > -1) {
              let productData = this.cart.products[indexOf]
              this.cart.voucherApplied.id = voucherId
              this.cart.discount = 5
              this.cart.grandTotal = this.cart.total - this.cart.discount
              success = true
              msg = 'Voucher applied'
            }
          }
          break
        case 3:
          success = false
          msg =
            'You need to buy at least €40 worth of products to apply this voucher'

          if (this.cart.total >= 40) {
            this.cart.voucherApplied.id = voucherId
            this.cart.discount = (this.cart.total * 5) / 100
            this.cart.grandTotal = this.cart.total - this.cart.discount
            success = true
            msg = 'Voucher applied'
          }
          break
      }
      let valObj = this.vouchers.find(function (elem, index) {
        return elem.id == voucherId
      })
      if (valObj != undefined) {
        let indexOf = this.vouchers.indexOf(valObj)
        this.cart.voucherApplied.name = this.vouchers[indexOf].name
      }

      if (showMsg) {
        let messageTitle = 'Voucher apply '
        messageTitle += success ? 'successful' : 'unsuccessful'
        Swal.fire({
          icon: success == true ? 'success' : 'error',
          title: messageTitle,
          text: msg,
          confirmButtonText: 'OK',
        })
      }
      setTimeout(() => {
        this.$parent.isLoading(false)
      }, 500)
      return success
    },
    removeVoucher(msgTitle = 'success', msgText = 'Voucher removed') {
      this.cart.voucherApplied.id = ''
      this.cart.voucherApplied.name = ''
      this.cart.discount = 0
      this.cart.grandTotal = this.cart.total
      Swal.fire({
        icon: 'success',
        title: msgTitle,
        text: msgText,
        confirmButtonText: 'OK',
      })
    },
    checkVoucherValidity() {
      let voucherApplied = this.cart.voucherApplied.id
      if (voucherApplied != '') {
        let result = this.applyVoucher(voucherApplied, false)
        if (!result) {
          let valObj = this.vouchers.find(function (elem, index) {
            return elem.id == voucherApplied
          })
          if (valObj != undefined) {
            let indexOf = this.vouchers.indexOf(valObj)
            if (indexOf > -1) {
              this.removeVoucher(
                'Voucher removed',
                this.vouchers[indexOf].name + ' criteria not met',
              )
            }
          }

          // fallback condition if something went wrong with the voucher
          if (this.cart.voucherApplied.id != '') {
            this.removeVoucher()
          }
        }
      }
    },
  },
}
</script>
