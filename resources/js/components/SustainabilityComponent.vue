<template>
    <v-container>
        <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/kirigamine_resized.png"
            ></v-img>
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Sustainability
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    環境に優しい包装について
                  </div>
              </div>
          </v-col>
      </v-row>
      <div class="mb-10">
          <p :class="descriptionClasses">
            {{$t('sustainability.lead')}}
          </p>   
      </div>
      <!-- <p class="description">
        このページでは、私たちが環境に対してどのようにアプローチしていくかをご紹介いたします。現在、準備中です。
      </p>    -->
      <v-row>
          <v-col cols="12" sm="12" md="4">
              <p :class="itemTitleClasses">{{$t('sustainability.title')}}</p>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <p :class="descriptionClasses" v-html="$t('sustainability.p1')"></p>
              <p :class="descriptionClasses" v-html="$t('sustainability.p2')"></p>
              <div class="divider-image pine-image">
                    <v-img
                        max-width=90
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/pine_tree.png"
                    ></v-img>
              </div>
              <p :class="descriptionClasses" v-html="$t('sustainability.p3')"></p>
              <p :class="descriptionClasses" v-html="$t('sustainability.p4')"></p>
              <div v-if="$i18n.locale=='en'">
                  <p :class="descriptionClasses" v-html="$t('sustainability.p5')"></p>
              </div>
          </v-col>
      </v-row>
    </v-container>
  
</template>

<script>
export default {
    data: function(){
        return {
            tab: null,
        items: [
          'web', 'shopping', 'videos', 'images', 'news',
        ],
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
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
        itemTitleClasses(){
          if(this.$i18n.locale == 'en') return 'en-item-title'
          return 'item-title'
        }
    },
    methods: {
      

        
    }


}
</script>

<style>
.mb60 {
  margin-bottom: 60px;

}

.en-item-title{
  font-weight: 600;
}

@media(max-width:780px){
    .pine-image{
      max-width: 90px;
    }
}

</style>