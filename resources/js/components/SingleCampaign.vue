<template>
  <div>
    <!-- Begin Campaign Single Banner Section -->
    <section
      class="campaign-single-banner"
      v-bind:style="[
        {
          backgroundImage:
            'url(' + image_src + campaign.banner.replace(/\\/g, '/') + ')',
        },
        { backgroundSize: 'cover' },
        { backgroundPosition: 'center 0' },
      ]"
    >
      <div class="container">
        <div class="row">
         <div class="col-sm-7"></div>
          <div class="col-sm-5">
            <div class="campaign-donation-wrap">
              <div class="campaign-donation-inner-content">
                <!-- <form @submit.prevent="addToCart"> -->
                <div class="campaign-donation-content">
                  <h1>{{ campaign.title }}</h1>
                  <div id="campaigndonationbox">
                    <div>
                      <ul class="payment-type-wrap">
                        <li
                          class="tabs"
                          :class="{ activeTab: selectedTab === tab }"
                          v-for="(tab, index) in tabs"
                          :key="index"
                          @click="selectedTab = tab"
                        >
                          <div class="select-payment-type">
                            <label>
                              <span>{{ tab }}</span>
                              <input
                                type="radio"
                                :value="tab"
                                v-model="cartData.paymenttype"
                              />
                            </label>
                          </div>
                        </li>
                      </ul>
                    </div>

                    <!-- <div v-show="selectedTab === 'Monthly'" class="donate-amount-box-wrap"> -->
                    <!-- Begin Donation Amount for one-off -->
                    <div v-show="selectedTab === 'One-off'" class="donate-amount-box-wrap monthly">
                      <ul class="three-col">
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.oneoff_amount1_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.oneoff_amount1"
                                checked
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.oneoff_amount1 }}
                                <small>{{ campaign.oneoff_amount1_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.oneoff_amount2_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.oneoff_amount2"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.oneoff_amount2 }}
                                <small>{{ campaign.oneoff_amount2_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.oneoff_amount3_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.oneoff_amount3"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.oneoff_amount3 }}
                                <small>{{ campaign.oneoff_amount3_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                      </ul>
                      <ul class="two-col">
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.oneoff_amount4_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.oneoff_amount4"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.oneoff_amount4 }}
                                <small>{{ campaign.oneoff_amount4_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-other-amount-li">
                          <div class="input-wrap other-amount-wrap">
                            <span class="currency-icon"
                              ><i class="fas fa-pound-sign"></i
                            ></span>
                            <input
                              v-on:click="showAmountText('')"
                              type="number"
                              v-model="cartData.amount"
                              class="input-bx other-amount"
                              placeholder="Other amount"
                            />
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!--// End Donation Amount -->
                    <!-- Begin Donation Amount for monthly -->
                    <div v-show="selectedTab === 'Weekly' || selectedTab === 'Monthly'" class="donate-amount-box-wrap monthly">
                      <ul class="three-col">
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.monthly_amount1_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.monthly_amount1"

                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.monthly_amount1 }}
                                <small>{{ campaign.monthly_amount1_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.monthly_amount2_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.monthly_amount2"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.monthly_amount2 }}
                                <small>{{ campaign.monthly_amount2_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.monthly_amount3_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.monthly_amount3"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.monthly_amount3 }}
                                <small>{{ campaign.monthly_amount3_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                      </ul>
                      <ul class="two-col">
                        <li class="campaign-donate-amount">
                          <div class="select-donate-amount">
                            <label>
                              <input
                                v-on:click="
                                  showAmountText(campaign.monthly_amount4_des)
                                "
                                type="radio"
                                v-model="cartData.amount"
                                :value="campaign.monthly_amount4"
                              />
                              <span
                                ><i class="fas fa-pound-sign"></i>
                                {{ campaign.monthly_amount4 }}
                                <small>{{ campaign.monthly_amount4_des }}</small></span
                              >
                            </label>
                          </div>
                        </li>
                        <li class="campaign-donate-other-amount-li">
                          <div class="input-wrap other-amount-wrap">
                            <span class="currency-icon"
                              ><i class="fas fa-pound-sign"></i
                            ></span>
                            <input
                              v-on:click="showAmountText('')"
                              type="number"
                              v-model="cartData.amount"
                              class="input-bx other-amount"
                              placeholder="Other amount"
                            />
                          </div>
                        </li>
                      </ul>
                    </div>
                    <!--// End Donation Amount -->

                    <!-- Begin Donation Type -->
                    <div class="custom-row">
                      <select v-model="cartData.appeal" class="select-bx">
                        <option
                          v-for="data in appeals"
                          v-bind:key="data.id"
                          v-bind:value="data.name"
                        >
                          {{ data.name }}
                        </option>
                      </select>
                    </div>
                    <!--// End Donation Type -->
                    <!-- <input type="radio" :value="campaign.id" v-model="cartData.id"> -->
                    <!-- <input type="radio" :value="campaign.title" v-model="cartData.title"> -->
                    <!-- Begin Donate Button -->
                    <div class="custom-row">
                      <a
                        v-on:click="addToCart(campaign)"
                        class="btn-wrap red-btn"
                      >
                        Donate
                        <span class="loading d-none"></span>
                      </a>
                    </div>
                    <!--// End Donate Button -->
                    <!-- Begin Donation Amount Related Text -->
                    <!-- <div class="donation-info-wrap monthly active">
                      <ul>
                        <li class="monthly-donation-info 10 active">
                          {{ amountRelatedText }}
                        </li>
                      </ul>
                    </div> -->
                    <!--// End Donation Amount Related Text -->
                    <!-- </div> -->
                  </div>
                </div>
                <!-- </form> -->
              </div>
              <p class="secure-txt"><span class="material-icons">security</span> Secure payments via Stripe</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Campaign Single Banner Section -->

    <!-- Begin Campaign Single Section -->
    <section class="section-wrap campaign-single-section bg-white">
      <div class="container">
        <div class="row">
          <!-- Begin Campaign Single Left Content -->
          <div class="col-sm-7">
            <!-- Begin Campaign Single Content -->
            <div
              class="campaign-single-content"
              v-html="campaign.description"
            ></div>
            <!--// End Campaign Single Content -->
          </div>
          <!--// End Campaign Single Left Content -->
          <!-- Begin Campaign Single Right Content -->
          <div class="col-sm-5">
            <div class="sidebar-wrap">
              <div class="campaign-related-news-wrap">
                <div class="title">
                  <h3>Latest news relating to orphans and widows</h3>
                </div>
                <ul>
                  <li v-for="post in campaign.posts" :key="post.id">
                    <!-- <a
                      :href="
                        $router.resolve({
                          name: 'edit',
                          params: { id: post.slug },
                        }).href
                      "
                      >{{ post.title }}</a
                    > -->
                    <router-link
                      :to="{
                        name: 'edit',
                        params: { id: post.slug },
                      }"
                      >{{ post.title }}
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--// End Campaign Single Right Content -->
        </div>
      </div>
    </section>
    <!--// End Campaign Single Section -->

    <!-- Begin Related Campaigns Section -->
    <section
      v-if="relatedcampaigns.length"
      class="section-wrap related-campaigns-section bg-light-grey"
    >
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title">
              <h2>Related campaigns that you might like to support</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="campaigns-content">
            <ul>
              <li
                v-for="relatedcampaign in relatedcampaigns"
                :key="relatedcampaign.id"
                class="col-sm-4"
              >
                <div class="campaign-item-wrap">
                  <div class="thumb-wrap">
                    <img
                      v-bind:src="image_src + relatedcampaign.thumbnail"
                      v-bind:alt="relatedcampaign.title"
                    />
                  </div>
                  <div class="campaign-bottom-content">
                    <div class="title">
                      <h3>{{ relatedcampaign.title }}</h3>
                    </div>
                    <div class="campaign-short-des">
                      <p v-html="relatedcampaign.excerpt"></p>
                    </div>
                    <div class="campaign-donate-btn">
                      <!-- <router-link :to="{name: 'campaign', params: { id: relatedcampaign.slug }}" class="btn-wrap">Donate now
                                            </router-link> -->
                      <a
                        :href="
                          $router.resolve({
                            name: 'campaign',
                            params: { id: relatedcampaign.slug },
                          }).href
                        "
                        class="btn-wrap"
                        >Donate now</a
                      >
                    </div>
                  </div>
                  <a
                    :href="
                      $router.resolve({
                        name: 'campaign',
                        params: { id: relatedcampaign.slug },
                      }).href
                    "
                    class="full-link"
                  ></a>
                  <!-- <router-link :to="{name: 'campaign', params: { id: relatedcampaign.slug }}" class="full-link"></router-link> -->
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!--// End Related Campaigns Section -->
    <!-- Begin Donete Basket Slide -->
    <div v-if="donateBasketSlide">
      <!-- <transition name="model"> -->
      <div class="modal-mask modal">
        <div
          class="custom-modal-backdrop"
          @click="donateBasketSlide = false"
        ></div>
        <div
          class="modal-dialog modal-dialog-slideout modal-lg"
          role="document"
        >
          <div class="modal-content">
            <div class="donate-basket-container">
              <!-- <div class="close" data-dismiss="modal" aria-hidden="true"><span class="material-icons">clear</span></div> -->
              <button
                type="button"
                class="close"
                @click="donateBasketSlide = false"
              >
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="custom-row">
                <div class="title">
                  <h1>Your donations ({{ $store.state.cartCount }})</h1>
                </div>
                <div class="donate-basket-content">
                  <ul>
                    <li v-for="item in $store.state.cart" :key="item.id">
                      <div class="donate-basket-item-wrap">
                        <div class="thumb-col column">
                          <!-- <img :src="'/images/campaign-img.jpg'" alt="image" /> -->
                          <img :src="image_src + item.image" alt="image" />
                        </div>
                        <div class="title-col column">
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
                <!-- <div v-if="$store.state.cartCount > 0" class="donate-basket-other-campaigns"> -->
                <div v-if="isSingleExist" class="donate-basket-other-campaigns">
                    <h3>Would you like to cover our admin cost?</h3>
                    <ul>
                        <li>
                            <div class="checkbx-wrap">
                                <div class="custom-checkbox">
                                    <input type="checkbox" id="adminCost" v-model="cartData.admincost" @change="addAdminCost()">
                                    <label for="adminCost">
                                          <h4>Admin cost (one-off)</h4>
                                          <p>£{{parseFloat(adminPercentage*totalSinglePrice/100).toFixed(2)}}</p>
                                    </label>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="donate-basket-total-amount-wrap">
                  <div class="donate-basket-total-amount">
                    <div class="total-txt column">
                      <h3>Total donation</h3>
                    </div>
                    <div class="total-amount column">
                      <h3>£{{totalPricewithAdminCost(totalPrice, totalSinglePrice)}}</h3>
                    </div>
                  </div>
                </div>
                <div class="btn-wrap-row">
                  <a :href="base_url + '/campaigns'" class="btn-wrap transparent-btn"
                    >Add another donation</a
                  >
                  <a :href="base_url + '/checkout'" class="btn-wrap">
                    Proceed to payment
                    <span class="loading d-none"></span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- </transition> -->
    </div>
    <!-- End Donete Basket Slide -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      campaign: {},
      relatedcampaigns: {},
      selectedTab: "One-off",
      cartData: {
        id: "",
        title: "",
        paymenttype: "One-off",
        amount: '',
        appeal: "",
        admincost: this.$store.state.adminCost,
        countries: "",
        allocation_type: "",
        theme: ""
      },
      cartContent: {},
      // tabs: ["One-off"],
      // tabs: ["One-off","Weekly", "Monthly"],
      tabs: ["One-off", "Monthly"],
      donateBasketSlide: false,
      appeals: [],
      amountRelatedText: "",
      adminPercentage: 0,
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  created() {
    this.axios
      .get(this.base_url +`/api/campaign/campaign/${this.$route.params.id}`)
      .then((response) => {
        window.scrollTo(0, 0);
        this.amountRelatedText = response.data.campaign.oneoff_amount1_des;
        // this.cartData.amount = response.data.campaign.oneoff_amount1;
        this.campaign = response.data.campaign;
        this.relatedcampaigns = response.data.relatedcampaigns;
        console.log(response.data);
      });
  },
  mounted() {
    this.getAppeals();
    this.getAdminPercentage();
  },
  computed: {
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
      }

      // return parseInt(total).toFixed(2);
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
    }
  },
  methods: {
     totalPricewithAdminCost(totalPrice, totalSinglePrice) {
       if(this.cartData.admincost)
       return (parseFloat(totalPrice)+parseFloat(this.adminPercentage*totalSinglePrice/100)).toFixed(2);
       else
       return totalPrice;
    },
    addAdminCost() {
        // get percentage value from settings
        this.$store.commit("adminCost", this.cartData.admincost);
    },
    showAmountText(text) {
      this.amountRelatedText = text;
    },
    addToCart(campaignData) {
      if (!campaignData.id) {
        this.errors.push("The name field is required.");
        this.errors.name = "The name field is required.";
        window.scrollTo({ top: 200, behavior: "smooth" });
      }
      this.cartData.id = campaignData.id;
      this.cartData.title = campaignData.title;
      this.cartData.allocation_type = campaignData.allocation_type;
      this.cartData.theme = campaignData.theme;
      this.cartData.image = campaignData.thumbnail;
      for (let country of campaignData.countries) {
        if(campaignData.countries.length > 1)
          
          this.cartData.countries += country.title+"-";
        else
          this.cartData.countries = country.title;
       }
      if(!this.cartData.amount){
        alert("Please Select Any Amount")
      }else{
        this.$store.commit("addToCart", this.cartData);
        this.donateBasketSlide = true;
      }
      
    },
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    getAppeals() {
      this.axios
        .get(this.base_url +"/api/appeals")
        .then((response) => {
          this.appeals = response.data;
          this.cartData.appeal = response.data[0].name;
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    getAdminPercentage() {
      return this.axios.get(this.base_url +"/api/admincost").then((response) => {
        this.adminPercentage = response.data;
      });
    }
  },
};
</script>
