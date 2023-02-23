<template>
  <div>
    <!-- Begin Banner Section-->
    <section
      v-if="loading"
      v-bind:class="{ loading: loading }"
      class="banner-section-wrap"
    ></section>
    <section v-else class="banner-section-wrap img-fluid w-100 clear">
      <b-carousel
        id="carousel-1"
        v-model="slide"
        :interval="4000"
        controls
        indicators
        background="#ababab"
        img-width="1024"
        img-height="480"
        style="text-shadow: 1px 1px 2px #333"
        @sliding-start="onSlideStart"
        @sliding-end="onSlideEnd"
      >
        <b-carousel-slide
          v-for="campaign in slidecampaigns"
          :key="campaign.id"
          :caption="campaign.title"
          :img-src="image_src + campaign.banner"
        >
          <div class="banner-caption-wrap">
            <div class="container">
              <div class="row">
                <div class="col-sm-6">
                  <div class="banner-caption-content bg-white">
                    <h3 v-html="campaign.excerpt"></h3>
                    <h1>{{ campaign.title }}</h1>
                    <div class="custom-row">
                      <router-link
                        :to="{
                          name: 'campaign',
                          params: { id: campaign.slug },
                        }"
                        class="btn-wrap"
                        >Donate now
                      </router-link>
                      <!-- <router-link
                        :to="{
                          name: 'campaign',
                          params: { id: campaign.slug },
                        }"
                        class="link-txt"
                        >Find out more</router-link
                      > -->
                    </div>
                  </div>
                </div>
                <!-- Begin Banner Video Block -->
                <div v-if="campaign.video_link" class="col-sm-6">
                  <div class="banner-caption-video-wrap">
                      <div class="banner-caption-video">
                          <iframe width="560" height="315" :src="campaign.video_link" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      </div>
                  </div>
                </div><!-- End Banner Video block -->
              </div>
            </div>
          </div>
        </b-carousel-slide>
      </b-carousel>
    </section>
    <!-- End Banner Section-->
    <!-- Begin About Section -->
    <section class="section-wrap home-about-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-about-content">
                        <h3 v-html="home.intro"></h3>
                        <router-link to="/about">Learn more</router-link>
                    </div>
                    <!-- Begin Video Block -->
                    <div class="home-about-video-wrap">
                        <div class="home-about-video">
                            <iframe width="560" height="315" :src="home.video_link" title="Intro video" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div><!-- End Video block -->
                </div>
            </div>
        </div>
    </section><!--// End About Section -->
    <!-- Begin Quick Donate desktop Section -->
    <section class="section-wrap quick-donate-section desktop-show bg-white">
      <div class="quick-donate-wrap">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <form action="#" method="post" id="" name="">
                <div class="quick-donate-content">
                  <div class="quick-title-col column">
                    <h3>Quick donate</h3>
                  </div>
                  <div class="quick-payment-type-col column">
                    <select v-model="cartData.paymenttype" class="select-bx">
                      <option value="One-off">One-off</option>
                      <option value="Monthly">Monthly</option>
                    </select>
                  </div>
                  <div class="quick-donation-type-col column">
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
                      <div>{{ errors.amount }}</div>
                    </div>
                  </div>
                  <div class="quick-btn-col column">
                    <a v-on:click="addToCart(campaign)" class="btn-wrap red-btn">
                      Donate now
                      <span class="loading d-none"></span>
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Quick Donate Desktop Section -->
    <!-- Begin Quick Donate Mobile View Section -->
    <section class="section-wrap quick-donate-section mobile-show bg-white">
      <div class="quick-donate-wrap">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
            <div class="quick-donate-mobile-title">
                <h2>Quick donate</h2>
                <a role="button" class="quick-donate-mobile-show-btn" v-on:click="quickDonateShowMobileView = !quickDonateShowMobileView" :aria-pressed="quickDonateShowMobileView ? 'true' : 'false'" :class="{ active: quickDonateShowMobileView }">
                    <span class="material-icons more">expand_less</span>
                </a>
            </div>
              <form action="#" method="post" id="" name="">
                <div class="quick-donate-content" v-show="quickDonateShowMobileView">
                  <div class="quick-title-col column">
                    <h3>Quick donate</h3>
                  </div>
                  <div class="quick-payment-type-col column">
                    <select v-model="cartData.paymenttype" class="select-bx">
                      <option value="One-off">One-off</option>
                      <option value="Monthly">Monthly</option>
                    </select>
                  </div>
                  <div class="quick-donation-type-col column">
                    <select v-model="cartData.appeal" class="select-bx">
                      <option
                        v-for="data in quickappeals"
                        v-bind:key="data.id"
                        v-bind:value="data.name"
                      >
                        {{ data.name }}
                      </option>
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
                      <div>{{ errors.amount }}</div>
                    </div>
                  </div>
                  <div class="quick-btn-col column">
                    <a v-on:click="addToCart(campaign)" class="btn-wrap red-btn">
                      Donate now
                      <span class="loading d-none"></span>
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Quick Donate Mobile View Section -->
    <!-- Begin Campaigns Section -->
    <section class="section-wrap campaigns-section bg-light-grey">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="section-title">
              <h2>Support our campaigns</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="campaigns-content">
            <ul class="three-col-grid">
              <li
                v-for="campaign in campaigns"
                :key="campaign.id"
              >
                <div class="campaign-item-wrap">
                  <div class="thumb-wrap">
                    <img
                      v-bind:src="image_src + campaign.thumbnail"
                      v-bind:alt="campaign.title"
                    />
                  </div>
                  <div class="campaign-bottom-content">
                    <div class="title">
                      <h3>{{ campaign.title }}</h3>
                    </div>
                    <div class="campaign-short-des">
                      <p v-html="campaign.excerpt"></p>
                    </div>
                    <div class="campaign-donate-btn">
                      <router-link
                        :to="{
                          name: 'campaign',
                          params: { id: campaign.slug },
                        }"
                        class="btn-wrap"
                        >Donate now
                      </router-link>
                    </div>
                  </div>
                  <router-link
                    :to="{ name: 'campaign', params: { id: campaign.slug } }"
                    class="full-link"
                  ></router-link>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!--// End Campaigns Section -->

    <!-- Begin Upcoming Events Section -->
    <section class="section-wrap upcoming-events-section bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Upcoming events</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="upcoming-events-container">
                        <ul class="slides three-col-grid">
                            <li v-for="upcomingevent in upcomingevents"
                            :key="upcomingevent.id">
                                <div class="upcoming-events-content-wrap">
                                    <div class="column thumb-column">
                                        <div class="thumb-wrap">
                                            <router-link
                                                :to="{
                                                name: 'event',
                                                params: { id: upcomingevent.slug },
                                                }"
                                                >
                                                <img
                                                v-bind:src="image_src + upcomingevent.thumbnail"
                                                v-bind:alt="upcomingevent.title"
                                                />
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="column description-column">
                                        <div class="upcoming-events-content">
                                            <div class="events-date-location">
                                                <p class="events-date"><span><i class="far fa-calendar"></i></span>{{ dateFormat(upcomingevent.start_date) }}</p>
                                            </div>
                                            <h3 class="event-title"><router-link
                                                :to="{
                                                name: 'event',
                                                params: { id: upcomingevent.slug },
                                                }"
                                                >{{ upcomingevent.title }}</router-link></h3>
                                            <p class="short-description">{{ upcomingevent.title }}…</p>
                                            <div class="events-date-location">
                                                <p class="events-location"><span><i class="fas fa-map-marker-alt"></i></span>{{upcomingevent.location}}</p>
                                            </div>
                                            <router-link
                                            :to="{
                                            name: 'event',
                                            params: { id: upcomingevent.slug },
                                            }"
                                            class="event-more-details btn-wrap transparent-btn"
                                            >More details
                                        </router-link>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Upcoming Events Section -->

    <!-- Begin Our Impact Section -->
    <section class="section-wrap our-impact-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2>Our impact</h2>
                        <h3>Our vision is to eradicate poverty in the world and our mission is to serve communities and individuals around the world to become productive, self-supporting and flourish.</h3>
                        <h3>Since our humble beginning in 2009, we have achieved:</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="home-impact-content">
                        <div class="column">
                            <div class="impact-inner-content">
                                <div class="ipmact-icon-wrap">
                                    <img src="images/impact-icon1.svg" alt="Projects delivered">
                                </div>
                                <div class="impact-text-wrap">
                                    <h3>1,000</h3>
                                    <h4>Projects delivered</h4>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="impact-inner-content">
                                <div class="ipmact-icon-wrap">
                                    <img src="images/impact-icon2.svg" alt="Orphans sponsored">
                                </div>
                                <div class="impact-text-wrap">
                                    <h3>11,000</h3>
                                    <h4>Orphans sponsored</h4>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <div class="impact-inner-content">
                                <div class="ipmact-icon-wrap">
                                    <img src="images/impact-icon3.svg" alt="Families helped">
                                </div>
                                <div class="impact-text-wrap">
                                    <h3>10,000</h3>
                                    <h4>Families helped</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Our Impact Section -->
    <!-- Begin Our Impact Bottom Section Bg Wrap -->
    <div class="home-bg-section" style="background: url(http://localhost/grt/images/impact-bg.jpg) no-repeat center 0; background-size: cover;">
        <!-- Begin News Section -->
        <section class="section-wrap home-news-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="section-title">
                            <h2>Latest updates</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="home-news-content">
                            <ul>
                                <li v-for="post in posts" :key="post.id">
                                    <div class="home-news-item-wrap">
                                        <div class="column news-date-col">
                                            <span class="news-date">{{ dateFormat(post.created_at) }}</span>
                                        </div>
                                        <div class="column news-title-col">
                                            <h3 class="news-title">{{ post.title }}</h3>
                                        </div>
                                        <div class="column news-read-more-col">
                                        <router-link
                                          :to="{ name: 'edit', params: { id: post.slug } }"
                                          class="news-read-more"
                                          >Read more
                                        </router-link>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--// End News Section -->

        <!-- Begin Hadith Fetured Section -->
        <section class="section-wrap hadith-featured-section">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="hadith-content">
                            <h3>“The believers in their mutual kindness, compassion and sympathy are just like one body. When one of the limbs suffers, the whole body responds to it with wakefulness and fever”</h3>
                            <h3>- Prophet Muhammad (PBUH)</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="featured-content">
                            <ul class="featured-grid">
                                <li v-on:click="support(1)" :class="{active : support_active_element == 1}">
                                    <div class="featured-item">
                                        <div class="icon-wrap">
                                            <img src="http://localhost/grt/images/food.svg" alt="Food">
                                        </div>
                                        <h3 class="featurd-title">Food</h3>
                                        <div class="expandable-wrap">
                                            <p>We educate children with disabilities so they can fulfil their potential</p>
                                            <a href="https://theplayculture.com/grt/campaign/food">Read more</a>
                                        </div>
                                    </div>
                                </li>
                                <li v-on:click="support(2)" :class="{active : support_active_element == 2}">
                                    <div class="featured-item">
                                        <div class="icon-wrap">
                                            <img src="http://localhost/grt/images/medical.svg" alt="Medical">
                                        </div>
                                        <h3 class="featurd-title">Medical</h3>
                                        <div class="expandable-wrap">
                                            <p>We educate children with disabilities so they can fulfil their potential</p>
                                            <a href="https://theplayculture.com/grt/campaign/medical">Read more</a>
                                        </div>
                                    </div>
                                </li>
                                <li v-on:click="support(3)" :class="{active : support_active_element == 3}">
                                    <div class="featured-item">
                                        <div class="icon-wrap">
                                            <img src="http://localhost/grt/images/education.svg" alt="Education">
                                        </div>
                                        <h3 class="featurd-title">Education</h3>
                                        <div class="expandable-wrap">
                                            <p>We educate children with disabilities so they can fulfil their potential</p>
                                            <a href="https://theplayculture.com/grt/campaign/education">Read more</a>
                                        </div>
                                    </div>
                                </li>
                                <li v-on:click="support(4)" :class="{active : support_active_element == 4}">
                                    <div class="featured-item">
                                        <div class="icon-wrap">
                                            <img src="http://localhost/grt/images/Livelihood.svg" alt="Livelihood">
                                        </div>
                                        <h3 class="featurd-title">Livelihood</h3>
                                        <div class="expandable-wrap">
                                            <p>We educate children with disabilities so they can fulfil their potential</p>
                                            <a href="https://theplayculture.com/grt/campaign/livelihood">Read more</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section><!--// End Hadith Fetured Section -->
    </div><!--// End Our Impact Bottom Section Bg Wrap -->
  </div>
