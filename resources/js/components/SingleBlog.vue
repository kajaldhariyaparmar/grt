<template>
    <div>
      <section
        class="single-page-banner clear"
        style="
          background: url(http://localhost/grt/images/single-banner.jpg) no-repeat center 0;
          background-size: cover;"
        >
        <div class="single-page-banner-container">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-title">
                  <h1>{{blog.title}}</h1>
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
                    <div class="about-page-content" v-html="blog.description"></div>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
  export default {
    data() {
      return {
        loading: false,
        blog: [],
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
            .get(this.base_url + `/api/blog/${this.$route.params.id}`)
            .then((response) => {
            this.blog = response.data.blog;
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