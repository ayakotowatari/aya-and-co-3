<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Contact
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        お問い合わせ
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <!-- <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    このページは、ただいま準備中です。
                </div> -->
                <div :class="itemTitleClasses" class="mb-4" v-if="$i18n.locale == 'en'">
                    We look forward to hearing from you.
                </div>
                <div class="grey--text text--darken-2 mb-4" v-html="$t('contact.google')">             
                </div>
                <div class="grey--text text--darken-2 mb-6">
                    {{$t('contact.line')}}
                </div>
                <div>
                <v-btn
                    href = "https://lin.ee/1RJJ9C3"
                    target="_blank"
                    outlined
                    color="primary"
                >
                    {{$t('product.line.line')}}
                </v-btn>
                </div>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
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
a{
    text-decoration: none;
}

</style>