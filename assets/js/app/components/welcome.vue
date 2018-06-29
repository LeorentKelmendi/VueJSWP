<template>
<div>
  <div class="container">
    <div class="row">


    <div class="col-md-4 fixedt" >
        <div class="search-blog-input">
        <h3>Search Blog</h3>
        <div class="card" style="width: 18rem;">
          <div class="card-header">
           <input class="list-group-item" value="" v-model="search" v-on:keyup="searchBlog()" autocomplete="off" />
          </div>
          <ul class="list-group list-group-flush ">
            <li class="list-group-item"  style="cursor: pointer">This is a result</li>
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
          search:'',
          baseUrl:'http://vuewp.me/wp-json/wp/v2/',
          searchResults:[]
        }
      },
      methods:{
        searchBlog(){
          if(this.search.length > 3 ){
            axios.get(this.baseUrl+'posts?search='+this.search).then((results) =>{
                this.searchResults = response.data
            }).catch((error)=>{
                console.log(error.data)
            });
          }
        }
      }
    }
</script>
