<template>
    <v-container>
         <v-row>
            <v-col cols="12" sm="12" md="12">
                <div class="heading-group">
                    <div class="page-heading">
                        Privacy Policy
                    </div>
                    <div class="page-subtitle grey--text text--darken-3">
                        プライバシーポリシー
                    </div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

            </v-col>
            <v-col cols="12" sm="12" md="8">
                <div class="mb-6">
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('privacy.lead') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a1.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a1.p1') }}
                        </p>
                        <p>
                            {{ $t('privacy.a1.p2') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                       {{ $t('privacy.a2.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a2.p1') }}
                        </p>
                        <p>
                            {{ $t('privacy.a2.p2') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a3.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a3.p1') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p2') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p3') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p4') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p5') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p6') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p7') }}
                        </p>
                        <p>
                            {{ $t('privacy.a3.p8') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a4.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('privacy.a4.p1') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a5.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p v-html="$t('privacy.a5.p1')"></p>
                        <p>
                            {{ $t('privacy.a5.p2') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a6.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p v-html="$t('privacy.a6.p1')"></p>
                        <p v-html="$t('privacy.a6.p2')"></p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a7.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('privacy.a7.p1') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a8.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a8.p1') }}
                        </p>
                        <p>
                            {{ $t('privacy.a8.p2') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a9.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3 mb-6">
                        {{ $t('privacy.a9.p1') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a10.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a10.p1') }}
                        </p>
                        <p>
                            {{ $t('privacy.a10.p2') }}
                        </p>
                        <p>
                            {{ $t('privacy.a10.p3') }}
                        </p>
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a11.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        {{ $t('privacy.a10.p1') }}
                    </div>
                </div>
                <div class="mb-6">
                    <div class="item-content policy-title">
                        {{ $t('privacy.a12.lead') }}
                    </div>
                    <div class="item-title line-height grey--text text--darken-3">
                        <p>
                            {{ $t('privacy.a12.p1') }}
                        </p>
                        <p v-html="$t('privacy.a12.p2')"></p>
                    </div>
                </div>
                
                <!-- <div class="jp-font-400 grey--text text--darken-2 mb-4">
                    このページは、ただいま準備中です。
                </div> -->
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
    
    },
    methods: {
      

        
    }


}
</script>

<style>
.policy-title{
    font-size: 14px;
}

.item-title a{
    text-decoration: none;
}

</style>