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
                  <h1>QURBANI PACKS</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--// End Banner Section -->
  
      <!-- Begin Qurbani Section -->
      <section class="zakat-calculate-page-section">
        <div class="container">
            <div class="row">
                <!-- Begin Qurbani List  -->
                <div class="col-sm-12">
                    <div class="zakat-pages-content">
                        <h3 class="qurbani-h3"><b>Fulfill your Qurbani obligation with GRT to one of the following countries:</b></h3>
                        <div class="row">
                            <div class="col-sm-3 text-center"  v-for="data in packs" 
                                                                v-bind:key="data.id"
                                                                >
                                                                <router-link
                                                                     :to="{ name: 'all-donation', params: { id: data.slug } }"
                                                                    ><img class="card-img-top"
                                                                        v-bind:src="image_src + data.thumbnail"
                                                                        v-bind:alt="data.title" 
                                                                    />
                                                                </router-link>
                            </div>
                            
                        </div>
                    </div>
                </div><!--// End Qurbani List  -->
            </div>
        </div>
      </section><!--// End Qurbani Page Section -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loading: false,
        packs: [],
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
       };
    },
   
    mounted() {
        this.loadQurbaniPacks();
    },
    methods: {
        loadQurbaniPacks() {
        this.axios
            .get(this.base_url + "/api/qurbanipacks")
            .then((response) => {
            this.packs = response.data;
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
  