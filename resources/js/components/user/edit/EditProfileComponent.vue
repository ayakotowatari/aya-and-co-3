<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="12" sm="12" md="12">
                    <div class="heading-group">
                        <div class="page-heading">
                            Edit Profile
                        </div>
                        <div class="page-subtitle grey--text text--darken-3">
                            プロフィール編集
                        </div>
                    </div>
                </v-col>
            </v-row>
            <v-row>
                <v-col cols="12" sm="12" md="4">
                    
                </v-col>
                <v-col cols="12" sm="12" md="8">
                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                {{ $t('edit.name') }}
                            </div>
                            <div v-if="$i18n.locale == 'ja'" class="item-title grey--text text--darken-3 mb-3">
                                {{ user.name }}（{{ user.kana }}）様
                            </div>
                            <div v-else class="item-title grey--text text--darken-3 mb-3">
                                {{ user.name }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditingName"
                                    @click="$store.commit('setIsEditingName', true)"
                                >
                                    {{ $t('edit.btn')}}
                                </v-btn>
                            </div>
                            <div v-if="isEditingName">
                                <editname-component
                                    v-bind:user='user'
                                ></editname-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                {{ $t('edit.address') }}
                            </div>
                            <div class="mb-3">
                                <div class="mb-2">
                                    <div class="item-title grey--text text--darken-3">
                                        〒{{ user.zipcode }} {{ user.prefecture}}{{ user.city }}{{ user.address_1 }}
                                    </div>
                                    <div v-if="user.building !== null" class="item-title grey--text text--darken-3">
                                        {{ user.building }}
                                    </div>
                                </div>
                                <div>
                                    {{ user.phone }}
                                </div>
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditingAddress"
                                    @click="$store.commit('setIsEditingAddress', true)"
                                >
                                    {{ $t('edit.btn')}}
                                </v-btn>
                            </div>
                            <div v-if="isEditingAddress">
                                <editaddress-component
                                    v-bind:user='user'
                                ></editaddress-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                {{ $t('edit.email.email') }}
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                {{ user.email }}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditingEmail"
                                    @click="$store.commit('setIsEditingEmail', true)"
                                >
                                    {{ $t('edit.btn')}}
                                </v-btn>
                            </div>
                            <div v-if="isEditingEmail">
                                <editemail-component
                                    v-bind:user='user'
                                ></editemail-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                {{ $t('edit.password.password')}}
                            </div>
                            <div class="item-title grey--text text--darken-3 mb-3">
                                ********
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    v-if="!isEditingPassword"
                                    @click="$store.commit('setIsEditingPassword', true)"
                                >
                                    {{ $t('edit.btn')}}
                                </v-btn>
                            </div>
                            <div v-if="isEditingPassword">
                                <editpassword-component
                                    v-bind:user='user'
                                ></editpassword-component>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <div class="mb-6">
                            <div v-if="user.unsubscribe !== 1">
                                <div class="item-content policy-title mb-3">
                                    {{ $t('edit.subscription.subscription')}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="$store.commit('setDialogUnsubscribe', true)"
                                    >
                                        {{ $t('edit.subscription.stop')}}
                                    </v-btn>
                                </div>
                            </div>
                            <div v-else>
                                <div class="item-title grey--text text--darken-3 mb-3">
                                    {{ $t('edit.subscription.message')}}
                                </div>
                                <div>
                                    <v-btn
                                        color="primary"
                                        outlined
                                        @click="$store.commit('setDialogSubscribe', true)"
                                    >
                                        {{ $t('edit.subscription.restart')}}
                                    </v-btn>
                                </div>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider>

                        <!-- <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                クーポン
                            </div>
                            <div v-for="coupon in coupons" :key="coupon.id">
                                <div class="item-title grey--text text--darken-3 mb-3">
                                    {{coupon.name}}
                                </div>
                            </div>
                        </div>

                        <v-divider class="mb-6"></v-divider> -->

                        <div class="mb-6">
                            <div class="item-content policy-title mb-3">
                                {{ $t('edit.account')}}
                            </div>
                            <div>
                                <v-btn
                                    color="primary"
                                    outlined
                                    @click="$store.commit('setDialogDeleteUser', true)"
                                >
                                    {{ $t('edit.delete.btn')}}
                                </v-btn>
                            </div>
                        </div>
                </v-col>
            </v-row>
        </v-container>
        <unsubscribedialog-component
            v-bind:user="user"
            v-bind:dialogUnsubscribe="dialogUnsubscribe"
        ></unsubscribedialog-component>
        <subscribedialog-component
            v-bind:user="user"
            v-bind:dialogSubscribe="dialogSubscribe"
        ></subscribedialog-component>
        <deleteuserdialog-component
            v-bind:user="user"
            v-bind:dialogDeleteUser="dialogDeleteUser"
        ></deleteuserdialog-component>
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
        // this.$store.dispatch('coupon/fetchCoupons');
    },
    created(){
     
    },
    computed: {
        ...mapState([
            'user',
            'isEditingName',
            'isEditingAddress',
            'isEditingEmail',
            'isEditingPassword',
            'dialogUnsubscribe',
            'dialogSubscribe',
            'dialogDeleteUser',
        ]),
        // ...mapState('coupon', [
        //     'coupons'
        // ])
    
    },
    methods: {
        ...mapActions([
            'deleteUser'
        ])
      

        
    }


}
</script>

<style>
.mb60 {
  margin-bottom: 60px;

}

@media(max-width:780px){
    .pine-image{
      max-width: 90px;
    }
}

</style>