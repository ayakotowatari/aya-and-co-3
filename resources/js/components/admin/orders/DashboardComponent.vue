<template>
    <v-container>
        <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Dashboard
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        ダッシュボード
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <p>販売個数: {{ sales.total}}個</p>
            </v-col>

        </v-row>
  </v-container>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    data: function(){
        return {
            // dialog: false,
           
        }
    },
    // watch: {
    //   dialog (val) {
    //     val || this.close()
    //   },
    // },
    mounted(){
        this.$store.dispatch('admin/fetchSales');
    },
    created(){
     
    },
    computed: {
        ...mapState('admin', [
            'sales',
        ]),
    
    },
    methods: {
        
        
    }


}
</script>

<style>

</style>