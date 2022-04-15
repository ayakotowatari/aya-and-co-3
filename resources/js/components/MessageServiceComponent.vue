<template>
    <v-container>
        <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/happy_spring.png"
            ></v-img>
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Sending a Gift 
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    ギフトサービス
                  </div>
              </div>
          </v-col>
      </v-row>
      <!-- <div class="mb-10">
          <p class="description">
            aya & co. では、環境に優しい包装に取り組んでいます。
          </p>   
      </div> -->
      <!-- <p class="description">
        このページでは、私たちが環境に対してどのようにアプローチしていくかをご紹介いたします。現在、準備中です。
      </p>    -->
      <v-row>
          <v-col cols="12" sm="12" md="4">
              <p class="item-title">{{ $t('gift.title') }}</p>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <!-- <p class="description">
                  マーマレードを手にとっていただくのは、<br class="lg">
                  頑張ったご自身へのねぎらいの贈り物であったり、<br class="lg">
                  少し疲れた時に勇気づけるためかもしれません。<br>
                  あるいは、もうすぐ誕生日を迎えるご家族やご友人のことを想っていたり、<br class="lg">
                  感謝の気持ちを誰かに伝えたくて、マーマレードを選んでいただくのかもしれません。<br class="lg">
                  自分にとって大切な人に愛情を贈ろうとされている方もいらっしゃると思います。<br> -->
              <p v-html="$t('gift.description')" class="description">
              </p>
              <div class="divider-image pine-image balloon-image">
                    <v-img
                        max-width=90
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/balloon.png"
                    ></v-img>
              </div>
              <!-- <div class="my-4">
                    <v-img
                        max-width="320"
                        class="mx-auto card-image"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/card_happyBD.jpg"
                    ></v-img>
              </div> -->
              <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        {{ $t('gift.message.title') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p class="mb-4">{{ $t('gift.message.line1') }}</p>
                        <v-row class="mb-4">
                            <v-col cols="12" sm="12" md="1" class="hidden-sm-and-down">

                            </v-col>
                            <v-col cols="12" sm="12" md="11">
                                <!-- <p class="mb-4">
                                    Happy Christmas
                                </p>
                                <p class="mb-4">
                                    Happy New Year
                                </p>
                                <p class="mb-4">
                                    Happy Christmas
                                </p>
                                <p class="mb-4">
                                    Season's Greetings（年末年始の季節のご挨拶）
                                </p> -->
                                <div class="mb-2">
                                    {{ $t('gift.message.message1') }}
                                </div>
                                <div class="mb-2">
                                    {{ $t('gift.message.message2') }}
                                </div>
                                <div class="mb-2">
                                    {{ $t('gift.message.message3') }}
                                </div>
                                <div class="mb-2">
                                    {{ $t('gift.message.message4') }}
                                </div>
                                <div v-html="$t('gift.message.message5')" class="mb-2">
                                </div>
                                <div v-html="$t('gift.message.message6')" class="mb-2">
                                </div>
                            </v-col>
                        </v-row>
                        <p>
                            {{ $t('gift.message.line2') }}
                        </p>
                        <p v-html="$t('gift.message.line3')">
                        </p>
                    </div>
                </div>

                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>

                <div class="mb-8">
                    <div class="item-content line-height policy-title mb-4">
                        {{ $t('gift.name.title') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('gift.name.line1') }}
                        </p>
                        <p v-if="$i18n.locale == 'ja'">
                            {{ $t('gift.name.line2') }}
                        </p>
                        <p v-if="$i18n.locale == 'ja'">
                            {{ $t('gift.name.line3') }}
                        </p>
                    </div>
                </div>

                <v-row class="mb-8">
                    <v-col cols="12" sm="12" md="12" class="line-color">
                        <v-divider></v-divider>
                    </v-col>
                </v-row>

                <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        {{ $t('gift.order.title') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('gift.order.line1') }}
                        </p>
                        <p>
                            <router-link v-if="$i18n.locale == 'ja'" to="/guest/register">会員登録</router-link><router-link v-else to="/guest/register">Register as a member</router-link>{{ $t('gift.order.line2') }}
                        </p>
                        <p class="mb-6">
                            {{ $t('gift.order.line3') }}
                        </p>
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
                </div>
          </v-col>
      </v-row>
    </v-container>
  
</template>

<script>
export default {
    data: function(){
        return {
            images:[
                { name: 'sample1', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/vintage_sample.JPG'},
                { name: 'sample2', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/key_bagel.JPG'},
                { name: 'sample3', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/kirigamine.png'},
            ]
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
.mb60 {
  margin-bottom: 60px;
}
.card-image{
    border: 0.5px solid #727272;
}
.font-14{
    font-size: 14px;
}

.line-color .theme--light.v-divider{
    border-color: #FE6862;
    border-style: dotted;
    /* background-image: linear-gradient(to right, black 33%, rgba(255,255,255,0) 0%);
    background-position: bottom;
    background-size: 3px 1px;
    background-repeat: repeat-x; */

}

.balloon-image{
    margin-top: 60px;
    margin-bottom: 60px;
}

.line-height{
    line-height: 1.8;
}

@media(max-width:780px){
    
}

</style>