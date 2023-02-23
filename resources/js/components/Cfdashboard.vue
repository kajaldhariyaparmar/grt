<template>
  <div>
    <!-- Begin Dashboard Heading Section -->
    <section class="cf-section-wrap cf-dashboard-header-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="cf-dashboard-header">
              <h2>
                Welcome, <span>{{ loggedinUserName }}!</span>
              </h2>
              <div class="cf-dashboard-heading-bottom">
                <div class="author-info">
                  <div class="author-info-inner">
                    <h3>
                      Thanks for being a part of the Charity Platform community.
                    </h3>
                  </div>
                </div>
                <div class="cf-dashboard-header-right">
                  <router-link
                    :to="{ name: 'create-individual-campaign' }"
                    class="cf-btn-wrap"
                  >
                    Create a new fundraising campaign</router-link
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End  Campaign Single Header Section -->
    <!-- Begin Dashboard Section -->
    <section class="cf-section-wrap cf-dashboard-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="cf-dashboard-content-wrap">
              <div class="cf-dashboard-content">
                <div class="cf-dashboard-content-header">
                  <h4>
                    Campaigns
                    <span>({{ totalIndividualCampaigns(cfmembers) }})</span>
                  </h4>
                </div>
                <div class="cf-dashboard-content-body">
                  <ul>
                    <span v-for="value in cfmembers" v-bind:key="value.id">
                      <span
                        v-for="value in value.cfcampaigns"
                        v-bind:key="value.id"
                      >
                        <li v-if="value.is_team == 'no'">
                          <div class="cf-dashboard-item-wrap">
                            <div class="cf-thumb-col cf-column">
                              <img
                                v-if="value.image"
                                v-bind:src="base_url + '/public/cfcampaigns/' + value.image
                                "
                                v-bind:alt="value.title"
                              />
                              <img
                                v-else
                                v-bind:src="
                                  image_src + cfAppeal(cfappeals, value.apeal)
                                "
                              />
                            </div>
                            <div class="cf-title-col cf-column">
                              <h2>
                                <router-link
                                  :to="{
                                    name: 'fundraisingsingle',
                                    params: { id: value.slug },
                                  }"
                                  >{{ value.title }}
                                </router-link>
                                <router-link
                                  :to="{
                                    name: 'CfeditIndividualCampaign',
                                    params: {
                                      campaign: value,
                                      cfappeal: value.apeal,
                                      cfappeals: cfappeals,
                                    },
                                  }"
                                >
                                  (Edit)
                                </router-link>
                              </h2>
                              <h3>
                                {{ dateDifference(value.created_at) }} days left
                                to fundraise
                              </h3>
                            </div>
                            <div class="cf-team-members-col cf-column">
                              <h2>
                                £{{
                                  value.cfdonations.reduce(
                                    (a, c) => a + parseFloat(c.amount),
                                    0
                                  )
                                }}
                                <span>total raised</span>
                              </h2>
                            </div>
                          </div>
                        </li>
                      </span>
                    </span>
                  </ul>
                </div>
              </div>
              <div class="cf-dashboard-content mt-0">
                <div class="cf-dashboard-content-header">
                  <h4>
                    Team Campaigns
                    <span>({{ totalTeamCampaigns(cfmembers) }})</span>
                  </h4>
                </div>
                <div class="cf-dashboard-content-body">
                  <ul v-bind:class="{ loading: loading }">
                    <span v-for="value in cfmembers" v-bind:key="value.id">
                      <span
                        v-for="value in value.cfcampaigns"
                        v-bind:key="value.id"
                      >
                        <li
                          v-if="
                            value.is_team == 'yes' &&
                            value.member_id == loggedinUserId
                          "
                        >
                          <div class="cf-dashboard-item-wrap">
                            <div class="cf-thumb-col cf-column">
                              <img
                                v-if="value.image"
                                v-bind:src="base_url + '/public/cfcampaigns/' + value.image
                                "
                                v-bind:alt="value.title"
                              />
                              <img
                                v-else
                                v-bind:src="
                                  image_src + cfAppeal(cfappeals, value.apeal)
                                "
                              />
                            </div>
                            <div class="cf-title-col cf-column">
                              <h2>
                                <router-link
                                  :to="{
                                    name: 'fundraisingsingle',
                                    params: { id: value.slug },
                                  }"
                                  >{{ value.title }}
                                </router-link>
                                <router-link
                                  :to="{
                                    name: 'CfeditTeamCampaign',
                                    params: {
                                      campaign: value,
                                      cfappeal: value.apeal,
                                      cfappeals: cfappeals,
                                    },
                                  }"
                                >
                                  (Edit)
                                </router-link>
                              </h2>
                              <h3>
                                {{ dateDifference(value.created_at) }} days left
                                to fundraise
                              </h3>
                            </div>
                            <div class="cf-team-members-col cf-column">
                              <h2 v-if="value.cfmembers.length > 1">
                                {{ value.cfmembers.length }} members
                              </h2>
                              <h2 v-else>
                                {{ value.cfmembers.length }} member
                              </h2>
                            </div>
                          </div>
                          <div class="cf-dashboard-item-bottom-wrap">
                            <div class="cf-bottom-column">
                              <h2>
                                £{{
                                  value.cfdonations.reduce(
                                    (a, c) => a + parseFloat(c.amount),
                                    0
                                  ) + teamTotalDonation
                                }}
                                <span>raised</span>
                              </h2>
                            </div>
                            <div class="cf-bottom-column">
                              <h2>
                                {{ getTeamTotalDonation(value.cfmembers) }}
                                {{ teamTotalDonation }}
                                <span>raised by members</span>
                              </h2>
                            </div>
                          </div>
                        </li>
                      </span>
                    </span>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Dashboard Section -->
  </div>
