<template>
  <div>
    <!--Begin Banner Section-->
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
                <h1>About us</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Banner Section -->

    <!-- Begin About Page Section -->
    <section class="section-wrap about-page-section">
      <div class="container">
        <div class="row">
        <!-- Begin About Left Content -->
          <div class="col-sm-4">
            <div class="sidebar-wrap">
              <div class="sidebar-menu">
                <ul>
                  <li>
                    <router-link to="/about" class="active">
                        About us
                        <span><i class="fas fa-angle-right"></i></span>
                    </router-link>
                  </li>
                  <li>
                    <router-link to="/contact">
                        Contact us
                        <span><i class="fas fa-angle-right"></i></span>
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>
          </div><!--// End About Left Content -->
          <!-- Begin About Right Content -->
          <div class="col-sm-8">
            <div class="about-page-content" v-html="about.description"></div>
          </div>
          <!--// End About Right Content -->
        </div>
      </div>
    </section>
    <!--// End About Page Section -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      about: {},
    };
  },
  mounted() {
    this.loadAbout();
  },
  methods: {
    loadAbout() {
      this.axios
        .get("http://localhost/grt/api/about")
        .then((response) => {
          this.about = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
  },
};
</script>
