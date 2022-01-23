<template>
  <v-container>
      <div class="key-visual">
        <v-img
            src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/key_bagel.JPG"
        ></v-img>
      </div>
      <v-row>
          <v-col>
              <h1 v-if="$i18n.locale == 'en'" class="en-lead mb-6">{{ $t('top.lead')}}</h1>
              <div :class="keyMessageClasses" v-html="$t('top.key_message')"></div>
          </v-col>
      </v-row>
      <div class="divider-image">
         <v-img
             max-width=90
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/spoon.png"
          ></v-img>
      </div>
      <div class="heading">
        Little Black Jars
      </div>
      <div v-html="$t('top.description')"></div>
      <v-row>
        <v-col cols="12" sm="12" md="4">
            <div class="subheading">
              How to Shop
            </div>
            <div class="subheading-jp">
              お買い物の方法
            </div>
        </v-col>
        <v-col cols="12" sm="12" md="8">
            <p :class="descriptionClasses">
              {{ $t('how_to_shop.lead')}}
            </p>
            <v-row>
                <v-col cols="12" sm="12" md="8">
                    <v-timeline
                      align-top
                      dense
                      class="mb-8"
                    >
                        <v-timeline-item small :class="descriptionClasses">{{ $t('how_to_shop.line1')}}</v-timeline-item>
                        <v-timeline-item small :class="descriptionClasses">{{ $t('how_to_shop.line2a')}}<router-link to='/postage'>{{ $t('how_to_shop.line2b') }}</router-link>{{ $t('how_to_shop.line2c')}}</v-timeline-item>
                        <v-timeline-item small :class="descriptionClasses">{{ $t('how_to_shop.line3a')}}<router-link to='/message-service'>{{ $t('how_to_shop.line3b') }}</router-link>{{ $t('how_to_shop.line3c')}}</v-timeline-item>
                        <v-timeline-item small :class="descriptionClasses">{{ $t('how_to_shop.line4')}}</v-timeline-item>
                    </v-timeline>
                </v-col>
            </v-row>
            <!-- <div class="mb80">
              <campaignbanner-component></campaignbanner-component>
            </div> -->
        </v-col>
      </v-row>

      <!-- <div class="divider-image">
         <v-img
             max-width=60
             class="mx-auto"
             src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/basket.svg"
          ></v-img>
      </div> -->
      
      <v-row class="mb-8">
          <v-col cols="12" sm="12" md="4">
              <div class="subheading">
                Products List
              </div>
              <div class="subheading-jp">
                商品ラインナップ
              </div>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <div :class="descriptionClasses" v-html="$t('products_list.lead')"></div>
          </v-col>
      </v-row>
      
      
      <v-tabs v-model="tab" class="mb-12">
          <v-tab
              href="#tab-1"
              :class="tabClasses"
          >
              {{ $t('products_list.heading_all')}}
          </v-tab>
          <v-tab
              href="#tab-2"
              :class="tabClasses"
          >
              {{ $t('products_list.heading_current')}}
          </v-tab>
          <!-- <v-tab router :to="{name: 'search-events'}">Search</v-tab> -->
      </v-tabs>

      <v-tabs-items v-model="tab">
          <v-tab-item 
              value="tab-1"
          >
              <allproducts-component></allproducts-component>
          </v-tab-item>
          <v-tab-item
              value="tab-2"
          >
              <currentproducts-component></currentproducts-component>
          </v-tab-item>
      </v-tabs-items>
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        user: Object,
    },
    data: function(){
        return {
            tab: null,
            // id: this.$route.params.id
            // message: "",
            // quantity: [1, 2, 3],
            // selectedQuantity:[],
        }
    },
    mounted(){
      // this.$store.dispatch('fetchProducts')
    },
    created(){
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
        ...mapState([
          'categories',
        ]),
        keyMessageClasses(){
          if(this.$i18n.locale == 'en') return 'en-key-message'
          return 'key-message'
        },
        descriptionClasses(){
          if(this.$i18n.locale == 'en') return 'en-description'
          return 'description'
        },
        tabClasses(){
          if(this.$i18n.locale == 'en') return 'en-tab'
        }
    },
    methods: {
        ...mapActions([
          // 'addToCart'
        ]),
        showmore(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        expand(id){
          this.$router.push({name: 'products', params: {id: id}})
        },
        scrollToTop(){
          window.scrollTo(0,0);
        },
        // formatPrice(value){
        //   let amount = value;

        //   return amount.toLocaleString('ja-JP', { style: 'currency', currency: 'JPY'});
        // },

        // @click="$store.commit('addToCart', {product, selectedQuantity})"

        // add(){
        //   this.addToCart({
        //     products: this.products,
        //     quantity: this.selectedQuantity
        //   })

        // },
        //  @click="add()"
        

        // 
        

        // toCart(){
        //   this.$router.push({name: 'carttwo'})
        // }

        // fetchProducts: function(){
        //     axios.get("/fetch-product").then(res => {
        //         this.products = res.data.products;
        //     })
        // },
       
    }

}
</script>

