<template>
  <div>
  <!-- Start Banner Section -->
  <section
    class="single-page-banner clear"
    style="
      background: url(images/single-banner.jpg) no-repeat center 0;
      background-size: cover;
    "
  >
    <div class="single-page-banner-container">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="page-title">
              <h1>Event booking</h1>
              <h2>{{title}}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Banner Section -->
  
  <!-- Begin Step Bar Section -->
  <section class="section-wrap stepbar-section">
    <div class="container">
      <div class="row">
          <div class="col-sm-12">
              <div class="steps-container">
                  <div class="step active">
                      <div class="step-lines-wrap">
                          <div class="step-line"></div>
                          <div class="step-line step-line-border"></div>
                          <div class="step-circle">1</div>
                      </div>
                      <div class="step-details">
                          <h4>Your details</h4>
                      </div>
                  </div>
                  <div class="step">
                      <div class="step-lines-wrap">
                          <div class="step-line step-line-border"></div>
                          <div class="step-line step-line-border"></div>
                          <div class="step-circle">2</div>
                      </div>
                      <div class="step-details">
                          <h4>Payment</h4>
                      </div>
                  </div>
                  <div class="step">
                      <div class="step-lines-wrap">
                          <div class="step-line step-line-border"></div>
                          <div class="step-line"></div>
                          <div class="step-circle">3</div>
                      </div>
                      <div class="step-details">
                          <h4>Complete</h4>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </section><!--// End Step Bar Section -->

<!-- Begin Contact Section -->
<section class="section-wrap">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="contact-form-wrap">
          <!-- <form method="POST" action="#"> -->
          <div class="row">
            <div class="custom-row input-row">
              <div class="col-sm-12">
                <label>First Name*</label>
                <input
                  type="text"
                  :style="[
                    errors.firstname
                      ? { border: '1px solid red' }
                      : { backgroundColor: 'white' },
                  ]"
                  v-model="form.firstname"
                  class="input-bx"
                  value=""
                  placeholder="First Name*"
                  name=""
                  required
                />
                <div>{{ errors.firstname }}</div>
              </div>
              <div class="col-sm-12">
                <label>Last Name*</label>
                <input
                  type="text"
                  :style="[
                    errors.lastname
                      ? { border: '1px solid red' }
                      : { backgroundColor: 'white' },
                  ]"
                  v-model="form.lastname"
                  class="input-bx"
                  value=""
                  placeholder="Last Name*"
                  name=""
                  required
                />
                <div>{{ errors.lastname }}</div>
              </div>
              <div class="col-sm-6">
                <label>Number of tickets*</label>
                <div v-for="noticket in ticketnumbers" v-bind:key="noticket.id">
                  <input type="radio"  v-model="form.notickets" :id="noticket.number" :value="noticket.number">
                  <label :for="noticket.id">{{noticket.number}}</label>
                </div>
                <div>{{ errors.notickets }}</div>
              </div>
              <div class="custom-row">
                <div class="col-sm-12">
                  <label>Phone*</label>
                  <input
                    type="number"
                    v-model="form.phone"
                    class="input-bx"
                    value=""
                    placeholder="Phone*"
                  />
                </div>
                <div>{{ errors.phone }}</div>
              </div>
              <div class="col-sm-6">
                <label>Email*</label>
                <input
                  type="email"
                  :style="[
                    errors.email
                      ? { border: '1px solid red' }
                      : { backgroundColor: 'white' },
                  ]"
                  v-model="form.email"
                  class="input-bx"
                  value=""
                  placeholder="Email*"
                  name=""
                  required
                />
                <div>{{ errors.email }}</div>
              </div>
              </div>
              <div class="custom-row ">
              <div class="col-sm-12">
                <label>Location and Date*</label>
                <select
                  name="locationdates"
                  v-model="form.locationdates"
                  :required="true"
                  class="select-bx"
                >
                <option v-for="locationdate in locationdates" :value="locationdate.id" >{{locationdate.name}}</option>
                </select>
                <div>{{ errors.locationdates }}</div>
              </div>
            <div class="col-sm-12">
              <div class="btn-wrap-row">
                <button class="btn-wrap" v-on:click="eventSubmit">
                  {{ loading ? "Loading..." : "Submit" }}
                </button>
                <!-- <router-link
                    :to="{
                    name: 'eventbookingpayment',
                    }"
                    >Continue to Payment
                </router-link> -->
                <!-- <p class="alert" v-if="isEventSuccess">
                  Your information has been submitted successfully.
                </p> -->
              </div>
            </div>
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!--// End Contact Section -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: this.$route.params.title, 
      form: {
        firstname: "",
        lastname: "",
        phone: "",
        email: "",
        locationdates: 'Birmingham - 22/12/22',
        notickets: []
      },
      ticketnumbers: [
          { number: '1' }, 
          { number: '2' }, 
          { number: '3' }, 
          { number: '4' }
      ], 
      locationdates: [
        { id: 'Birmingham - 22/12/22', name: 'Birmingham - 22/12/22' },
        { id: 'Luton - 23/12/22', name: 'Luton - 23/12/22' },
        { id: 'London - 24/12/22', name: 'London - 24/12/22' }
      ],
      errors: [],
      isEventSuccess: false,
      loading: false,
      base_url: '/grt',
      image_src:'/grt/storage/app/public/',
    };
  },
  methods: {
    eventSubmit() {
      // form validation
      this.validateForm();
      
      // if form is validated
      if (!this.errors.length) {
        this.loading = true;
        const data = { form: this.form };
        this.axios
          .post("/grt/api/processevents", data)
          .then((response) => {
            this.isEventSuccess = true;
            this.loading = false;
            this.form = {};
            var self = this;
            self.$router.push({ name: "eventbookingthankyou",  params: { title: self.title} });
            console.log(response.data);
          })
          .catch((error) => {
            this.isEventSuccess = false;
            this.loading = true;
            // callback(error, error.response.data);
          });
      }
    },
    validateForm() {
      this.errors = [];
      if (!this.form.firstname) {
        this.errors.push("This is a required field.");
        this.errors.firstname = "This is a required field.";
      }
      if (!this.form.lastname) {
        this.errors.push("This is a required field.");
        this.errors.lastname = "This is a required field.";
      }
      if (this.form.notickets.length == 0) {
        this.errors.push("This is a required field.");
        this.errors.notickets = "This is a required field.";
      }
      if (!this.form.phone) {
        this.errors.push("This is a required field.");
        this.errors.phone = "This is a required field.";
      }
      if (!this.form.email) {
        this.errors.push("This is a required field.");
        this.errors.email = "This is a required field.";
      } else if (!this.validEmail(this.form.email)) {
        this.errors.push("Valid email is required.");
        this.errors.email = "Valid email is required.";
      }
      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 200, behavior: "smooth" });
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
  },
};
</script>