</template>
<script>
import moment from "moment";
export default {
  data() {
    return {
      isLoggedIn: false,
      loggedinUserId: 0,
      loggedinUserName: "",
      loading: true,
      cfappeals: [],
      cfmembers: [],
      teamTotalDonation: 0,
      base_url: '/grt',
      image_src:'/grt/storage/app/public/',
    };
  },
  mounted() {
    this.getloginusername();
    this.getloginstate();
    this.getloginuserid();
  },
  computed: {},
  created() {
    this.axios.get(this.base_url + "/getdashboarddata").then((response) => {
      this.cfmembers = response.data.cfmembers;
      this.cfappeals = response.data.cfappeals;
      this.loading = false;
    });
  },
  methods: {
    totalIndividualCampaigns(cfmembers) {
      let totalCampaigns = 0;
      for (let value of cfmembers) {
        if (value.cfcampaigns.length > 0) {
          for (let value of value.cfcampaigns) {
            if (value.is_team == "no") {
              totalCampaigns += 1;
            }
          }
        }
      }
      return totalCampaigns;
    },
    totalTeamCampaigns(cfmembers) {
      let totalCampaigns = 0;
      for (let value of cfmembers) {
        if (value.cfcampaigns.length > 0) {
          for (let value of value.cfcampaigns) {
            if (
              value.is_team == "yes" &&
              value.member_id == this.loggedinUserId
            ) {
              totalCampaigns += 1;
            }
          }
        }
      }
      return totalCampaigns;
    },
    getTeamTotalDonation(cfmembers) {
      let totalDonations = 0;
      for (let member of cfmembers) {
        if (member.cfcampaigns.length > 0) {
          for (let membercampaign of member.cfcampaigns) {
            if (membercampaign.is_member == "yes") {
              for (let donation of membercampaign.cfdonations) {
                totalDonations += parseFloat(donation.amount);
              }
            }
          }
        }
      }
      this.teamTotalDonation = totalDonations;
    },
    cfAppeal(cfappeals, value) {
      let cfAppeal = "";
      for (let appealvalue of cfappeals) {
        if (value == appealvalue.name) {
          cfAppeal = appealvalue.photo;
        }
      }
      return cfAppeal;
    },
    dateDifference(value) {
      // npm install moment
      const campaignCreatedDate = moment(value).format("YYYY-MM-DD hh:mm:ss");
      const today = moment().format("YYYY-MM-DD hh:mm:ss");
      return 100 - moment(today).diff(moment(campaignCreatedDate), "days");
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
    getloginusername() {
      let self = this;
      axios.get(self.base_url + "/loginusername").then((response) => {
        self.loggedinUserName = response.data;
      });
    },
  },
};
</script>