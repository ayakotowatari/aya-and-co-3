<template>
<div>
            <v-container>
                 <v-row>
                    <v-col cols="12" sm="12" md="12">
                        <div class="heading-group">
                            <div class="page-heading">
                                Reset Password
                            </div>
                            <div class="page-subtitle grey--text text--darken-3">
                                パスワードをリセットする
                            </div>
                        </div>
                    </v-col>
                    </v-row>
                    <v-row>
                        <v-col cols="12" sm="12" md="4" class="hidden-sm-and-down">

                        </v-col>
                        <v-col cols="12" sm="12" md="8">
                            <div>

                            </div>
                            <v-form 
                                ref="form"
                                v-model="valid"
                                lazy-validation
                            >
                                <v-row>
                                    <v-col cols="12" sm="12" md="6">
                                        <v-text-field
                                            v-model='email'
                                            :label="$t('register.email')"
                                            outlined
                                            required
                                            :rules="emailRules"
                                            validate-on-blur
                                            @blur="() => $refs.form.resetValidation()"
                                            :error = "errorMessage ? true : false"
                                            :error-messages="errorMessage"
                                        ></v-text-field>
                                        <div class="mb-1">
                                            <v-row>
                                                <v-col cols="12" sm="12" md="12" class="hidden-sm-and-down">
                                                    <v-btn 
                                                        dark 
                                                        color="primary" 
                                                        @click="reset()"
                                                        :loading="loading"
                                                        :disabled="disabled.sendResetLink"
                                                        :class="btnClasses"
                                                        class="mr-2"
                                                    >
                                                        {{$t('btn.reset_password')}}
                                                    </v-btn>
                                                    <v-btn
                                                        color="primary"
                                                        outlined
                                                        :disabled="disabled.resetEmail"
                                                        @click="resetInput()"
                                                    >
                                                        {{$t('btn.reset_email')}}
                                                    </v-btn>
                                                </v-col>
                                                <!-- <v-col cols="12" sm="12" md="3" class="hidden-sm-and-down">
                                                    <v-btn outlined color="primary" @click="reset">入力内容をリセットする</v-btn>
                                                </v-col> -->
                                                <v-col cols="12" sm="12" md="12" class="hidden-md-and-up">
                                                    <v-btn 
                                                        block 
                                                        dark 
                                                        color="primary" 
                                                        @click="reset()"
                                                        :loading="loading"
                                                        :disabled="disabled.sendResetLink"
                                                        class="mb-2"
                                                    >
                                                        {{$t('btn.reset_password')}}
                                                    </v-btn>
                                                     <v-btn
                                                        block
                                                        color="primary"
                                                        outlined
                                                        :disabled="disabled.resetEmail"
                                                    >
                                                        {{$t('btn.reset_email')}}
                                                    </v-btn>
                                                </v-col>
                                                <!-- <v-col cols="12" sm="12" md="3" class="hidden-md-and-up">
                                                    <v-btn block outlined color="primary" @click="reset">入力内容をリセットする</v-btn>
                                                </v-col> -->
                                            </v-row>
                                        </div>
                                    </v-col>
                                </v-row>
                            <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                        </v-form>
                    </v-col>
                </v-row>
            </v-container>
            <!-- <linksentsnackbar-component
                v-bind:linkSentSnackbar="linkSentSnackbar"
            ></linksentsnackbar-component> -->
             <linksentdialog-component
                v-bind:dialogLinkSent="dialogLinkSent"
            ></linksentdialog-component>
</div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data: function(){
        return {
            valid: true,
            email: '',
        }
    },
    mounted(){
        // this.$store.dispatch('fetchUser');
    },
    created(){
      // this.$store.dispatch('fetchProducts');  

        // this.fetchProducts();

      // this.fetchUser();
      // this.fetchInst();
      // this.fetchInitials();

    },
    computed: {
        ...mapState([
            'errorMessage',
            'loading',
            'disabled',
            // 'disableInputEmail',
            'linkSentSnackbar',
            'dialogLinkSent',
            // 'user',
        ]),
        btnClasses(){
            if(this.$i18n.locale == 'en'){
                return 'en-btn-mb'
            }
        },
        emailRules() {
            return [
                (v) => !!v || this.$t('register.email_rule'),
                (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || this.$t('register.email_rule2')
            ];
        },
    },
    methods: {
        ...mapActions([
            'sendResetLink',
        ]),
        reset(){

            this.$store.commit('setLoading', true);

            if(this.$refs.form.validate()){
                this.sendResetLink({
                    url: "/password/email",
                    email: this.email,
                })
            }
        },
        resetInput(){
            
            this.$refs.form.reset();
            this.$store.commit('setErrorMessage', '');
            this.$store.commit('setDisabledSendResetLink', false);
            this.$store.commit('setDisabledResetEmail', true);
        }
    }
}
</script>

<style>
.en-btn-mb{
    margin-bottom: 16px;
}

</style>