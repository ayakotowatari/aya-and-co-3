<template>
    <div v-if="user !== null && ifCoupon !== false">
         <v-card>
            <v-card-title class="jp-font-400-20">
                 <v-icon
                    color="primary"
                    class="mr-2"
                >
                    mdi-ticket
                </v-icon>  
                クーポンをご利用いただけます。
            </v-card-title>
            <v-card-text class="jp-font-400">
                クーポンコード: <strong>{{couponName}}</strong>
            </v-card-text>
            <v-card-text class="jp-font-400">
                {{user.name}}様、いつもaya & co.をご利用いただき、誠にありがとうございます。
            </v-card-text>
            <v-card-text class="jp-font-400">
                感謝の気持ちを込めまして、本サイトでのお買い物の際に、商品のお買い上げ金額の合計が<strong>{{formatPrice(1000)}}以上</strong>でお使いいただけるクーポンを発行いたしました。
            </v-card-text>
            <v-card-text class="jp-font-400">
                ご注文時に、クーポンコードをご入力いただくと、<strong>{{couponInfo}}</strong>となります。ぜひご利用ください。
            </v-card-text>
            <v-card-text class="jp-font-400">
                このクーポンの有効期限は、<strong>{{couponDeadline}}</strong>です。 クーポンは1回限りでご利用いただけます。
            </v-card-text>
             <v-card-text class="jp-font-400">
                ご注文内容の確認画面で、再度、クーポンご利用のご案内が表示されます。
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

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
            'couponDeadline', 
            'couponName',
            'couponInfo'
        ]),
    },
    methods: {
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },

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