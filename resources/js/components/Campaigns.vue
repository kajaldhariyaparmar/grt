<template>
  <!-- Begin Campaigns Section -->
  <section class="section-wrap campaigns-page-section bg-light-grey">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Support our campaigns</h2>
            <h3>
              While we battle the root causes of poverty through sustainable,
              empowering projects, we also recognise the importance of providing
              emergency relief to communities affected by crises. Learn more
              about our current appeals here, and donate today.
            </h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="filters-wrap">
            <select
              class="form-control select-bx"
              v-model="project"
              @change="filterpDropdownCampaigns($event)"
            >
              <option value="0">All projects</option>
              <option
                v-for="data in projects"
                v-bind:key="data.slug"
                v-bind:value="data.slug"
              >
                {{ data.title }}
              </option>
            </select>
            <select
              class="select-bx"
              v-model="country"
              @change="filtercDropdownCampaigns($event)"
            >
              <option value="0">All countries</option>
              <option
                v-for="data in countries"
                v-bind:key="data.slug"
                v-bind:value="data.slug"
              >
                {{ data.title }}
              </option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="campaigns-content">
          <ul class="three-col-grid">
            <li
              v-for="campaign in loadcampaigns"
              :key="campaign.id"
            >
              <div class="campaign-item-wrap">
                <div class="thumb-wrap">
                  <!-- <img src="images/campaign-img.jpg" alt="title"> -->
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
                    <!-- <p v-html="campaign.description.substring(0, 300)"></p> -->
                    <p v-html="campaign.excerpt"></p>
                  </div>
                  <div class="campaign-donate-btn">
                    <router-link
                      :to="{ name: 'campaign', params: { id: campaign.slug } }"
                      class="btn-wrap"
                      >Donate now
                    </router-link>
                    <!-- <a v-bind:href="url"> ... </a> -->
                    <!-- <a v-bind:href="url"> ... </a> -->
                    <!-- <a :href="url"> ... </a> -->
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
        <div class="col-sm-12" v-if="campaignsVisible < campaigns.length">
            <div class="btn-wrap-row">
                <button class="btn-wrap transparent-btn campaigns-load-more" @click="campaignsVisible += step" v-if="campaignsVisible < campaigns.length">
                    Load more
                </button>
            </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Campaigns Section -->
</template>

<script>
export default {
  data() {
    return {
      campaigns: [],
      project: 0,
      country: 0,
      loading: false,
      countries: [],
      projects: [],
      base_url: 'http://localhost/grt',
      image_src:'http://localhost/grt/storage/app/public/',
      campaignsVisible: 18,
      step: 18
    };
  },
  computed: {
    loadcampaigns() {
      return this.campaigns.slice(0, this.campaignsVisible);
    }

  },
  mounted() {
    this.filterCampaigns();
    this.filterCountries();
    this.filterProjects();
  },
  methods: {
    addHashToLocation(params) {
      history.pushState(
          {},
          '/campaigns/',
          params
      );
    },
    filterpDropdownCampaigns(e) {
      if(e.target.value != 0)
          this.addHashToLocation("http://localhost:3000/grt" +"/campaigns/" +e.target.value);

      this.campaignsVisible = 18;
      this.loading = true;

      this.axios
        .get(this.base_url + "/api/dropdowncampaigns", {
          params: {
            project_id: this.project,
            country_id: this.country,
          },
        })
        .then((response) => {
          this.campaigns = response.data.data;
          this.loading = false;
          this.$route.params.flag = '';
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    filtercDropdownCampaigns(e) {
      if(e.target.value != 0)
          this.addHashToLocation("http://localhost:3000/grt" +"/campaigns/" +e.target.value);

      this.campaignsVisible = 18;
      this.loading = true;

      this.axios
        .get(this.base_url + "/api/dropdowncampaigns", {
          params: {
            project_id: this.project,
            country_id: this.country,
          },
        })
        .then((response) => {
          this.campaigns = response.data.data;
          this.loading = false;
          this.$route.params.flag = '';
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    filterCampaigns() {
      this.campaignsVisible = 18;
      this.loading = true;
      this.axios
        .get(this.base_url +`/api/campaigns/${this.$route.params.id}`)
        .then((response) => {
          if(response.data.project > 0)
          this.project = this.$route.params.id;
          if(response.data.country > 0)
          this.country = this.$route.params.id;
          this.campaigns = response.data.data;
          this.loading = false;
          this.$route.params.flag = '';
        })
        .catch((error) => {
          callback(error, error.response.data);
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
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
  },
};
</script>
