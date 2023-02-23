<template>
  <!-- Begin Event Single Section -->
  <section class="section-wrap event-single-section">
      <div class="container">
          <div class="row">
              <!-- Begin Event Single Left Content -->
              <div class="col-sm-8">
                  <!-- Begin Breadcrumb -->
                  <div class="breadcrumb-wrap">
                      <ul>
                          <li>
                            <router-link
                              :to="{
                              name: 'events',
                              }"
                              ><span class="material-icons">arrow_back</span> Back to Events
                            </router-link>
                          </li>
                      </ul>
                  </div>
                  <!--// End Breadcrumb -->
                  <!-- Begin Event Single Content -->
                  <div class="event-single-content">
                      <h1>{{event.title}}</h1>
                      <div
                        v-html="event.description"
                      ></div>
                  </div><!--// End Event Single Content -->
              </div><!--// End Event Single Left Content -->
              <!-- Begin Event Single Right Content -->
              <div class="col-sm-4">
                  <div class="sidebar-wrap">
                      <div class="event-single-sidebar">
                          <div class="thumb">
                               <img
                                v-bind:src="image_src + event.thumbnail"
                                v-bind:alt="event.title"
                                />
                          </div>
                          <div class="right-column">
                              <div class="btn-wrap-row">
                                  <a :href="event.registration_link" class="btn-wrap">Register Now</a>
                                  <!-- <router-link
                                      :to="{
                                      name: 'eventbooking',
                                      params: { id: event.slug, title: event.title },
                                      }"
                                      >Register Now
                                  </router-link> -->
                              </div>
                              <div class="event-info-wrap">
                                  <div class="custom-row">
                                      <h4>
                                          Time
                                          <span class="events-time">{{event.start_time}} - {{event.end_time}}</span>
                                      </h4>
                                      <h4>
                                          Date
                                          <span class="events-time">{{dateFormat(event.start_date)}} - {{dateFormat(event.end_date)}}</span>
                                      </h4>
                                      <h4>
                                          Location
                                          <span class="events-location">{{event.location}}</span>
                                      </h4>
                                      <h4>
                                          Price
                                          <span class="events-price">{{event.price}}</span>
                                      </h4>
                                  </div>
                              </div>                      
                          </div>
                      </div>
                  </div>
              </div><!--// End Event Single Right Content -->
          </div>
      </div>
  </section><!--// End Event Single Section -->
</template>
 
<script>
import moment from "moment";
export default {
  data() {
    return {
      event: [],
      loading: false,
      base_url: '/grt',
      image_src:'/grt/storage/app/public/',
    };
  },
  mounted() {
    this.loadSingleEvent();
  },
  methods: {
      loadSingleEvent() {
      this.axios
        .get(this.base_url +`/api/event/${this.$route.params.id}`)
        .then((response) => {
          this.event = response.data.event;
          this.loading = false;
          console.log(response.data.event);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    dateFormat(date) {
      return moment(date).format("ddd DD MMMM YYYY");
    },
    
  },
};
</script>