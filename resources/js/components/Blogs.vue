<template>
    <div>
      <section
        class="single-page-banner clear"
        style="
          background: url(http://localhost/grt/images/single-banner.jpg) no-repeat center 0;
          background-size: cover;
        "
      >
        <div class="single-page-banner-container">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-title">
                  <h1>Blogs</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--// End Banner Section -->
  
      <!-- Begin Blog Section -->
      <section class="section-wrap zakat-calculate-page-section">
        <div class="container">
            <div class="row">
                <!-- Begin Blogs List Content -->
                <div class="col-sm-12">
                    <div class="zakat-pages-content">
                        <div class="row">
                            <div class="col-sm-3" v-for="data in blogs"
                                                    :key="data.id">
                                <div class="card" style="width: 18rem;">
                                    <router-link
                                            :to="{
                                            name: 'blog',
                                            params: { id: data.slug },
                                            }"
                                            >
                                            <img class="card-img-top"
                                             v-bind:src="image_src + data.thumbnail"
                                             v-bind:alt="data.title" 
                                            />
                                        </router-link>
                                    <div class="card-body">
                                        <h5 class="card-title">{{data.title}}</h5>
                                        <p class="card-text">{{data.short_description}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--// End Blogs List Content -->
            </div>
        </div>
      </section><!--// End Blog Page Section -->
    </div>
  </template>
  
<script>
  export default {
    data() {
      return {
        loading: false,
        blogs: [],
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
       };
    },
   
    mounted() {
        this.loadBlogs();
    },
    methods: {
        loadBlogs() {
        this.axios
            .get(this.base_url + "/api/blogs")
            .then((response) => {
            this.blogs = response.data;
            this.loading = false;
            console.log(response.data);
            })
            .catch((error) => {
            callback(error, error.response.data);
            });
        },
    },
  };
  </script>
  