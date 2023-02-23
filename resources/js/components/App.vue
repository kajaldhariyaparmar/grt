<template>
  <div class="main-wrap clear">
    <!-- Begin Mobile Menu -->
    <div v-show="mobilemenuopen == mobilemenuopen" :aria-pressed="mobilemenuopen ? 'true' : 'false'" :class="{ mobilemenuopen: mobilemenuopen }">
      <div class="mobile-menu-backdrop" v-on:click="mobilemenuopen = !mobilemenuopen" :aria-pressed="mobilemenuopen ? 'false' : 'false'" :class="{ active: mobilemenuopen }"></div>
      <div v-if="!isCheckoutPage" class="mobile-nav-wrap">
        <!-- Begin Close Icon  -->
        <div class="mobile-nav-icon">
          <div class="phone-nav close-nav" v-on:click="mobilemenuopen = !mobilemenuopen">
          <div class="material-icons">clear</div>
          </div>
        </div>
        <!--// End Close Icon  -->
        <div class="mobile-nav">
          <div class="main-nav-wrap">
            <div class="nav-container fw-medium">
              <ul>
                
                <li><router-link to="/about">About</router-link></li>
                <li class="small-submenu">
                  <router-link to="/campaigns">Sadaqah</router-link>
                  <span class="dropdown-arrow" v-on:click="customdropdown = !customdropdown" :aria-pressed="customdropdown ? 'true' : 'false'" :class="{ active: customdropdown }"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                    <div class="dropdown-menu-wrap" :class="{ active: customdropdown }">
                        <div class="dropdown-menu-content">
                            <div class="custom-dropdown-menu">
                                <ul class="dropdown-menu-ul">
                                  <li v-for="data in projects"
                                    v-bind:key="data.id"
                                    v-bind:value="data.id">
                                      <router-link
                                        :to="{ name: 'campaign', params: { id: data.slug} }"
                                        >{{data.title}}
                                      </router-link>
                                  </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="small-submenu">
                  <router-link to="/campaigns">Countries</router-link>
                  <span class="dropdown-arrow" v-on:click="customdropdown1 = !customdropdown1" :aria-pressed="customdropdown1 ? 'true' : 'false'" :class="{ active: customdropdown1 }"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                    <div class="dropdown-menu-wrap" :class="{ active: customdropdown1 }">
                        <div class="dropdown-menu-content">
                            <div class="custom-dropdown-menu">
                                <ul class="dropdown-menu-ul">
                                  <li v-for="data in countries"
                                    v-bind:key="data.id"
                                    v-bind:value="data.id">
                                      <router-link
                                        :to="{ name: 'campaign', params: { id: data.slug+'-appeal'} }"
                                        >{{data.slug}}
                                      </router-link>
                                  </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <li><router-link to="/zakat">Zakat</router-link></li>
                <!-- <li><router-link to="/posts">News</router-link></li> -->
                <li><router-link to="/events">Events</router-link></li>
                <li><router-link to="/contact">Contact</router-link></li>
              </ul>
              <div class="mobile-menu-donate-btn">
                <div class="header-donate-btn">
                  <a
                    v-if="$store.state.cartCount > 0"
                    href="/checkout"
                    class="btn-wrap"
                    >Donate now</a
                  >
                  <a v-else href="/campaigns" class="btn-wrap">Donate now</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--// End Mobile Menu -->
    <!-- Begin Main Wrap -->
    <div class="main-wrap clear">
      <!-- Begin Main Wrap Inner -->
      <div class="main-wrap-inner clear">
        <!-- Begin Header -->
        <header class="header">
          <!-- Begin Header Top -->
          <div class="header-top-wrap bg-white">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <div class="logo-wrap">
                    <router-link to="/"
                      ><img :src="base_url + '/images/logo.svg'" alt="GRT"
                    /></router-link>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div v-if="!isCheckoutPage" class="header-top-right">
                    <!-- <div class="header-fundraise-btn">
                        <router-link :to="{ name: 'fundraising' }" class="btn-wrap transparent-btn">
                            <span class="material-icons">groups</span>Fundraise
                        </router-link>
                    </div> -->
                    <div class="header-donate-btn">
                      <!-- <router-link v-if="$store.state.cartCount > 0 && isLoggedIn" to="/checkout" class="btn-wrap red-btn"
                        ><span v-if="$store.state.adminCost == true" class="cart-icon-wrap">
                          <span class="material-icons-outlined"
                            >shopping_cart</span
                          >
                        </span>Donate
                        <span v-if="$store.state.adminCost == true" class="header-cart-count">(£{{totalPricewithAdminCost}})</span>
                        <span v-if="$store.state.adminCost == false" class="header-cart-count">(£{{totalPrice}})</span>
                      </router-link> -->
                      <router-link v-if="$store.state.cartCount > 0" to="/checkout" class="btn-wrap red-btn"
                        ><span v-if="$store.state.adminCost == true" class="cart-icon-wrap">
                          <span class="material-icons-outlined"
                            >shopping_cart</span
                          >
                        </span>Donate
                        <span v-if="$store.state.adminCost == true" class="header-cart-count">(£{{totalPricewithAdminCost}})</span>
                        <span v-if="$store.state.adminCost == false" class="header-cart-count">(£{{totalPrice}})</span>
                      </router-link>
                      <router-link v-else to="/campaigns" class="btn-wrap red-btn">Donate
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--// End Header Top -->
          <!-- Begin Header Menu Container -->
          <div v-if="!isCheckoutPage" class="header-menu-container bg-white">
            <div class="container clear">
              <div class="row">
                <div class="col-sm-12">
                  <div class="menu-container">
                    <div class="phone-nav open-nav" v-on:click="mobilemenuopen = !mobilemenuopen" :aria-pressed="mobilemenuopen ? 'true' : 'false'" :class="{ active: mobilemenuopen }">
                      <span></span>
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <div class="main-nav-wrap">
                      <div class="nav-container fw-medium">
                        <ul>
                          <li class="small-submenu">
                              <router-link to="campaign/ramadan-appeal">Ramadan</router-link>
                              <span  class="dropdown-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                              <div class="dropdown-menu-wrap">
                                  <div class="dropdown-menu-content">
                                      <div class="custom-dropdown-menu">
                                          <ul class="dropdown-menu-ul">
                                              <li><router-link to="campaign/fidya">Fidya</router-link></li>
                                              <li><router-link to="campaign/kaffarah">Kaffarah</router-link></li>
                                              <li><router-link to="campaign/fitrana">Fitrana</router-link></li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li><router-link to="/about">About</router-link></li>
                          <li class="small-submenu">
                              <router-link :to="{ name: 'campaigns' }">Sadaqah</router-link>
                              <span  class="dropdown-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                              <div  class="dropdown-menu-wrap">
                                  <div class="dropdown-menu-content">
                                      <div class="custom-dropdown-menu">
                                          <ul class="dropdown-menu-ul">
                                              <li v-for="data in projects"
                                          v-bind:key="data.id"
                                          v-bind:value="data.id">
                                                <router-link
                                                  :to="{ name: 'campaign', params: { id: data.slug} }"
                                                  >{{data.title}}
                                                </router-link>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </li>
                          <li class="small-submenu">
                              <router-link :to="{ name: 'campaigns' }">Countries</router-link>
                              <span  class="dropdown-arrow"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                              <div  class="dropdown-menu-wrap">
                                  <div class="dropdown-menu-content">
                                      <div class="custom-dropdown-menu">
                                          <ul class="dropdown-menu-ul">
                                              <li v-for="data in countries"
                                          v-bind:key="data.id"
                                          v-bind:value="data.id">
                                                <router-link
                                                  :to="{ name: 'campaign', params: { id: data.slug+'-appeal'} }"
                                                  >{{data.slug}}
                                                </router-link>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                              </div>
                          </li>
                            <li><router-link to="/zakat">Zakat</router-link></li>
                          <!-- <li><router-link to="/posts">News</router-link></li> -->
                          <li><router-link to="/events">Events</router-link></li>
                          <li>
                            <router-link to="/contact"
                              >Contact</router-link
                            >
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="right-menu">
                      <ul>
                        <!-- <li>
                          <router-link :to="{ name: 'fundraising' }"
                            >Fundraise for us</router-link
                          >
                        </li> -->
                        <!-- <li>
                          <a href="#">Be a hero</a>
                        </li> -->
                        <li>
                          <router-link
                            v-if="isLoggedIn"
                            :to="{ name: 'userdashboard' }"
                            >My account</router-link
                          >
                        </li>
                        <li>
                          <a v-if="isLoggedIn" href="#" @click.prevent="logout"
                            >Logout</a
                          >
                          <a v-else :href="base_url +'/login'">My account</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--// End Header Menu Container -->
        </header>
        <!--// End Header -->
        <router-view :key="$route.fullPath"></router-view>
      </div>
      <!--// End Main Wrap Inner-->
    </div>
    <!--// End Main Wrap -->
    <!-- Begin Footer -->
    <footer class="footer bg-light-black" v-bind:class="{ 'home-footer': isHomePage }">
        <div class="footer-section">
            <div class="container">
               <div class="row">
                    <div class="col-sm-5 footer-column">
                        <h5>Global Relief Trust (GRT) is a leading Muslim charity working across the globe founded in the UK in 2009 by a group of inspired friends determined to do good.</h5>
                    </div>
                    <div class="col-sm-3 footer-column">
                        <h6>Useful links</h6>
                        <ul class="footer-menu-wrap">
                            <li>
                                <a :href="base_url + '/about'">About us</a>
                            </li>
                            <!-- <li>
                                <a :href="base_url + '/posts'">News</a>
                            </li> -->
                            <li>
                                <a :href="base_url + '/contact'">Contact us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-sm-4 footer-column">
                        <h6>Bank details</h6>
                        <span>Account no: 00695602</span>
                        <span>Sort code: 20-08-64</span>
                        <span>Swift/BIC code: BUKBGB22</span>
                        <span>IBAN: GB42 BUKB 2008 6400 6956 02</span>
                        <div class="footer-social-media">
                            <ul>
                                <li><a href="https://www.facebook.com/globalrelieftrustuk" target="_blank">Facebook</a></li>
                                <li><a href="https://www.instagram.com/globalrelieftrust/?igshid=sxqcbmz23ev" target="_blank">Instagram</a></li>
                                <li><a href="#" target="_blank">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
               </div>
               <div class="row">
                    <div class="copyright">
                        <div class="col-sm-12">
                            <p>Copyright @ {{ new Date().getFullYear() }} GRT, All Right Reserved. We do not deal with interest money. Charity Number: 1191793</p>
                            <p><a href="#!default-page">Privacy policy</a> | <a href="#!default-page">Terms & conditions</a> </p>
                        </div>
                    </div>

               </div>
           </div>
        </div>
    </footer>
    <!--// End Footer -->
    <!-- Begin Donete Basket Slide -->
    <div v-if="myModel">
      <transition name="model">
        <div class="modal-mask">
          <div class="custom-modal-backdrop" @click="myModel = false"></div>
          <div
            class="modal-dialog modal-dialog-slideout modal-lg"
            role="document"
          >
            <div class="modal-content">
              <div class="donate-basket-container">
                <button type="button" class="close" @click="myModel = false">
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
                            <img :src="image_src + item.image" alt="image" />
                          </div>
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
                            <!-- <span class="remove-item" @click.prevent="removeFromCart(item)">X</span> -->
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
                        <h3 v-if="$store.state.adminCost == true">£{{ totalPricewithAdminCost }}</h3>
                        <h3 v-else>£{{ totalPrice }}</h3>
                      </div>
                    </div>
                  </div>
                  <div class="btn-wrap-row">
                    <router-link
                      to="/campaigns"
                      class="btn-wrap transparent-btn"
                      >Add another donation</router-link
                    >
                    <router-link to="/checkout" class="btn-wrap">
                      Proceed to payment
                      <span class="loading d-none"></span>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
    <!-- End Donete Basket Slide -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      myModel: false,
      admincost: this.$store.state.adminCost,
      adminPercentage:0,
      projects: [],
      countries: [],
      project: 0,
      country: 0,
      isLoggedIn: false,
      mobilemenuopen:false,
      customdropdown:false,
      customdropdown1:false,
      base_url: 'http://localhost/grt',
      image_src: 'http://localhost/grt/storage/app/public/',
    };
  },
  computed: {
    isHomePage() {
      if(this.$route.path == "/" ) {
        return true;
      } else {
        return false;
      }
    },
    isCampaignPage() {
      if(this.$route.path == "/campaigns" ) {
        return true;
      } else {
        return false;
      }
    },
    isCheckoutPage() {
      if(this.$route.path == "/checkout" || this.$route.path == "/your-details" || this.$route.path == "/payment-details") {
        return true;
      } else {
        return false;
      }
    },
    totalPrice() {
      let total = 0;
      for (let item of this.$store.state.cart) {
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
    totalPricewithAdminCost() {
      let totalPrice = this.totalPrice;
        return (parseFloat(totalPrice)+parseFloat(this.adminPercentage*this.totalSinglePrice/100)).toFixed(2);
    }
  },
  methods: {
    projectClicked: function(e) {
      this.$router.push({
        name: "campaigns",
        params: { project: e.currentTarget.getAttribute('project-id'), flag: 'menu' }
      });
    },
    countryClicked: function(e) {
      this.$router.push({
        name: "campaigns",
        params: { country: e.currentTarget.getAttribute('country-id'), flag: 'menu' }
      });
    },
    getAdminPercentage() {
      return this.axios.get(this.base_url + "/api/admincost").then((response) => {
        this.adminPercentage = response.data;
      });
    },
    openModel: function () {
      this.myModel = true;
    },
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    logout() {
      axios.post(this.base_url + "/logout").then((response) => {
        this.isLoggedIn = false;
        localStorage.setItem('usertoken', false);
        window.location.href = this.base_url + "/login";
      });
    },
    getloginstate() {
      let self = this;
      axios.get(this.base_url + "/loginstate").then((response) => {
        self.isLoggedIn = response.data;
        localStorage.setItem('usertoken', response.data);
      });
    },
    filterProjects() {
      this.axios
        .get(this.base_url + "/api/projects")
        .then((response) => {
          this.projects = response.data;
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    filterCountries() {
      this.axios
        .get(this.base_url + "/api/countries")
        .then((response) => {
          this.countries = response.data;
          console.log(this.countries)
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
  },
  mounted() {
    this.getAdminPercentage();
    this.getloginstate();
    this.filterProjects();
    this.filterCountries();
  },
};
</script>
