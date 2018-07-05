<template>
<div>
<div class="col-md-4 fixedt" >
    <div class="search-blog-input">
    <h3>Search Blog</h3>
    <div class="card" style="width: 18rem;">
      <div class="card-header">
       <input class="list-group-item" value=""
       v-model="searchQuery"
       v-on:keyup="autocomplete()"/>
      </div>
      <ul class="list-group list-group-flush ">
        <li class="list-group-item"
        v-for="post in posts"
        style="cursor: pointer"
        v-on:click="showPost(post)"
        >
            {{ post.title.rendered }}
        </li>
      </ul>
    </div>
    </div>
  </div>


<div class="col-md-8 jumbotron" style="margin-bottom:100px"  v-if="currentPost">
<div class="card" style="width: 18rem;">
<div class="card-body">
  <h3 class="card-title">{{ selectedPost.title }}</h3>
  <p class="card-text" v-html="selectedPost.body"> </p>
  <div>
  <a  class="btn btn-primary" style="margin-top: 5px;" >Edit Post</a>
  <a  class="btn btn-danger" style="margin-top: 5px;" v-on:click="deletePost()">Delete Post</a>
  </div>
</div>
</div>
</div>

</div>
</template>
<script>
export default{
    data(){
    return{
      searchQuery:'',
      baseUrl:'http://vuewp.me/wp-json/leo/v1/',
      posts:[],
      currentPost:false,
      selectedPost:{
        id:'',
        title:'',
        body:'',
      }
    }
    },
    methods:{
        autocomplete(){
        axios.get(this.baseUrl+'search/posts/'+this.searchQuery).then(response=>{
            this.posts = response.data;
        }).catch(error=>{
            console.log(error.data);
        });
        },
        showPost(post){
        this.currentPost = true;
        this.selectedPost.id = post.id;
        this.selectedPost.title = post.title.rendered;
        this.selectedPost.body = post.content.rendered;
        },
        deletePost(){
           swal({
            title:'Are you sure you want to delete this?',
            icon:'warning',
            buttons:true,
            dangerMode:true,
           }).then((willDelete)=>{
            if(willDelete){
                axios.delete(this.baseUrl+'posts/'+this.selectedPost.id).then(response=>{
                    swal("Post has been deleted!",{icon:"success"});
                }).catch(error=>{
                    swal("Something went wrong!",{icon:"error", timer:2000});
                });
            }else{
                swal("Your post is not deleted!",{icon:"warning"});
            }
           })
        }
    },
    mounted(){

    }
}
</script>