<style>
.mb80{
    margin-bottom: 80px;
}

.v-list-item .v-list-item__subtitle, .v-list-item .v-list-item__title{
    line-height: 1.4 !important
}

.key-visual{
  margin-top: 20px;
  margin-bottom: 48px;
}

.en-lead{
  font-family: ltc-kennerley, serif;
  font-weight: 700;
  font-style: normal;
}

.key-message{
  line-height: 2.0;
  font-family: 'Noto Serif JP', serif;
  font-weight: 400;
  font-style: normal;
  font-size: 18px;
  margin-bottom: 48px;
  color: rgba(0, 0, 0, 0.87)
}

.en-key-message{
  font-size: 18px;
  margin-bottom: 48px;
}

.divider-image{
  margin-top: 40px;
  margin-bottom: 56px;
}

.heading{
  font-family: mrs-eaves-roman-all-small-ca, sans-serif;
  font-weight: 400;
  font-style: normal;
  font-size: 40px;
  margin-bottom: 24px;
  color: rgba(0, 0, 0, 0.87)
}

.description{
  font-weight: 300;
  font-style: normal;
  font-size: 16px;
  letter-spacing: 0.03em;
  /* color: #424242 */
}

.subheading{
  font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal;
  font-size: 24px;
  color: rgba(0, 0, 0, 0.87)
}

.subheading-jp{
  font-size: 12px;
  margin-bottom: 24px;
  color: rgba(0, 0, 0, 0.87)
}

.en-tab{
  font-family: roboto, sans-serif;
}

.product-name{
  font-family: copperplate, serif;
  font-weight: 700;
  font-style: normal;
  font-size: 18px;
  letter-spacing: 0.03em;
  color: rgba(0, 0, 0, 0.87)
}
.product-size{
  font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal;
}

.product-price{
  /* font-family: mrs-eaves, serif;
  font-weight: 400;
  font-style: normal; */
  font-family: ltc-kennerley, serif;
  font-weight: 400;
  font-style: normal;
  letter-spacing: 0.03em;
  font-size: 16px;
}

.product-details{
  font-size: 12px;
  letter-spacing: 0.03em;
}

.en-product-details{
  font-size: 16px;
  letter-spacing: 0.03em;
}

.en-product-season{
  font-size: 12px;
}

.sm {
  display: none
}

.logo-title{
    font-family: mrs-eaves, serif;
    font-weight: 400;
    font-style: normal;
    font-size: 20px;
}

@media(max-width:780px){
    .key-visual{
      margin-bottom: 32px;
    }

    .key-message{
        font-size: 18px;
    }

    .sm{
        display:block;
    }

    .divider-image{
      max-width: 60px;
      margin: 48px auto;
    }
}

</style>