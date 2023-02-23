<template>
<div>
  <!-- Begin Fundraising Header Section -->
  <section class="cf-section-wrap cf-header-section-wrap">
      <div class="container">
          <div class="row">
              <div class="col-sm-6">
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
               <!-- Begin Campaign Search Box Container -->
              <div class="col-sm-6">
                  <div class="cf-search-form">
                      <div class="input-group">
                          <input type="text" v-model="searchquery" class="form-control cf-input-bx" placeholder="Search campaigns...">
                          <div class="input-group-append">
                            <button v-on:click="searchSubmit" :disabled="disableButton" class="cf-btn-wrap" type="button">
                              {{ searchLoading ? "Loading..." : "Search" }}
                            </button>
                          </div>
                      </div>
                  </div>
              </div><!--// End Campaign Search Box Container -->
           </div>
      </div>
  </section><!--// End Fundraising Header Section -->
  <!-- Begin Campaigns Section -->
  <section class="cf-section-wrap cf-campaigns-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="cf-section-title">
                    <h2>Support our fundraisers</h2>
                    <h3>Help us fight poverty by supporting campaigns by our amazing fundraisers</h3>
                </div>
            </div>
        </div>
    </div>
    <!-- Begin CF Campaigns Container -->
    <div v-if="loading" v-bind:class="{ loading: loading }"></div>
    <div v-else class="container">
      <div class="row">
        <div class="cf-campaigns-content">
          <ul v-if="campaigns.data.length > 0" class="cf-three-col-grid">
            <li
              v-for="campaign in campaigns.data"
              :key="campaign.id">
              <div class="cf-campaign-item-wrap">
                <div class="thumb-wrap">
                  <router-link
                    :to="{
                      name: 'fundraisingsingle',
                      params: { id: campaign.slug },
                    }"
                  >
                    <img
                      v-if="campaign.image"
                      v-bind:src="base_url + '/public/cfcampaigns/' + campaign.image"
                      v-bind:alt="campaign.title"
                    />
                    <img
                      v-else
                      v-bind:src="
                        image_src + cfAppeal(cfappeals, campaign.apeal)
                      "
                      v-bind:alt="campaign.title"
                    />
                  </router-link>
                </div>
                <div class="cf-campaign-bottom-content">
                  <div class="title">
                    <h3>
                      <router-link
                        :to="{
                          name: 'fundraisingsingle',
                          params: { id: campaign.slug },
                        }"
                        >{{ campaign.title }}</router-link
                      >
                    </h3>
                  </div>
                  <div class="progress">
                    <div
                      class="progress-bar"
                      role="progressbar"
                      :aria-valuenow="
                        (getTotalRaised(campaign) * 100) / campaign.goal
                      "
                      aria-valuemin="0"
                      aria-valuemax="100"
                      :style="{
                        width:
                          (getTotalRaised(campaign) * 100) / campaign.goal +
                          '%',
                      }"
                    ></div>
                  </div>
                  <div class="cf-raised-target">
                    <ul>
                      <li>
                        <span class="cf-stats-figure"
                          >{{
                            Math.round(
                              (getTotalRaised(campaign) * 100) / campaign.goal
                            )
                          }}%</span
                        >
                        <span class="cf-stats-label">raised</span>
                      </li>
                      <li>
                        <span class="cf-stats-figure"
                          >£{{ campaign.goal }}</span
                        >
                        <span class="cf-stats-label">goal</span>
                      </li>
                    </ul>
                  </div>
                </div>

                <router-link
                  :to="{ name: 'cfdashboard' }"
                  v-if="isLoggedIn & (campaign.member_id == loggedinUserId)"
                  class="cf-author-wrap"
                >
                  <!-- <a v-bind:href="'/fundraising/dashboard'" v-if="isLoggedIn&campaign.member_id == loggedinUserId" class="cf-author-wrap"> -->
                  <div class="cf-author-avatar">
                    <div class="cf-author-avatar-initial">
                      {{ capitalizeFirstLetter(campaign.author) }}
                    </div>
                  </div>
                  <div class="cf-author-name">
                    <h4>{{ campaign.author }}</h4>
                  </div>
                  <!-- </a> -->
                </router-link>
                <router-link
                  :to="{
                    name: 'cfauthorprofile',
                    params: { id: campaign.member_id, name: campaign.author },
                  }"
                  v-else-if="isLoggedIn"
                  class="cf-author-wrap"
                >
                  <!-- <a v-bind:href="'/fundraising/author/' + campaign.member_id+'&'+campaign.author" v-else-if="isLoggedIn" class="cf-author-wrap"> -->
                  <div class="cf-author-avatar">
                    <div class="cf-author-avatar-initial">
                      {{ capitalizeFirstLetter(campaign.author) }}
                    </div>
                  </div>
                  <div class="cf-author-name">
                    <h4>{{ campaign.author }}</h4>
                  </div>
                  <!-- </a> -->
                </router-link>
                <router-link
                  :to="{
                    name: 'cfauthorprofile',
                    params: { id: campaign.member_id, name: campaign.author },
                  }"
                  v-else
                  class="cf-author-wrap"
                >
                  <!-- <router-link :to="{name: 'cfauthorprofile', params: { id: campaign.member_id+'&'+campaign.author }}" v-else class="cf-author-wrap"> -->
                  <!-- <a v-bind:href="'/fundraising/author/' + campaign.member_id+'&'+campaign.author" v-else class="cf-author-wrap"> -->
                  <div class="cf-author-avatar">
                    <div class="cf-author-avatar-initial">
                      {{ capitalizeFirstLetter(campaign.author) }}
                    </div>
                  </div>
                  <div class="cf-author-name">
                    <h4>{{ campaign.author }}</h4>
                  </div>
                  <!-- </a> -->
                </router-link>
              </div>
            </li>
          </ul>
          <ul v-else class="cf-search-notfound-content-wrap">
            <li>No Campaigns Found</li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="cf-pager-wrap">
            <pagination
              align="center"
              :data="campaigns"
              @pagination-change-page="loadCampaigns"
            ></pagination>
          </div>
        </div>
      </div>
    </div>
    <!--// End CF Campaigns Container -->
  </section>
  <!--// End Campaigns Section -->
