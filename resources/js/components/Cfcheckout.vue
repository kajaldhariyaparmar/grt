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
      <div class="row">
        <div class="col-sm-12">
          <div class="cf-checkout-wrap">
            <div class="custom-row">
              <label>Name</label>
              <ul>
                <li>
                  <input
                    type="text"
                    v-model="form.firstname"
                    :style="[
                      errors.firstname
                        ? { border: '1px solid red' }
                        : { backgroundColor: 'white' },
                    ]"
                    class="cf-input-bx"
                    value=""
                    placeholder="First name"
                  />
                  <span>{{ errors.firstname }}</span>
                </li>
                <li>
                  <input
                    type="text"
                    v-model="form.lastname"
                    :style="[
                      errors.lastname
                        ? { border: '1px solid red' }
                        : { backgroundColor: 'white' },
                    ]"
                    class="cf-input-bx"
                    value=""
                    placeholder="Last name"
                  />
                  <span>{{ errors.lastname }}</span>
                </li>
              </ul>
            </div>
            <div class="custom-row">
              <div class="form-check">
                <input
                  type="checkbox"
                  v-model="form.hide_name"
                  class="form-check-input"
                  id="cfNameShowHideCheck"
                />
                <label
                  class="form-check-label txt-t-default"
                  for="cfNameShowHideCheck"
                  >Hide my name from showing on campaign page.</label
                >
              </div>
            </div>
            <div class="custom-row">
              <label>Email</label>
              <input
                type="email"
                v-model="form.email"
                :style="[
                  errors.email
                    ? { border: '1px solid red' }
                    : { backgroundColor: 'white' },
                ]"
                class="cf-input-bx"
                value=""
                placeholder="Enter your email"
              />
              <span>{{ errors.email }}</span>
            </div>
            <div class="custom-row">
              <label>Contact</label>
              <input
                type="number"
                v-model="form.phone"
                class="input-bx"
                :style="[
                  errors.phone
                    ? { border: '1px solid red' }
                    : { backgroundColor: 'white' },
                ]"
                value=""
                placeholder="Contact number"
              />
            </div>
            <div class="custom-row">
              <div class="form-check">
                <input
                  type="checkbox"
                  v-model="form.giftaid"
                  class="form-check-input"
                  id="cfGiftAid"
                />
                <label class="form-check-label" for="cfGiftAid">
                  Gift Aid.
                  <span class="cf-giftaid-info"
                    >By choosing to add Gift Aid, you confirm that you are a UK
                    taxpayer and that you would like Charity platform to reclaim
                    25p of tax for every £1 of your donation made in the last
                    four years and any future donations at no extra cost or
                    effort for you. What is
                    <a
                      href="https://www.gov.uk/donating-to-charity/gift-aid"
                      target="_blank"
                      >Gift Aid?</a
                    ></span
                  >
                </label>
              </div>
            </div>
            <div class="custom-row cf-giftaid-homeaddress">
              <div class="custom-row">
                <label>Address</label>
                <input
                  type="text"
                  v-model="form.address"
                  class="cf-input-bx cf-ga-required"
                  value=""
                  placeholder=""
                />
              </div>
              <div class="custom-row">
                <ul>
                  <li>
                    <label>City / Town</label>
                    <input
                      type="text"
                      v-model="form.city"
                      class="cf-input-bx cf-ga-required"
                      value=""
                      placeholder=""
                    />
                  </li>
                  <li>
                    <label>Post code</label>
                    <input
                      type="text"
                      v-model="form.postcode"
                      class="cf-input-bx cf-ga-required"
                      value=""
                      placeholder=""
                    />
                  </li>
                </ul>
              </div>
            </div>
            <div class="custom-row">
              <label>Card details</label>
              <div ref="card"></div>
            </div>
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
        firstname: "",
        lastname: "",
        email: "",
        phone: "",
        address: "",
        city: "",
        postcode: "",
        giftaid: "",
        hide_name: "",
        amount: this.$route.params.data.amount,
        note: this.$route.params.data.note,
        campaign: this.$route.params.data.campaign_title,
        slug: this.$route.params.data.campaign_slug,
        cfcampaign_id: this.$route.params.data.campaign_id,
        apeal: this.$route.params.data.appeal,
        author: this.$route.params.data.author,
        member_id: this.$route.params.data.member_id,
      },
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
  methods: {
    stripepublickey: function () {
      let self = this;
      return this.axios.get(self.base_url + "/api/stripepublickey").then((response) => {
        this.stripepublickey = response.data;
        return this.stripepublickey;
      });
    },
    mountStripeElements: function () {
      let self = this;
      this.stripepublickey().then((data) => {
        (self.stripe = Stripe(data)),
          (self.elements = self.stripe.elements()),
          (self.card = undefined);
        self.card = self.elements.create("card", { hidePostalCode: true });
        self.card.mount(self.$refs.card);
      });
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