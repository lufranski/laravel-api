<script>

import axios from 'axios';

const empty_movie= {
  tags_id: []
}

export default{
  data(){
    return{
      api: 'http://127.0.0.1:8000/api/v1/',
      movies: [],
      genres: [],
      tags: [],
      new_movie: {...empty_movie},
      status: {
        movie_form: false
      }
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
                
                console.log(this.movies);
              }  
    
           })
           .catch(err => console.error(err));
    },
    editMovie(movie) {
            
      this.new_movie = { ...movie };
      this.new_movie.tags_id = [];
      for (let x=0; x < movie.tags.length; x++) {
        
        const tag = movie.tags[x];
        this.new_movie.tags_id.push(tag.id);
      }
      this.status.movie_form = true;
    },
    deleteMovie(movie) {
      axios.delete(this.api + 'movie/delete/' + movie.id)
           .then(res => {
              const data = res.data;
              const success = data.success;
              if (success) 
                this.getAllMovies();
           })
           .catch(err => console.log);
    },
    submitMovie(e) {
      e.preventDefault();
      
      const new_movie = this.new_movie;
      const actualApi = this.api + (
        'id' in new_movie 
        ? 'movie/update/' + this.new_movie.id
        : 'movie/store'
      );
            
      axios.post(actualApi, new_movie)
           .then(res => {
              const data = res.data;
              const success = data.success;
              if (success) {
                this.closeForm();
                this.getAllMovies();
              }
           })
           .catch(err => console.log);
    },
    closeForm() {
      this.new_movie = { ...empty_movie };
      this.status.movie_form = false;
    },
  },
  mounted(){
    
    this.getAllMovies();
  }
}

</script>

<template>
  
  <h1>Movies</h1>

  <form v-if="status.movie_form">

      <label for="name">Name</label>
      <input type="text" name="name" v-model="new_movie.name">

      <label for="year">Year</label>
      <input type="number" name="year" v-model="new_movie.year">
  
      <label for="boxOffice">Box Office</label>
      <input type="number" name="boxOffice" v-model="new_movie.boxOffice">
      
      <label for="genre">Genre</label>
      <select name="genre_id" v-model="new_movie.genre_id">
        <option v-for="genre in genres" :key="genre.id" :value="genre.id">{{ genre.name }}</option>
      </select>
      
      <label>Tags:</label>
      <div v-for="tag in tags" :key="tag.id">
        <input type="checkbox" :id="'tag-' + tag.id" :value="tag.id" v-model="new_movie.tags_id">
        <label :for="'tag-' + tag.id">{{ tag.name }}</label>
      </div>

      <button @click="closeForm()">CANCEL</button>
      <input type="submit" @click="submitMovie()" :value="'id' in new_movie ? 'UPDATE MOVIE: ' : 'CREATE NEW MOVIE'">
    </form>

    <div>
      <button @click="status.movie_form = true">CREATE NEW MOVIE</button>
    </div>  

  <ul>
    <li v-for="movie in movies" :key="movie.id">
        {{ movie.name }}

        <ul class="tag_list">
          <li v-for="tag in movie.tags" :key="tag.id">
            #{{ tag.name }}
          </li>
        </ul>

        <button @click="editMovie(movie)">EDIT</button>
        <button @click="deleteMovie(movie)">DELETE</button>
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
