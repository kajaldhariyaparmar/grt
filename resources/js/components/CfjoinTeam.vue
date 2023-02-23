<template>
  <!-- Begin Join Team Campaign Section -->
  <section class="cf-section-wrap cf-join-team-campaign-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <div class="avatar-initial" style="background-color: #fe813a">
              P
            </div>
            <h3>Join {{ campaign.campaign.author }}</h3>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="cf-new-campaign-wrap">
            <div class="custom-row">
              <label>Campaign name</label>
              <input
                type="text"
                :style="[
                  errors.title
                    ? { border: '1px solid red' }
                    : { backgroundColor: 'white' },
                ]"
                v-model="form.title"
                class="cf-input-bx"
                value=""
                placeholder="Give your campaign a name"
                name=""
              />
              <div>{{ errors.title }}</div>
            </div>
            <div class="custom-row">
              <label>Campaign goal</label>
              <div class="input-wrap">
                <input
                  type="number"
                  :style="[
                    errors.goal
                      ? { border: '1px solid red' }
                      : { backgroundColor: 'white' },
                  ]"
                  v-model="form.goal"
                  name=""
                  class="cf-input-bx"
                  oninput="if(value.length>100)value=value.slice(0,100)"
                  value="300.00"
                />
                <span class="cf-currency-icon"
                  ><i class="fas fa-pound-sign"></i
                ></span>
                <div>{{ errors.goal }}</div>
              </div>
            </div>
            <div class="custom-row">
              <div>{{ errors.exception }}</div>
              <button
                class="cf-btn-wrap"
                v-on:click="formSubmit"
                :disabled="disableButton"
              >
                {{ loading ? "Loading..." : "Join the Team" }}
              </button>
            </div>
            <div class="recaptcha-text">
              <p class="mt-1 text-center">
                This site is protected by reCAPTCHA and the Google
                <a href="https://policies.google.com/privacy">Privacy Policy</a>
                and
                <a href="https://policies.google.com/terms"
                  >Terms&nbsp;of&nbsp;Service</a
                >&nbsp;apply.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Join Team Section -->
</template>

<script>
export default {
  data() {
    return {
      campaign: [],
      form: {
        title: "",
        goal: "300",
        is_member: "yes",
        is_team: "no",
        campaignid: this.$route.params.campaign.id,
        campaignslug: this.$route.params.campaign.slug,
        appeal: this.$route.params.campaign.apeal,
      },
      errors: [],
      loading: false,
      isLoggedIn: false,
      loggedinUserId: 0,
      disableButton: false,
      campaignid: 0,
      base_url: '/grt',
    };
  },
  mounted() {
    this.getloginstate();
    this.getloginuserid();
    this.campaigndata();
  },
  methods: {
    campaigndata() {
      this.campaign = this.$route.params;
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
    formSubmit() {
      // validate the form
      this.validateForm();

      // if form is validated
      if (!this.errors.length) {
        this.disableButton = true;
        this.loading = true;
        const data = { form: this.form };

        this.axios
          .post(this.base_url + "/submit-join-team", data)
          .then((response) => {
            if (response.data.result == "notloggedin") {
              window.location.href = this.base_url +"/register";
            } else if (response.data.result == "loggedin") {
              window.location.href = this.base_url +"/fundraising/" + response.data.slug;
            } else {
              this.loading = false;
              this.errors.exception = response.data.result;

              if (response.data.slug) {
                setTimeout(function () {
                  window.location.href = this.base_url +"/fundraising/" + response.data.slug;
                }, 3000);
              }
            }
          })
          .catch((error) => {
            this.loading = true;
          });
      }
    },
    validateForm() {
      this.errors = [];
      if (!this.form.title) {
        this.errors.push("The campaign name field is required.");
        this.errors.title = "The campaign name field is required.";
      }

      if (!this.form.goal) {
        this.errors.push("The goal field is required.");
        this.errors.goal = "The goal field is required.";
      }

      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 0, behavior: "smooth" });
      }
    },
  },
};
</script>