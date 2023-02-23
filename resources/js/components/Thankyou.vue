<template>
  <!-- Begin Thankyou Page Section-->
  <section class="section-wrap thankyou-section-wrap clear">
      <div class="container">
          <div class="row">
              <!-- Begin Thankyou Section -->
              <div class="col-sm-12">
                  <div class="thankyou-content">
                      <div class="icon-wrap">
                          <span class="material-icons">check_circle_outline</span>
                      </div>
                      <div class="section-title">
                          <h2>Thank you for your donation!</h2>
                          <p>GRT team would like to thank you for your kind support. A confirmation email will be emailed to you.</p>
                      </div>
                      <div class="thankyou-bottom-btn-wrap">
                          <a :href="base_url + '/campaigns'" class="btn-wrap">Discover other projects</a>
                      </div>
                  </div>
              </div><!--// End Thankyou Left Section -->
          </div>
      </div>
  </section><!--// End Thankyou Page Section -->
</template>

<script>
export default {
  data() {
    return {
      base_url: '/grt',
    };
  },
  methods: {
    /* getloginstate() {
      axios.get(this.base_url + "/loginstate").then((response) => {
        localStorage.setItem('usertoken',  response.data);
      });
    }, */
    insertAPI(){
      console.log(localStorage.getItem('donation'));
      let token  = localStorage.getItem('donation');
      this.axios
        .post(`http://localhost:3000/api/singlePaymentProcess`, token)
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error)
        });
    }
  },
  mounted() {
    //this.getloginstate();
    this.insertAPI();
  },
};
</script>