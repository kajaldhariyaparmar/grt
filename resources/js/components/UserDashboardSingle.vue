<template>
  <div>
    <!-- Begin Order Details Section -->
    <section class="section-wrap order-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="section-title">
                        <h2 class="text-left">Donation details!</h2>
                        <h3>{{donor.name}} {{donor.lastname}}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="order-left-content">
                        <h2>Donation details</h2>
                        <div class="customer-info-wrap">
                            <div class="customer-info">
                                <h4><span>Donate on:</span> {{dateFormat(donations[0].created_at)}}</h4>
                                <h4><span>Donation no: {{donations[0].reference}}</span> </h4>
                                <h4><span>Status:</span> Success</h4>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-sm-6">
                    <div class="order-left-content">
                        <h2>Billing Address</h2>
                        <div class="customer-info-wrap">
                            <div class="customer-info">
                                <address>{{donations[0].address}} {{donations[0].postcode}} {{donations[0].city}}</address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 right-column mt-4">
                    <div class="order-details-content-wrap">
                        <div class="order-details-content-inner">
                            <div class="order-details-item-row order-details-item-title-row">
                                <div class="column item-title-column">
                                    <h3>Project name</h3>
                                </div>
                                <!-- <div class="column item-status-column">
                                    <h3>Date</h3>
                                </div> -->
                                <div class="column item-price-column">
                                    <h3>Amount</h3>
                                </div>
                                
                            </div>
                            <div v-for="data in donations"
                                v-bind:key="data.id"
                                v-bind:value="data.id"
                                 class="order-details-item-row">
                                <div class="column item-title-column">
                                    <h3>{{data.title}}</h3>
                                    <h4>Type: {{data.type}}</h4>
                                    <h5>Payment type: {{data.appeal}}</h5>
                                </div>
                                <!-- <div class="column item-status-column">
                                    <h3>{{ dateFormat(data.created_at) }}</h3>
                                </div> -->
                                <div class="column item-price-column">
                                    <h3>£{{data.amount}}</h3>
                                </div>
                            </div>
                            <div class="order-details-item-row order-details-total-row">
                                <div class="column order-details-total-content">
                                    <div class="order-details-total-amount-wrap">
                                        <div class="order-details-total-amount">
                                            <div class="column1 colL">
                                                <h3>Subtotal</h3>
                                            </div>
                                            <div class="column1 colR">
                                                <h3>£{{subTotal}}</h3>
                                            </div>
                                        </div>
                                        <div class="order-details-total-amount">
                                            <div class="column1 colL">
                                                <h3>Admin donation</h3>
                                            </div>
                                            <div class="column1 colR">
                                                <h3>£0.00</h3>
                                            </div>
                                        </div>
                                        <div class="order-details-total-amount total-row">
                                            <div class="column1 colL">
                                                <h3>Total</h3>
                                            </div>
                                            <div class="column1 colR">
                                                <h3>£{{subTotal}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--// End Order Details Section -->
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
      donations: [],
      donor: [],
      subTotal: 0,
      base_url: '/grt',
    };
  },
  mounted() {
    this.getloginusername();
    this.getloginstate();
    this.getloginuserid();
  },
  computed: {},
  created() {
     this.axios.get(this.base_url + `/donation-details/${this.$route.params.reference}`).then((response) => {
    //  this.axios.get("/donation-details").then((response) => {
      this.donations = response.data.donations;
      this.donor = response.data.donor;
      this.subTotal = response.data.sub_total;
    });
  },
  methods: {
     dateFormat(date) {
      return moment(date).format("dddd, DD MMM YYYY");
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