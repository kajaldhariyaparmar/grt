<template>
  <!-- Begin Donation Login Section-->
  <section class="section-wrap donation-login-section-wrap bg-white clear">
      <div class="container">
          <div class="row">
              <div class="col-sm-6">
                  <div class="login-form-wrap">
                      <div class="login-form-inner">
                          <div class="section-title">
                              <h3>Returning donors</h3>
                          </div>
                          <div class="custom-row">
                              <input type="email" v-model="email" name="email" class="input-bx" placeholder="Email address">
                          </div>
                          <div class="custom-row"> 
                              <input type="password" v-model="password" name="password" class="input-bx" placeholder="Password">
                          </div>
                          <div class="custom-row">
                              <div class="forgot-pass-wrap">
                                  <div class="column">
                                      <label>
                                          <input type="checkbox" name="" checked class="remembe-me">
                                            Remember me
                                      </label>
                                  </div>
                                  <div class="column">
                                      <a :href="base_url + '/forgot-password'" class="link-txt">Forgot password?</a> 
                                  </div>
                              </div>
                          </div>
                          <div class="custom-row">
                              <p class="signin-errors">{{errors}}</p>
                          </div>
                          <div class="custom-row">
                              <button v-on:click="login" class="btn-wrap transparent-btn">
                                  Login
                                  <span class="loading d-none"></span>
                              </button>
                          </div>
                      </div>
                  </div> 
              </div>
              <div class="col-sm-6">
                  <div class="new-customer-box-wrap">
                      <div class="section-title">
                          <h3>New donors</h3>
                          <p>New donors can checkout securely and quickly using our intuitive process, enabling you to register while making the payment.</p>
                      </div>
                      <div class="custom-row">
                          <a :href="base_url + '/checkout'" class="btn-wrap">Continue to checkout</a> 
                      </div>
                  </div>  
              </div>
          </div>
      </div>
  </section><!--// End Donation Login Section -->
</template>

<script>
export default {
  data() {
    return {
      email: '',
      password: '',
      errors: '',
      base_url: '/grt',
    };
  },
  methods: {
    login() {
      const data = { 
        email:this.email,
        password:this.password
        };
        this.axios
          .post(this.base_url + "/signin", data)
          .then((response) => {
              const charge = response.data;
              if (charge.error) {
                this.errors = charge.error;
                // localStorage.setItem('usertoken', false);
              }

              if (charge.success) {
                // this.$router.push({ name: "checkout" });
                window.location.href = this.base_url+"/checkout";
                localStorage.setItem('usertoken', true);
              }
              
            })
            .catch((err) => {
                console.log(err)
            })
      },
  },
};
</script>