</template>
<script>
import moment from "moment";
export default {
  data() {
    return {
      posts: [],
      slidecampaigns: [],
      campaigns: [],
      campaign: {},
      cartData: {
        id: "",
        title: "",
        paymenttype: "One-off",
        // paymenttype: "Monthly",
        amount: 10,
        appeal: ""
      },
      home: {
        intro: "",
        video_link: ""
      },
      cartContent: {},
      appeals: [],
      quickappeals: [],
      errors: [],
      slide: 0,
      sliding: null,
      loading: true,
      support_active_element: 3,
      quickDonateShowMobileView: false,
      upcomingevents: [],
      base_url: 'http://localhost/grt',
      image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  mounted() {
    this.loadSlideCampaigns();
    this.loadCampaigns();
    this.loadPost();
    this.loadHomesettingsdata();
    this.getAppeals();
    this.getQuickAppeals();
    this.loadUpcomingEvents();
  },
  methods: {
    support:function(el) {
        this.support_active_element = el;
    },
    dateFormat(date) {
      return moment(date).format("dddd, DD MMM YYYY");
    },
    onSlideStart(slide) {
      this.sliding = true;
    },
    onSlideEnd(slide) {
      this.sliding = false;
    },
    addToCart(campaignData) {
      this.validateForm();
      if (!this.errors.length) {
        // this.cartData.id = 11111;
        this.cartData.title = "Where most needed";
        this.cartData.image = "";
        this.$store.commit("addToCart", this.cartData);
        // console.log(this.$store.state.count);
        // window.location.href = '/checkout';
        this.$router.push({ name: "checkout" });
      }
    },
    validateForm() {
      this.errors = [];
      if (this.cartData.amount < 1) {
        this.errors.push("Amount is required.");
        this.errors.amount = "Amount is required.";
      }
      if (!this.errors.length) {
        return true;
      }
    },
    getAppeals() {
      this.axios
        .get(this.base_url + "/api/appeals")
        .then((response) => {
          this.appeals = response.data;
          this.cartData.appeal = response.data[0].name;
          this.loading = false;
          // console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    getQuickAppeals() {
      this.axios
        .get(this.base_url + "/api/quickappeals")
        .then((response) => {
          this.quickappeals = response.data;
          this.cartData.appeal = response.data[0].name;
          this.loading = false;
          // console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    loadPost() {
      this.axios.get(this.base_url + "/api/allposts").then((response) => {
        this.posts = response.data;
      });
    },
    loadHomesettingsdata() {
      this.axios.get(this.base_url + "/api/homesettings").then((response) => {
        this.home.intro = response.data[0].intro;
        this.home.video_link = response.data[0].video;
      });
    },
    loadCampaigns() {
      this.axios
        .get(this.base_url + "/api/allcampaigns")
        .then((response) => {
          this.campaigns = response.data;
          this.loading = false;
          // console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    loadSlideCampaigns() {
      this.axios
        .get(this.base_url + "/api/slidecampaigns")
        .then((response) => {
          this.slidecampaigns = response.data;
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    loadUpcomingEvents() {
      this.axios
        .get(this.base_url + "/api/upcomingevents")
        .then((response) => {
          this.upcomingevents = response.data;
          this.loading = false;
          console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
  },
};
</script>
