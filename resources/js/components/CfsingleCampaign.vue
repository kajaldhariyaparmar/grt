<template>
<div>
  <!-- Begin Fundraising Header Section -->
  <section class="cf-section-wrap cf-header-section-wrap">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="cf-header-left">
                      <ul>
                          <li class="active">
                              <router-link :to="{ name: 'fundraising' }">
                                  <span class="material-icons">home</span>
                              </router-link>
                          </li>
                          <li>
                              <router-link :to="{ name: 'create-individual-campaign' }">
                                  <span class="material-icons">add</span>
                                  Create your campaign
                              </router-link>
                          </li>
                      </ul>
                  </div>
              </div>
           </div>
      </div>
  </section><!--// End Fundraising Header Section -->
  <div v-if="loading" v-bind:class="{ loading: loading }"></div>
  <div v-else>
    <!-- Begin Campaign Single Header Section -->
    <section class="cf-section-wrap cf-campaign-single-header-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="cf-campaign-single-header">
              <h2>{{ campaign.title }}</h2>
              <div class="cf-campaign-heading-bottom">
                <div class="author-info">
                  <div class="author-info-inner">
                    <div class="author-avatar">
                      {{ capitalizeFirstLetter(campaign.author) }}
                      {{ getAlreadyJoined(campaign) }}
                    </div>
                    <h3>
                      <router-link
                        :to="{
                          name: 'cfdashboard',
                          params: {
                            id: campaign.member_id,
                            name: campaign.author,
                          },
                        }"
                        v-if="
                          isLoggedIn & (campaign.member_id == loggedinUserId)
                        "
                        class="cf-author-name"
                        >{{ campaign.author }}</router-link
                      >
                      <router-link
                        :to="{
                          name: 'cfauthorprofile',
                          params: {
                            id: campaign.member_id,
                            name: campaign.author,
                          },
                        }"
                        v-else-if="isLoggedIn"
                        class="cf-author-name"
                        >{{ campaign.author }}</router-link
                      >
                      <router-link
                        :to="{
                          name: 'cfauthorprofile',
                          params: {
                            id: campaign.member_id,
                            name: campaign.author,
                          },
                        }"
                        v-else
                        class="cf-author-name"
                        >{{ campaign.author }}</router-link
                      >
                      <span class="cf-fundraising-for-campaign-txt"
                        >fundraising for <a href="#">{{ campaign.apeal }}</a
                        >.</span
                      >
                      <span
                        v-if="campaign.is_member == 'yes'"
                        class="cf-team-campaign-name"
                        >As part of team
                        <a
                          @click="teamRedirect(getTeamInformation(campaign))"
                          >{{ getTeamInformation(campaign) }}</a
                        >.</span
                      >
                    </h3>
                  </div>
                </div>
                <div class="cf-campaign-single-header-right">
                  <a
                    v-if="(campaign.is_team == 'yes') & (already_joined == 0)"
                    @click="joinRedirect(campaign)"
                    class="cf-btn-wrap cf-join-team-btn"
                    >Join the Team</a
                  >
                  <a
                    v-if="(campaign.is_team == 'yes') & (already_joined == 1)"
                    class="cf-btn-wrap"
                    >Already joined</a
                  >
                  <div class="cf-social-share-btn-wrap">
                    <a href="#" class="facebook-icon"
                      ><i class="fab fa-facebook-f"></i
                    ></a>
                    <a href="#" class="twitter-icon"
                      ><i class="fab fa-twitter"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End  Campaign Single Header Section -->
    <!-- Begin Campaign Individual Section -->
    <section
      class="
        cf-section-wrap
        cf-campaign-single-content-section
        cf-campaign-individual-section
      "
    >
      <div class="container">
        <div class="row">
          <!-- Begin Right Column -->
          <div class="col-sm-7">
            <div class="cf-single-info-wrap">
              <div class="thumb-wrap">
                <img
                  v-if="campaign.image"
                  v-bind:src="base_url + '/public/cfcampaigns/' + campaign.image"
                  v-bind:alt="campaign.title"
                />
                <img
                  v-else
                  v-bind:src="image_src + cfappeal[0].photo"
                  v-bind:alt="campaign.title"
                />
              </div>
              <div class="cf-single-info-inner">
                <div class="cf-single-info">
                  <div class="raised-details">
                    <h3>
                        £{{ total_donations }}
                        <span class="target-amount">Raised of £{{ campaign.goal }} goal</span>
                    </h3>
                  </div>
                  <div class="cf-stats-figure-wrap">
                     <span class="cf-stats-figure">000%</span>
                  </div>
                </div>
                <div class="progress">
                  <div
                    class="progress-bar"
                    role="progressbar"
                    :aria-valuenow="donationRaisedPercentage(campaign)"
                    aria-valuemin="0"
                    aria-valuemax="100"
                    :style="{ width: donationRaisedPercentage(campaign) + '%' }"
                  ></div>
                </div>
                <div class="cf-campaign-duration-wrap">
                   <span class="material-icons-outlined">timer</span>
                   <span class="time-left"><strong class="cf-left-days">{{ dateDifference(campaign) }} days</strong> left to donate</span>
                </div>
              </div>
            </div>
            <div class="cf-donate-mobile-btn">
              <a
                href="#cfMobileDonateScroll"
                class="cf-btn-wrap cf-mobile-donate-scroll"
                >Donate to this campaign</a
              >
            </div>
            <div
              v-if="campaign.description"
              v-html="campaign.description"
              class="cf-campaign-single-content"
            ></div>
            <div
              v-else
              v-html="cfappeal[0].mission_statement"
              class="cf-campaign-single-content"
            ></div>
          </div>
          <!--// End Right Column -->
          <!-- Begin Left Column -->
          <div class="col-sm-5">
            <div
              class="cf-single-donate-form-container"
              id="cfMobileDonateScroll"
            >
              <div class="cf-single-donate-form-header">
                <h4>Enter an amount to give</h4>
              </div>
              <div class="cf-single-donate-form-body">
                <div class="input-wrap">
                  <input
                    type="number"
                    v-model="form.amount"
                    :style="[
                      errors.amount
                        ? { border: '1px solid red' }
                        : { backgroundColor: 'white' },
                    ]"
                    class="cf-input-bx"
                    oninput="if(value.length>100)value=value.slice(0,100)"
                    value="50"
                  />
                  <span class="cf-currency-icon"
                    ><i class="fas fa-pound-sign"></i
                  ></span>
                  <span>{{ errors.amount }}</span>
                </div>
                <div class="custom-row">
                  <textarea
                    v-model="form.note"
                    class="cf-text-area"
                    placeholder="Leave a note (optional)"
                  ></textarea>
                </div>
                <div class="custom-row">
                  <button
                    class="cf-btn-wrap"
                    v-on:click="formSubmit"
                    :disabled="disableButton"
                  >
                    {{ loading ? "Loading..." : "Donate" }}
                  </button>
                </div>
              </div>
              <div class="recaptcha-text">
                <p><i class="fas fa-lock"></i> Secure Payment.</p>
              </div>
            </div>
            <div class="cf-single-donors-box-container">
              <div class="cf-single-donors-box-header">
                <h4>Recent donations</h4>
              </div>
              <div class="cf-single-donors-box-body">
                <div class="cf-supporters-content">
                  <ul>
                    <li
                      v-for="value in campaign.cfdonations"
                      v-bind:key="value.id"
                      class="cf-supporter-block"
                    >
                      <div class="cf-supporters-info-wrap">
                        <div class="cf-supporters-img">
                          <div class="cf-default-profile-icon">
                            <span v-if="value.hide_name != 'Yes'">{{
                              value.firstname[0]
                            }}</span>
                            <span v-else>A</span>
                          </div>
                        </div>
                        <div class="cf-supporters-info">
                          <div class="cf-supporter-comments-date">
                            {{ dateFormat(value.created_at) }}
                          </div>
                          <div class="cf-supporter-name">
                            <h2 v-if="value.hide_name != 'Yes'">
                              {{ value.firstname }} {{ value.lastname }}
                            </h2>
                            <h2 v-else>Anonymous</h2>
                          </div>
                          <div class="cf-supporter-comments">
                            {{ value.note }}
                          </div>
                          <div class="cf-supporter-donate-amount">
                            £{{ value.amount }}
                          </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <div class="custom-row cf-suppoter-show-more">
                    <button class="cf-btn-wrap" id="cfShowMoreSupporters">
                      Show More
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div
              v-if="campaign.is_team == 'yes'"
              class="cf-single-all-team-container"
            >
              <div class="cf-single-all-team-header">
                <h4>{{ campaign.title }} <span>is a team campaign.</span></h4>
                <div class="cf-campaign-team-members">
                  <h4>
                    {{ campaign.cfmembers.length }}
                    <span>members</span>
                  </h4>
                </div>
              </div>
              <div class="cf-single-all-team-body">
                <div class="cf-all-team-content">
                  <ul>
                    <span
                      v-for="value in campaign.cfmembers"
                      v-bind:key="value.id"
                    >
                      <span
                        v-for="value in value.cfcampaigns"
                        v-bind:key="value.id"
                      >
                        <li
                          v-if="value.is_member == 'yes'"
                          class="cf-all-team-block"
                        >
                          <a :href="value.slug">
                            <div class="cf-all-team-info-wrap">
                              <div class="cf-all-team-img">
                                <div class="cf-default-profile-icon">
                                  <span>{{ value.title[0] }}</span>
                                </div>
                              </div>
                              <div class="cf-all-team-info">
                                <div class="cf-all-team-campaign-name">
                                  <h2>{{ value.title }}</h2>
                                </div>
                                <div class="cf-all-team-donate-amount">
                                  £{{
                                    value.cfdonations.reduce(
                                      (a, c) => a + parseInt(c.amount),
                                      0
                                    )
                                  }}
                                </div>
                              </div>
                            </div>
                          </a>
                        </li>
                      </span>
                    </span>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!--// End Left Column -->
        </div>
      </div>
    </section>
    <!--// End Campaign Individual Section -->
  </div>
