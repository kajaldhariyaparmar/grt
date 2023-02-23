<template>
  <!-- Begin Crowdfunding Checkout Section -->
  <section class="cf-section-wrap cf-checkout-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Checkout</h2>
          </div>
        </div>
      </div>
      <div class="custom-row">
          <div class="col-sm-12">
          <div >
            <div class=" payment-option-wrap">
              <ul>
                  <li v-on:click="mountStripeElements" :class="{active : active == 1}">
                      <div class="radio-wrap">
                        <label class="radio-btn">
                            <h4>Credit or debit card</h4>
                            <input type="radio" name="payment_option_radio" value="" class="custom-radio" checked>
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
                            <input type="radio" name="payment_option_radio" value="" class="custom-radio">
                            <div class="radio-default-state">
                              <i class="fas fa-circle"></i>
                            </div>
                            <span class="card-icons-wrap paypal-icons">
                                <img :src="base_url +'/images/paypal.svg'" alt="Paypal">
                            </span>
                        </label>
                      </div>
                  </li>
                  <!-- <li v-on:click="mountAppleElements" :class="{active : active == 3}">
                      <div class="radio-wrap">
                        <label class="radio-btn">
                            <h4>Apple Pay or Google Pay</h4>
                            <input type="radio" name="payment_option_radio" value="" class="custom-radio" checked>
                            <div class="radio-default-state">
                              <i class="fas fa-circle"></i>
                            </div>
                            <span class="card-icons-wrap google-pay-icons">
                                <img src="images/ApplePay.svg" alt="">
                            </span>
                        </label>
                      </div>
                  </li> -->
              </ul>
            </div>
            <div class="payment-card-debit-card-wrap" v-if="active == 1">
              <label>Card details</label>
              <div ref="card"></div>
              <div class="custom-row">
              <button
                class="cf-btn-wrap"
                v-on:click="paymentSubmit"
                :disabled="disableButton"
              >
                {{ loading ? "Loading" : "Donate now"
                }}<span v-bind:class="{ loading: loading }"></span>
              </button>
              <p class="alert" v-if="isPaymentSuccess">
                Payment is Success. Redirecting to the thank you page.
              </p>
              <p class="alert processing-payment" v-if="duringPaymentProcess">
                Payment is processing. Please do not close your browser
              </p>
              <p>{{ errors.payment }}</p>
              <!-- <a href="#" class="cf-btn-wrap">Donate now</a> -->
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
                      <input type="hidden" name="item_name_1" v-model="form.campaign">
                      <input type="hidden" name="amount_1" v-model="form.amount">
                      <input type="hidden" :name="'cancel_return'" :value="base_url +'/payment-cancel'">
                      <input type="hidden" :name="'return'" :value="'https://theplayculture.com/grt/fundraising/payment-status'">
                      <input type="image" :src="base_url +'/images/PayPal.png'" name="submit" class="pp"  alt="Make payments with PayPal - it's fast, free and secure!">
                    </form>
                    </div>
                  </div>
              </div>
          </div>
           
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Crowdfunding Checkout Section -->
</template>

