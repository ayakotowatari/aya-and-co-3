<template>
    <v-container>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Order Summary
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    注文履歴
                  </div>
              </div>
          </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">
                <div v-if="$i18n.locale == 'en'" class="grey--text text--darken-4">List of Your Orders</div>
                <div v-else class="grey--text text--darken-4">{{user.name}}様の注文履歴リスト</div>
            </v-col>
            <v-col cols="12" sm="12" md="8">
                <v-row class="mb-6" v-if="orders.length <= 0">
                    <v-col cols="12" sm="12" md="6" class="jp-font-400 grey--text text--darken-2">
                        {{$t('summary.message')}}
                    </v-col>
                </v-row>
                <v-row class="mb-6" v-if="orders.length > 0">
                    <v-col cols="12" sm="12" md="6">
                        <v-row class="mb-8">
                            <v-col cols="12" sm="12" md="12" v-for="item in orders" :key="item.id">
                                <v-card
                                    class="mx-auto"
                                    max-width="480"
                                    outlined
                                    @click="itemPage(item.order_id)"
                                >
                                    <v-row align="center">
                                        <v-col cols="10" sm="10" md="10">
                                            <v-list-item three-line class="pa-4">
                                                <v-badge
                                                    bordered
                                                    bottom
                                                    outlined
                                                    :content="item.quantity"
                                                    class="mr-6"
                                                    overlap
                                                >
                                                    <v-avatar
                                                        tile
                                                        size="80"
                                                        color="grey"
                                                    >
                                                        <v-img
                                                            :src="`https://s3-ap-northeast-1.amazonaws.com/aya-and-co/${item.image}`"
                                                        ></v-img>
                                                    </v-avatar>
                                                </v-badge>
                                            
                                                <v-list-item-content>
                                                    <v-list-item-title class="product-name">
                                                        {{item.name}} 
                                                    </v-list-item-title>
                                                    <v-list-item-subtitle v-if="item.slug !== 'marmalade-loaf'" class="product-size mb-2">
                                                        {{item.size}}
                                                    </v-list-item-subtitle>
                                                    <v-list-item-title class="date grey--text text--darken-4">
                                                        {{formattedDate(item.updated_at)}}
                                                    </v-list-item-title>
                                                </v-list-item-content>
                                            </v-list-item>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="2">
                                            <v-icon>mdi-chevron-right</v-icon>
                                        </v-col>
                                    </v-row>
                                </v-card>
                            </v-col>
                        </v-row>
                        <v-pagination
                            v-model="page"
                            :length="lastPage"
                            :total-visible="7"
                            circle
                            @input="getOrders"
                        ></v-pagination>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
       
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

import moment from "moment";

export default {
     data: function(){
        return {
            page: 1,
            publicAWS: process.env.MIX_AWS_URL,
            
        }
    },
    mounted(){
        // this.$store.dispatch('fetchOrders');
    },
    created(){
        // console.log('page', this.page)
        let pageNumber = this.page
        this.$store.dispatch('fetchOrders', {
            pageNumber
        })

    },
    computed: {
     ...mapState([
          'orders',
          'user',
          'lastPage'
        ])
    },
    methods: {
        ...mapActions([
            'fetchOrders'
        ]),
        getOrders(page){

            let pageNumber = page

            this.fetchOrders({
                pageNumber: pageNumber
            })

        },
        itemPage(id){
            this.$router.push({name: 'order-details', params: {id: id}})
        },
        formattedDate(value){
            return moment(value).format('YYYY/MM/DD')
        }
       

    }
}
</script>

<style>
.date{
  font-family: mrs-eaves-roman-all-small-ca, sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 16px;
}

</style>