<template>
  <div class="pt-6">
        <!-- <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Checkout
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        お支払いの手続き
                    </div>
                </div>
            </v-col>
        </v-row> -->
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                 <h4 :class="formTitleClasses" class="grey--text text--darken-4 mb24 marginminus">{{$t('checkout.card_payment')}}</h4>
            </v-col>
        </v-row>

                <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <v-row justify="start">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{$t('product.total2')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="cartTotal" class="totalprice">
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <v-row justify="start">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{$t('product.shipping')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    {{formatPrice(deliveryAddress.postage)}}
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <v-row justify="start" class="mb-4">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="charge grey--text text--darken-3">
                                    {{$t('product.total3')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="totalPrice" class="charge">
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                 <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <div class="totalprice grey--text text--darken-2">
                            {{$t('checkout.card_note')}}
                        </div>
                    </v-col>
                </v-row>
                <!-- <v-row justify="center">
                    <v-col cols="12" sm="12" md="6">
                        <div class="totalprice grey--text text--darken-2">
                            {{$t('checkout.card_receipt')}}
                        </div>
                    </v-col>
                </v-row> -->
                <!-- <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        {{user.name}} 様のご購入手続き
                    </v-col>
                </v-row>
                <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        <span>
                            合計金額（税込・送料別）：
                        </span>
                        <span v-text="cartTotal"></span>
                    </v-col>
                </v-row> -->
                <v-row justify="center" class="mb-4">
                    <v-col cols="12" sm="12" md="6">
                        <v-card
                            max-width=556
                            class="pa-6"
                        >
                        <v-form>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <label for="card-number" class="card-info-title">{{$t('checkout.card_number')}}</label>
                                    <!-- <div id="card-element"></div> -->
                                    <div class="card-info" id="card-number"></div>
                                    <v-divider></v-divider>
                                    <div id="card-error" v-if="cardNumberError">{{ cardNumberError }}</div>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <label for="card-expiry" class="card-info-title">{{$t('checkout.card_expiry')}}</label>
                                    <div class="card-info" id="card-expiry"></div>
                                    <v-divider></v-divider>
                                    <div id="card-error" v-if="cardExpiryError">{{ cardExpiryError }}</div>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <label for="card-cvc" class="card-info-title">{{$t('checkout.card_cvc')}}</label>
                                    <div class="card-info" id="card-cvc"></div>
                                    <v-divider></v-divider>
                                    <div id="card-error" v-if="cardCvcError">{{ cardCvcError }}</div>
                                </v-col>
                            </v-row>
                            <v-row justify="center">
                                <v-col cols="12" sm="12" md="12">
                                    <v-btn
                                        color="primary"
                                        block
                                        dark
                                        @click="processPaymentAsGuest"
                                        :loading="loading"
                                    >
                                        {{$t('checkout.pay')}}
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-form>
                        </v-card>
                    </v-col>
                </v-row>

<!-- 
        {{message}} -->
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import { loadStripe } from '@stripe/stripe-js';

export default {
    component: {
       
    },
    props: {
        deliveryAddress: Object
    },
    data: function(){
        return{
            stripe: {},
            // cardElement: {},
            //publicKey: process.env.MIX_STRIPE_KEY,
            cardNumberElement: null,
            cardExpiryElement: null,
            cardCvcElement: null,
            cardNumberError: null,
            cardExpiryError: null,
            cardCvcError: null,
            message: "",
            errors: [],
            errorMessage:'',
            customer: {
                name: '',
                email: '',
                address: '',
                city: '',
                state: '',
                zip_code: '',
                deliveryName: '',
                deliveryKana: '',
                deliveryZipcode: '',
                deliveryPrefecture: '',
                deliveryCity: '',
                deliveryAddress1: '',
                deliveryBuilding: '',
                deliveryPhone: '',
                deliveryCourierType: '',
                deliveryTime: '',
                deliveryPostage: ''
            },
            paymentProcessing: false,
            loading: false,
        }
    
    },
    async mounted(){
        this.stripe = await loadStripe("pk_live_51J0LDyHqbknAxatFzrgue8qXopbEBy5AYGYJ26oSnK0Wqm4FPP8TrdlpQbPDKljHqmxQrm5xhIi5xkWYOLJsIoHB0040SBgx86");
        // this.stripe = await loadStripe("pk_test_51J0LDyHqbknAxatFaAwlCUX9kBQ0Pm1y8vxHS7HfavGtjQoUzUcqdlCYHa94F5JZXhZKIiOVfXknzPHey45W9DR600Zv4O4onO");
        let elements = this.stripe.elements();
       
        let elementStyles = {
            base: {
                color: "#32325D",
                fontWeight: 500,
                fontFamily: "Inter, Open Sans, Segoe UI, sans-serif",
                fontSize: "16px",
                fontSmoothing: "antialiased",

                "::placeholder": {
                // color: "#CFD7DF"
                color: "#A5A5A5",
                }
            },
            invalid: {
                color: "#FE6862"
            }
        };

        let elementClasses = {
            focus: 'focus',
            empty: 'empty',
            invalid: 'invalid',
        };

        this.cardNumberElement = elements.create('cardNumber', {
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // }       
            style: elementStyles,
            classes: elementClasses,
        });
        this.cardExpiryElement = elements.create('cardExpiry', {
            style: elementStyles,
            classes: elementClasses,
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // } 
        });
        this.cardCvcElement = elements.create('cardCvc', {
            style: elementStyles,
            classes: elementClasses,
            // classes: {
            //       base: 'bg-gray-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out'   
            // } 
        });
        this.cardNumberElement.mount('#card-number');
        this.cardExpiryElement.mount('#card-expiry');
        this.cardCvcElement.mount('#card-cvc');

        this.listenForErrorsCardNumber();
        this.listenForErrorsCardExpiry();
        this.listenForErrorsCardCvc();

        // registerElements([this.cardNumber, this.cardExpiry, this.cardCvc], 'card');
    },
    created(){

    },
    computed: {
        ...mapState([
            'guest',
            'cart',
            'order',
            'dialogThankYouGuest',
        ]),
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        cartTotal(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            //console.log(cartAmount);
            return cartAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        // totalPrice(){
        //     if(this.cart !== null && this.deliveryAddress !== null){
        //         let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
        //         let totalAmount = cartAmount + this.deliveryAddress.postage

        //         return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        //     }else{
        //         return null;
        //     }
        // },
         totalPrice(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
            let totalAmount = cartAmount + this.deliveryAddress.postage

            return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
            
            //  let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
            //  let totalAmount = cartAmount + this.deliveryAddress.postage

            //  return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
    },
    methods: {
        ...mapActions([
            'clearCart',
        ]),
        formatPrice(value){
          let postage = value;

          return postage.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        listenForErrorsCardNumber(){
            const vm = this;

            this.cardNumberElement.addEventListener('change', (event)=>{
                vm.cardNumberError = event.error ? event.error.message: null;
            })
        },
        listenForErrorsCardExpiry(){
            const vm = this;

            this.cardExpiryElement.addEventListener('change', (event)=>{
                vm.cardExpiryError = event.error ? event.error.message: null;
            })
        },
        listenForErrorsCardCvc(){
            const vm = this;

            this.cardCvcElement.addEventListener('change', (event)=>{
                vm.cardCvcError = event.error ? event.error.message: null;
            })
        },
        async processPaymentAsGuest(){
            
            this.paymentProcessing = true;
            this.loading = true;

            let itemTotal = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
            //console.log('itemTotal', itemTotal);

            let total = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0) + this.deliveryAddress.postage
            //console.log('total', total);

            this.customer.guest_id = this.guest.id;
            this.customer.name = this.guest.name;
            this.customer.email = this.guest.email;
            this.customer.address = this.guest.address_1 + ' ' + this.guest.building;
            this.customer.city = this.guest.city;
            this.customer.state = this.guest.prefecture;
            this.customer.zip_code = this.guest.zipcode;
            // this.customer.address_id = this.guest.id;
            // this.customer.delivery_time = this.deliveryAddress.delivery_time;
            // this.customer.delivery_address = this.deliveryAddress.id;
            this.customer.deliveryName = this.deliveryAddress.name; 
            this.customer.deliveryKana = this.deliveryAddress.kana;
            this.customer.deliveryZipcode = this.deliveryAddress.zipcode; 
            this.customer.deliveryPrefecture = this.deliveryAddress.prefecture;
            this.customer.deliveryCity = this.deliveryAddress.city;
            this.customer.deliveryAddress1 = this.deliveryAddress.address_1;
            this.customer.deliveryBuilding = this.deliveryAddress.building; 
            this.customer.deliveryPhone = this.deliveryAddress.phone;
            this.customer.deliveryCourierType = this.deliveryAddress.courier_type;
            this.customer.deliveryTime = this.deliveryAddress.delivery_time;
            this.customer.deliveryPostage = this.deliveryAddress.postage;
            this.customer.deliveryBoxQuantity = this.deliveryAddress.box_quantity;
            this.customer.itemTotal = itemTotal;

            const {paymentMethod, error} = await this.stripe.createPaymentMethod(
                'card', this.cardNumberElement, {
                    billing_details: {
                        name: this.customer.name,
                        email: this.customer.email,
                        address: {
                            line1: this.customer.address,
                            city: this.customer.city,
                            state: this.customer.prefecture,
                            zipcode: this.customer.zipcode,
                        }
                    }
                }
            );

            

            if(error) {
                this.paymentProcessing = false; 
                //console.error(error);
            }else{
                //console.log('paymentMethod', paymentMethod);
                this.customer.payment_method_id = paymentMethod.id;
                // this.customer.amount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                this.customer.amount = total;
                this.customer.cart = JSON.stringify(this.$store.state.cart);
            }

            axios.post('/guest/purchase', this.customer)
            .then((response) => {
                this.paymentProcessing = false;
                //console.log('response', response);

                this.$store.commit('updateOrder', response.data);
                this.$store.dispatch('showDialogThankYouGuest');
                this.$store.dispatch('sendGuestOrderNotify', this.order);
                this.$store.dispatch('clearCart');
                // this.$store.dispatch('clearDeliveryAddress');
                this.loading = false;
                
                // this.$router.push({ name: 'order-summary'})
            })
            .catch((error) => {
                this.paymentProcessing = false;
                this.loading = false;

                this.errors = error.response.data.errors;
                // console.log('errors', this.errors)

                if(this.errors){
                    // this.message = this.errors.message;
                    // this.$store.commit('setSoldOutMessage', this.message);
                    this.$store.commit('setDialogGuestSoldout', true);
                }else{
                    if(this.$i18n.locale == 'ja'){
                        this.message = error.response.data.message;
                    }else{
                        this.message = error.response.data.message_en;
                    }
                    this.$store.commit('setCheckoutErrorMessage', this.message);
                    this.$store.commit('setCheckoutSnackbar', true);
                }

                
                //console.error(error);
            })
        },
    },
}
</script>

<style>
.marginminus{
    margin-top: -12px;
}

</style>