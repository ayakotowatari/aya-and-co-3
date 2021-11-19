<template>
    <div v-if="user !== null && ifCoupon !== null">
         <v-card>
            <v-card-title class="jp-font-400-20">
                 <v-icon
                    color="primary"
                    class="mr-2"
                >
                    mdi-ticket
                </v-icon>  
                クーポンが発行されました。
            </v-card-title>
            <v-card-text class="jp-font-400">
                 {{user.name}}様への感謝の気持ちを込めまして、本サイトでのお買い物の際にお使いいただけるクーポンを発行いたしました。
            </v-card-text>
            <v-card-text class="jp-font-400">
                クーポンコード: <strong class="fontsize18">{{ifCoupon.name}}</strong><br>
                有効期限： <strong>{{formattedDate(ifCoupon.deadline)}}</strong><br>
                内容： <strong>{{ifCoupon.coupon_info}}</strong> 
            </v-card-text>
            <v-card-text class="jp-font-400">
                商品のお買い上げ金額の合計が<strong>{{formatPrice(1000)}}以上</strong>でお使いいただけます。ぜひ期限までにご利用ください。
            </v-card-text>
            <!-- <v-card-text class="jp-font-400">
                クーポンの有効期限: <strong>{{couponDeadline}}</strong>
            </v-card-text> -->
             <v-card-text class="jp-font-400">
                クーポンのご利用方法については、ご注文内容の確認画面で詳しくご案内します。
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import moment from 'moment';

export default {
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
            'user'
        ]),
        ...mapState('coupon',[
            'ifCoupon',
            // 'couponDeadline', 
            // 'couponName',
            // 'couponInfo'
        ]),
    },
    methods: {
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        formattedDate(value){
            return moment(value).format('YYYY年M月D日')
        }

    }


}
</script>

<style>
.small-description{
    font-size: 12px;
}

.dialog-title-14{
    font-size: 16px;
    font-weight: 400;
}

.jp-font-400-20{
    line-height: 1.5;
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
    letter-spacing: 0.03em;
    /* color: rgba(0, 0, 0, 0.6) */
}

</style>