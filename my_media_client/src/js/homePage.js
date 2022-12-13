import axios  from "axios";
import {mapGetters} from "vuex";
export default {
       name : "HomePage",
       data(){
        return {
           postLists:{},    
           categoryList:{},
           searchKey:"",
           tokenStatus:false,
        };
       },
       computed:{
        ...mapGetters(['storageToken','storageUserData']),
    },
       methods: {
        getAllPost() {
           axios.get("http://localhost:8000/api/allPost").then((response)=>{
           
                // this.postLists=response.data.post;
                // console.log(this.postLists);
                for(let i=0;i<response.data.post.length;i++){
                  if(response.data.post[i].image !=null){
                    response.data.post[i].image="http://localhost:8000/postImage/"+response.data.post[i].image;
                  }else{
                    response.data.post[i].image="http://localhost:8000/defaultPIC/defaultPIC.png";
                  }
                }
             
                 this.postLists=response.data.post;
            }).catch((error)=>{
              console.log(error);
            });
          
           
        },
        loadCategory(){
          axios.get("http://localhost:8000/api/allCategory").then((response)=>{
            this.categoryList=response.data.category;
        }).catch((error)=>{
          console.log(error);
        });
        },
        search(){
          let search={
            key: this.searchKey,
          }
          console.log('data searching ...');
          axios.post("http://localhost:8000/api/post/search",search).then((response)=>{
            for(let i=0;i<response.data.searchData.length;i++){
              if(response.data.searchData[i].image !=null){
                response.data.searchData[i].image="http://localhost:8000/postImage/"+response.data.searchData[i].image;
              }else{
                response.data.searchData[i].image="http://localhost:8000/defaultPIC/defaultPIC.png";
              }
            }
         
            
            this.postLists=response.data.searchData;
          });
        },
        newDetails(id){
          console.log(id);
          this.$router.push({
            name: "newsDetails",
            params :{
              newsId: id,
            },
          });

        },
        categorySearch(searchKey){
          let search={
            key: searchKey
          };
          axios.post("http://localhost:8000/api/category/search",search).then((response)=>{
            for(let i=0;i<response.data.result.length;i++){
              if(response.data.result[i].image !=null){
                response.data.result[i].image="http://localhost:8000/postImage/"+response.data.result[i].image;
              }else{
                response.data.result[i].image="http://localhost:8000/defaultPIC/defaultPIC.png";
              }
            }


           console.log(response.data.result);
           this.postLists=response.data.result;
          }).catch((error)=> console.log(error));
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
      checkToken(){
        if(this.storageToken != null && this.storageToken !=undefined && this.storageToken !=""){
          this.tokenStatus=true;
        }else{
          this.tokenStatus=false;
        }
      },
      logout(){
        this.$store.dispatch("setToken",null);
        this.login();
      }
       },

       mounted() {
        this.checkToken();
        console.log(this.storageToken);
         this.getAllPost();
         this.loadCategory();
       },
};
