<template>
    <div>
        <div v-if="inSeasonCategories.length <= 0">
            <div class="grey--text text--darken-3 mb-3">
                {{$t('product.current.lead')}}
            </div>
            <div class="grey--text text--darken-3 mb-6">
                {{$t('product.line.lead')}}
            </div>
            <div>
                <v-btn
                    v-if="$i18n.locale == 'ja'"
                    href = "https://lin.ee/1RJJ9C3"
                    target="_blank"
                    outlined
                    color="primary"
                    class="mr-2 mb-2"
                >
                    {{$t('product.line.line')}}
                </v-btn>
                <v-btn
                    v-else
                    href = "https://lin.ee/4xyKS07"
                    target="_blank"
                    outlined
                    color="primary"
                    class="mb-2"
                >
                    {{$t('product.line.line')}}
                </v-btn>
                <v-btn
                    v-if="$i18n.locale == 'en'"
                    href="https://facebook.com/ayaandco.jp/"
                    target="_blank"
                    outlined
                    color="primary"
                    class="mb-2"
                >
                    {{$t('product.line.facebook')}}
                </v-btn>
                <v-btn
                    href="https://www.instagram.com/ayaandco.jp/"
                    target="_blank"
                    outlined
                    color="primary"
                    class="mb-2"
                >
                    {{$t('product.line.instagram')}}
                </v-btn>
            </div>
        </div>
        <div v-if="inSeasonCategories.length > 0">
            <v-row>
                <v-col cols="12" sm="12" md="3" v-for="category in inSeasonCategories" :key="category.id">
                    <v-card
                        class="mx-auto"
                        max-width="344"
                        outlined
                        @click.prevent="showmore(category.id)"
                    >
                        <v-img
                            max-height="200"
                            :src="category.absolute_path"
                        > 
                        </v-img>
                        <v-card-text>
                            <div class="product-name mb-1">
                                {{category.name}}
                            </div>
                            <div v-if="$i18n.locale=='ja'" :class="productSeasonClasses" class="mb-4">
                                {{category.season}}
                            </div>
                            <div v-else :class="productSeasonClasses" class="mb-4">
                                {{category.season_en}}
                            </div>
                            <div v-if="$i18n.locale=='ja'" :class="productDetailsClasses">
                                {{category.details}}
                            </div>
                            <div v-else :class="productDetailsClasses">
                                {{category.details_en}}
                            </div>
                        </v-card-text>
                        <div class="link">
                            <router-link
                                :to="{
                                    name: 'products',
                                    params: {id: category.id}
                                }"
                                @click.native="scrollToTop"
                            >
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn
                                    v-if="$i18n.locale == 'ja'"
                                    outlined
                                    rounded
                                    text
                                    color="grey darken-2"
                                    @click.prevent="expand(category.id)">
                                    詳細
                                    </v-btn>
                                    <v-btn
                                    v-else
                                    text
                                    color="grey darken-2"
                                    @click.prevent="expand(category.id)">
                                    <v-icon>mdi-open-in-new</v-icon>
                                    </v-btn>
                                </v-card-actions>
                            </router-link>
                        </div>
                    </v-card>
                </v-col>
            </v-row>
        </div>
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
            'categories'
        ]),
        inSeasonCategories(){

            return this.categories.filter(category => category.status_id === 1);
        },
        productSeasonClasses(){
          if(this.$i18n.locale == 'en') return 'en-product-season'
          return 'product-season'
        },
         productDetailsClasses(){
          if(this.$i18n.locale == 'en') return 'en-product-details'
          return 'product-details'
        },
    },
    methods: {
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        
    }


}
</script>

<style>

</style>