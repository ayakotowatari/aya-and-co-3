<template>
    <div class="pt-6">
        <v-row justify="center">
            <v-col cols="12" sm="12" md="8">
                <div :class="formTitleClasses" class="grey--text text--darken-4">{{ $t('checkout.confirm_order')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center" class="mb-4">
           <v-col cols="12" sm="12" md="8">
                <v-row>
                    <v-col cols="12" sm="12" md="6" v-for="item in cart" :key="item.id">
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
                                    <div>{{ $t('product.quantity')}}</div>
                                </v-col>
                                <v-col cols="3" sm="3" md="4">
                                <div>{{item.quantity}}</div>
                                </v-col>
                            </v-row>
                            <div class="text-overline mb-4">
                            {{ $t('product.item-total')}}: {{ cartLineTotal(item) }}
                            </div>
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
                <v-row align="start">
                    <v-col cols="12" sm="12" md="6" class="mb-4">
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{ $t('product.total2')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="cartTotal" class="totalprice">
                                </div>
                            </v-col>
                        </v-row>
                        <v-row v-if="coupon.applied !== false && coupon.type !== 'postage'">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{$t('coupon.discount')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    -{{formatPrice(discount)}}
                                </div>
                            </v-col>
                            <!-- <v-col cols="6" sm="6" md="6" class="py-1" v-if="coupon.type == 'fixed'">
                                <div class="totalprice">
                                    -{{formatPrice(coupon.value)}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1" v-if="coupon.type == 'percent'">
                                <div v-text="percentDiscount" class="totalprice">
                                    
                                </div>
                            </v-col> -->
                        </v-row>
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{ $t('product.shipping')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    {{formatPrice(deliveryAddress.postage)}}
                                </div>
                            </v-col>
                        </v-row>
                        <v-row v-if="coupon.applied !== false && coupon.type == 'postage'">
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice grey--text text--darken-3">
                                    {{$t('coupon.discount')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="totalprice">
                                    -{{formatPrice(discount)}}
                                </div>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" sm="12" md="12">
                                <v-divider></v-divider>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div class="charge grey--text text--darken-3">
                                    {{ $t('product.total3')}}
                                </div>
                            </v-col>
                            <v-col cols="6" sm="6" md="6" class="py-1">
                                <div v-text="totalPrice" class="charge">
                                </div>
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" sm="12" md="6">
                         <v-row v-if="ifCoupon !== null">
                             <v-col cols="12" sm="12" md="12">
                                 <p v-if="$i18n.locale == 'ja'">
                                    {{user.name}}様に、クーポンが発行されています。
                                 </p>
                                 <p v-else>
                                    Dear {{user.name}}, Don't forget to check your coupon!
                                 </p>
                                 <v-btn
                                    color="primary"
                                    outlined
                                    @click="$store.commit('coupon/setDialogCoupon', true)"
                                 >
                                     {{$t('coupon.check')}}
                                 </v-btn>
                             </v-col>
                         </v-row>
                         <v-row class="mb-4">
                            <v-col cols="12" sm="12" md="12">
                                <v-form
                                    ref="form"
                                    v-model="valid"
                                    lazy-validation
                                >
                                    <v-text-field
                                        v-model="coupon_code"
                                        :label="$t('coupon.label')" 
                                        outlined
                                        :error="allError.coupon || allError.coupon_code ? true : false"
                                        :error-messages="allError.coupon || allError.coupon_code"
                                    ></v-text-field>
                                    <v-btn
                                        @click="apply()"
                                        v-if="couponDisabled == false"
                                    >
                                        {{$t('coupon.apply')}}
                                    </v-btn>
                                    <v-btn
                                        @click="resetCoupon()"
                                        v-if="couponDisabled == true"
                                    >
                                        {{$t('coupon.remove')}}
                                    </v-btn>
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
                
                <v-row class="mb-4">
                    <v-col cols="12" sm="12" md="12">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>
                <!-- <v-select
                    v-model="use_coupon"
                    label="クーポンの使用"
                    outlined
                    :items = "ask_coupon"
                    required
                >
                </v-select> -->
                <h4 :class="fontWeightClasses" class="grey--text text--darken-3 mb24">{{ $t('checkout.shipping_details')}}</h4>
                <v-row>
                    <v-col cols="12" sm="12" md="8">
                        <v-card
                            max-width="480"
                            outlined
                        >
                            <v-list-item>
                                <v-list-item-content two-line>
                                    <v-list-item-subtitle>
                                        {{ $t('checkout.address')}}
                                    </v-list-item-subtitle>
                                    <div>
                                        〒{{deliveryAddress.zipcode}}<br>
                                        {{deliveryAddress.prefecture}} {{deliveryAddress.city}} {{deliveryAddress.address_1}}
                                    </div>
                                    <v-list-item-title v-if="deliveryAddress.building !== null" class="jp-font-400">
                                        {{deliveryAddress.building}}
                                    </v-list-item-title>
                                    <v-list-item-title>
                                        {{deliveryAddress.name}}<span v-if="$i18n.locale == 'ja'">様</span>
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle>
                                        {{ $t('checkout.phone')}}
                                    </v-list-item-subtitle>
                                    <v-list-item-title>
                                        {{deliveryAddress.phone}}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle>
                                        {{ $t('checkout.method')}}
                                    </v-list-item-subtitle>
                                    <v-list-item-title>
                                        {{deliveryAddress.courier_type}}
                                    </v-list-item-title>
                                    <div v-if="deliveryAddress.courier_type===$t('checkout.yamato_compact')">
                                        <v-list-item-title>
                                            {{$t('checkout.box_qty')}}：{{deliveryAddress.box_quantity}}
                                        </v-list-item-title>
                                    </div>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle>
                                        {{ $t('checkout.time')}}
                                    </v-list-item-subtitle>
                                    <v-list-item-title>
                                        {{deliveryAddress.delivery_time}}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                            <v-list-item>
                                <v-list-item-content>
                                    <v-list-item-subtitle>
                                        {{$t('customcard.lead')}}
                                    </v-list-item-subtitle>
                                    <div v-if="deliveryCardUse===$t('customcard.nouse')">
                                        {{$t('customcard.nouse')}}
                                    </div>
                                    <div v-if="deliveryCardUse===$t('customcard.use')">
                                        <v-list-item-title>
                                            {{$t('customcard.message')}}：{{deliveryCardMessage}}
                                        </v-list-item-title>
                                        <v-list-item-title>
                                            {{$t('customcard.from')}}：{{deliveryCardName}}
                                        </v-list-item-title>
                                    </div>
                                </v-list-item-content>
                            </v-list-item>
                            <!-- <v-list-item v-if="deliveryAddress.courier_type == 'ヤマト運輸 宅急便コンパクト'">
                                <v-list-item-content>
                                    <v-list-item-subtitle class="jp-font-400">
                                        簡単ギフトラッピングキットのご利用
                                    </v-list-item-subtitle>
                                    <div v-if="giftcard.length <= 0">
                                        利用なし
                                    </div>
                                    <div v-if="giftcard.length >= 1">
                                        <v-list-item-title v-for="item in giftcard" :key="item.number">
                                            {{item.name}}: {{item.amount}}セット
                                        </v-list-item-title>
                                    </div>
                                </v-list-item-content>
                            </v-list-item> -->
                            <div>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle>
                                            {{$t('checkout.note')}}
                                        </v-list-item-subtitle>
                                        <div v-if="deliveryAddress.delivery_note !==''">
                                            <p class="jp-font-400 line-height">
                                                {{deliveryAddress.delivery_note}}
                                            </p>
                                        </div>
                                        <div v-if="deliveryAddress.delivery_note ==''">
                                            <v-list-item-title>
                                                {{$t('checkout.no')}}
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                            </div>
                            <!-- <div v-if="deliveryAddress.courier_type == '日本郵便 ゆうパック'">
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            備考欄
                                        </v-list-item-subtitle>
                                        <div v-if="deliveryAddress.delivery_note !==''">
                                            <v-list-item-title class="jp-font-400">
                                                {{deliveryAddress.delivery_note}}
                                            </v-list-item-title>
                                        </div>
                                        <div v-if="deliveryAddress.delivery_note ==''">
                                            <v-list-item-title class="jp-font-400">
                                                なし
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                            </div> -->
                        </v-card>
                    </v-col>
                </v-row>

           </v-col>
        </v-row>
        <coupondialog-component
            v-bind:dialogCoupon="dialogCoupon"
            v-bind:user="user"
            v-bind:ifCoupon="ifCoupon"
        ></coupondialog-component>
    </div>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    components: {
        
    },
    props: {
        deliveryAddress: Object
    },
    data: function(){
        return{
            valid: true,
            coupon_code: null,
            // couponRules: [
            //     v => !!v || 'クーポンコードを入力してください。',
            // ],
            use_coupon: '使用しない',
            ask_coupon: ['使用する', '使用しない']
        }
    },
    mounted(){
        
    },
    created(){
        // this.$store.commit('selectAddress');
        this.$store.dispatch('coupon/checkIfCoupon')

    },
    computed: {
        ...mapState([
            'user',
            'cart',
            'deliveryCardUse',
            'deliveryCardMessage',
            'deliveryCardName',
        ]),
        ...mapState('coupon', [
            'coupon',
            'ifCoupon',
            'dialogCoupon',
            // 'couponDeadline',
            // 'couponName', 
            // 'couponInfo',
            'allError',
            'couponDisabled'
        ]),
        ...mapGetters('coupon', [
            'discount'
        ]),
        ...mapState('giftcard', [
            'giftcard',
        ]),
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        },
        cartTotal(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

                //console.log(cartAmount);
                return cartAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        totalPrice(){

            if(this.coupon.applied !== true){
                let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let totalAmount = cartAmount + this.deliveryAddress.postage

                //console.log('totalAmount', totalAmount)

                return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});

            }else{

                let discount = this.discount
                let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);
                let totalAmount = (cartAmount + this.deliveryAddress.postage) - discount;

                return totalAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
                   
            }
        },
       
    },
    methods: {
        ...mapActions('coupon', [
            'applyCoupon',
        ]),
        cartLineTotal(item) {   
            let amount = item.price * item.quantity;

            return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        apply(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            this.applyCoupon({
                coupon_code: this.coupon_code,
                amount: cartAmount
            })
        },
        resetCoupon(){
            this.$refs.form.reset();
            this.$store.commit('coupon/setCouponDisabled', false);
            this.$store.dispatch('coupon/clearAllErrors');
            this.$store.dispatch('coupon/clearCoupon');
        },
    },
}
</script>

<style>
.charge{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 500;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
}

.line-height{
    line-height: 1.5;
}
</style>