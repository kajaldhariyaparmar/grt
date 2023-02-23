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
                <h1>Zakat</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Banner Section -->

    <!-- Begin Zakat Calculate Page Section -->
    <section class="section-wrap zakat-calculate-page-section">
      <div class="container">
          <div class="row">
              <!-- Begin Zakat Calculate Left Content -->
              <div class="col-sm-4">
                  <div class="sidebar-wrap">
                      <div class="sidebar-menu">
                          <ul>
                            <li><router-link to="/zakat"> What is zakat<span><i class="fas fa-angle-right"></i></span></router-link></li>
                            <li>
                                <a href="#" class="active">
                                    Calculate zakat
                                    <span><i class="fas fa-angle-right"></i></span>
                                </a>
                            </li>
                          </ul>
                      </div>
                  </div>
              </div><!--// End Zakat Calculate Left Content -->

              <!-- Begin Zakat Calculate Right Content -->
              <div class="col-sm-8">
                  <form action="#" method="post" id="" name="">
                    <div class="quick-donate-content">
                      <!-- <div class="quick-title-col column">
                        <h3>Quick donate</h3>
                      </div> -->
                      <div class="quick-payment-type-col column">
                        <select v-model="cartData.paymenttype" class="select-bx">
                          <option value="One-off">One-off</option>
                          <option value="Monthly">Monthly</option>
                        </select>
                      </div>
                      <div class="quick-donation-type-col column">
                      <select v-model="cartData.appeal" class="select-bx">
                        <option value="Zakat">Zakat</option>
                      </select>
                    </div>
                      <div class="quick-amount-col column">
                        <div class="input-wrap">
                          <input
                            type="number"
                            :style="[
                              errors.amount
                                ? { border: '1px solid red' }
                                : { backgroundColor: 'white' },
                            ]"
                            v-model="cartData.amount"
                            class="input-bx"
                            oninput="if(value.length>100)value=value.slice(0,100)"
                            required
                          />
                          <span class="currency-icon"
                            ><i class="fas fa-pound-sign"></i
                          ></span>
                        </div>
                      </div>
                      <div class="quick-btn-col column">
                        
                        <a v-on:click="addToCartQuickDonate(campaign)" class="btn-wrap">
                          <span v-if="errors.amount" style="font-size: 0.7rem;">{{ errors.amount }}</span> 
                          <span v-else>Donate Now</span>
                          <span class="loading d-none"></span>
                        </a>
                      </div>
                    </div>
                  </form>
                  <div class="zakat-pages-content">
                      <h2>Calculate and Pay/Donate Your Zakat Using the Latest Nisab Values</h2>
                      <p><em style="color: #009FDF;">“The alms are only for the poor and the needy and those employed to collect (the funds); and to attract the hearts of those who have been inclined (towards Islam); and to free the captives; and for those in debt; and for Allah’s Cause, and for the wayfarer (a traveler who is cut off from everything); a duty imposed by Allah. And Allah is All-Knower, All-Wise.“</em> [Al-Quran 9:60]</p>
                      <p>Zakat, the giving of alms to the poor and needy, is one of the five pillars of Islam. It is mandatory upon all Muslims who meet the necessary threshold (Nisab) of wealth.</p>
                      <p>In order to meet the threshold upon which zakat becomes obligatory, an individual must own a specific amount of wealth or savings for over 1 year (outside of living costs and daily expenditures).</p>
                      <p>This is referred to as Nisab and is the threshold at which Zakat becomes payable. The amount of Zakat to be paid is 2.5% of Nisab.</p>


                      <div class="row">
                          <div class="col-sm-6 text-center">
                              <div class="thumb-wrap">
                                  <img src="http://localhost/grt/images/nisab-gold-zakat-2.jpg" alt="">
                              </div>
                              <h3>Gold Nisab</h3>
                              <p>The Zakat payable on the Gold you own is 2.5% of its value. Using the value of gold (87.48 grams) – approximately £3,432.72  – the Zakat you’re due to pay is £0.98 per Gram, £11.11 per tola/bori (11.34g).</p>
                          </div>
                          <div class="col-sm-6 text-center">
                              <div class="thumb-wrap">
                                  <img src="http://localhost/grt/images/nisab-silver-zakat-1.jpg" alt="">
                              </div>
                              <h3>Silver Nisab</h3>
                              <p>Silver: The nisab by the silver standard is 21 ounces of silver (612.36 grams) or its equivalent in cash. This is approximately £361.29, £0.58/g silver</p>
                          </div>
                      </div>
                      <div class="zakat-calculator-wrap">
                        <div class="custom-row">
                            <h3>Gold and Silver</h3>
                            <ul class="half-width">
                                <li>
                                    <label>Value of Gold & Silver You Own*</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        v-model="amount_gold"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                        @change="setInputToDouble($event)"
                                        name="amount_gold"
                                        required
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-row">
                            <h3>Money</h3>
                            <ul class="half-width">
                                <li>
                                    <label>Cash You Possess (Home & Bank)*</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                    <input
                                      type="number"
                                      v-model="amount_home"
                                      class="input-bx"
                                      value=""
                                      placeholder=""
                                      @change="setInputToDouble($event)"
                                      name="amount_home"
                                      required
                                    />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <li>
                                    <label>Other Savings</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                    <input
                                      type="number"
                                      v-model="amount_bank"
                                      class="input-bx"
                                      value=""
                                      placeholder=""
                                      @change="setInputToDouble($event)"
                                      name="amount_bank"
                                    />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <li>
                                    <label>Investment & Share Values</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        v-model="amount_shares"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                        @change="setInputToDouble($event)"
                                        name="amount_shares"
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <li>
                                    <label>Money Owed To You</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        v-model="amount_merchandise"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                        @change="setInputToDouble($event)"
                                        name="amount_merchandise"
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-row">
                            <h3>Business Assets</h3>
                            <ul class="half-width">
                                <li>
                                  <label>Stock Value</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                    <input
                                      type="number"
                                      v-model="amount_property"
                                      class="input-bx"
                                      value=""
                                      placeholder=""
                                      @change="setInputToDouble($event)"
                                      name="amount_property"
                                    />
                                    <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-row">
                            <h3>Short Term Liabilities</h3>
                            <ul class="half-width">
                                <li>
                                    <label>Money You Owe</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        v-model="amount_debts"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                        @change="setInputToDouble($event)"
                                        name="amount_debts"
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <li>
                                    <label>Other Outgoings Due</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        v-model="amount_expenses"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                        @change="setInputToDouble($event)"
                                        name="amount_expenses"
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-row">
                            <ul class="half-width">
                                <li>
                                    <label>Net Assets</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                    <input
                                        type="number"
                                        v-model="netAssets"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <li>
                                    <label>Nisab Threshold</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                      <input
                                        type="number"
                                        :readonly="true"
                                        v-model="amount_nisab"
                                        class="input-bx"
                                        value=""
                                        placeholder=""
                                      />
                                      <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                            </ul>
                        </div>
                        <div class="custom-row">
                            <ul class="half-width">
                                <li>
                                  <label>YOUR TOTAL AMOUNT LIABLE FOR ZAKAT</label>
                                </li>
                                <li>
                                  <div class="field-wrap">
                                    <input
                                    type="number"
                                    :readonly="true"
                                    v-model="zakatableAmount"
                                    class="input-bx"
                                    value=""
                                    placeholder=""
                                  />
                                  <span class="currency-icon"><i class="fas fa-pound-sign"></i></span>
                                  </div>
                                </li>
                                <div>{{ errors.zakatableAmount }}</div>
                              </ul>
                            </div>

                            <div class="custom-row border-0 pt-0">
                              <div class="btn-wrap-row">
                              <button class="btn-wrap" v-on:click="addToCart">
                                {{ loading ? "Loading..." : "Donate now" }}
                              </button>
                            </div>
                        </div>
                      </div>
                  </div>
              </div><!--// End Zakat Calculate Right Content -->
          </div>
      </div>
    </section><!--// End Zakat Calculate Page Section -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      amount_home: '',
      amount_bank: '',
      amount_shares: '',
      amount_merchandise: '',
      amount_gold: '',
      amount_property: '',
      amount_other: '',
      amount_debts: '',
      amount_expenses: '',
      amount_nisab: 361.29,
      amount_zakah1: 0.0,
      errors: [],
      loading: false,
      currencyValue: 0,
      cartData: {
        id: "",
        title: "",
        paymenttype: "One-off",
        amount: 10,
        appeal: "Zakat"
      },
    };
  },

  computed: {
    netAssets: function () {
      let calamt = 0;
      this.amount_zakah1 = parseFloat(this.amount_home) + parseFloat(this.amount_bank) + parseFloat(this.amount_shares) + parseFloat(this.amount_merchandise) + parseFloat(this.amount_gold) + parseFloat(this.amount_property);
      calamt = parseFloat(this.amount_zakah1) - parseFloat(this.amount_debts) - parseFloat(this.amount_expenses) - parseFloat(this.amount_nisab);
      if (calamt > 0) {
            return Math.round((parseFloat(this.amount_zakah1) - parseFloat(this.amount_debts) - parseFloat(this.amount_expenses)) * 100) / 100;
        } else {
            return 0.0;
        }
    },
    zakatableAmount: function () {
      let netassets = 0;
      netassets = this.netAssets;
      if (netassets > 0) {
            return Math.round( netassets * .025 * 100) / 100;
        } else {
            return 0.0;
        }
    }
  },
  methods: {
    setInputToDouble(event) {
      var element = event.target;
      const model = element.getAttribute('name');
      this[model] = parseFloat(event.target.value).toFixed(2);
      // If you want to access to some data by its name, you should do
      // model = 'genders' // just to ilustrate the example
      // this[model] = data
      // because this.model is equal to this['model'], and in the above code, this[model] is equal to this['genders'] or this.genders
    },
    addToCart() {
      // form validation
      this.validateForm();
      // if form is validated
      if (!this.errors.length) {
        this.loading = true;
        // this.cartData.id = 11111;
        this.cartData.title = "Zakat";
        this.cartData.image = "";
        this.cartData.amount = this.zakatableAmount;
        this.$store.commit("addToCart", this.cartData);
        this.$router.push({ name: "checkout" });
      }
    },
    addToCartQuickDonate(campaignData) {
      this.quickDonatevalidateForm();
      if (!this.errors.length) {
        this.cartData.title = "Where most needed";
        this.cartData.image = "";
        this.$store.commit("addToCart", this.cartData);
        this.$router.push({ name: "checkout" });
      }
    },
    quickDonatevalidateForm() {
      this.errors = [];
      if (this.cartData.amount < 1) {
        this.errors.push("Amount is required.");
        this.errors.amount = "Amount is required.";
      }
      if (!this.errors.length) {
        return true;
      }
    },
    validateForm() {
      this.errors = [];
      if (!this.zakatableAmount) {
        this.errors.push("Please Enter you Zakat Amount");
        this.errors.zakatableAmount = "Please Enter you Zakat Amount";
      }

      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 2000, behavior: "smooth" });
      }
    }
  },
};
</script>
