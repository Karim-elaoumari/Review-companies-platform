<script>
</script>
<template>
<nav class="navbar bg-primary navbar-expand-lg" data-bs-theme="dark">
  
  <div class="container-fluid bg-primary">
    <a class="navbar-brand" href="#">
      <img src="https://w7.pngwing.com/pngs/361/627/png-transparent-leaf-logo-green-leaves-green-and-teal-leaf-logo-text-maple-leaf-grass.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
      BS
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <router-link to="/" class="nav-link active">Home</router-link>
        </li>
        <li class="nav-item">
            <router-link to="/posts" class="nav-link active">posts</router-link>
        </li>
        <li class="nav-item">
            <router-link to="/create-post" class="nav-link active">create post</router-link>
        </li>
      </ul>
    </div>
  </div>

</nav>
</template>
<style>
</style>