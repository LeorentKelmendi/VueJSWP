<template>
<div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 jumbotron" style="margin-bottom:100px"  >
        <div class="card" style="width: 18rem;">
        <div class="card-body">
          <h3 class="card-title">Title</h3>
          <p class="card-text"  >Here goes the body</p>
          <div>
          <a  class="btn btn-primary" style="margin-top: 5px;" >Edit Post</a>
          <a  class="btn btn-danger" style="margin-top: 5px;"  >Delete Post</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-8 jumbotron" style="inline-block" >
        <div class="card" >
        <div class="card-body">
          <label for="title">Post Title</label>
          <input type="text" name="" class="form-control" >
          <label>Post Body</label>
          <textarea  class="form-control"> </textarea>
          <a href="#" class="btn btn-primary" style="margin-top:10px;">Update</a>
        </div>
      </div>
    </div>

    <div class="col-md-4 fixedt" >
        <div class="search-blog-input">
        <h3>Search Blog</h3>
        <div class="card" style="width: 18rem;">
          <div class="card-header">
           <input class="list-group-item" value=""/>
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

    }
</script>
<style>
.fixedt{
   position: fixed; top: 20px; left: 20px;
}
</style>