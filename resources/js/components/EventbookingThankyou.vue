<template>
  <div>
  <!-- Start Banner Section -->
  <section
    class="single-page-banner clear"
    style="
      background: url(images/single-banner.jpg) no-repeat center 0;
      background-size: cover;
    "
  >
    <div class="single-page-banner-container">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title">
              <h1>Event booking</h1>
              <h2>{{title}}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Banner Section -->
  
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
                  <div class="step">
                      <div class="step-lines-wrap">
                          <div class="step-line step-line-border"></div>
                          <div class="step-line step-line-border"></div>
                          <div class="step-circle">2</div>
                      </div>
                      <div class="step-details">
                          <h4>Payment</h4>
                      </div>
                  </div>
                  <div class="step">
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

  <!-- Begin Campaign Checkout Section -->
  <section class="section-wrap campaign-checkout-section bg-white">
        <div class="container">
          <div class="row campaign-checkout-row">
              <!-- Begin Campaign Checkout Left Section -->
              <div class="col-sm-7">
                  <div class="campaign-checkout-left-content">
                      <div class="form-wrap">
                          <div class="row">
                              <div class="custom-row payment-option-title">
                                  <div class="col-sm-12">
                                      <h3 class="mt-0">Thank you for booking</h3>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div><!--// End Campaign Checkout Left Section -->
          </div>
        </div>
  </section><!--// End Campaign Checkout Section -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: this.$route.params.title,
    };
  }
};
</script>
