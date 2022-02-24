<template>
    <div class="mb-8">
        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title1')}}
        </div>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.compact.p1')}}
        </p>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.compact.p2')}}
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>
    
        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title2')}}
        </div>
        <p :class="descriptionClasses">
            {{$t('shipping.compact.p3')}}
        </p>
        <p :class="descriptionClasses">
            {{$t('shipping.compact.p4')}}
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title4')}}
        </div>
        <p :class="descriptionClasses">
            {{$t('shipping.compact.p5')}}
        </p>

         <!-- <v-row class="mb-8">
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
        </div> -->
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
        descriptionClasses(){
          if(this.$i18n.locale == 'en') return 'en-description'
          return 'description'
        },
        itemContentClasses(){
          if(this.$i18n.locale == 'en') return 'en-item-content'
          return 'item-content'
        },
    
    },
    methods: {
      

        
    }


}
</script>

<style>

</style>