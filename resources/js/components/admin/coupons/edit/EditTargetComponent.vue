<template>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
        <v-row>
            <v-col cols="12" sm="12" md="6">
                <v-select
                    v-model="target"
                    label = "ターゲット"
                    :items="targets"
                    item-text="name"
                    item-value="number"
                >
                </v-select>
                <v-btn
                    color="primary"
                    darken
                    class="mr-2"
                    @click="updateCouponTarget"
                >
                    更新する
                </v-btn>
                <v-btn
                    outlined
                    color="grey darken-2"
                    @click="back"
                >
                    戻る
                </v-btn>
            </v-col>
        </v-row>
    </v-form>
  
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    props: {
        adminCoupon: Object,
    },
    data: function(){
        return {
            valid: true,
            target: '',
            targets: [{name:'個別', number:0},{name:'全員', number:1}]
        }
    },
    mounted(){

        
      
    },
    created(){
     
    },
    computed: {
        ...mapState('coupon', [
            'allerror',

        ]),
    },
    methods: {
        ...mapActions('coupon', [
            'updateTarget'
        ]),
        updateCouponTarget(){

            if(this.$refs.form.validate()){
                this.updateTarget({
                    id: this.adminCoupon.id,
                    target: this.target
                })
            }
    
        },
        back(){
            this.$store.commit('coupon/setIsEditingTarget', false)
            // this.$store.dispatch('coupon/fetchCoupon');
        },
      

        
    }


}
</script>

<style>

</style>