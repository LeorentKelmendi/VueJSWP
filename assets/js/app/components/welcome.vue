<template>
<div>
 <div class="widget">
    <h3 class="margin-top-0 margin-bottom-25">Search Blog</h3>
    <div class="search-blog-input">
        <div class="input">
         <input class="search-field" v-on:keyup="autoComplete" autocomplete="off" type="text" v-model="search" placeholder="Type and hit enter" value=""/>
            <div class="panel-footer" v-if="posts.length">
                <ul class="list-group" style="list-style-type: none">
                    <li class="list-group-item" v-for="(post, index) in posts" style="cursor: pointer" v-on:click="showPost(post)">{{ post.title.rendered }}</li>
                </ul>
            </div>
        </div>
    </div>
   <div class="clearfix"></div>
</div>
<div class="widget" v-if="showpost">
    <h3>{{ post.title.rendered }}</h3>
    <div>
        <p>{{ post.excerpt.rendered }}</p>
    </div>
</div>
</div>
</template>
<script>
    export default {
        data(){
          return{
            search:null,
            posts:[],
            showpost:false,
            post:null
          }
        },
        methods:{
         showPost(post){
            this.showpost= !this.showpost;
            this.post = post;
         },
         autoComplete(){
            axios.post("http://vuewp.me/wp-json/wp/send-contact-form/v2/contact").then(response=>{
                console.log(response.data[0]);
                this.posts = response.data;
               }).catch(error=>{
           });
            }
        },
        mounted() {

        }
    }
</script>

