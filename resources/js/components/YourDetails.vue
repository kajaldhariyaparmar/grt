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
                <div class="custom-row your-information">
                  <div class="col-sm-12">
                    <h3>Your information</h3>
                    <span v-if="!isUserLoggedIn" class="have-account">Already registered? <a :href="base_url +'/login'">login here</a></span>
                  </div>
                </div>

                <div class="custom-row input-row">
                  <div class="col-sm-12">
                    <select
                      name="customertitle"
                      v-model="user.customertitle"
                      class="select-bx"
                    >
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Miss">Miss</option>
                      <option value="Dr">Dr</option>
                      <option value="Ms">Ms</option>
                      <option value="Prof">Prof</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx"
                      :style="[
                        errors.name
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.name"
                      value=""
                      placeholder="First name"
                      name=""
                    />
                    <div>{{ errors.name }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      :style="[
                        errors.lastname
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      class="input-bx"
                      v-model="user.lastname"
                      value=""
                      placeholder="Last name"
                      name=""
                    />
                    <div>{{ errors.lastname }}</div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="email"
                      @change="checkUniqueEmail()"
                      class="input-bx"
                      :style="[
                        errors.email
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.email"
                      value=""
                      placeholder="Email address"
                      name=""
                    />
                    <div>{{ errors.email }}</div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <vue-tel-input name="contact" 
                    placeholder="Contact number" class="input-bx"
                    autoFormat
                    :enableCountryCode = "true" 
                    :dropdownOptions="{
                      showFlags: true,
                      showDialCodeInSelection: true,
                    }"
                    :inputOptions="{
                      showDialCode:false
                    }"
                    :style="[
                        errors.contact
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                    
                    v-model="user.contact"
                   @input="telValidate"
                    ></vue-tel-input>
                    <div>{{ errors.contact }}</div>
                  </div>
                </div>
                <div v-if="!isUserLoggedIn" class="custom-row">
                  <div class="col-sm-12 want-to-signup">
                    <div class="custom-checkbox">
                          <input type="checkbox" id="wanttoSignup" v-model="user.signup" value="No"> 
                          <label for="wanttoSignup">Create an account for faster checkout in the future?</label>
                      </div>
                  </div>
                </div>
                <div v-if="!isUserLoggedIn && user.signup" class="custom-row input-row">
                  <div class="col-sm-6">
                    <input
                      type="password"
                      class="input-bx"
                      :style="[
                        errors.password
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.password"
                      value=""
                      placeholder="Password"
                    />
                    <div>{{ errors.password }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="password"
                      class="input-bx"
                      :style="[
                        errors.confirm_password
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.confirm_password"
                      value=""
                      placeholder="Confirm password"
                    />
                    <div>{{ errors.confirm_password }}</div>
                    <div class="error-pass-confirmation">
                      {{ errors.password_confirmation }}
                    </div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <h3>Billing address</h3>
                  </div>
                </div>
                <div class="custom-row postcode-search">
                    <div class="col-sm-12">
                        <div id="postcodeSearch"></div>
                        <!---<input type="text" class="input-bx" value="" placeholder="Search your postcode" name="">
                        <button class="btn-wrap">Find my address</button> -->
                    </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="text"
                      class="input-bx" id="addressLine1"
                      v-model="user.addressline1"
                      value=""
                      placeholder="Address"
                      name="address"
                    />
                    <div>{{ errors.addressline1 }}</div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="text"
                      class="input-bx" id="addressLine2"
                      v-model="user.addressline2"
                      value=""
                      placeholder="Address"
                      name="address"
                    />
                  </div>
                </div>
                <div class="custom-row input-row">
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx" id="postCity"
                      v-model="user.city"
                      value=""
                      placeholder="City"
                      name="city"
                    />
                    <div>{{ errors.city }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx" id="postCode"
                      v-model="user.postcode"
                      value=""
                      placeholder="Post code"
                      name="postcode"
                     
                    />
                    <div>{{ errors.postcode }}</div>
                  </div>
                </div>
                
                <div class="custom-row">
                  <div class="col-sm-12">
                    <div class="gift-aid-box-wrap">
                      <h3>
                        Increase the value of your donation to £{{
                          (
                            parseInt(totalPrice) +
                            (totalPrice * 25) / 100
                          ).toFixed(2)
                        }}
                      </h3>
                      <p>
                        By choosing to add Gift Aid, you confirm that you are a
                        UK taxpayer and that you would like Palestine Aid to
                        reclaim 25% of tax for every £1 of your donation made in
                        the last four years and any future donations at no extra
                        cost or effort for you.<a href="https://www.gov.uk/donating-to-charity/gift-aid" target="_blank"> What is Gift Aid?</a>
                        <span class="gift-aid-logo">
                            <img src="images/gift-aid-uk-logo.svg" alt="">
                        </span>
                      </p>
                      <div class="gift-aid-box">
                        <ul>
                          <li v-on:click="giftaidActive(1)" :class="{active : giftaid_active_element == 1}">
                            <div class="radio-wrap">
                              <label class="radio-btn">
                                <h4>
                                  Yes, add £{{
                                    ((totalPrice * 25) / 100).toFixed(2)
                                  }}
                                  of my Gift Aid
                                </h4>
                                <input
                                  type="radio"
                                  name="giftaid_radio"
                                  v-model="user.giftaid"
                                  value="true"
                                  class="custom-radio"
                                />
                                <div class="radio-default-state">
                                  <i class="fas fa-circle"></i>
                                </div>
                              </label>
                            </div>
                          </li>
                          <li v-on:click="giftaidActive(2)" :class="{active : giftaid_active_element == 2}">
                            <div class="radio-wrap">
                              <label class="radio-btn">
                                <h4>No, do not my Gift Aid</h4>
                                <input
                                  type="radio"
                                  name="giftaid_radio"
                                  v-model="user.giftaid"
                                  value="false"
                                  class="custom-radio"
                                  checked
                                />
                                <div class="radio-default-state">
                                  <i class="fas fa-circle"></i>
                                </div>
                              </label>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="custom-row">
                    <div class="col-sm-12">
                        <div class="checkout-additional-info-wrap">
                            <div class="checkout-additional-info-inner">
                                <h3>
                                    Additional informations (optional)
                                    <span class="material-icons more" v-on:click="expandContactMethod = !expandContactMethod" :aria-pressed="expandContactMethod ? 'true' : 'false'" :class="{ active: expandContactMethod }">expand_more</span>
                                </h3>
                                <div v-show="expandContactMethod">
                                    <div class="custom-row">
                                        <textarea class="text-area" v-model="user.additionalDonateNote" placeholder="Donation note (any donation requests or water pump names add here)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-additional-info-wrap checkout-contact-method-box-wrap">
                            <div class="checkout-additional-info-inner">
                                <div class="custom-row">
                                    <h4>Your donations are saving lives. Stay involved by keeping up to date with our appeals. </h4>
                                </div>
                                <div class="custom-row">
                                    <div class="checkout-contact-method-wrap">
                                      <ul>
                                          <li v-for="contactmethod in contactmethods" :key="contactmethod.id">
                                            <div class="custom-checkbox">
                                                  <input type="checkbox" :id="contactmethod.id" v-model="contactmethod.checked" > 
                                                  <label :for="contactmethod.id">
                                                      {{contactmethod.name}}
                                                  </label>
                                              </div>  
                                          </li>
                                          {{getAllCheckedIDs}}
                                      </ul>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap-row">
                  <div class="col-sm-12">
                    <button
                      class="btn-wrap"
                      v-on:click="continuePayment"
                      :disabled="disableButton"
                    >
                      {{ loading ? "LOADING" : "Continue to payment"
                      }}<span v-bind:class="{ loading: loading }"></span>
                    </button>
                    <p>{{ errors.cartEmpty }}</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- </form> -->
          </div>
        </div>
        <!--// End Campaign Checkout Left Section -->
        <!-- Begin Campaign Checkout Summary Section -->
        <div class="col-sm-5">
          <div class="sidebar-wrap">
            <div class="campaign-checkout-summary-wrap">
              <div class="title">
                <h2>Your donations ({{ $store.state.cartCount }})</h2>
              </div>
              <div class="campaign-checkout-summary-content">
                <ul>
                  <li v-for="item in $store.state.cart" :key="item.id">
                    <div class="campaign-checkout-summary-item">
                      <div class="title-col column">
                        <!-- <h2>{{ item.title}}x{{ item.quantity }}</h2> -->
                        <h2>{{ item.title }}</h2>
                        <h3>{{ item.paymenttype }} | {{ item.appeal }}</h3>
                      </div>
                      <div class="amount-col column">
                        <h2>
                          £{{
                            parseFloat(
                              item.amount
                                .toString()
                                .replace(/[^0-9.]/g, "")
                                .replace(/(\..*)\./g, "$1")
                                .replace(/(?!^)-/g, "")
                                .replace(/^0+(\d)/gm, "$1")
                            ).toFixed(2)
                          }}
                        </h2>
                        <span
                          class="remove-item"
                          @click.prevent="removeFromCart(item)"
                          >Remove</span
                        >
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div v-if="totalAdminCost(totalSinglePrice) > 0" class="campaign-checkout-total-amount-wrap">
                <div class="campaign-checkout-total-amount">
                  <div class="total-txt column">
                    <h3>Admin cost(one-off)</h3>
                  </div>
                  <div class="total-amount column">
                    <h3>£{{totalAdminCost(totalSinglePrice)}}</h3>
                  </div>
                </div>
              </div>
              <div class="campaign-checkout-total-amount-wrap">
                <div class="campaign-checkout-total-amount">
                  <div class="total-txt column">
                    <h3>Total donation</h3>
                  </div>
                  <div class="total-amount column">
                    <h3>£{{ totalPrice }}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="other-ways-donate-content">
                <div class="sidebar-title">
                    <h3>Other ways to donate</h3>
                </div>
                <div class="bank-transfer-wrap">
                    <h4>Bank transfer</h4>
                    <ul>
                        <li><span class="ac-number-title column-1">Account number:</span><span class="ac-number column-2">00695602</span></li>
                        <li><span class="sort-code-title column-1">Sort code:</span> <span class="ac-code column-2">20-08-64</span></li>
                    </ul>
                    <h4 class="mt-4">International bank transfer</h4>
                    <ul>
                        <li><span class="ac-number-title column-1">Swift/BIC code:</span><span class="ac-number column-2">BUKBGB22</span></li>
                        <li><span class="sort-code-title column-1">IBAN:</span> <span class="ac-code column-2">GB42 BUKB 2008 6400 6956 02</span></li>
                    </ul>
                </div>
            </div>
          </div>
        </div>
        <!--// End Campaign Checkout Summary Section -->
      </div>
    </div>
  </section>
  <!--// End Campaign Checkout Section -->
</div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        customertitle: "Mr",
        name: "",
        lastname: "",
        email: "",
        contact: "",
        addressline1: "",
        addressline2: "",
        city: "",
        postcode: "",
        country: "",
        giftaid: "false",
        signup: "",
        password: "",
        confirm_password: "",
        allcontactmethods: [],
        additionalDonateNote: '',
        phone: "",
        countryCode: "",
      },
      errors: [],
      isPaymentSuccess: false,
      duringPaymentProcess: false,
      disableButton: false,
      loading: false,
      amount_single: 0,
      amount_monthly: 0,
      amount_weekly: 0,
      stripe: "",
      elements: "",
      card: "",
      isemailexist: 0,
      adminPercentage:0,
      admincost: this.$store.state.adminCost,
      isUserLoggedIn: false,
      contactmethods: [
          { id: 'telephone', name: 'Contact by phone', checked: false },
          { id: 'email', name: 'Email', checked: false },
          { id: 'sms', name: 'WhatsApp/SMS', checked: false },
          { id: 'post', name: 'Post', checked: false }
      ],
      expandContactMethod: true,
      giftaid_active_element: 2,
      loginuserdetails: "",
      base_url: '/grt',
      reference: Math.random().toString(36).slice(2),
      currency: 'GBP'
    };
  },
  mounted() {
    this.getAdminPercentage();
    this.getloginuserdetails();
    this.getloginstate();
    this.searchPostCode();
  },
  /*beforeMount(){
    this.searchPostCode();
  },*/
  computed: {
    isMonthlyExist() {
      let amount_monthly_weekly = 0
      for(let item of this.$store.state.cart) {
        if (item.paymenttype == "Monthly" || item.paymenttype == "Weekly") 
        amount_monthly_weekly += item.totalPrice;
      }
      if(amount_monthly_weekly > 0)
        return true;
      else 
        return false;
    },
    isSingleExist() {
      let amount_single = 0;
      for(let item of this.$store.state.cart) {
        if (item.paymenttype == "One-off") 
        amount_single += item.totalPrice;
      }
      if(amount_single > 0)
        return true;
      else 
        return false;
    },
    totalPrice() { 
      let total = 0;
      for (let item of this.$store.state.cart) {
        // total += parseInt(item.totalPrice);
        let price = 0;
        price = item.totalPrice;
        total += Number(
          price
            .toString()
            .replace(/[^0-9.]/g, "")
            .replace(/(\..*)\./g, "$1")
            .replace(/(?!^)-/g, "")
            .replace(/^0+(\d)/gm, "$1")
        );
        if (item.paymenttype == "Monthly") {
          this.amount_monthly += item.totalPrice;
        } else if (item.paymenttype == "Weekly") {
          this.amount_weekly += item.totalPrice;
        } else {
          this.amount_single += item.totalPrice;
        }
      }
      if(this.admincost)
       return (parseFloat(total)+parseFloat(this.adminPercentage*this.totalSinglePrice/100)).toFixed(2);
      else 
      //  return totalPrice;
      return total.toFixed(2);
    },
    totalSinglePrice() {
      let total = 0;

      for (let item of this.$store.state.cart) {
        if (item.paymenttype == "One-off") {
        // total += parseInt(item.totalPrice);
        let price = 0;
        price = item.totalPrice;
        total += Number(
          price
            .toString()
            .replace(/[^0-9.]/g, "")
            .replace(/(\..*)\./g, "$1")
            .replace(/(?!^)-/g, "")
            .replace(/^0+(\d)/gm, "$1")
        );
        }
      }
      // return parseInt(total).toFixed(2);
      return total.toFixed(2);
    },
    getAllCheckedIDs: function () {
        this.user.additionalSelected = this.contactmethods.filter(contactmethod => contactmethod).map(contactmethod => contactmethod.id+ ":" + contactmethod.checked)
    },
  },
  methods: {
    giftaidActive:function(el) {
        this.giftaid_active_element = el;
    },
    searchPostCode() {
      IdealPostcodes.PostcodeLookup.setup({
        apiKey: 'ak_ld02zk29vVc6YWCvQGWU3sEQHMtt8', //ak_kmlz9ys3kOIm7ooJp2BYwRPKzn2m8
        context: "#postcodeSearch",
        outputFields: {
          line_1: '#addressLine1',  
          line_2: '#addressLine2',         
          post_town: '#postCity',
          postcode: '#postCode'
        }
        });
    },
    getloginstate() {
      let self = this;
      axios.get(self.base_url + "/loginstate").then((response) => {
        self.isUserLoggedIn = response.data;
      });
    },
    getloginuserdetails() {
      let self = this;
      axios.get(self.base_url + "/loginuserdetails").then((response) => {
        self.user.email = response.data;
      });
    },
    totalPricewithAdminCost(totalPrice, totalSinglePrice) {
       if(this.admincost)
       return (parseFloat(totalPrice)+parseFloat(this.adminPercentage*totalSinglePrice/100)).toFixed(2);
       else 
       return totalPrice;
    },
    totalAdminCost(totalSinglePrice) {
       if(this.admincost)
       return parseFloat(this.adminPercentage*totalSinglePrice/100).toFixed(2);
       else 
       return 0;
    },
    getAdminPercentage() {
      return this.axios.get(this.base_url + "/api/admincost").then((response) => {
        this.adminPercentage = response.data;
      });
    },
    checkUniqueEmail() {
      this.axios.get(this.base_url + `/checkuniquemail/${this.user.email}`).then((response) => {
        this.isemailexist = response.data;
      });
    },
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    telValidate(telnumber,object) {
        this.user.phone = object.number;
        this.user.countryCode = object.countryCode;
    },
    continuePayment() {
      if (this.$store.state.cartCount > 0) {
        // form validation
        this.validateForm();
        if (!this.errors.length) {
          this.$router.push({ name: "payment-details", params: {data: this.user} });
         }
      } else {
        this.errors.push("Cart is empty");
        this.errors.cartEmpty = "Cart is empty";
      }
    },
    passwordConfirmationRule() {
      if (this.user.confirm_password.length > 0) {
        if (this.user.password != this.user.confirm_password) {
          this.errors.password_confirmation =
            "Password and Confirm password must be match";
          this.errors.push("Password and Confirm password must be match");
        }
      }
    },
    validateForm() {
      this.errors = [];

      if (!this.user.name) {
        this.errors.push("The name field is required.");
        this.errors.name = "The name field is required.";
      }
      if (!this.user.lastname) {
        this.errors.push("The last name field is required.");
        this.errors.lastname = "The last name field is required.";
      }
      if (!this.user.contact) {
        this.errors.contact = "The contact field is required.";
        this.errors.push("The contact field is required.");
      }
      if (this.user.signup) {
        if (!this.user.password) {
          this.errors.password = "The password field is required.";
          this.errors.push("The password field is required.");
        } else if (!this.validPassword(this.user.password)) {
          this.errors.password =
            "Password must be 5 characters long";
          this.errors.push(
            "Password must be 5 characters long"
          );
        }
        if (!this.user.confirm_password) {
          this.errors.confirm_password =
            "The confirm password field is required.";
          this.errors.push("The confirm password field is required.");
        }

        // Whether email exists or not
        if (this.isemailexist == 1) {
          this.errors.push("The email has already been taken.");
          this.errors.email = "The email has already been taken.";
        }

        this.passwordConfirmationRule();
      }
      if (!this.user.email) {
        this.errors.push("The email field is required.");
        this.errors.email = "The email field is required.";
      } else if (!this.validEmail(this.user.email)) {
        this.errors.push("Valid email is required.");
        this.errors.email = "Valid email is required.";
      }

      if (!this.user.addressline1) {
        this.errors.push("The address field is required.");
        this.errors.addressline1 = "The address field is required.";
      }
      if (!this.user.city) {
        this.errors.push("The city field is required.");
        this.errors.city = "The city field is required.";
      }
      if (!this.user.postcode) {
        this.errors.push("The postcode field is required.");
        this.errors.postcode = "The postcode field is required.";
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
    validPassword: function (password) {
      var re = /^(?=.*[A-Za-z0-9]).{5,}$/;
      // var re = /^(?=.*[A-Za-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/;
      return re.test(password);
    },
  },
};
</script>