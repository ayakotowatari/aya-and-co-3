<template>
    <v-container>
         <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/gift_box_2.jpg"
            ></v-img>
        </div>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Shipping & Postage
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        配送方法と送料について
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div :class="itemTitleClasses">{{$t('shipping.timing.lead')}}</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div :class="descriptionClasses">{{$t('shipping.timing.text')}}</div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div :class="itemTitleClasses">{{$t('shipping.lead')}}</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="mb-8">
                    <p :class="descriptionClasses">
                        {{$t('shipping.line1')}}
                    </p>
                    <p :class="descriptionClasses" v-html="$t('shipping.line2')">
                    </p>
                    <p :class="descriptionClasses">
                        {{$t('shipping.line3')}}
                    </p>
                    <!-- <v-btn
                        color="primary"
                        outlined
                        @click="$router.push({name: 'wrapping-kit'})"
                    >
                        簡単ギフトラッピングキットを無料進呈中
                    </v-btn> -->
                </div>
                <v-tabs v-model="tab" class="mb-12">
                    <v-tab
                        href="#tab-1"
                    >
                        {{$t('shipping.tab1')}}
                    </v-tab>
                    <v-tab
                        href="#tab-2"
                    >
                        {{$t('shipping.tab2')}}
                    </v-tab>
                    <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
                </v-tabs>

                <v-tabs-items v-model="tab">
                    <v-tab-item 
                        value="tab-1"
                    >
                        <yamatotakkyubin-component></yamatotakkyubin-component>
                    </v-tab-item>
                    <v-tab-item
                        value="tab-2"
                    >
                        <yamatocompact-component></yamatocompact-component>
                    </v-tab-item>
                </v-tabs-items>

                <div class="divider-image delivery-image">
                    <v-img
                        max-width=120
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/delivery.png"
                    ></v-img>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div class="item-title">{{$t('shipping.postage.title')}}</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <p class="description mb-8">
                    {{$t('shipping.postage.lead')}}
                </p>
                <v-row>
                    <v-col cols="12" sm="12" md="6">
                        <v-select
                            v-model="courier"
                            :items="couriers"
                            :item-text="setItem()"
                            item-value="id"
                            :label="$t('shipping.postage.select')"
                            required
                            class="mb24"
                            solo
                        ></v-select>
                        <div v-if="this.courier === 1">
                            <div
                                v-for="postageYamatoTakkyubin in postageYamatoTakkyubins"
                                :key="postageYamatoTakkyubin.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div v-if="$i18n.locale=='en'" :class="itemContentClasses">{{ postageYamatoTakkyubin.name_en}}</div>
                                        <div v-else :class="itemContentClasses">{{ postageYamatoTakkyubin.name}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageYamatoTakkyubin.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                         <div v-if="this.courier === 2">
                            <div
                                v-for="postageYamatoBig in postageYamatoBigs"
                                :key="postageYamatoBig.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div v-if="$i18n.locale=='en'" :class="itemContentClasses">{{ postageYamatoBig.name_en}}</div>
                                        <div v-else :class="itemContentClasses">{{ postageYamatoBig.name}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageYamatoBig.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                        <div v-if="this.courier === 3">
                            <div
                                v-for="postageCompact in postageCompacts"
                                :key="postageCompact.id"
                            >
                                <v-row>
                                    <v-col cols="6" sm="6" md="6">
                                        <div v-if="$i18n.locale=='en'" :class="itemContentClasses">{{ postageCompact.name_en}}</div>
                                        <div v-else :class="itemContentClasses">{{ postageCompact.name}}</div>
                                    </v-col>
                                    <v-col cols="6" sm="6" md="6">
                                        <div class="grey--text text--darken-3">{{ formatPrice(postageCompact.postage)}}</div>
                                    </v-col>
                                </v-row>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            courier: null,
            tab: null,
            postageType: null,
        }
    },
    mounted(){
      
    },
    created(){
        this.$store.dispatch('fetchPostages')
    },
    computed: {
        ...mapState([
            'postages',
            'postageYamatoTakkyubins',
            'postageYamatoBigs',
            'postageCompacts',
            'couriers'
        ]),
        descriptionClasses(){
          if(this.$i18n.locale == 'en') return 'en-description'
          return 'description'
        },
        itemContentClasses(){
          if(this.$i18n.locale == 'en') return 'en-item-content'
          return 'item-content'
        },
        itemTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-item-title'
          return 'item-title'
        }
    },
    methods: {
        formatPrice(value){
          return value.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'})
        },
        setItem(){
            if(this.$i18n.locale == 'ja'){
                return item => item.name + ' ' + item.type
            }else{
                return item => item.name_en + ' ' + item.type_en
            }
        },
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

.mb16{
    margin-bottom: 16px;
}

.spot-color{
    color: #FE6862
}

@media(max-width:780px){
   .delivery-image{
       max-width: 100px;
   }
}
</style>