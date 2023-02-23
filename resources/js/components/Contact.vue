<template>
  <div>
    <section
      class="single-page-banner clear"
      style="
        background: url(http://localhost/grt/images/single-banner.jpg) no-repeat center 0;
        background-size: cover;
      "
    >
      <div class="single-page-banner-container">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <div class="page-title">
                <h1>Contact us</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Banner Section -->
    <!-- Begin Contact Section -->
    <section class="section-wrap contact-page-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="sidebar-wrap">
              <div class="contact-info-wrap">
                  <address>
                      <h4>Address</h4>
                      <p>175 Ladypool Road Birmingham B12 8LQ</p>
                      <p><strong>Registered Charity No:</strong> 1191793</p>
                  </address>
                  <address>
                      <h4>Email us</h4>
                      <p><a href="mailto:info@grtuk.org">info@grtuk.org</a></p>
                  </address>
                  <address>
                      <h4>Phone us</h4>
                      <p><strong>Mon-Fri:</strong> <a href="tel:01217940055">0121 794 0055</a></p>
                  </address>
                  <div class="contact-social-media">
                      <h4>Contact us via social media</h4>
                      <ul>
                          <li>
                              <a href="https://www.facebook.com/globalrelieftrustuk" target="blank"><i class="fab fa-facebook-square"></i></a>
                          </li>
                          <li>
                              <a href="https://www.instagram.com/globalrelieftrust/?igshid=sxqcbmz23ev" target="_blank"><i class="fab fa-instagram"></i></a>
                          </li>
                          <li>
                              <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                          </li>
                      </ul>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-sm-8">
            <div class="contact-form-wrap">
              <!-- <form method="POST" action="#"> -->
              <div class="row">
                <div class="custom-row input-row">
                  <div class="col-sm-6">
                    <input
                      type="text"
                      :style="[
                        errors.name
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="form.name"
                      class="input-bx"
                      value=""
                      placeholder="Name*"
                      name=""
                      required
                    />
                    <div>{{ errors.name }}</div>
                  </div>
                  <div class="col-sm-6">
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
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="number"
                      v-model="form.phone"
                      class="input-bx"
                      value=""
                      placeholder="Phone number"
                    />
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <textarea
                      v-model="form.comment"
                      class="text-area"
                      placeholder="Leave a comment"
                    ></textarea>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="btn-wrap-row">
                    <button class="btn-wrap" v-on:click="contactSubmit">
                      {{ loading ? "Loading..." : "Submit enquiry" }}
                    </button>
                    <p class="alert" v-if="isContactSuccess">
                      Your information has been submitted successfully.
                    </p>
                  </div>
                </div>
              </div>
              <!-- </form> -->
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
      form: {
        name: "",
        email: "",
        phone: "",
        phone: "",
        comment: "",
      },
      errors: [],
      isContactSuccess: false,
      loading: false,
    };
  },

  methods: {
    contactSubmit() {
      // form validation
      this.validateForm();
      // if form is validated
      if (!this.errors.length) {
        this.loading = true;
        const data = { form: this.form };
        this.axios
          .post("/grt/api/contact", data)
          .then((response) => {
            this.isContactSuccess = true;
            this.loading = false;
            this.form = {};
            var self = this;
            setTimeout(function () {
              self.isContactSuccess = false;
            }, 5000);
            console.log(response.data);
          })
          .catch((error) => {
            this.isContactSuccess = false;
            this.loading = true;
            // callback(error, error.response.data);
          });
      }
    },
    validateForm() {
      this.errors = [];
      if (!this.form.name) {
        this.errors.push("Name is required.");
        this.errors.name = "Name is required.";
      }
      if (!this.form.email) {
        this.errors.push("Email is required.");
        this.errors.email = "Email is required.";
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
