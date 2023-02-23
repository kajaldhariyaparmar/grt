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
                                            <li v-if="!isMonthlyExist" v-on:click="mountPaypalElements" :class="{active : active == 2}">
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
                                            <!-- <li v-if="!isMonthlyExist" v-on:click="mountAppleElements" :class="{active : active == 3}">
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
                                </div>
                            </div>

                            <div class="custom-row">
                                <div class="col-sm-12">
                                    <span class="separator-row"></span>
                                </div>
                            </div>
                            <div class="payment-card-debit-card-wrap" v-if="active == 1">
                              <div v-if="isSingleExist" class="custom-row">
                                <div class="col-sm-12">
                                  <h3>Credit or debit card (one-off donations)</h3>
                                </div>
                              </div>
                              <div v-if="isSingleExist" class="custom-row card-details-one-off">
                                <div class="col-sm-12">
                                  <!-- <div ref="card"></div> -->
                                  <div id="card"></div>
                                </div>
                              </div>
                              <div v-if="isMonthlyExist" class="card-details-direct-debit">
                                    <div class="custom-row">
                                        <div class="col-sm-12">
                                            <h3 class="direct-debit-title">Direct debit details <span>(for recurring payments)</span></h3>
                                        </div>
                                    </div>
                                    <div class="custom-row">
                                        <div class="col-sm-12">
                                            <input type="text" class="input-bx" v-model="user.accountname" value="" placeholder="Account Name" required>
                                             <div>{{ errors.accountname }}</div>
                                        </div>
                                    </div>
                                    <div class="custom-row input-row">
                                      <div class="col-sm-6">
                                            <input type="number" class="input-bx" v-model="user.accountnumber"   value="" placeholder="Account Number" name="accountnumber" oninput="if(value.length>8)value=value.slice(0,8)" maxlength="8" onkeydown="return event.keyCode !== 69">
                                           <div>{{ errors.accountnumber }}</div>
                                      </div>
                                        <div class="col-sm-6">
                                            <input type="number" class="input-bx" v-model="user.sortcode"   value="" placeholder="Branch Code" name="sortcode" oninput="if(value.length>6)value=value.slice(0,6)" maxlength="6" onkeydown="return event.keyCode !== 69">
                                             <div>{{ errors.sortcode }}</div>
                                        </div>
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
                                          
                                         <!---  <form id="paypalPaymentProcess2"  class="paypalPaymentProcess2" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                                            <input type="hidden" name="cmd" value="_cart">
                                            <input type="hidden" name="upload" value="1">
                                            <input type="hidden" name="business" value="mamunur002.play@gmail.com">
                                            <input type="hidden" name="currency_code" value="GBP">
                                            <li 
                                            v-for="(item, index) in $store.state.cart" :key="item.id"
                                            >
                                              
                                              <input type="hidden" :name="'item_name_'+incrementIndex(index)" :value="item.title">
                                              <input type="hidden" :name="'amount_'+incrementIndex(index)" :value="amountEachCartItem(item.amount)">
                                            </li>   
                                            <input type="hidden" :name="'cancel_return'" :value="base_url +'/payment-cancel'">
                                            <input type="hidden" :name="'return'" :value="'https://testing.grtuk.org/grt/thankyou'">
                                            <input type="image" :src="base_url +'/images/PayPal.png'"  class="pp"  alt="Make payments with PayPal - it's fast, free and secure!">
                                          </form> -->
                                          <div id="paypal-button"></div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="payment-applegoogle-wrap" v-if="active == 3">
                                <div class="custom-row">
                                    <div class="col-sm-12">
                                        <div class="apple-google-pay-btn-wrap">
                                            <div id="payment-request-button" style="width:200px">
                                              <!-- A Stripe Element will be inserted here. -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--// End Campaign Checkout Left Section -->
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
                            <!-- <span class="remove-item"
                              @click.prevent="removeFromCart(item)"
                              >Remove</span> -->
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  <div v-if="totalAdminCost(totalSinglePrice) > 0" class="campaign-checkout-total-amount-wrap">
                    <div class="campaign-checkout-total-amount">
                      <div class="total-txt column">
                        <h3>Admin cost</h3>
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
    </section><!--// End Campaign Checkout Section -->
