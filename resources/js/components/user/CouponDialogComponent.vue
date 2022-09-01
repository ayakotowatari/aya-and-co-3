<template>
    <v-container>
        <v-row justify="center" v-if="ifCoupon !== null">
            <v-dialog 
                v-model="dialogCoupon" 
                persistent 
                max-width="640"
                fullscreen
            >
                <v-card>
                    <v-toolbar
                        dark
                        color="primary"
                    >
                        <v-btn
                            icon
                            dark
                            @click="$store.commit('coupon/setDialogCoupon', false)"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-card-title >
                        <div class="dialog-title grey--text text--darken-4">{{ $t('coupon.title') }}</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        {{ $t('coupon.code') }}: <strong class="fontsize18">{{ifCoupon.name}}</strong><br>
                        {{ $t('coupon.deadline') }}: <strong>{{formattedDate(ifCoupon.deadline)}}</strong><br>
                        {{ $t('coupon.content') }}: <strong v-if="$i18n.locale == 'ja'">{{ifCoupon.coupon_info}}</strong><strong v-else>{{ifCoupon.coupon_info_en}}</strong> 
                    </v-card-text>
                    <!-- <v-card-text class="jp-font-400">
                        {{user.name}}様への感謝の気持ちを込めまして、クーポンを発行いたしました。
                    </v-card-text> -->
                    <v-card-text v-if="$i18n.locale == 'ja'" class="jp-font-400">
                        商品のお買い上げ金額の合計が<strong>{{formatPrice(1000)}}以上</strong>でお使いいただけます。ぜひ期限までにご利用ください。
                    </v-card-text>
                    <v-card-text v-else class="jp-font-400">
                        You can redeem your coupon when you spend <strong>{{formatPrice(1000)}}</strong> or more on purchasing our items. 
                    </v-card-text>
                    <v-card-text class="jp-font-400" v-if="checkTotal == false && $i18n.locale == 'ja'">
                        ただいまカートに入っている商品の合計金額は、{{cartTotal}}です。
                    </v-card-text>
                    <v-card-text class="jp-font-400" v-if="checkTotal == false && $i18n.locale == 'en'">
                        Your current total spend is {{cartTotal}}.
                    </v-card-text>
                    <!-- <v-card-text class="jp-font-400">
                        このクーポンの有効期限は、<strong>{{couponDeadline}}</strong>です。クーポンは1回限りでご利用いただけます。
                    </v-card-text> -->
                    <v-card-title>
                        <div class="dialog-title grey--text text--darken-4">{{ $t('coupon.manual.title') }}</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        {{ $t('coupon.manual.line1') }}
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        {{ $t('coupon.manual.line2') }}
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        {{ $t('coupon.manual.line3') }}
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <!-- <v-spacer></v-spacer> -->
                    <v-btn color="primary" text @click="copyCoupon">{{ $t('coupon.btn.copy') }}</v-btn>
                    <v-btn color="primary" text @click="backHome">{{ $t('coupon.btn.ignore') }}</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import moment from 'moment';

export default {
    props: {
        dialogCoupon: Boolean,
        user: Object,
        ifCoupon: Object,
        // couponDeadline: String,
        // couponName: String,
        // couponInfo: String
    },
    data: function(){
        return {
            
        }
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
        ...mapState([
            
        ]),
        cartTotal(){
            let cartAmount = this.$store.state.cart.reduce((acc,item) => acc + (item.price * item.quantity), 0);

            //console.log(cartAmount);
            return cartAmount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        checkTotal(){
            if(this.cartTotal > 1000){
                return true
            }else{
                return false
            }
        }
    },
    methods: {
        copyCoupon(){
            const container = document.querySelector('.v-dialog');
            //ストライプを２度目にうまく読み込まないため変更
            // window.location.href='/member/summary';
            this.$copyText(this.ifCoupon.name, container).then(() => {
                 this.$store.commit('coupon/setDialogCoupon', false);
            })
            // this.$store.commit('setDisabled', false);
        },
        backHome(){
             //ストライプを２度目にうまく読み込まないため変更
            // window.location.href='/';
            this.$store.commit('coupon/setDialogCoupon', false);
            // this.$store.commit('setDisabled', false);
        },
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formattedDate(value){
            if(this.$i18n.locale == 'ja'){
                return moment(value).format('YYYY年M月D日')
            }else{
                return moment(value).format('Do MMMM YYYY')
            }
        }
        
    }


}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}

.fontsize18{
    font-size: 18px;
}


</style>