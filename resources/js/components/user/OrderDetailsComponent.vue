<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Order Details
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            注文履歴詳細
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    <div class="mb-4">
                        <div class="item-content">
                        {{$t('summary.id')}}
                        </div>
                        <div class="item-title">
                        {{order.id}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        {{$t('summary.date')}}
                        </div>
                        <div class="item-title">
                        {{order.created_at}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        {{$t('summary.shipment_date')}}
                        </div>
                        <div class="item-title mb-2" v-if="plannedShipmentDate !== null">
                            {{plannedShipmentDate}} 
                        </div>
                        <div class="item-title mb-2" v-if="plannedShipmentDate === null">
                        {{$t('summary.tbc')}}
                        </div>
                    </div>
                    <div class="mb-8">
                        <div class="item-content">
                        {{$t('summary.shipment_date2')}}
                        </div>
                        <div class="item-title" v-if="actualShipmentDate !== null">
                            {{actualShipmentDate}}
                        </div>
                        <div class="item-title" v-if="actualShipmentDate === null">
                        {{$t('summary.tbc')}}
                        </div>
                    </div>
                    <div v-if="order.status == 'Shipped' || order.status =='Delivered'" class="mb-8">
                        <v-btn
                            color="primary"
                            outlined
                            @click="create(order.id)"
                        >
                            {{$t('summary.receipt')}}
                        </v-btn>
                    </div>
                </v-col>
                <v-col cols="12" sm="12" md="8">
                    <v-row justify="start" class="mb-8">
                        <v-col cols="12" sm="12" md="12" v-for="product in orderedProducts" :key="product.id">
                            <v-card
                                max-width="390"
                                outlined
                                color="#F1F1F1"
                            >
                                <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="product-name mb-1">
                                        {{product.name}} 
                                    </div>
                                    <div v-if="product.slug !== 'marmalade-loaf'" class="product-size mb-4">
                                        {{product.size}}
                                    </div>
                                    <div class="product-price mb-6">
                                        {{formatPrice(product.price)}}　{{product.quantity}}<span :class="fontClasses">{{$t('summary.unit')}}</span>　
                                    </div>
                                </v-list-item-content>
                                <v-list-item-avatar
                                    tile
                                    size="80"
                                    color="grey"
                                >
                                    <v-img
                                        :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${product.image}`"
                                    ></v-img>
                                </v-list-item-avatar>
                                </v-list-item>
                            </v-card>
                          </v-col>
                        </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        {{$t('product.total2')}}
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        {{formatPrice(order.item_total)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        {{$t('product.shipping')}}
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        {{formatPrice(order.postage)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row v-if="order.discount !== null">
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="totalprice grey--text text--darken-3">
                                        {{$t('coupon.discount')}}
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1">
                                    <div class="totalprice">
                                        - {{formatPrice(order.discount)}}
                                    </div>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="12" sm="12" md="6">
                                    <v-divider></v-divider>
                                </v-col>
                            </v-row>
                            <v-row>
                                <v-col cols="8" sm="8" md="4" class="py-1">
                                    <div class="charge grey--text text--darken-3">
                                        {{$t('product.total3')}}
                                    </div>
                                </v-col>
                                <v-col cols="4" sm="4" md="4" class="py-1 mb48">
                                    <div class="charge">
                                        {{formatPrice(order.total)}}
                                    </div>
                                </v-col>
                            </v-row>
                      
                    
                    <v-divider class="mb48"></v-divider>

                    <h4 :class="fontWeightClasses" class="grey--text text--darken-3 mb-4">{{$t('summary.billing')}}</h4>
                    <v-row class="mb-6">
                        <v-col cols="12" sm="12" md="6">
                            <v-card
                                max-width="480"
                                outlined
                            >
                                <v-list-item>
                                    <v-list-item-content two-line>
                                        <v-list-item-subtitle>
                                            {{ $t('register.name')}}
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="mb-4">
                                            {{order.user_name}}<span v-if="$i18n.locale == 'ja'">様</span>
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ $t('checkout.email')}}
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="mb-4">
                                            {{order.user_email}}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ $t('checkout.phone')}}
                                        </v-list-item-subtitle>
                                        <v-list-item-title class="mb-4">
                                            {{order.user_phone}}
                                        </v-list-item-title>
                                        <v-list-item-subtitle>
                                            {{ $t('checkout.address')}}
                                        </v-list-item-subtitle>
                                        <div>
                                            〒{{order.user_zipcode}}<br>
                                            {{order.user_prefecture}} {{order.user_city}} {{order.user_address_1}}<br>
                                        </div>
                                        <v-list-item-title v-if="order.user_building !== null" class="jp-font-400">
                                            {{order.user_building}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </v-card>
                        </v-col>
                    </v-row>
                    <h4 :class="fontWeightClasses" class="grey--text text--darken-3 mb-4">{{$t('summary.shipping')}}</h4>
                    <v-row>
                        <v-col cols="12" sm="12" md="6" class="mb48">
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
                                            〒{{order.delivery_zipcode}}<br>
                                            {{order.delivery_prefecture}} {{order.delivery_city}} {{order.delivery_address_1}}<br>
                                        </div>
                                        <div v-if="order.user_building !== null">
                                            {{order.delivery_building}}
                                        </div>
                                        <v-list-item-title>
                                            {{order.delivery_name}}<span v-if="$i18n.locale == 'ja'">様</span>
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-subtitle>
                                            {{ $t('checkout.phone')}}
                                        </v-list-item-subtitle>
                                        <v-list-item-title>
                                            {{order.delivery_phone}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="order.delivery_courier !== null">
                                    <v-list-item-content>
                                        <v-list-item-subtitle>
                                            {{ $t('checkout.method')}}
                                        </v-list-item-subtitle>
                                        <v-list-item-title>
                                            {{order.delivery_courier}}
                                        </v-list-item-title>
                                        <div v-if="order.box_quantity !== null">
                                            <v-list-item-title>
                                                {{$t('checkout.box_qty')}}：{{order.box_quantity}}
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
                                            {{order.delivery_time}}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                                <v-list-item v-if="order.delivery_courier == $t('checkout.yamato')">
                                    <v-list-item-content>
                                        <v-list-item-subtitle>
                                            {{$t('customcard.card')}}
                                        </v-list-item-subtitle>
                                        <div v-if="order.delivery_carduse === $t('customcard.nouse') || order.delivery_carduse === null">
                                            <v-list-item-title class="jp-font-400">
                                                {{$t('customcard.nouse')}}
                                            </v-list-item-title>
                                        </div>
                                        <div v-if="order.delivery_carduse === '利用する'">
                                            <v-list-item-title>
                                                {{$t('customcard.message')}}：{{order.delivery_cardmessage}}
                                            </v-list-item-title>
                                            <v-list-item-title>
                                                {{$t('customcard.from')}}：{{order.delivery_cardname}}
                                            </v-list-item-title>
                                        </div>
                                    </v-list-item-content>
                                </v-list-item>
                                <!-- <v-list-item v-if="order.delivery_courier == 'ヤマト運輸 宅急便コンパクト'">
                                    <v-list-item-content>
                                        <v-list-item-subtitle class="jp-font-400">
                                            簡単ギフトラッピングキットのご利用
                                        </v-list-item-subtitle>
                                        <div v-if="orderedCards.length <= 0">
                                        利用なし
                                        </div>
                                        <div v-if="orderedCards.length >= 1">
                                            <v-list-item-title v-for="item in orderedCards" :key="item.id">
                                                {{item.card_name}}: {{item.quantity}}セット
                                            </v-list-item-title>

                                        </div>
                                    </v-list-item-content>
                                </v-list-item> -->
                                 <v-list-item>
                                        <v-list-item-content>
                                            <v-list-item-subtitle>
                                                {{$t('checkout.note')}}
                                            </v-list-item-subtitle>
                                            <p v-if="this.order.message !== null" class=" line-height">
                                                {{order.message}}
                                            </p>
                                            <p v-else>
                                                {{$t('checkout.no')}}
                                            </p>
                                        </v-list-item-content>
                                </v-list-item>
                            </v-card>
                        </v-col>
                    </v-row>
                    <v-btn
                        color="primary"
                        outlined
                        @click="$router.push({name: 'order-summary'})"
                        class="hidden-sm-and-down"
                    >
                        {{$t('btn.summary2')}}
                    </v-btn>
                    <v-btn
                        color="primary"
                        outlined
                        block
                        @click="$router.push({name: 'order-summary'})"
                        class="hidden-md-and-up"
                    >
                        {{$t('btn.summary2')}}
                    </v-btn>
                </v-col>
            </v-row>
        </v-container> 
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            id: Number(this.$route.params.id),
            
        }
    },
    beforeRouteEnter: (to, from, next) => {
       axios.post('/member/check-order', {
           id: to.params.id
       })
       .then((response) => {
           console.log('response', response)
           if (response.data.length === 0){
               next({path: 'not-found'})
           }else{
               next();
           }
       })
    },
    beforeRouteUpdate: (to, from, next) => {
       axios.post('/member/check-order', {
           id: to.params.id
       })
       .then((response) => {
           if (response.data.length === 0){
               next({path: 'not-found'})
           }else{
               next();
           }
       })
    },
    mounted(){
        this.$store.dispatch('fetchOrder', {
            id: this.id
        });
        this.$store.dispatch('fetchShipment', {
            id: this.id
        });
        
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'order',
            'orderedProducts',
            // 'shipment',
            'plannedShipmentDate',
            'actualShipmentDate',
            'deliveredDate',
        ]),
        ...mapState('giftcard', [
            'orderedCards'
        ]),
        fontClasses(){
          if(this.$i18n.locale == 'en') return 'en-font-small'
          return 'font-small'
        },
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        },
    },
    methods: {
        formatPrice(value){
          let price = value;

          return price.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        },
        create(id){

            window.location.href='/member/create-receipt/'+ id;
            
            // this.createUserReceipt({
            //     id: id
            // })

        }
    }


}
</script>

<style>
.font-small{
    font-family: 'Noto Sans JP', sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 14px;
}

.en-font-small{
    font-family: quasimoda, sans-serif;
    font-weight: 400;
    font-style: normal;
    font-size: 14px;
}

</style>