</div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        accountname: "",
        accountnumber: "",
        sortcode: "",
      },
      active:1,
      errors: [],
      isPaymentSuccess: false,
      duringPaymentProcess: false,
      disableButton: false,
      loading: false,
      amount_single: 0,
      amount_monthly: 0,
      amount_weekly: 0,
      stripePublickey: "",
      stripe: "",
      elements: "",
      card: "",
      stripea: "",
      elementsa: "",
      paymentRequestButton: "",
      paymentRequest: "",
      prButton: "",
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
      expandContactMethod: false,
      giftaid_active_element: 2,
      loginuserdetails: "",
      base_url: '/grt',
      reference: Math.random().toString(36).slice(2),
      currency: 'GBP'
    };
  },
  mounted() {
    
    console.log(this.$route.params.data);
    this.user = this.$route.params.data;
    this.mountStripeElements();
    this.getAdminPercentage();
    // this.getloginuserdetails();
    this.getloginstate();
    this.searchPostCode();
    //this.paypalScript();
  },
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
    amountEachCartItem(itemamount) {
      return parseFloat(
          itemamount
            .toString()
            .replace(/[^0-9.]/g, "")
            .replace(/(\..*)\./g, "$1")
            .replace(/(?!^)-/g, "")
            .replace(/^0+(\d)/gm, "$1")
        ).toFixed(2)
     },
    incrementIndex(key) {
        return key + 1;
    },
    giftaidActive:function(el) {
        this.giftaid_active_element = el;
    },
    searchPostCode() {
      IdealPostcodes.PostcodeLookup.setup({
        apiKey: 'ak_l8sp5kelbfEbfNRzVpNqjid2HZPvt',//ak_l8sp5kelbfEbfNRzVpNqjid2HZPvt
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
    // getloginuserdetails() {
    //   let self = this;
    //   axios.get(self.base_url + "/loginuserdetails").then((response) => {
    //     self.user.email = response.data;
    //   });
    // },
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
      if( this.isSingleExist) {
        let self = this;
        // self.stripepublickey().then((data) => {
          (self.stripe = Stripe("pk_test_LTOn51TCWCKF57JtVK9xQ3t7")),
            (self.elements = self.stripe.elements()),
            (self.card = undefined);
          self.card = self.elements.create("card", { hidePostalCode: true });
          // self.card.mount(self.$refs.card);
          self.card.mount('#card');
        // });
      }
    },
    async mountPaypalElements() {
      const result = await this.mountPaypalElementsActive();
      this.showPaypalElements();
    },
    mountPaypalElementsActive: function() {
      this.active = 2;
    },
    showPaypalElements:function(){
      
      let self = this;
      let new_array = [];
      let unit_amount = [];
      let cartData = self.$store.state.cart;
      
      for (let item of cartData) {
        const amountdata = {
          'value': item.amount,
          'currency_code': self.currency
        }
        const data = {
          
            'name': item.title,
            //'unit_amount':'{value:'+item.amount+'}',
            "unit_amount": amountdata,
            'quantity':item.quantity
          }
          new_array.push(data);
      }
      //console.log(new_array);

      
      function loadScript(url, callback) {
          let el = document.querySelector(`script[src="${url}"]`);
          console.log(el)
          //if (!el) {
              console.log('helloo')
              const s = document.createElement('script');
              s.setAttribute('src', url); 
              s.onload = callback;
              document.head.insertBefore(s, document.head.firstElementChild);
          //}
      };
      loadScript('https://www.paypal.com/sdk/js?client-id=Afh9_P6-99dBVp15z-jhvEMoVmRgnxI4Y4OhCrjLXTHFesPexbhzauXCZBk6xnQtaArUhlqyO9BX_bvP&currency='+self.currency, () => {
            paypal.Buttons({
              fundingSource:paypal.FUNDING.PAYPAL,
              style: {
                    size: 'responsive',
                    shape: 'pill',
                    //label: 'checkout',
                },
                // Set up the transaction
                createOrder(data, actions) {
                    return actions.order.create({
                      purchase_units: [{
                        amount: {
                            value: self.totalPrice,
                            currency_code: self.currency,
                            breakdown: {
                                item_total: {value: self.totalPrice,currency_code: self.currency}
                            } 
                        },
                        items:new_array

                    }]
                    });
                },

                // Finalize the transaction
                onApprove(data, actions) {
                    return actions.order.capture().then(details => {
                      console.log(details)
                        // Show a success message to the buyer
                        const token = {
                          payment_type: 'PayPal',
                          id: details.id,
                          user: self.user,
                          cartContent: self.$store.state.cart,
                          cartTotal: self.totalPrice,
                          reference: self.reference,
                          currency: self.currency,
                        };
                        self.axios
                        .post(`http://localhost:3000/api/singlePaymentProcess`, token)
                        .then((response) => {
                          const charge = response.data;
                          console.log(charge);
                          if (details.status != 'COMPLETED') {
                            self.disableButton = false;
                            self.isPaymentSuccess = false;
                            self.duringPaymentProcess = false;
                            self.loading = false;
                            //self.errors.payment = charge.error.errors[0].field +" " + charge.error.errors[0].message;
                            //self.errors.push(charge.error.errors[0].field +" " + charge.error.errors[0].message);
                          }
                          if (details.status == "COMPLETED") {
                            self.isPaymentSuccess = true;
                            self.duringPaymentProcess = false;
                            self.loading = false;
                            localStorage.clear();
                            self.$router.push({ name: "thankyou" });
                            // window.location.href = "/thankyou";
                          }

                        })
                        .catch((error) => {
                          (self.duringPaymentProcess = false),
                            (self.errors.payment = error);
                          self.errors.push(error);
                        });
                        
                    });
                },

            }).render('#paypal-button');
        });
    },
    telValidate(telnumber,object) {
        this.user.phone = object.number;
        this.user.countryCode = object.countryCode;
    },
    paymentSubmit() {
      // if cart is not empty
      if (this.$store.state.cartCount > 0) {
        // form validation
        this.validateForm();

        // if form is validated
        if (!this.errors.length) {
          this.loading = true;
          let self = this;
          // if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
          //   self.makeSingleWeeklyMonthlyPayment();
          if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly == 0)
            self.makeSingleMonthlyPayment();
          // if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
          //   self.makeSingleWeeklyPayment();
          // if (self.amount_single == 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
          //   self.smartdebitWeeklyMonthlyPayment();
          if (self.amount_monthly > 0 && self.amount_single == 0 && self.amount_weekly == 0)
            self.makeMonthlyPayment(); // Gocardless
          if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly == 0)
            self.makeSinglePayment(); // Stripe
          // if (self.amount_single == 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
          //   self.smartdebitWeeklyPayment();
        }
      } else {
        this.errors.push("Cart is empty");
        this.errors.cartEmpty = "Cart is empty";
      }
    },
    payPalPaymentSubmit() {
      // if cart is not empty
      if (this.$store.state.cartCount > 0) {
        // form validation
        // if form is validated
        
          this.loading = true;
          let self = this;
          // if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
          //   self.makeSingleWeeklyMonthlyPayment();
          if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly == 0)
            self.makeSingleMonthlyPayment();
          // if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
          //   self.makeSingleWeeklyPayment();
          // if (self.amount_single == 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
          //   self.smartdebitWeeklyMonthlyPayment();
          if (self.amount_monthly > 0 && self.amount_single == 0 && self.amount_weekly == 0)
            self.makeMonthlyPayment(); // Gocardless
          if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly == 0)
            self.makeSinglePayment(); // Stripe
          // if (self.amount_single == 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
          //   self.smartdebitWeeklyPayment();
       
      } else {
        this.errors.push("Cart is empty");
        this.errors.cartEmpty = "Cart is empty";
      }
    },
    makeMonthlyPayment() {
      let self = this;
      console.log('gocardless');
      self.disableButton = true;
      const token = {
        user: self.user,
        cartContent: self.$store.state.cart,
        cartTotal: self.totalPrice,
        reference: self.reference,
        currency: self.currency,
      };
      self.axios
        .post(self.base_url + `/api/monthlyPaymentProcess`, token)
        .then((response) => {
          const charge = response.data;
          // console.log(charge.error);
          if (charge.error) {
            self.disableButton = false;
            self.isPaymentSuccess = false;
            self.duringPaymentProcess = false;
            self.loading = false;
            self.errors.payment = charge.error.errors[0].field +" " + charge.error.errors[0].message;
            self.errors.push(charge.error.errors[0].field +" " + charge.error.errors[0].message);
          }
          if (charge.status && charge.status == "active") {
            self.isPaymentSuccess = true;
            self.duringPaymentProcess = false;
            self.loading = false;
            localStorage.clear();
            self.$router.push({ name: "thankyou" });
            // window.location.href = "/thankyou";
          }
        })
        .catch((error) => {
          (self.duringPaymentProcess = false),
            (self.errors.payment = error);
          self.errors.push(error);
        });
          
    },
    makeSingleMonthlyPayment() {
      this.disableButton = true;
      let self = this;
      self.stripe.createToken(self.card).then(function (result) {
        // console.log(self.user);
        // console.log(result.token.id);
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          const token = {
            id: result.token.id,
            user: self.user,
            cartContent: self.$store.state.cart,
            cartTotal: self.totalPrice,
            reference: self.reference,
            currency: self.currency,
          };
          self.axios
          .post(self.base_url + `/api/monthlyPaymentProcess`, token)
          .then((response) => {
            const charge = response.data;
            // console.log(charge.error);
            if (charge.error) {
              self.disableButton = false;
              self.isPaymentSuccess = false;
              self.duringPaymentProcess = false;
              self.loading = false;
              self.errors.payment = charge.error.errors[0].field +" " + charge.error.errors[0].message;
              self.errors.push(charge.error.errors[0].field +" " + charge.error.errors[0].message);
            }
            if (charge.status && charge.status == "active") {
              self.makeSinglePayment(); // Stripe
            }
          })
          .catch((error) => {
            console.log(error);
          });
        }
        // Access the token with result.token
        console.log(result);
      });
    },
    makeSinglePayment() {
      this.disableButton = true;
      let self = this;
      console.log(self.totalPrice);
      self.stripe.createToken(self.card).then(function (result) {
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = {
            payment_type: 'Stripe',
            id: result.token.id,
            user: self.user,
            cartContent: self.$store.state.cart,
            cartTotal: self.totalPrice,
            reference: self.reference,
            currency: self.currency,
          };
          console.log(token);
          self.axios
            .post(`http://localhost:3000/api/singlePaymentProcess`, token)
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

      if(this.isMonthlyExist) {
        if (!this.user.accountname) {
          this.errors.accountname = "The account name field is required.";
          this.errors.push("The account name field is required.");
        }
        if (!this.user.sortcode) {
          this.errors.sortcode = "The sort code field is required.";
          this.errors.push("The sort code field is required.");
        }
        if (!this.user.accountnumber) {
          this.errors.accountnumber = "The account number field is required.";
          this.errors.push("The account number field is required.");
        }
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
