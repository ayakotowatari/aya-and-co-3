<template>
    <div class="mb-8">
        <!-- <p :class="descriptionClasses">
            {{$t('shipping.takkyuubin.p1')}}
        </p>
        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row> -->
        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title1')}}
        </div>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.takkyuubin.p1')}}
        </p>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.takkyuubin.p2')}}
        </p>

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title2')}}
        </div>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.takkyuubin.p3')}}
        </p>
        <p v-html="$t('shipping.takkyuubin.p3-1')" :class="descriptionClasses" class="mb-8">
        </p>
        <p v-html="$t('shipping.takkyuubin.p3-2')" :class="descriptionClasses" class="mb-8">
        </p>
        <!-- <p class="description mb-8">
            {{$t('shipping.takkyuubin.p5')}}
        </p> -->

        <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row>

        <div :class="itemContentClasses" class="policy-title mb-4">
            {{$t('shipping.title3')}}
        </div>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.takkyuubin.p4')}}
        </p>
        <p :class="descriptionClasses" class="mb-8">
            {{$t('shipping.takkyuubin.p5')}}<router-link to="/message-service">{{$t('shipping.takkyuubin.card')}}</router-link>{{$t('shipping.takkyuubin.p5-2')}}
        </p>

        

        <!-- <v-row class="mb-8">
            <v-col cols="12" sm="12" md="12" class="line-color">
                <v-divider></v-divider>
            </v-col>
        </v-row> -->

        <!-- <div class="item-content policy-title mb-4">
            ご自宅で受け取られてから、ギフトボックスとして使用されたい場合
        </div>
        <p class="description">
            お買い求めいただいた商品をボックスに梱包した後、別の宅配ボックス（もしくは袋）に入れて配送することが可能です。外側の箱（もしくは袋）から取り出していただいて、中のボックスをギフトとしてお渡しいただけます。ご希望の際には、ご注文時にご希望を備考欄へご記入ください。
        </p>
        <p class="description">
            このギフトボックスを何組かお求めの場合には、それぞれの「選べるメッセージカード」をお作りできます。ご注文の際に、ご希望を備考欄にご記入ください。
        </p>
        <p class="description mb-8">
            なおこのアレンジは、1つのギフトボックスにつき、2瓶以上をお求めいただいた場合、また、会員登録されているお客様限定でご利用いただけます。
        </p> -->
    </div>
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