</div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      campaign: {},
      isLoggedIn: false,
      form: {
        amount: "50",
        note: "",
        campaign_title: "",
        campaign_slug: "",
        campaign_id: "",
        appeal: "",
        author: "",
        member_id: "",
      },
      errors: [],
      loading: true,
      loggedinUserId: 0,
      already_joined: 0,
      total_donations: 0,
      cfappeal: {},
      isLoggedIn: false,
      loggedinUserId: 0,
      disableButton: false,
      aspartteamslug: "",
      aspartteamtitle: "",
      base_url: 'http://localhost/grt',
      image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  mounted() {
    this.getloginstate();
    this.getloginuserid();
  },
  computed: {},
  created() {
    this.axios
      .get(this.base_url + `/api/fundraising/${this.$route.params.id}`)
      .then((response) => {
        this.campaign = response.data.cfcampaign;
        this.total_donations = response.data.total_donations;
        this.cfappeal = response.data.cfappeal;
        this.loading = false;
      });
  },
  methods: {
    dateFormat(date) {
      return moment(date).format("MMMM DD,YYYY");
    },
    donationRaisedPercentage(campaign) {
      return Math.round((this.total_donations * 100) / campaign.goal);
    },
    dateDifference(campaign) {
      // npm install moment
      const campaignCreatedDate = moment(campaign.created_at).format(
        "YYYY-MM-DD hh:mm:ss"
      );
      const today = moment().format("YYYY-MM-DD hh:mm:ss");
      return 100 - moment(today).diff(moment(campaignCreatedDate), "days");
    },
    teamRedirect(team) {
      window.location.href = this.base_url + "/fundraising/" + team;
    },
    joinRedirect(campaign) {
      this.$router.push({ name: "join-team", params: { campaign: campaign } });
    },
    getAlreadyJoined(campaign) {
      if (this.isLoggedIn) {
        if (campaign.cfmembers.length > 0) {
          for (let teamvalue of campaign.cfmembers) {
            if (teamvalue.user_id == this.loggedinUserId) {
              this.already_joined = 1;
            }
          }
        }
      }
    },
    getTeamInformation(campaign) {
      if (campaign.is_member == "yes") {
        for (let teamvalue of campaign.cfmembers) {
          let i = 0;
          for (let value of teamvalue.cfcampaigns) {
            if (value.is_team == "yes" && value.id == campaign.team_id) {
              if (i <= 0) {
                return value.title;
              }
              i++;
            }
          }
        }
      }
    },
    capitalizeFirstLetter(string) {
      if (string) return string.charAt(0).toUpperCase();
    },
    formSubmit() {
      // validate the form
      this.validateForm();

      // if form is validated
      if (!this.errors.length) {
        console.log(this.campaign);
        this.form.campaign_title = this.campaign.title;
        this.form.campaign_slug = this.campaign.slug;
        this.form.campaign_id = this.campaign.id;
        this.form.appeal = this.campaign.apeal;
        this.form.author = this.campaign.author;
        this.form.member_id = this.campaign.member_id;
        this.disableButton = true;
        this.loading = true;
        window.scrollTo({ top: 0 });
        this.$router.push({ name: "cfyourdetails", params: { data: this.form } });
      }
    },
    validateForm() {
      this.errors = [];
      if (!this.form.amount) {
        this.errors.push("The amount field is required.");
        this.errors.amount = "The amount field is required.";
      }
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
