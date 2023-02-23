<template>
<div>
  <!-- Begin Step Bar Section -->
  <section class="section-wrap stepbar-section">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="steps-container">
                      <div class="step active">
                          <div class="step-lines-wrap">
                              <div class="step-line"></div>
                              <div class="step-line step-line-border"></div>
                              <div class="step-circle">1</div>
                          </div>
                          <div class="step-details">
                              <h4>Your details</h4>
                          </div>
                      </div>
                      <div class="step active">
                          <div class="step-lines-wrap">
                              <div class="step-line step-line-border"></div>
                              <div class="step-line step-line-border"></div>
                              <div class="step-circle">2</div>
                          </div>
                          <div class="step-details">
                              <h4>Payment</h4>
                          </div>
                      </div>
                      <div class="step active">
                          <div class="step-lines-wrap">
                              <div class="step-line step-line-border"></div>
                              <div class="step-line"></div>
                              <div class="step-circle">3</div>
                          </div>
                          <div class="step-details">
                              <h4>Complete</h4>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section><!--// End Step Bar Section -->
  <!-- Begin Thankyou Page Section-->
  <section class="section-wrap thankyou-section-wrap complete-section-wrap clear">
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
                          <a :href="'./campaigns'" class="btn-wrap">Discover other projects</a>
                          <a :href="'./fundraising'" class="btn-wrap transparent-btn">Fundraise for us</a>
                      </div>
                  </div>
              </div><!--// End Thankyou Left Section -->
          </div>
      </div>
  </section><!--// End Thankyou Page Section -->
</div>
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
    
    //Stripe Link Data Insert in Databse
    insertAPI(){
      let token  = JSON.parse(localStorage.getItem('donation'));
      console.log(token);
      console.log(this.$route.query.redirect_status)
      if(this.$route.query.redirect_status == 'succeeded'){
        this.axios
        .post(`http://localhost:3000/api/singlePaymentProcess`, token)
        .then((response) => {
            console.log(response);
            localStorage.removeItem('donation');
        })
        .catch((error) => {
            console.log(error)
        });
      }
    }
  },
  mounted() {
    //this.getloginstate();
    this.insertAPI();
  },
};
</script>