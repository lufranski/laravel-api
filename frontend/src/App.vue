<script>

import axios from 'axios';

export default{
  data(){
    return{
      movieList : []
    }
  },
  mounted(){

    axios.get('http://127.0.0.1:8000/api/v1/movie/all')
         .then(res => {

            const data = res.data;
            const success = data.success;
            const movies = data.response;

            this.movieList = movies;

            console.log(movies);
         })
         .catch(err => console.error(err));
  }
}

</script>

<template>
  
  <h1>Movies</h1>
  <ul>
    <li v-for="movie in this.movieList" :key="movie.index">
        {{ movie.name }}
    </li>
  </ul>

</template>

<style>
.logo {
  height: 6em;
  padding: 1.5em;
  will-change: filter;
  transition: filter 300ms;
}
.logo:hover {
  filter: drop-shadow(0 0 2em #646cffaa);
}
.logo.vue:hover {
  filter: drop-shadow(0 0 2em #42b883aa);
}
</style>
