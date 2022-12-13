import axios  from "axios";
import {mapGetters} from "vuex";
import loginPage from "./loginPage";
export default {
    name: "NewsDetails",
    data() {
        return {
            postId: 0,
            posts:{},
            tokenStatus:false,
            viewCount:0
        };
    },
    computed:{
      ...mapGetters(['storageToken','storageUserData']),
  },
    methods: {
        loadPost(id) {
            let post={
              postId:id,
            }
            axios.post("http://localhost:8000/api/post/detail",post).then((response)=>{
            
              if(response.data.post.image !=null){
                response.data.post.image="http://localhost:8000/postImage/"+response.data.post.image;
              }else{
                response.data.post.image="http://localhost:8000/defaultPIC/defaultPIC.png";
              }
       
            this.posts=response.data.post;
            console.log(this.posts);
          });
         
        },
        back(){
            history.back();

            // this.$router.push({
            //     name: "newsDetails",
    
            //   });  same with history.back()
        },
        home(){
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
        checkToken(){
          if(this.storageToken != null && this.storageToken !=undefined && this.storageToken !=""){
            this.tokenStatus=true;
          }else{
            this.tokenStatus=false;
          }
        },
        viewCountLoad(){
          let data={
            user_id: this.storageUserData.id,
            post_id:this.$route.params.newsId
          }
          axios.post("http://localhost:8000/api/post/actionLog",data).then((response)=>{
                
            this.viewCount=response.data.post.length;
           console.log(response.data.post);
        });
        }
        
    },
    mounted () {
      this.viewCountLoad();
      this.checkToken();
        this.postId=this.$route.params.newsId;
        this.loadPost(this.postId);
    },
}