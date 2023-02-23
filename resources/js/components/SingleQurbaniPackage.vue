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
                  <h1>{{ package.title}}</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--// End Banner Section -->
  
      <!-- Begin Qurbani Section -->
      <section class="section-wrap zakat-calculate-page-section">
        <div class="container">
            <h3></h3>
        </div>
      </section><!--// End Qurbani Page Section -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loading: false,
        package: [],
        base_url: 'http://localhost/grt',
       };
    },
   
    mounted() {
        this.loadQurbaniPacks();
    },
    methods: {
        loadQurbaniPacks() {
        this.axios
            .get(this.base_url + `/api/qurbanipack/${this.$route.params.id}`)
            .then((response) => {
            this.package = response.data.package;
            this.loading = false;
            console.log(response.data.package);
            })
            .catch((error) => {
            callback(error, error.response.data);
            });
        },
    },
  };
  </script>
  