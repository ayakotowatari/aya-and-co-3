<template>
<div>
    <v-app>
        <!-- <passwordresetsnackbar-component
            v-bind:passwordResetSnackbar="passwordResetSnackbar"
        ></passwordresetsnackbar-component> -->
        <!-- <navbar-component></navbar-component> -->
        <v-main class="my48">
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
                        <v-row>
                            <v-col cols="12" sm="12" md="6">
                                <v-form 
                                        ref="form"
                                        v-model="valid"
                                        lazy-validation
                                    >
                                        <!-- <input type="hidden" name="token" :value="token"> -->

                                        <v-row justify="center">
                                        <v-col cols="12" sm="12" md="12">
                                            <v-text-field
                                                :value="email"
                                                :label="title_email" 
                                                outlined
                                                readonly
                                            ></v-text-field>
                                            <v-text-field 
                                                v-model="password"
                                                :label="newpassword" 
                                                outlined
                                                required
                                                :rules="passwordRules" 
                                                :error="errorMessage"
                                                :error-messages="errorMessage"
                                            ></v-text-field>
                                            <v-text-field 
                                                v-model="password_confirmation"
                                                :label="confirm_newpassword" 
                                                outlined
                                                required
                                                :rules="confirmPasswordRules" 
                                                :error="errorMessage"
                                                :error-messages="errorMessage"
                                            ></v-text-field>

                                            <v-btn 
                                                block 
                                                dark 
                                                color="primary" 
                                                class="mb-2" 
                                                @click="reset"
                                                :loading="loading"
                                                :disabled="disableInputPassword"
                                            >
                                                <span v-if="lang == 'ja'">パスワードをリセットする</span><span v-else>Reset Password</span>
                                            </v-btn>
                                            <!-- <v-btn text color="primary" class="pa-0" @click.stop="toLogin()">ログインする</v-btn> -->
                                        </v-col>
                                    </v-row>
                                    <!-- <input type="hidden" name="event_id" :value="eventId"> -->
                                </v-form>
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
        <footer-component></footer-component>
    </v-app>
</div>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    props: ['email', 'token', 'lang'],
    data: function(){
        return {
            valid: true,
            // token: '',
            // email: '',
            password: '',
            password_confirmation: '', 
        }
    },
    mounted(){
        // this.$store.dispatch('fetchUser');
        // console.log(this.$route.query.email)
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
            'disableInputPassword',
            'passwordResetSnackbar',
            // 'user',
        ]),
        title_email(){
            if(this.lang == 'ja'){
                return 'メールアドレス';
            }else{
                return 'Email';
            }
        },
        newpassword(){
            if(this.lang == 'ja'){
                return '新しいパスワード';
            }else{
                return 'New Password';
            }
        },
        confirm_newpassword(){
            if(this.lang == 'ja'){
                return '新しいパスワードを確認する';
            }else{
                return 'Confirm New Password';
            }
        },
         passwordRules(){
            return[
                (v) => !!v || this.$t('register.password_rule'),
                (v) => v.length >= 8 || this.$t('register.password_rule2')
            ];
        },
        confirmPasswordRules(){
            return[
                (v) => !!v || this.$t('register.confirmPassword_rule'),
                (v) => v == this.password || this.$t('register.confirmPassword_rule2')
            ];
        },
    },
    methods: {
        ...mapActions([
            'resetPassword',
        ]),
       reset(){

        //    console.log(this.token)

           this.$store.commit('setLoading', true);

           if(this.$refs.form.validate()){
            //    console.log('request');

               this.resetPassword({
                   token: this.token,
                   email: this.email,
                   password: this.password,
                   password_confirmation: this.password_confirmation,
               })
               
           }

       },
    }
}
</script>

<style>
.my48 {
    margin-top: 48px;
    margin-bottom: 48px;
}

</style>