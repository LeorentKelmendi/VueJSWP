<template>
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 jumbotron" style="margin-bottom:100px" v-if="showpost">
        <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h3 class="card-title">{{ post.title.rendered }}</h3>
          <p class="card-text" v-html="post.content.rendered"> </p>
          <div>
          <a  class="btn btn-primary" style="margin-top: 5px;" v-on:click="editPost(post)">Edit Post</a>
          <a  class="btn btn-danger" style="margin-top: 5px;" v-on:click="deletePost(post)">Delete Post</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8 jumbotron" style="inline-block" v-if="edit">
        <div class="card" >
        <div class="card-body">
          <label for="title">Post Title</label>
          <input type="text" name="" class="form-control" v-model="title">
          <label>Post Body</label>
          <textarea v-html="body" class="form-control"> </textarea>
          <a href="#" class="btn btn-primary" style="margin-top:10px;" v-on:click="updatePost(post)">Update</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 fixedt" >
        <div class="search-blog-input">
        <h3>Search Blog</h3>
        <div class="card" style="width: 18rem;">
          <div class="card-header">
           <input class="list-group-item" v-on:keyup="autoComplete" autocomplete="off" type="text" v-model="search" placeholder="Type and hit enter" value=""/>
          </div>
          <ul class="list-group list-group-flush "  v-if="posts.length && clicked">
            <li class="list-group-item"  v-for="(post, index) in posts" style="cursor: pointer" v-on:click="showPost(post)">{{ post.title.rendered}}</li>
          </ul>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import swal from 'sweetalert';
    export default {
        data(){
          return{
            search:null,
            posts:[],
            showpost:false,
            post:null,
            basepath:'http://vuewp.me/wp-json/wp/v2/',
            tokenEndpoint: 'http://vuewp.me/wp-json/jwt-auth/v1/token',
            jwtToken:'',
            clicked:true,
            edit:false,
            title:'',
            body:'',
          }
        },
        methods:{
         showPost(post){
            this.showpost= !this.showpost;
            this.post = post;
            this.clicked = false
         },
         autoComplete(){
            axios.get(this.basepath+"posts?search="+this.search).then(response=>{
                console.log(response.data[0]);
                this.posts = response.data;
               }).catch(error=>{
           });
          },
         credentials(){
          return{
            'username':'leo',
            'password':'trancezonale321'
          }
         },
         updatePost(post){
          if(this.title === ''){
            swal("Please fill title",{icon:"error"});
          }
          axios.post(this.basepath+'posts/'+post.id,{title:this.title},{
            headers:{'Authorization': 'Bearer ' + this.jwtToken,
                      'Content-Type': 'Application/json',
                      'Accept' : 'Application/json'
                    }
          }).then(response=>{
             swal("Success",{icon:"success"});
             this.edit = false;
             this.post = response.data;
          }).catch(error=>{
             swal("Something went wrong!",{icon:"error"});
          });
         },
         editPost(post){
          this.edit = true;
          this.title = post.title.rendered;
          this.body =post.content.rendered;
         },
         requestJWT(){
            axios.post(this.tokenEndpoint,this.credentials()).then(response=>{
              this.jwtToken = response.data.token;
            }).catch(error=>{
              console.log(error.data);
            });
         },
         deletePost(post){
             swal({
                title: "Are you sure ?",
                text: "Are you sure you want to delete this post",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete)=>{
                if(willDelete){
                  axios.delete(this.basepath+"posts/"+post.id, {
                    headers:{'Authorization': 'Bearer ' + this.jwtToken}
                  }).then(response=>{
                  swal("Posting has been deleted", {icon:"success"});
                  }).catch(error=>{
                  swal(error.message, {icon:"error"});
                  });
                }else{
                  swal("Canceled", {icon:"error"})
                }
             });
         }
        },
        mounted() {
          this.requestJWT();
        }
    }
</script>
<style>
.fixedt{
   position: fixed; top: 20px; left: 20px;
}
</style>