<template>
    <v-container>
        <v-row justify="center">
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
                        <div class="dialog-title grey--text text--darken-4">クーポンの詳細</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        クーポンコード: <strong class="fontsize18">{{ifCoupon.name}}</strong><br>
                        有効期限: {{ifCoupon.deadline}}
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        {{user.name}}様への感謝の気持ちを込めまして、クーポンを発行いたしました。
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                        商品のお買い上げ金額の合計が<strong>{{formatPrice(1000)}}以上</strong>で、<strong>{{ifCoupon.info}}</strong>となるクーポンです。ぜひ期限までにご利用ください。
                    </v-card-text>
                    <v-card-text class="jp-font-400" v-if="checkTotal == false">
                        ただいまの商品お買い上げ合計金額は、{{cartTotal}}です。
                    </v-card-text>
                    <!-- <v-card-text class="jp-font-400">
                        このクーポンの有効期限は、<strong>{{couponDeadline}}</strong>です。クーポンは1回限りでご利用いただけます。
                    </v-card-text> -->
                    <v-card-title>
                        <div class="dialog-title grey--text text--darken-4">クーポンの使い方</div>
                    </v-card-title>
                    <v-card-text class="jp-font-400">
                        下の「コードをコピーする」をクリックしたあと、コードの入力欄に貼り付け（スマホでは入力欄をタップ、パソコンでは右クリックで貼り付け）、「クーポンを適用する」を押します。
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                         もしくは
                    </v-card-text>
                    <v-card-text class="jp-font-400">
                         コードを入力欄に手動で入力し、「クーポンを適用する」を押します。
                    </v-card-text>
                    <!-- <v-card-subtitle>
                        <p>{{ event.date }}</p>
                        <p>{{ event.title }}</p>
                    </v-card-subtitle> -->
                    <v-card-actions>
                    <!-- <v-spacer></v-spacer> -->
                    <v-btn color="primary" text @click="copyCoupon">コードをコピーする</v-btn>
                    <v-btn color="primary" text @click="backHome">今回は使わない</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

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
        
    }


}
</script>

<style>
.dialog-title{
  font-family: 'Noto Sans JP', sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  margin-bottom: 24px;
}

.fontsize18{
    font-size: 18px;
}


</style>