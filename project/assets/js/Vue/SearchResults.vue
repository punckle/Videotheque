<template>
  <div id="app">

    <!-- HEADER -->

    <div class="position-relative overflow-hidden">

      {{ movies }}

      <!-- TABS -->

      <div class="position-relative overflow-hidden mx-5 mt-2">
        <b-tabs content-class="mt-3">

          <!-- MOVIES -->

          <b-tab title="Movies" active>
            <div class="card mx-5 mt-3" v-if="results.movies.results && results.movies.results.length > 0">
              <div class="card-header">
                Movies
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col">Poster</th>
                    <th scope="col">Title</th>
                    <th scope="col"></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="movie in results.movies.results">
                    <td>
                      <img class="img-fluid img-thumbnail" :src="imgUrl + movie.poster_path" alt="Poster">
                    </td>
                    <td>
                      <p><u>French title</u>: {{ movie.title }}</p>
                      <p><u>Original title</u>: {{ movie.original_title }}</p>
                      <p v-if="movie.overview"><u>Overview</u>: {{ movie.overview }}</p>
                    </td>
                    <td>
                      <button v-if="!movies.find(c => c.id === movie.id)" class="btn btn-primary" v-on:click="addMovie(movie)"> Add
                      </button>
                      <button v-if="movies.find(c => c.id === movie.id)" class="btn btn-warning" v-on:click="removeMovie(movie)"> Remove
                      </button>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </b-tab>

          <!-- TV SHOWS -->

          <b-tab title="TV Shows">
            <div class="card mx-5 mt-3" v-if="results.tvShows.results && results.tvShows.results.length > 0">
              <div class="card-header">
                TV Shows
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col">Poster</th>
                    <th scope="col">Name</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="tvShow in results.tvShows.results">
                    <td>
                      <img v-if="tvShow.poster_path" class="img-fluid img-thumbnail" :src="imgUrl + tvShow.poster_path" alt="Poster">
                    </td>
                    <td>
                      <p><u>French title</u>: {{ tvShow.name }}</p>
                      <p><u>Original title</u>: {{ tvShow.original_name }}</p>
                      <p v-if="tvShow.overview"><u>Overview</u>: {{ tvShow.overview }}</p>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </b-tab>

          <!-- PERSONS -->

          <b-tab title="Persons">
            <div class="card mx-5 mt-3" v-if="results.persons.results && results.persons.results.length > 0">
              <div class="card-header">
                Persons
              </div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Known for</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="person in results.persons.results">
                    <td>{{ person.name }}</td>
                    <td>{{ person.known_for_department }}</td>
                    <td>
                      <span class="badge bg-primary mr-2" v-for="known_for in person.known_for">{{ known_for.title }}</span>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </b-tab>

        </b-tabs>
      </div>
     </div>

    </div>
</template>

<script>

export default {
  name: "SearchResults",
  data: function() {
    return {
      results: [],
      imgUrl: "https://image.tmdb.org/t/p/w200/",
      movies: []
    }
  },
  mounted() {
    this.getResults();
  },
  methods: {
    getResults() {
      const pathArray = window.location.pathname.split('/');
      let query = pathArray[pathArray.length - 1];
      this.$http.get('/admin/api/search_results/' + query).then((res) => {
        this.results = res.data;
      })
    },
    addMovie(movie) {
      this.movies.push(movie);
    },
    removeMovie(movie) {
      let index = this.movies.indexOf(movie);
      this.movies.splice(index, 1);
    }
  }
}
</script>