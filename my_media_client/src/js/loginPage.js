import axios  from "axios";
import {mapGetters} from "vuex";
export default {
    name:'LoginPage',
    data() {
        return {
            userData:{
                email:'',
                password:'',
            },
            tokenStatus:false,
            userStatus:false
       
        }
    },
    computed:{
        ...mapGetters(['storageToken','storageUserData']),
    },

    methods: {
        home() {
            this.$router.push({
                name:'home'
            });
        },
        login(){
            this.$router.push({
                name:'login'
            });
        },
        logout(){
            this.$store.dispatch("setToken",null);
            this.login();
          },
        accountLogin(){
             
              axios.post("http://localhost:8000/api/user/login",this.userData).then((response)=>{
             
              if(response.data.token == null){
                this.userStatus=true;
              }else{
                this.userStatus=false;
                this.storeUserInfo(response);
                this.home();
               
              }

            }).catch((error)=>{
                console.log(error);
              });
        },
        storeUserInfo(response){
            this.$store.dispatch("setToken",response.data.token);
            this.$store.dispatch("setUserData",response.data.user);
            this.$router.push({
                name:'home'
            });
         
        },
        // checkToken(){
        //     console.log(this.storageToken);
        //     console.group(this.storageUserData);
        // }
        checkToken(){
            if(this.storageToken != null && this.storageToken !=undefined && this.storageToken !=""){
              this.tokenStatus=true;
            }else{
              this.tokenStatus=false;
            }
          }
    },
    mounted () {
        this.checkToken();
         
      },
};