<template>
  <nav>
    <v-app-bar
      flat app color="white"
    >
        <v-app-bar-nav-icon
            class="mr-6"
            @click.stop="drawer = !drawer"
        ></v-app-bar-nav-icon>

        <router-link
            to="/"
        >
            <v-app-bar-title>
                <v-img
                    max-width=120
                    height=auto
                    v-if="$vuetify.breakpoint.md || $vuetify.breakpoint.lg"
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo_latest.png"
                >
                </v-img>
                <v-img
                    max-width=120px
                    height=auto
                    v-if="$vuetify.breakpoint.xs || $vuetify.breakpoint.sm"
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/logo.png"
                >
                </v-img>
            </v-app-bar-title>
        </router-link>
        <v-spacer></v-spacer>
        <v-switch
            class="pt-5 mr-6"
            v-model="language"
            label="EN"
        ></v-switch>
        <v-badge
            color="error"
            :content="cartQuantity"
            :value="itemNumber"
            class="mr-4"
            overlap
        >            
            <v-icon
                @click="$router.push({name: 'cart'})"
            >$vuetify.icons.basket</v-icon>
        </v-badge>
    </v-app-bar>

    <v-navigation-drawer
        v-model="drawer"
        app
        temporary
        :close-on-content-click="closeOnContentClick"
    >
        <v-row>
            <v-col cols="12" align="center" class="mt-5">
                <v-img
                    max-width=90
                    src="https://aya-and-co.s3.ap-northeast-1.amazonaws.com/tree.png"
                >
                </v-img>
            </v-col>
            <!-- <v-col class="mt-4 mb-3 text-center">
                <Popup @projectAdded="snackbar = true"/>
            </v-col> -->
        </v-row>
        <v-list
            nav
            dense
        >
            <v-list-item-group
                v-model="group1"
                color="primary"
            >
                <v-list-item v-for="link in links" :key="link.title" router :to="link.route">
                    <v-list-item-title class="font-300">{{$t(link.title)}}</v-list-item-title>
                </v-list-item>
                <!-- <v-list-item router :to="home">
                    <v-list-item-title class="jp-font-300">ホーム</v-list-item-title>
                </v-list-item>
                  <v-list-item router :to="cart">
                    <v-list-item-title class="jp-font-300">カート</v-list-item-title>
                </v-list-item> -->
            </v-list-item-group>

            <v-divider class="my-2"></v-divider>

            <v-list-item-group
                v-model="group2"
                color="primary"
            >
                <v-list-item
                    v-for="product in products" :key="product.title"
                    route :to="product.route"
                >
                    <v-list-item-title v-text="$t(product.title)" class="font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>

             <!-- <v-list-group
                :value="true"
                no-action
            >
                <template v-slot:activator>
                    <v-list-item-title class="jp-font-300">商品アイテム</v-list-item-title>
                </template>

                    <v-list-item
                        v-for="product in products" :key="product.title"
                        route :to="product.route"
                    >
                        <v-list-item-title v-text="product.title" class="product-name"></v-list-item-title>
                    </v-list-item>

            </v-list-group> -->

            <v-divider class="my-2"></v-divider>

            <v-list-group
                :value="true"
                v-if="user !== null"
                no-action
            >
                <template v-slot:activator>
                    <v-list-item-title class="font-300">{{$t('nav.member')}}</v-list-item-title>
                </template>

                    <v-list-item
                        v-for="item in members" :key="item.title"
                        route :to="item.route"
                    >
                        <v-list-item-title v-text="$t(item.title)" class="font-300"></v-list-item-title>
                    </v-list-item>
                    <v-list-item
                        @click="logout"
                    >
                        <v-list-item-title>{{$t('nav.logout')}}</v-list-item-title>
                            <form id="logout-form" action="/logout" method="POST">
                            <input type="hidden" name="_token" :value="token">
                            </form>
                    </v-list-item>

            </v-list-group>

            <v-list-item-group
                v-model="group3"
                v-if="user === null"
                color="primary"
            >
                <v-list-item
                    v-for="item in guests" :key="item.title"
                    route :to="item.route"
                >
                    <v-list-item-title v-text="$t(item.title)" class="font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>

            <v-divider class="my-2"></v-divider>

            <v-list-item-group
                v-model="group4"
                color="primary"
            >
                <v-list-item
                    v-for="item in items" :key="item.title"
                    route :to="item.route"
                >
                    <v-list-item-title v-text="$t(item.title)" class="font-300"></v-list-item-title>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>

  </nav>
