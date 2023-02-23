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
                                      <h3 class="mt-0">Payment options</h3>
                                  </div>
                              </div>
                              <div class="custom-row">
                                  <div class="col-sm-12">
                                      <div class="payment-option-wrap">
                                          <ul>
                                              <li v-on:click="mountStripeElements" :class="{active : active == 1}">
                                                  <div class="radio-wrap">
                                                    <label class="radio-btn">
                                                        <h4>Credit or debit card</h4>
                                                        <input type="radio" name="payment_option_radio" value="" class="custom-radio">
                                                        <div class="radio-default-state">
                                                          <i class="fas fa-circle"></i>
                                                        </div>
                                                        <span class="card-icons-wrap stripe-icons">
                                                            <img src="images/card-icons.svg" alt="">
                                                        </span>
                                                    </label>
                                                  </div>
                                              </li>
                                              <li v-on:click="mountPaypalElements" :class="{active : active == 2}">
                                                  <div class="radio-wrap">
                                                    <label class="radio-btn">
                                                        <h4>PayPal</h4>
                                                        <input type="radio" name="payment_option_radio" value="" class="custom-radio" checked>
                                                        <div class="radio-default-state">
                                                          <i class="fas fa-circle"></i>
                                                        </div>
                                                        <span class="card-icons-wrap paypal-icons">
                                                            <img src="images/paypal.svg" alt="Paypal">
                                                        </span>
                                                    </label>
                                                  </div>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                              <div class="custom-row">
                                  <div class="col-sm-12">
                                      <span class="separator-row"></span>
                                  </div>
                              </div>
                              <div class="payment-card-debit-card-wrap" v-if="active == 1">
                                <div class="custom-row">
                                  <div class="col-sm-12">
                                    <h3>Credit or debit card (one-off donations)</h3>
                                  </div>
                                </div>
                                <div class="custom-row card-details-one-off">
                                  <div class="col-sm-12">
                                    <!-- <div ref="card"></div> -->
                                    <div id="card"></div>
                                  </div>
                                </div>
                                <div class="btn-wrap-row">
                                    <div class="col-sm-12">
                                        <button
                                          class="btn-wrap"
                                          v-on:click="paymentSubmit"
                                          :disabled="disableButton"
                                        >
                                          {{ loading ? "LOADING" : "Complete donation payment"
                                          }}<span v-bind:class="{ loading: loading }"></span>
                                        </button>
                                        <p class="alert" v-if="isPaymentSuccess">
                                          Payment is Success. Redirecting to the thank you page.
                                        </p>
                                        <p class="alert" v-if="duringPaymentProcess">
                                          Payment is processing. Please do not close your browser
                                        </p>
                                        <p>{{ errors.payment }}</p>
                                        <p>{{ errors.cartEmpty }}</p>
                                    </div>
                                </div>
                              </div>
                              <div class="payment-paypal-wrap" v-if="active == 2">
                                  <div class="custom-row">
                                      <div class="col-sm-12">
                                          <div class="paypal-btn-wrap">
                                            <form id="paypalPaymentProcess2"  class="paypalPaymentProcess2" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                              <input type="hidden" name="cmd" value="_cart">
                                              <input type="hidden" name="upload" value="1">
                                              <input type="hidden" name="business" value="mamunur002.play@gmail.com">
                                              <input type="hidden" name="currency_code" value="GBP">
                                              <input type="hidden" name="item_name_1" value="Event">
                                              <input type="hidden" name="amount_1" value="12.99">
                                              <input type="hidden" :name="'cancel_return'" :value="base_url +'/payment-cancel'">
                                              <input type="hidden" :name="'return'" :value="'http://theplayculture.com/grt/payment-status'">
                                              <input type="image" :src="base_url +'/images/PayPal.png'" name="submit" class="pp"  alt="Make payments with PayPal - it's fast, free and secure!">
                                            </form>
                                          </div>
                                      </div>
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
      active:1,
      errors: [],
      isPaymentSuccess: false,
      duringPaymentProcess: false,
      disableButton: false,
      loading: false,
      amount: 10,
      stripePublickey: "",
      stripe: "",
      elements: "",
      card: "",
      base_url: '/grt',
      reference: Math.random().toString(36).slice(2),
      currency: 'GBP'
    };
  },
  mounted() {
    this.user = this.$route.params.data;
    this.mountStripeElements();
    this.getloginstate();
  },
  methods: {
    stripepublickey: function () {
      let self = this;
      return this.axios.get(self.base_url + "/api/stripepublickey").then((response) => {
        this.stripepublickey = response.data;
        return this.stripepublickey;
      });
    },
    async mountStripeElements() {
      const result = await this.mountStripeElementsActive();
      this.showStripeElements();
    },
    mountStripeElementsActive: function () {
       this.active = 1;
    },
    showStripeElements: function () {
      let self = this;
      // self.stripepublickey().then((data) => {
        (self.stripe = Stripe("pk_test_LTOn51TCWCKF57JtVK9xQ3t7")),
          (self.elements = self.stripe.elements()),
          (self.card = undefined);
        self.card = self.elements.create("card", { hidePostalCode: true });
        // self.card.mount(self.$refs.card);
        self.card.mount('#card');
      // });
    },
    mountPaypalElements: function() {
      this.active = 2;
    },
    paymentSubmit() {
      // form validation
      this.validateForm();

      // if form is validated
      if (!this.errors.length) {
        this.loading = true;
        let self = this;
        self.makeSinglePayment(); // Stripe
      }
    },
    makeSinglePayment() {
      this.disableButton = true;
      let self = this;
      self.stripe.createToken(self.card).then(function (result) {
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = {
            id: result.token.id,
            user: self.user,
            cartTotal: self.amount,
            reference: self.reference,
            currency: self.currency,
          };
          self.axios
            .post(self.base_url + `/api/eventPaymentProcess`, token)
            .then((response) => {
              const charge = response.data;
              if (charge.error) {
                self.isPaymentSuccess = false;
                self.duringPaymentProcess = false;
                self.loading = false;
                self.errors.payment = charge.error.message;
                self.errors.push(charge.error.message);
              }
              self.duringPaymentProcess = true;
              if (charge.status && charge.status == "succeeded") {
                self.isPaymentSuccess = true;
                self.duringPaymentProcess = false;
                self.loading = false;
                localStorage.clear();
                self.$router.push({ name: "thankyou" });
                // window.location.href = '/thankyou';
              }
            })
            .catch((error) => {
              (self.duringPaymentProcess = false),
                (self.errors.payment = error);
              self.errors.push(error);
              console.log(error);
            });
        }
        // Access the token with result.token
        console.log(result);
      });
    },
    validateForm() {
      this.errors = [];

      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 200, behavior: "smooth" });
      }
    }
  },
};
</script>
