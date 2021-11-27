<template>
    <div class="mb-8">
        <p class="description">
            宅急便コンパクトでは、ヤマト運輸の薄型の専用ボックスに、木毛の緩衝材を用いて商品を配置します。ボックスの高さが低く、たとえば140g以上のサイズの瓶は、横向きに倒した状態で包装いたします。
        </p>
        <!-- <p class="description mb-8">
            「<router-link to="/message-service">選べるメッセージカードサービス</router-link>」をご利用の場合は、宅急便コンパクトには葉書サイズのカードが同封できませんので、宅急便をお選びください。
        </p> -->
        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div class="item-content policy-title mb-4">
            おすすめの用途
        </div>
        <p class="description mb-8">
            宅急便コンパクトのパッケージは、宅急便と比較して、審美的には簡素になりますが、送料がリーズナブルです。ご自宅などでの普段づかいとしてお買い求めいただく際に、ぜひご利用ください。
        </p>

         <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>
    
        <div class="item-content policy-title mb-4">
            1梱包（宅急便コンパクト）でお送りできる商品数
        </div>
        <p class="description">
            100g瓶の場合、セット商品、単品あわせて、全部で6瓶までとなります。
        </p>
        <p class="description">
            7瓶以上の商品をご注文いただくことも可能です。その際には、複数の梱包となり、梱包数分の送料がかかります。
        </p>
        <p class="description">
            また、150gや250g瓶との組み合わせは、ご注文時に、梱包数が自動計算され、送料に反映されます。「ご注文内容の確認」に表示されますので、どうぞお確かめください。
        </p>

         <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

         <div class="item-content policy-title mb-4">
            簡単ギフトラッピングキット
        </div>
        <p class="description mb-8">
            宅急便コンパクトでまとめてご購入いただき、ご家族やご友人にプレゼントをされるお客様も多くいらっしゃいます。
        </p>
        <p class="description mb-8">
            会員登録をいただいたお客様で、ご希望の場合には、年末年始の期間中、1瓶ずつを簡単でおしゃれにシンプル包装できる「簡単ギフトラッピングキット」を無料で同封いたします。贈り物にぜひご利用ください。
        </p>
        <div class="mb-8">
            <campaignbanner-component></campaignbanner-component>
        </div>
        <!-- <v-btn
            color="primary"
            outlined
            class="mb-8"
            @click="$router.push({name: 'wrapping-kit'})"
        >
            簡単ギフトラッピングキットとは？
        </v-btn> -->
        <!-- <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row> -->
    </div>
</template>

<script>
export default {
    data: function(){
        return {
            tab: null,
        
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

</style>