</template>

<script>
import { mapState } from 'vuex'

  export default {
    props: {
        user: Object
    },
    data: () => ({
        // language: false,
        drawer: false,
        group1: null,
        group2: null,
        group3: null,
        group4: null,
        // itemNumber: 0,
      links: [
        { title: 'nav.home', route: '/' },
        { title: 'nav.cart', route: '/cart' },
        { title: 'nav.sustainability', route: '/sustainability'},
       ],
    //   products: [
    //     { title: 'Summer Meets Autumn', route: '/products/1' },
    //     { title: 'Vintage', route: '/products/2' },
    //     { title: 'Morning', route: '/products/3' },
    //     { title: 'Serenity', route: '/products/4' },
    //     { title: 'Blush', route: '/products/5' },
    //     { title: 'Miss You', route: '/products/6' },
    //     { title: 'Praise', route: '/products/7' },
    //     { title: 'Lemonade', route: '/products/8' },
    //   ],
      products: [
          {title: 'nav.products', route:'/products-list'},
          {title: 'nav.delivery', route: '/postage'},
          {title: 'nav.card', route: '/message-service'},
      ],
      members: [
        {title: 'nav.summary', route: '/member/summary'},
        {title: 'nav.profile', route: "/member/profile"},
        //{title: '配送先の編集', route: "/member/addresses"},
      ],
      guests: [
        {title: 'nav.login', route: "/guest/login"},
        {title: 'nav.register', route: '/guest/register'},
      ],
      items:  [
        {title: 'nav.contact', route: '/contact'},
        //{title: 'よくある質問', route: "/faq"},
        {title: 'nav.policy', route:"/policy"},
        {title: 'nav.privacy', route:"/privacy-policy"},
        {title: 'nav.about', route:"/about"}
      ],
      closeOnContentClick: true,
    }),
    watch: {
        group(){
            this.drawer = false
        },
        language(newValue){
            let lang = newValue

            if(lang == true){
                // this.$store.commit('language/language', {
                //     lang: 'en'
                // });
                this.$i18n.locale = 'en'
                this.$store.dispatch('language/setLang', {
                    lang: "en"
                });
                // this.$store.commit('language/setEnglishSnackbar', true)
            }else{
                // this.$store.commit('language/language', {
                //     lang: 'ja'
                // });
                this.$i18n.locale = 'ja'
                this.$store.dispatch('language/setLang', {
                    lang: "ja"
                });
            }
            // console.log(newValue)
        }
    },
    mounted() {
        // this.$store.dispatch('student/fetchStudentUser');
        // this.$store.dispatch('student/fetchInitials');
    },
    computed: {
        token() {
            let token = document.head.querySelector('meta[name="csrf-token"]');
            return token.content
        },
        ...mapState([
            'cart',
            'lang'
            // 'user',
            // 'initials',
            // 'isLoggedIn',
        ]),
        language: {
            get(){                
                return this.lang
            },
            set (value) {
                this.$store.commit('setLanguage', value)
            }
        },
        itemNumber(){
            if(this.cart.length > 0){
                return true
            }else{
                return false
            }
        },
        cartQuantity(){
            return this.$store.state.cart.reduce((acc,item) => acc + Number(item.quantity), 0);
        },
    },
    methods: {
        logout() {
            document.getElementById('logout-form').submit();
        },
        toTopPage(){
          this.$router.push({path: '/'})
        },
        // toLogin(){
        //     window.location.href = "/student/login";
        // },
        toLogin(){
          this.$router.push({name: 'login'})
        },
        toRegister(){
          this.$router.push({name: 'register'})
        }
    }
  }
</script>
<style>
.logo-image{
    width: 100%;
    height: 100%;
}
.font-300{
  font-weight: 300;
}

.v-list--dense .v-list-item .v-list-item__title{
   font-weight:400;
}

.top-title{
    font-family: mrs-eaves-roman-all-small-ca, sans-serif;
    font-weight: 400;
    font-style: normal;
}
.v-toolbar__content{
    margin-bottom: 40px;
}

@media(max-width:780px){
    .v-navigation-drawer{
        display: list-item;
    }
    
}

</style>