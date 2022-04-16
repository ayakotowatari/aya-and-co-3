<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        About
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        プロフィール
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <!-- <div>
                    {{ item.title }}
                </div>
                <div>
                    {{ item.text }}
                </div>
                <v-row>
                    <v-col md="4">
                        {{ item.title }}
                    </v-col>
                    <v-col md="8">
                        {{ item.text }}
                    </v-col>
                </v-row> -->
                <v-row align="end" class="mb24">
                    <v-col cols="12" sm="12" md="2">
                        <div>
                            <v-img
                                max-width=120
                                src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/ayako_grey.png"
                            >
                            </v-img>
                        </div>
                    </v-col>
                    <v-col cols="12" sm="12" md="10">
                        <div class="name">
                            <span class="jobtitle">Founder</span><br>
                            Ayako Ueda
                        </div>
                    </v-col>
                </v-row>
                
                
                <div v-if="$i18n.locale == 'ja'" class="jp-serif-400-16 grey--text text--darken-2 mb-6">
                    <p>
                        マーマレードのレシピが初めて歴史上にあらわれるのは、<br class="lg">1677年ごろのことだそうです。
                    </p>
                    <p>
                        イングランド北西部のイライザ・チョムリーという女性が、<br class="lg">
                        出版したレシピブックのなかで「オレンジのマルマレット」を書き残しています。
                    </p>
                    <p>
                        それから350年近く、マーマレードが生き続けているのは、<br class="lg">
                        毎日の生活のなか、<br class="sm">とりわけ朝目覚めたときに必ずそこにあることに、<br class="lg">
                        人間にとってベーシックな<br class="sm">美しさと喜びがあるからだと感じます。
                    </p>
                    <p>
                        同じことがマーマレードを作るという行為そのものにもいえます。<br>
                        果物という自然の恵みを、果実と果汁だけでなく、皮から種にいたるまで<br>
                        どこもあますことなく使うこと。<br>
                        それを口にする誰かに喜びをもたらすことを祈りながら、時間をかけてつくること。<br>
                    </p>
                    <p>
                        いつの時代も。世界のどこにいても。
                    </p>
                    <p>
                        人間を普遍的に幸せにするものだから、ずっと作りつづけたいマーマレード。<br>
                        こうして、aya & co.として、Little Black Jarsをスタートさせました。
                    </p>
                </div>
                <div v-else class="jp-serif-400-16 grey--text text--darken-2 mb-6">
                    <p>
                        There is something emotional and beautiful about marmalade making.
                    </p>
                    <p>
                        It is emotional because, for me, it reminds me of my days in Britain. It connects me with one summer in Oxford when I was a student and the moment when my host father in the family I stayed with proudly introduced an "Oxford" marmalade jar to me. Its taste and look were so different from what I had known in Japan that I brought one back home, and my mother fell in love with it. Since then, a few jars of marmalades had always travelled with me between Japan and Britain. 
                    </p>
                    <p>
                        I found marmalade making beautiful because of the idea that it appreciates the entire fruit of citruses, from pips and pulps to skins and juice. Absolutely no waste. Every bit of the fruit contributes to a gorgeous jar of preserves. It never fails to amaze me and make me feel good and happy. 
                    </p>
                    <p>
                        So when I took a career break a few years ago (I left a British organisation in Tokyo where I had worked for more than ten years), I decided to start a small business focusing on marmalade making. The idea and act of turning distinctively Japanese citrus fruits into authentic marmalades through British recipes enchanted me. Something that emotionally connects me with Britain and makes me feel good and happy.
                    </p>
                    <p>
                        In the meantime, I studied web design and development skills to create this website where my customers can purchase seasonal jars directly from me. Encouraged by my British friend, I also ventured into a translation of my Japanese site to English. This project is yet to complete as of April 2022, and you will find some parts still not readable, but I am now happy to welcome English-speaking customers to my online store. 
                    </p>
                    <p>
                        I hope that the marmalades I create will bring you moments of happiness! 
                    </p>
                    <p>
                        With love,<br>
                        Ayako
                    </p>

                </div>
                <div class="divider-image bird-image">
                    <v-img
                        max-width=120
                        class="mx-auto"
                        src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/birds.jpg"
                    ></v-img>
                </div>
                <div>
                    <div v-if="$i18n.locale == 'ja'">
                        <div class="jobtitle mb-2">Profile</div>
                        <div class="jp-sanserif-400-14 mb-8">
                            <p>
                                早稲田大学第一文学部卒業、ロンドン大学歴史学研究所研究修士号<br>
                                2006-2008年、大阪大学大学院文学研究科助教を経て、<br>
                                2009-2019年、英国の公的な国際文化交流機関ブリティッシュ・カウンシルで<br>
                                日本とイギリスを繋ぐ教育・研究事業のプロジェクトマネージャーを務める。<br>
                                2019年、デジタルハリウッドのStudio渋谷にてWebデザインを、<br>
                                2020年、ジーズアカデミーでプログラミングを学ぶ。<br>
                                2021年、aya & co.を創業。
                                <br>
                            </p>
                        </div>
                        <div class="jobtitle mb-2">Works</div>
                        <div class="jp-sanserif-400-14 mb-8">
                            <p>
                                マーマレード・ジャムの製作と販売<br>
                                ウェブサイトのデザインと制作<br>
                            </p>
                        </div>
                    </div>
                    <div class="jobtitle mb-2">Contact</div>
                    <div class="jp-sanserif-400-14 mb-10">
                        <p v-html="$t('about.contact')" ></p>
                    </div>
                    <div class="jobtitle mb-8">
                        <p>
                            Website designed and developed by Ayako Ueda.<br>
                            Special thanks to Yuka Fujisawa for taking lovely photos of the jars. 
                        </p>
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
            // items:  [
            //     {title: '送料はいくらですか？', text: '<router-link to:"/postage">こちらのページ</router-link>でご覧いただけます。'},
            // ],
            
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
.jobtitle{
    font-family: ltc-kennerley, serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 0.03em;
    font-size: 14px;
}

.name{
    font-family: ltc-kennerley, serif;
    font-weight: 400;
    font-style: normal;
    letter-spacing: 0.03em;
    font-size: 18px;
}

.jp-serif-400-16{
    font-family: 'Noto Serif JP', serif;
    font-weight: 400;
    font-style: normal;
    font-size: 16px;
    letter-spacing: 0.03em;
    line-height: 1.6;
}

.jp-sanserif-400-14{
    line-height: 1.5;
    font-weight: 300;
    font-style: normal;
    font-size: 14px;
    letter-spacing: 0.03em;
    line-height: 1.6;
}

.mb24{
    margin-bottom: 24px;
}

@media(max-width:780px){
   .bird-image{
       max-width: 100px;
   }
}

</style>