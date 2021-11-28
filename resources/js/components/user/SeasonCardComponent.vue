<template>
    <div class="jp-font grey--text text--darken-2 mb24">
        <p class="mb-4">
            ご希望の方に、シンプルでおしゃれなギフトラッピングをご自身でできる、「簡単ギフトラッピングキット」（小さな袋・カード・ラベルシールのセット）を無料で同封いたします。
        </p>
        <v-btn
            color="primary"
            outlined
            @click="$store.commit('giftcard/setDialogOrderCard', true)"
            class="mb24"
        >
            セットを申し込む・修正する
        </v-btn>
        <div>
            現在のお申し込み内容：
        </div>
        <div v-if="giftcard.length <= 0">
            利用なし
        </div>
        <div v-if="giftcard.length >= 1">
            <div v-for="item in giftcard" :key="item.number">
                {{item.name}}: {{item.amount}}セット
            </div>
        </div>
        <ordercarddialog-component
            v-bind:dialogOrderCard='dialogOrderCard'
            v-bind:items='items'
        ></ordercarddialog-component>
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
        ...mapState('giftcard',[
            'giftcard',
            'items',
            'dialogOrderCard'
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