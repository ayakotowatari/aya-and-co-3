<template>
    <div class="pt-6">
        <!-- <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order
                  </div>
                  <div class="page-subtitle text--lighten-5">
                    ご購入の手続き
                  </div>
              </div>
          </v-col>
      </v-row> -->
        <registertoorderdialog-component
            v-bind:dialogRegisterToOrder="dialogRegisterToOrder"
        ></registertoorderdialog-component>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div :class="formTitleClasses" class="grey--text text--darken-4">{{$t('checkout.shipping_address')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div :class="fontWeightClasses" class="grey--text text--darken-3">{{$t('checkout.login')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center">
            <v-col cols="12" sm="12" md="4" class="mb-6">
                <logintoorder-component></logintoorder-component>
            </v-col>
        </v-row>

        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <v-divider class="mt-4 mb-8"></v-divider>
            </v-col>
        </v-row>

        <v-row justify="center">
            <v-col cols="12" sm="12" md="6">
                <div :class="fontWeightClasses" class="grey--text text--darken-3">{{$t('checkout.order_guest')}}</div>
            </v-col>
        </v-row>
        <v-row justify="center">
                    <v-col cols="12" sm="12" md="4">
                        <div v-if="$i18n.locale == 'en'" class="grey--text text--darken-2 mb-2">
                            {{$t('checkout.message')}}
                        </div>
                        <v-tabs v-model="tab" class="mb-12">
                            <v-tab
                                href="#tab-1"
                            >
                                {{$t('checkout.ship_home')}}
                            </v-tab>
                            <v-tab
                                href="#tab-2"
                            >
                                {{$t('checkout.ship_other')}}
                            </v-tab>
                            <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
                        </v-tabs>

                        <v-tabs-items v-model="tab">
                            <v-tab-item 
                                value="tab-1"
                            >
                                <guesthomeaddress-component></guesthomeaddress-component>
                            </v-tab-item>
                            <v-tab-item
                                value="tab-2"
                            >
                                <guestotheraddress-component></guestotheraddress-component>
                            </v-tab-item>
                        </v-tabs-items>
                    </v-col>
                </v-row>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import Login from '../LoginComponent'

export default {
    components: {
        Login,
    },
    props: {
        user: Object
    },
    data: function(){
        return {
            tab: null,
        }
    },
    watch: {
        zipcode: function(val){
            if(7 != val.length){
                return;
            }

            let self = this;
            //自サイトのAPI
            let url = "/ajax/zipcode/" + val;

            axios
            .get(url)
            .then(res => {
                self.state = res.data.pref;
                self.city = res.data.address;
                // self.address1 = res.data.town;
            })
        }
    },
    mounted(){
       
    },
    computed: {
        ...mapState([
            'dialogRegisterToOrder'
        ]),
        formTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-form-title'
          return 'form-title'
        },
        fontWeightClasses(){
          if(this.$i18n.locale == 'en') return 'en-jp-font'
          return 'jp-font'
        }
    },
    methods: {
        
    }

}
</script>

<style>
.form-title{
  font-weight: 500;
  font-size: 18px;
}
.en-form-title{
  font-weight: 500;
  font-size: 20px;
}
.en-jp-font{
    font-weight:500;
    font-size:18px;
}

</style>