</div>
</template>

<script>
import pagination from "laravel-vue-pagination";
export default {
  components: {
    pagination,
  },
  data() {
    return {
      campaigns: [],
      raised: 0,
      pageSize: 12,
      isLoggedIn: false,
      loggedinUserId: 0,
      searchLoading: false,
      searchquery: "",
      disableButton: false,
      total_donations: 0,
      cfappeals: [],
      loading: true,
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  mounted() {
    this.loadCampaigns();
    this.getloginstate();
    this.getloginuserid();
  },
  methods: {
    async loadCampaigns(page = 1) {
      this.loading = true;
      await this.axios
        .get(this.base_url + `/api/fundraising?page=${page}`)
        .then(({ data }) => {
          this.campaigns = data.data;
          this.cfappeals = data.cfappeals;
          this.loading = false;
          window.scrollTo({ top: 0 });
        })
        .catch(({ response }) => {
          console.error(response);
        });
    },
    searchSubmit() {
      this.disableButton = true;
      this.searchLoading = true;
      this.axios
        .get(this.base_url + "/api/fundraising", {
          params: {
            query: this.searchquery,
          },
        })
        .then((response) => {
          this.campaigns = response.data.data;
          this.cfappeals = response.data.cfappeals;
          this.searchLoading = false;
          this.disableButton = false;
        });
    },
    getTotalRaised(campaign) {
      let total_donations = 0;

      // Individual total
      for (let donation of campaign.cfdonations) {
        total_donations += parseFloat(donation.amount);
      }

      // Team total
      let total_member_donations = 0;
      for (let teamvalue of campaign.cfmembers) {
        for (let tvalue of teamvalue.cfcampaigns) {
          if (tvalue.is_member == "yes") {
            for (let donation of tvalue.cfdonations) {
              total_member_donations += parseFloat(donation.amount);
            }
          }
        }
      }

      // If it is a team
      if (campaign.is_team == "yes") {
        total_donations = total_donations + total_member_donations;
      }

      this.total_donations = total_donations;
      return total_donations;
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
    capitalizeFirstLetter(string) {
      if (string) return string.charAt(0).toUpperCase();
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
<style scoped>
.pagination {
  margin-bottom: 0;
}
</style>
