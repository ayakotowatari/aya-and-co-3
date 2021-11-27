<template>
    <v-container>
        <div class="key-visual">
            <v-img
                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/wrapping_2.jpg"
            ></v-img>
        </div>
        <v-row>
          <v-col cols="12" sm="12" md="12">
              <div class="heading-group">
                  <div class="page-heading">
                    Gift Wrapping Kit
                  </div>
                  <div class="page-subtitle grey--text text--darken-3">
                    簡単ギフトラッピングキット
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
              <p class="item-title">シンプルでおしゃれな簡単ラッピング</p>
          </v-col>
          <v-col cols="12" sm="12" md="8">
              <div class="mb-8">
                  <!-- <p class="description">
                    キットの使い方をご紹介する動画を近日公開予定です。
                  </p> -->
                  <youtube-component
                      v-bind:youtube='youtube'
                  ></youtube-component>
              </div>
              <div class="mb-10">
                <p class="description">
                    マーマレードをご購入いただき、ご家族やご友人へプレゼントをされるお客様がいらっしゃることから、生まれたサービスです。
                </p>
                <p class="description">
                    会員登録いただいたお客様が、配送方法として<strong>宅急便コンパクト</strong>を選択された場合、ご希望に応じて、一瓶ずつを簡単でおしゃれにラッピングできるキットを<strong>無料で</strong>同封いたします。
                </p>
                <p class="description">
                    配送時に緩衝材として使用している高知県産の木毛を有効に再利用していただくラッピングです。
                </p>
                <p class="description">
                    ご注文時にお申し込みいただけますので、ぜひご利用ください。
                </p>
              </div>
              <div class="mb-10">
                  <div class="item-content policy-title mb-4">
                        キットの内容
                  </div>
                  <p class="description">
                    ① １〜２瓶が入る大きさの透明の袋<br>
                    ② 季節のメッセージがデザインされた小さなカード（裏面にはお店のご案内が印字されています）<br>
                    ③ ラベルシール<br>
                    ④ 高知県産木毛（配送の際に使用している緩衝材を再利用していただきます。）
                  </p>
              </div>
               <div class="mb-8">
                    <div class="item-content policy-title mb-4">
                        カードの種類
                    </div>
                    <p class="description">
                        3種類からお選びいただけます。ご注文時に、種類と枚数をお申し込みください。
                    </p>
              
                    <v-row>
                        <v-col cols="12" sm="12" md="4" v-for="image in images" :key="image.name">
                            <p class="description fontsize14">{{image.name}}</p>
                            <v-img
                                :src="image.link"
                            ></v-img>
                        </v-col>
                    </v-row>
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
                { name: 'クリスマス', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/xmas.png'},
                { name: '新年', link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/newyear.png'},
                { name: "併用", link: 'https://aya-and-co.s3.ap-northeast-1.amazonaws.com/snowman.png'},
            ],
            youtube: 'ZQMbx7iHbfw'
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
.fontsize14{
    font-size: 14px;
}

@media(max-width:780px){
    
}

</style>