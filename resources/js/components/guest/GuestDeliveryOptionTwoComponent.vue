<template>
    <div class="pt-6">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div :class="formTitleClasses" class="grey--text text--darken-4">{{$t('checkout.shipping_method')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                 <v-form 
                    ref="form"
                    v-model="valid"
                    lazy-validation
                >
                
                    <div class="mb-8">
                        <div :class="fontWeightClasses" class="grey--text text--darken-3 mb24">Step 1: {{$t('checkout.select_shipping')}}</div>

                         <v-select
                            v-model="courier"
                            outlined
                            :items = "courierOptions"
                            :item-text="setItem()"
                            item-value="id"
                            :label="$t('checkout.shipping_label')"
                            required
                            :rules="courierRules" 
                            validate-on-blur
                            @blur="() => $refs.form.resetValidation()"
                            :error="allerror.couriers ? true : false"
                            :error-messages="allerror.couriers"
                        ></v-select>

                         <div class="grey--text text--darken-2 note">{{$t('checkout.shipping_note1')}}<router-link to="/postage">{{$t('checkout.shipping_note2')}}</router-link>{{$t('checkout.shipping_note3')}}</div>
                    </div>
                    <v-divider class="mt-4 mb-8"></v-divider>
                   
                    <h4 :class="fontWeightClasses" class="grey--text text--darken-3 mb24">Step 2: {{$t('checkout.delivery_time')}}</h4>
                    <v-select
                        v-model="deliveryTime"
                        :items="$t('checkout.time_options')"
                        :label="$t('checkout.delivery_label')"
                        outlined
                        required
                        :rules="deliveryTimeRules" 
                        validate-on-blur
                        @blur="() => $refs.form.resetValidation()"
                        :error="allerror.delivery_time"
                        :error-messages="allerror.delivery_time"
                    ></v-select>
                    <v-btn
                        color="primary"
                        block
                        @click="confirm"
                        :disabled="disabled.confirmGuestDeliveryOption"
                        class="mb-6"
                    >
                    {{$t('btn.confirm')}}
                    </v-btn>
                </v-form>
            </v-col>
        </v-row>
               
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        deliveryAddress: Object
    },
    data: function(){
        
        return {
            valid: true,
            courier: null,
            deliveryTime: '',
            // items: ["希望なし", "午前中", "12:00-14:00頃", "14:00-16:00頃", "16:00-18:00頃", "18:00-20:00頃", "19:00-21:00頃", "20:00-21:00頃"],
            items: ["希望なし", "8:00-12:00", "14:00-16:00", "16:00-18:00", "18:00-20:00", "19:00-21:00"],
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages');
        this.$store.dispatch('fetchStates');
    },
    computed: {
        ...mapState([
            'allerror',
            'user',
            'disabled',
            'postages',
            'couriers', 
            'cart'
        ]),
        courierRules(){
            return[
                v => !!v || this.$t('checkout.courier_rule')
            ];
        },
        deliveryTimeRules(){
            return[
                v => !!v || this.$t('checkout.deliveryTime_rule')
            ];
        },
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        },
        totalQuantityInCart(){
           
            let setInCart = this.cart.filter(cart => cart.if_set === 1);
            let setInCartQuantity = setInCart.reduce((acc,item) => acc + item.quantity, 0);

            let itemInCartQuantity = this.cart.reduce((acc,item) => acc + item.quantity, 0);

            let totalInCartQuantity = setInCartQuantity + itemInCartQuantity;
            // console.log('result', totalInCartQuantity);

            return totalInCartQuantity;
        },
        courierOptions(){
            let itemInCart150 = this.cart.filter(cart => cart.size === "150g")
            // console.log('150', itemInCart150)
            if(itemInCart150.length > 0){
                if(this.totalQuantityInCart > 15){
                    return this.couriers.filter(courier => courier.id === 2)
                }else{
                    return this.couriers.filter(courier => courier.id === 1)
                }
            }else{
                if(this.totalQuantityInCart > 15){
                    return this.couriers.filter(courier => courier.id !== 1)
                }else{
                    return this.couriers.filter(courier => courier.id !== 2)
                }
            }
        },
        courierStandard(){
            return this.couriers.filter(courier => courier.id !== 2)
        },
        courierMiddle(){
            return this.couriers.filter(courier => courier.id !== 1)
        },
        courierBig(){
            return this.couriers.filter(courier => courier.id === 2)
        },
    },
    methods: {
        ...mapActions([
            'setGuestDeliveryOption',
            'setPostage',
        ]),
        setItem(){
            if(this.$i18n.locale == 'ja'){
                return item => item.name + ' ' + item.type
            }else{
                return item => item.name_en + ' ' + item.type_en
            }
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        confirm(){
            if(this.$refs.form.validate()){

                // this.$store.dispatch('setPostage', this.courier);
                this.setPostage({
                    lang: this.$i18n.locale,
                    courier: this.courier,
                    prefecture: this.deliveryAddress.prefecture,
                    totalQuantity: this.totalQuantityInCart
                })

                let delivery_time = this.deliveryTime

                this.setGuestDeliveryOption({
                    delivery_time: delivery_time
                })

            }
        }
    }       
}
</script>

<style>
.jp-font-400{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
}

.mb48{
    margin-bottom: 48px;
}

</style>