<script>
export default {
  data() {
    return {
      form: {
        firstname: this.$route.params.data.firstname,
        lastname: this.$route.params.data.lastname,
        email: this.$route.params.data.email,
        phone: this.$route.params.data.phone,
        address: this.$route.params.data.address,
        city: this.$route.params.data.city,
        postcode: this.$route.params.data.postcode,
        giftaid: this.$route.params.data.giftaid,
        hide_name: this.$route.params.data.hide_name,
        amount: this.$route.params.data.amount,
        note: this.$route.params.data.note,
        campaign: this.$route.params.data.campaign,
        slug: this.$route.params.data.campaign_slug,
        cfcampaign_id: this.$route.params.data.cfcampaign_id,
        apeal: this.$route.params.data.apeal,
        author: this.$route.params.data.author,
        member_id: this.$route.params.data.member_id,
      },
      active:1,
      errors: [],
      isPaymentSuccess: false,
      duringPaymentProcess: false,
      loading: false,
      stripePublickey: "",
      stripe: "",
      elements: "",
      card: "",
      isLoggedIn: false,
      loggedinUserId: 0,
      disableButton: false,
      base_url: '/grt'
    };
  },
  mounted() {
    this.mountStripeElements();
  },
  // created() {
  //   this.axios.get("/api/stripepublickey").then((response) => {
  //       this.stripePublickey = response.data;
  //     });
  // },
  methods: {
    stripepublickey: function () {
      let self = this;
      return this.axios.get(self.base_url + "/api/stripepublickey").then((response) => {
        this.stripepublickey = response.data;
        return this.stripepublickey;
      });
    },
    // mountStripeElements2: function () {
    //   let self = this;
    //   this.stripepublickey().then((data) => {
    //     (self.stripe = Stripe(data)),
    //       (self.elements = self.stripe.elements()),
    //       (self.card = undefined);
    //     self.card = self.elements.create("card", { hidePostalCode: true });
    //     self.card.mount(self.$refs.card);
    //   });
    // },
    async mountStripeElements() {
      this.active = 1;
      const result = await this.mountStripeElements1();
      this.mountStripeElements2();
    },
    mountStripeElements1: function () {
      this.active = 1;
    },
    mountStripeElements2: function () {
       let self = this;
       // self.stripepublickey().then((data) => {
         (self.stripe = Stripe("pk_test_LTOn51TCWCKF57JtVK9xQ3t7")),
           (self.elements = self.stripe.elements()),
           (self.card = undefined);
         self.card = self.elements.create("card", { hidePostalCode: true });
         self.card.mount(self.$refs.card);
        //  self.card.mount('#card');
       // });
    },
    mountPaypalElements: function() { 
      this.active = 2;
    },
    paymentSubmit() {
      // Form validation
      this.validateForm();
      // If form is validated
      if (!this.errors.length) {
        this.loading = true;
        this.stripeSinglePayment();
      }
    },
    stripeSinglePayment() {
      this.disableButton = true;
      let self = this;
      console.log(self.form);
      self.stripe.createToken(self.card).then(function (result) {
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = { id: result.token.id, form: self.form };
          self.axios
            .post(self.base_url + "/api/cfPaymentProcess", token)
            .then((response) => {
              const charge = response.data;
              if (charge.error) {
                self.isPaymentSuccess = false;
                self.duringPaymentProcess = false;
                self.loading = false;
                self.errors.push(charge.error.message);
                self.errors.payment = charge.error.message;
              }
              self.duringPaymentProcess = true;
              if (charge.status && charge.status == "succeeded") {
                const formData = { form: self.form };
                self.axios
                  .post(self.base_url + "/api/cfPaymentDataProcess", formData)
                  .then((response) => {
                    if (response.data.result == "success") {
                      self.isPaymentSuccess = true;
                      self.duringPaymentProcess = false;
                      self.$router.push({ name: "cfthankyou" });
                    } else {
                      self.errors.payment = response.data.result;
                      self.errors.push(response.data.result);
                      self.duringPaymentProcess = false;
                      setTimeout(function () {
                        self.$router.push({ name: "cfthankyou" });
                      }, 3000);
                    }
                  })
                  .catch((error) => {
                    (self.duringPaymentProcess = false),
                      (self.errors.payment = error);
                    self.errors.push(error);
                    console.log(error);
                  });
              }
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
    validateForm() {
      this.errors = [];

      if (!this.form.firstname) {
        this.errors.push("The first name field is required.");
        this.errors.firstname = "The first name field is required.";
      }
      if (!this.form.lastname) {
        this.errors.push("The last name field is required.");
        this.errors.lastname = "The last name field is required.";
      }
      if (!this.form.email) {
        this.errors.push("The email field is required.");
        this.errors.email = "The email field is required.";
      } else if (!this.validEmail(this.form.email)) {
        // this.errors.push('Valid email required.');
        this.errors.email = "Valid email is required.";
      }

      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 200, behavior: "smooth" });
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    getloginstate() {
      let self = this;
      axios.get(self.base_url + "/loginstate").then((response) => {
        self.isLoggedIn = response.data;
      });
    },
    getloginuserid() {
      let self = this;
      axios.get(self.base_url + "/loginuserid").then((response) => {
        self.loggedinUserId = response.data;
      });
    },
  },
};
</script>