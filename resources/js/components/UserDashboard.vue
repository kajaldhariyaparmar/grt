<template>
  <div>
    <!--Begin Banner Section-->
    <section class="single-page-banner clear" style="background: url(images/campaign-banner.jpg) no-repeat center center; background-size: cover;">
        <div class="single-page-banner-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title">
                            <h1>My account</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Banner Section -->
    <!-- Begin Dashboard Section -->
    <section class="section-wrap dashboard-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 left-column">
                    <div class="dashboard-menu-column">
                        <ul class="dashboard-menu-wrap nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#donations" role="tab" data-toggle="tab"><span><i class="far fa-heart"></i></span>Donations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#userCampaignsCreated" role="tab" data-toggle="tab"><span><i class="fas fa-hand-holding-medical"></i></span>Campaigns created</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#profile" role="tab" data-toggle="tab"><span><i class="far fa-user"></i></span>Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9 right-column">
                    <div class="tab-content">
                        <!-- Begin Donations Tab -->
                        <div role="tabpanel" class="tab-pane active" id="donations">
                            <div class="orders-content-wrap">
                                <div class="order-item-row order-item-title-row">
                                    <div class="column order-id-column">
                                        <h3>Donation reference</h3>
                                    </div>
                                    <div class="column item-title-column">
                                        <h3>Project name</h3>
                                    </div>
                                    <div class="column purchase-date-column">
                                        <h3>Donation date</h3>
                                    </div>
                                    <!-- <div class="column country-column">
                                        <h3>Country</h3>
                                    </div> -->
                                    <div class="column amount-column">
                                        <h3>Amount</h3>
                                    </div>
                                    <div class="column order-details-column">
                                        
                                    </div>
                                </div>
                                <div v-for="data in donations"
                                v-bind:key="data.id"
                                v-bind:value="data.id"
                                class="order-item-row">
                                    <div class="column order-id-column">
                                        <h3>{{data.reference}}</h3>
                                    </div>
                                    <div class="column item-title-column">
                                        <h3>{{data.title}}</h3>
                                        <h4>Type: {{data.appeal}}</h4>
                                        <h5>Payment type: {{data.type}}</h5>
                                    </div>
                                    <div class="column purchase-date-column">
                                        <h3>{{ dateFormat(data.created_at) }}</h3>
                                    </div>
                                    <!-- <div class="column country-column">
                                        <h3>{{data.countries}}</h3>
                                    </div> -->
                                    <div class="column amount-column">
                                        <h3>£{{data.amount}}</h3>
                                    </div>
                                    <div class="column order-details-column">
                                        <router-link
                                        :to="{
                                            name: 'donation-details',
                                            params: {
                                            reference: data.reference,
                                            },
                                        }"
                                        >
                                        Details
                                        </router-link>
                                    </div>
                                </div>
                                
                                <!-- Begin Order empty Section -->
                                <div class="order-tab-empty-wrap d-none">
                                    <div class="order-tab-empty-content">
                                        <h3>No donation have been placed yet.</h3>
                                    </div>
                                </div><!--// End Order empty Section -->
                            </div>
                        </div><!--// End Donations Tab -->
                        <!-- Begin Campaigns Created Tab -->
                        <div role="tabpanel" class="tab-pane" id="userCampaignsCreated">
                            <div class="tab-box-wrap">
                                <div class="cf-dashboard-content-wrap">
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
                            </div>
                        </div><!--// End Campaigns Created Tab -->
                        <!-- Begin Profile Tab -->
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="tab-box-wrap">
                                <div class="profile-update-form-wrap">
                                    <div class="profile-update-form-inner">
                                        <div class="section-title">
                                            <h3>Update profile</h3>
                                        </div>
                                        <div class="custom-row">
                                            <ul class="my-account-two-col">
                                                <li>
                                                    <label>First name</label>
                                                    <input
                                                      type="text"
                                                      name="name"
                                                      v-model="donor.name"
                                                      class="input-bx"
                                                      value=""
                                                    />
                                                </li>
                                                <li>
                                                    <label>Last name</label>
                                                    <input
                                                      type="text"
                                                      name="lastname"
                                                      v-model="donor.lastname"
                                                      class="input-bx"
                                                      value=""
                                                    />
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="custom-row">
                                            <label>Email address</label>
                                            <input
                                            type="email"
                                            class="input-bx"
                                            v-model="donor.email"
                                            value=""
                                            placeholder="Email address"
                                            name=""
                                          />
                                        </div>
                                        <div class="custom-row">
                                            <ul class="my-account-two-col">
                                                <li>
                                                    <label>Reset password</label>
                                                    <input type="password" class="input-bx" value="123456" name=""> 
                                                    <span class="password-info">Leave empty to keep the same</span>
                                                </li>
                                                <li>
                                                    <label>Confirm reset password</label>
                                                    <input type="password" class="input-bx" value="" name="">
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="custom-row">
                                            <ul class="my-account-two-col">
                                                <li>
                                                    <label>Contact number</label>
                                                    <input
                                                      type="text"
                                                      name="contact"
                                                      v-model="donor.contact"
                                                      class="input-bx"
                                                      value=""
                                                    />
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="custom-row">
                                            <div class="btn-wrap-row">
                                                <!-- <button type="submit" class="btn-wrap">
                                                    Update
                                                    <span class="loading"></span>
                                                </button> -->
                                                <a :href="base_url + '/userdashboard'" class="btn-wrap">
                                                    Update
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div><!--// End Profile Tab -->
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Dashboard Section -->
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
      loading: false,
      donations: [],
      donor:'',
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
  computed: { },
  created() {
    this.axios.get(this.base_url + "/getuserdashboarddata").then((response) => {
      this.donations = response.data.donations;
      this.donor = response.data.donor;
      this.loading = false;
      console.log(this.donations);
    });

    this.axios.get(this.base_url + "/getdashboarddata").then((response) => {
      this.cfmembers = response.data.cfmembers;
      this.cfappeals = response.data.cfappeals;
      this.loading = false;
    });
  },
  methods: {
    dateFormat(date) {
      return moment(date).format("dddd, DD MMM YYYY");
    },
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
      axios.get(this.base_url + "/loginstate").then((response) => {
        self.isLoggedIn = response.data;
      });
    },
    getloginuserid() {
      let self = this;
      axios.get(this.base_url + "/loginuserid").then((response) => {
        self.loggedinUserId = response.data;
      });
    },
    getloginusername() {
      let self = this;
      axios.get(this.base_url + "/loginusername").then((response) => {
        self.loggedinUserName = response.data;
      });
    },
  },
};
</script>