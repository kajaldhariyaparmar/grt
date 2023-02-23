<template>
  <!-- Begin New Campaign Section -->
  <section class="cf-section-wrap cf-new-campaign-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Let's Go!</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="cf-new-campaign-wrap">
            <!-- <form action="#" method="post" class="cf-new-campaign-form"> -->
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
              <ul>
                <li>
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
                </li>
                <li>
                  <label>Campaigning for</label>
                  <select class="cf-select-bx" v-model="form.appeal">
                    <option
                      v-for="data in appeals"
                      v-bind:key="data.id"
                      v-bind:value="data.name"
                    >
                      {{ data.name }}
                    </option>
                  </select>
                </li>
              </ul>
            </div>
            <div class="custom-row">
              <div>{{ errors.exception }}</div>
              <button
                class="cf-btn-wrap"
                v-on:click="formSubmit"
                :disabled="disableButton"
              >
                {{ loading ? "Loading..." : "Create Campaign" }}
              </button>
            </div>
            <div class="custom-row text-center">
              <router-link
                :to="{ name: 'create-team-campaign' }"
                class="link-txt"
              >
                Want To Campaign as a Team?</router-link
              >
            </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End New Campaign Section -->
</template>

<script>
export default {
  data() {
    return {
      appeals: [],
      form: {
        title: "",
        goal: "300",
        appeal: "",
        is_team: "no",
        is_member: "no",
      },
      errors: [],
      loading: false,
      disableButton: false,
      base_url: '/grt',
    };
  },
  mounted() {
    this.getAppeals();
  },
  methods: {
    getAppeals() {
      this.axios
        .get(this.base_url + "/api/cfappeals")
        .then((response) => {
          this.appeals = response.data;
          this.form.appeal = response.data[0].name;
        })
        .catch((error) => {
          callback(error, error.response.data);
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
          .post(this.base_url + "/createcfcampaign", data)
          .then((response) => {
            if (response.data.result == "notloggedin") {
              window.location.href = this.base_url + "/register";
            } else if (response.data.result == "loggedin") {
              window.location.href = this.base_url + "/fundraising/" + response.data.slug;
            } else {
              this.loading = false;
              this.errors.exception = response.data.result;

              if (response.data.slug) {
                setTimeout(function () {
                  window.location.href = this.base_url + "/fundraising/" + response.data.slug;
                }, 5000);
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