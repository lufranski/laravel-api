<script>

import axios from 'axios';

export default{
  data(){
    return{
      movieList : [],
      api: 'http://127.0.0.1:8000/api/v1/',
      genres: [],
      tags: []
    }
  },
  methods: {

    getAllMovies(){

      axios.get(this.api + 'movie/all')
           .then(res => {
    
              const data = res.data;
              const success = data.success;
              const response = data.response;

              const movies = response.movies;
              const genres = response.genres;
              const tags = response.tags;


              if(success){
    
                this.movies = movies;
                this.genres = genres;
                this.tags = tags;
              }  
    
           })
           .catch(err => console.error(err));
    }
  },
  mounted(){
    
    this.getAllMovies();
  }
}

</script>

<template>
  
  <h1>Movies</h1>
  <ul>
    <li v-for="movie in this.movies" :key="movie.id">
        {{ movie.name }}

        <!-- <p>{{ movie.genre }}</p> -->

        <ul class="tag_list">
          <li v-for="tag in movie.tags" :key="tag.id">
            #{{ tag.name }}
          </li>
        </ul>
    </li>
  </ul>

</template>

<style>
ul {
  list-style-type: none;

}

.tag_list {
  display: flex;
  justify-content: center;
  gap: .5rem;
}
</style>
