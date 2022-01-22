<template>
    <v-container>
        <v-row justify="center">
            <v-dialog 
                v-model="dialogOrderCard" 
                persistent 
                fullscreen
            >
                <v-card>
                    <v-toolbar
                        dark
                        color="primary"
                    >
                        <v-btn
                            icon
                            dark
                            @click="$store.commit('giftcard/setDialogOrderCard', false)"
                        >
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </v-toolbar>
                    <v-container>
                    <v-row justify="center">
                        <v-col cols="12" sm="12" md="8">
                            <v-row>
                                <v-col cols="12" sm="12" md="12">
                                    <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <div class="jp-font-400-18 grey--text text--darken-4 mt48 mb48">ラッピングキットを申し込む</div>
                                        </v-col>
                                    </v-row>
                                     <p>
                                        ご希望のカード種類の数量を入力し、更新ボタンを押してください。終わったら、ページを閉じてください。
                                    </p>
                                    <v-row v-for="item in items" :key="item.number" align="center">
                                        <v-col cols="6" sm="6" md="4">
                                            {{item.name}}
                                        </v-col>
                                        <v-col cols="4" sm="4" md="2">
                                            <v-text-field
                                                v-model="item.amount"
                                                label="数量"
                                            >
                                            </v-text-field>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="1" class="mr-4">
                                            <v-btn
                                                color="grey darken-2"
                                                outlined
                                                @click="$store.commit('giftcard/setGiftCard', item)"
                                            >
                                                更新
                                            </v-btn>
                                        </v-col>
                                        <v-col cols="2" sm="2" md="1">
                                            <v-btn
                                                color="grey darken-2"
                                                outlined
                                                @click="$store.commit('giftcard/clearGiftCard', item)"
                                            >
                                                削除
                                            </v-btn>
                                        </v-col>
                                        <v-col v-if="item.number !==3 " cols="12" sm="12" md="12" class="line-color hidden-md-and-up">
                                            <v-divider></v-divider>
                                        </v-col>
                                    </v-row>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                    <v-card-actions class="hidden-md-and-up">
                        <v-spacer></v-spacer>
                        <v-btn color="primary" text @click="$store.commit('giftcard/setDialogOrderCard', false)">閉じる</v-btn>
                    </v-card-actions>
                    </v-container>
                </v-card>
        </v-dialog>
    </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        dialogOrderCard: Boolean,
        items: Array
    },
    data: function(){
        return {
        }
    },
    watch: {
       
    },
    mounted(){
      
    },
    created(){
       
     
    },
    computed: {
         ...mapState([
          
        ]),
      
      
    },
    methods: {
        ...mapActions([
            
        ]),

        
    }


}
</script>

<style>
.dialog-title{
  margin-bottom: 24px;
}

.jp-font-400-18{
  font-family: 'Noto Sans JP', sans-serif;
  letter-spacing: 0.03em;
  font-size: 18px;
}


</style>