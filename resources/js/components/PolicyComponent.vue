<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Terms & Conditions
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        特定商取引法に基づく表記
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.business.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        {{ $t('terms.business.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.owner.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        {{ $t('terms.owner.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.address.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        {{ $t('terms.address.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.qualification.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        {{ $t('terms.qualification.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.price.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                         {{ $t('terms.price.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.others.lead') }}
                    </div>
                    <div v-if="$i18n.locale=='ja'" class="item-title line-height grey--text text--darken-3">
                        送料<br>
                        ヤマト運輸の運賃によります。詳しくは、<router-link to="/postage">送料のページ</router-link>をご覧ください。
                    </div>
                     <div v-else class="item-title line-height grey--text text--darken-3">
                        Postage<br>
                        Postages are set by our courier, Yamato. For more detail, please see <router-link to="/postage">Shipping & Postage</router-link>.
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.courier.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3">
                        {{ $t('terms.courier.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.shipment.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('terms.shipment.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.time.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('terms.time.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.payment.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('terms.payment.content') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.return.lead') }}
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        {{ $t('terms.return.lead1') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3 mb-6">
                        <p>
                            {{ $t('terms.return.content1') }}
                        </p>
                        <p>
                            {{ $t('terms.return.content2') }}
                        </p>
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        {{ $t('terms.return.lead2') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3 mb-6">
                        <p>
                            {{ $t('terms.return.content3') }}
                        </p>
                    </div>
                    <div class="item-title grey--text text--darken-3 mb-2">
                        {{ $t('terms.return.lead3') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3 mb-6">
                        <p>
                            {{ $t('terms.return.content4') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('terms.contact.lead') }}
                    </div>
                    <div v-if="$i18n.locale=='ja'" class="item-title grey--text text--darken-3">
                        <router-link to="/contact">お問い合わせフォーム</router-link>をご利用ください。
                    </div>
                    <div v-else class="item-title grey--text text--darken-3">
                        Please contact us by <router-link to="/contact">Contact Form</router-link>.
                    </div>
                </div>
                
                <!-- <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    このページは、ただいま準備中です。
                </div> -->
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
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
    
    },
    methods: {
      

        
    }


}
</script>

<style>
.policy-title{
    font-size: 14px;
}

.item-title a{
    text-decoration: none;
}

</style>