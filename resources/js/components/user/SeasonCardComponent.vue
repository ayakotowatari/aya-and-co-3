<template>
    <div class="jp-font grey--text text--darken-2 mb24">
        <p>
            年末年始のご家族やご友人への贈り物としてご購入されますか？
        </p>
        <p>
            お選びの配送オプションは、ご希望の場合、シンプルでおしゃれなギフトラッピングをご自身でできる、「小さなカード・ラベルシール・袋」のセットを無料で同封いたします。
        </p>
        <p>
            ご希望のカードの種類の数量を入力し、更新ボタンを押してください。
        </p>
        <v-row v-for="item in items" :key="item.number" align="center">
            <v-col cols="8" sm="8" md="4">
                {{item.name}}
            </v-col>
            <v-col cols="4" sm="4" md="2">
                <v-text-field
                    v-model="item.amount"
                    label="数量"
                >
                </v-text-field>
            </v-col>
            <v-col cols="4" sm="4" md="2" class="mr-2">
                <v-btn
                    color="grey darken-2"
                    outlined
                    @click="$store.commit('giftcard/setGiftCard', item)"
                >
                    更新
                </v-btn>
            </v-col>
              <v-col cols="4" sm="4" md="2">
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
        <!-- <tr v-for="item in items" :key="item.number">
            <td>
                {{item.name}}
            </td>
            <td>
                <v-text-field
                    v-model="amount"
                    label="数量"
                >
                </v-text-field>
            </td>
            <td>
                <v-btn
                    outlined
                    @click="add(item)"
                >
                    追加する
                </v-btn>
            </td>
        </tr> -->
        <!-- <v-select
            v-model="cardType"
            label="カードの種類"
            :items="items"
            item-text="type"
            item-value="number"
        >
        </v-select> -->
        
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            // items: [
            //     {name:"Happy Christmas", number:1, amount:''},
            //     {name:"Happy New Year", number:2, amount:''},
            //     {name: "Season's Greetings", number:3, amount:''}
            // ],
        }
    },
    mounted(){
      
    },
    created(){
     
    },
    computed: {
        ...mapState('giftcard',[
            'giftcard',
            'items'
        ]),
    
    },
    methods: {
        ...mapActions([
            
        ]),
        // add(value){

        //     this.addGiftCard({
        //         id: value.number,
        //         name: value.name
        //     })

        // }
      

        
    }


}
</script>

<style>
.lastchild:last-child{
    display: none;
}

</style>