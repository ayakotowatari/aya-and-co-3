<template>
    <v-container>
        <updatecartquantitydialog-component
            v-bind:dialogUpdateCartQuantity='dialogUpdateCartQuantity'
            v-bind:selectableNumbers='selectableNumbers'
        ></updatecartquantitydialog-component>
        <removecartitemdialog-component
            v-bind:dialogRemoveCartItem='dialogRemoveCartItem'
        ></removecartitemdialog-component>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Shopping Cart
                    </div>
                    <div v-if="user === null" class="page-subtitle grey--text text--darken-3">
                        お買い物かご
                    </div>
                    <div v-if="user !== null" class="page-subtitle grey--text text--darken-3">
                        {{user.name}}様のお買い物かご
                    </div>
                </div>
            </v-col>
        </v-row>
        <div v-if="cart.length <= 0" class="mb48">
            <div class="mb-8">
                {{ $t('cart.message')}}
            </div>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                     <coupondisplay-component></coupondisplay-component>
                </v-col>
            </v-row>
        </div>
        <div v-if="cart.length >= 1" class="mb48">
            <v-row>
                <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row justify="start">
                        <v-col cols="12" sm="12" md="6" v-for="(item) in cart" :key="item.id">
                            <v-card
                                class="mx-auto"
                                max-width="390"
                                outlined
                                color="#F1F1F1"
                            >
                                <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="product-name mb-1">
                                        {{item.name}} 
                                    </div>
                                    <div v-if="item.slug !== 'marmalade-loaf'" class="product-size mb-4">
                                        {{item.size}}
                                    </div>
                                    <div class="product-price mb-6">
                                        {{formatPrice(item.price)}}
                                        </div>
                                    <v-row align="center">
                                        <v-col cols="4" sm="4" md="4" >
                                            <label class="product-quantity" for="">{{ $t('product.quantity')}}</label>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="2">
                                            <!-- <select :value="`${item.quantity}`" class="select-box" @change="updateCartQuantity(index, $event.target.value)">
                                                <option value=1>1</option>
                                                <option value=2>2</option>
                                                <option value=3>3</option>
                                                <option value=4>4</option>
                                                <option value=5>5</option>
                                                <option value=6>6</option>
                                                <option value=7>7</option>
                                                <option value=8>8</option>
                                                <option value=9>9</option>
                                            </select> -->
                                                {{ item.quantity }}
                                        </v-col>
                                    </v-row>
                                    <div class="text-overline mb-4">
                                    {{ $t('product.item-total')}}: {{ cartLineTotal(item) }} 
                                    </div>
                                    <v-row>
                                        <v-col cols="12" md="12" sm="12">
                                            <v-btn
                                                outlined
                                                color="grey darken-1"
                                                @click="updateCartQuantity(item)"
                                                class="mr-3"
                                            >
                                                {{ $t('btn.update')}}
                                            </v-btn>
                                            <v-btn
                                                outlined
                                                color="grey darken-1"
                                                @click="remove(item)"
                                            >
                                                {{ $t('btn.remove')}}
                                            </v-btn>
                                        </v-col>
                                    </v-row>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    tile
                                    size="80"
                                    color="grey"
                                >
                                    <v-img
                                        :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${item.image}`"
                                    ></v-img>
                                </v-list-item-avatar>
                                </v-list-item>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <span class="totalprice">
                                {{ $t('product.total')}}：
                            </span>
                            <span v-text="cartTotal" class="totalprice"></span>
                        </v-col>
                    </v-row>
                    <v-row class="mb-8">
                        <v-col cols="12" sm="12" md="3">
                            <v-btn
                                dark
                                color="primary"
                                v-if='user === null'
                                @click="$router.push({name: 'guest-order'})"
                                class="hidden-sm-and-down"
                            >
                            {{ $t('btn.checkout')}}
                            </v-btn>
                            <v-btn
                                block
                                dark
                                color="primary"
                                v-if='user === null'
                                @click="$router.push({name: 'guest-order'})"
                                class="hidden-md-and-up"
                            >
                            {{ $t('btn.checkout')}}
                            </v-btn>
                            <v-btn
                                dark
                                color="primary"
                                v-if='user !== null'
                                @click="toOrder"
                                class="hidden-sm-and-down"
                            >
                            {{ $t('btn.checkout')}}
                            </v-btn>
                            <v-btn
                                block
                                dark
                                color="primary"
                                v-if='user !== null'
                                @click="toOrder"
                                class="hidden-md-and-up"
                            >
                            {{ $t('btn.checkout')}}
                            </v-btn>
                        </v-col>
                        <v-col cols="12" sm="12" md="3">
                            <v-btn
                                color="primary"
                                outlined
                                @click="goToProductsList"
                                class="hidden-sm-and-down"
                            >{{ $t('btn.shopping')}}</v-btn>
                            <v-btn
                                block
                                color="primary"
                                outlined
                                @click="goToProductsList"
                                class="hidden-md-and-up"
                            >{{ $t('btn.shopping')}}</v-btn>
                        </v-col>
                    </v-row>
                    <div class="mb-6">
                        <p :class="descriptionClasses">
                            {{$t('cart.check-postage1')}}<router-link to="/postage">{{$t('cart.check-postage2')}}</router-link>{{$t('cart.check-postage3')}}
                        </p>     
                    </div>
                    <v-row>
                        <v-col cols="12" sm="12" md="8">
                            <coupondisplay-component></coupondisplay-component>
                        </v-col>
                    </v-row>
                </v-col>
            </v-row>
        </div>
       
        <div class="divider-image orange-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/orange.png"
          ></v-img>
        </div>

        <div class="subheading">
            Products List
        </div>
        <div class="subheading-jp">
            商品リスト
        </div>

        <v-tabs v-model="tab" class="mb-12">
          <v-tab
              href="#tab-1"
              :class="tabClasses"
          >
              {{ $t('products_list.heading_all')}}
          </v-tab>
          <v-tab
              href="#tab-2"
              :class="tabClasses"
          >
              {{ $t('products_list.heading_current')}}
          </v-tab>
          <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
      </v-tabs>

      <v-tabs-items v-model="tab">
          <v-tab-item 
              value="tab-1"
          >
              <allproducts-component></allproducts-component>
          </v-tab-item>
          <v-tab-item
              value="tab-2"
          >
              <currentproducts-component></currentproducts-component>
          </v-tab-item>
      </v-tabs-items>
   </v-container>
</template>

<script>

import { mapState, mapActions } from 'vuex';

export default {
    props: {
        user: Object
    },
    data: function(){
        return {
            // id: this.$route.params.id
            tab: null,
            // quantity: [1, 2, 3]
        }
    },
    mounted(){
        
    },
    created(){
        this.$store.dispatch('coupon/checkIfCoupon')
    },
    computed: {
        ...mapState([
          'cart',
          'categories',
          'dialogUpdateCartQuantity',
          'dialogRemoveCartItem',
          'selectableNumbers',
        ]),
        ...mapState('coupon',[
            'ifCoupon'
        ]),
        cartTotal(){
            let amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            //console.log(amount);
            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        descriptionClasses(){
          if(this.$i18n.locale == 'en') return 'en-description'
          return 'description'
        },
        tabClasses(){
          if(this.$i18n.locale == 'en') return 'en-tab'
        }
    },
    methods: {
        ...mapActions([
            'removeProduct',
            'openDialogUpdateCartQuantity', 
            'openDialogRemoveCartItem',
            'fetchInventoryToUpdate'
        ]),
        formatPrice(value){
          let amount = value;

          return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        updateCartQuantity(value){

            //console.log('value', value);
            //this.$store.commit('openDialogUpdateCartQuantity', id)
            this.openDialogUpdateCartQuantity({
                cartItem: value
            })
            // this.fetchInventory({
            //     product_id: value.id
            // })
            this.fetchInventoryToUpdate({
                product_id: value.id
            })
        },
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        remove(value){

            //console.log(value);

            this.openDialogRemoveCartItem({
                cartItem: value
            })

        },
        toOrder(){
            this.$router.push({name: 'order'})

            this.$store.dispatch('coupon/clearCoupon');
            this.$store.commit('coupon/setCouponDisabled', false);
            this.$store.dispatch('coupon/clearAllErrors');
        },
        goToProductsList(){
            this.$router.push({name: 'products-list'})
        },
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
    }
}
</script>

<style>
.product-quantity{
    font-weight: 400;
}
.item-quantity{
    border: 1px solid;
}

.select-box{
    border: solid 1px #bfbfbf; 
    border-radius: 5px;
    padding: 5px 8px;
}

.totalprice{
    color: rgba(0, 0, 0, 0.87)
}

@media(max-width:780px){
   .orange-image{
       max-width: 70px;
   }
}

</style>