<template>
  <!-- Begin Events Section -->
  <section class="section-wrap events-page-section">
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="section-title">
                      <h2>Find out more about our events</h2>
                      <h3>While we battle the root causes of poverty through sustainable, empowering projects, we also recognise the importance of providing emergency relief to communities affected by crises. Learn more about our current appeals here, and donate today.</h3>
                  </div>
              </div>
          </div>
          <!-- Begin Events Tabs Container -->
          <div class="row">
              <div class="col-sm-12">
                  <div class="events-tab-container">
                      <!-- Begin Events Tabs Menu -->
                      <div class="events-tab-menu">
                          <nav class="events-tab-nav">
                              <ul id="eventsTabNav">
                                  <li v-on:click="events_tab = 1" :class="{active : events_tab == 1}">Upcoming events</li>
                                  <li v-on:click="events_tab = 2" :class="{active : events_tab == 2}">Past events</li>
                              </ul>
                          </nav>
                      </div><!--// End Events Tabs Menu -->
                      <!-- Begin Events Tabs Contents Wrap -->
                      <div class="events-tab-contents-wrap" id="eventsTab">
                          <!-- Begin Upcoming Events Tab -->
                          <div class="events-tab-contents" v-if="events_tab == 1" :class="{active : events_tab == 1}">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="events-page-content">
                                          <ul>
                                              <li v-for="upcomingevent in upcomingevents"
                                                :key="upcomingevent.id">
                                                  <div class="events-item-content-wrap">
                                                      <div class="column thumb-column">
                                                          <div class="thumb-wrap">
                                                              <router-link
                                                                    :to="{
                                                                    name: 'event',
                                                                    params: { id: upcomingevent.slug },
                                                                    }"
                                                                    >
                                                                    <img
                                                                    v-bind:src="image_src + upcomingevent.thumbnail"
                                                                    v-bind:alt="upcomingevent.title"
                                                                    />
                                                                </router-link>
                                                          </div>
                                                      </div>
                                                      <div class="column description-column">
                                                          <div class="short-des-content">
                                                              <div class="events-date-location">
                                                                  <p class="events-date"><span><i class="far fa-calendar"></i></span>{{ dateFormat(upcomingevent.start_date) }}</p>
                                                              </div>
                                                              <h3 class="event-title">{{ upcomingevent.title }}</h3>
                                                              <p class="short-description">{{ upcomingevent.title }}…</p>
                                                              <div class="events-date-location">
                                                                  <p class="events-location"><span><i class="fas fa-map-marker-alt"></i></span>{{upcomingevent.location}}</p>
                                                              </div>
                                                              <router-link
                                                                :to="{
                                                                name: 'event',
                                                                params: { id: upcomingevent.slug },
                                                                }"
                                                                class="btn-wrap transparent-btn"
                                                                >More details
                                                            </router-link>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                      <div class="btn-wrap-row">
                                          <button @click="loadMoreupcoming" class="btn-wrap transparent-btn upcoming-events-load-more">Load more</button>
                                      </div>
                                  </div>
                              </div>
                          </div><!--// End Upcoming EventsTab -->

                          <!-- Begin Past Events Tab -->
                          <div class="events-tab-contents" v-if="events_tab == 2" :class="{active : events_tab == 2}">
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="events-page-content">
                                          <ul>
                                              <li v-for="pastevent in pastEventsLoaded"
                                                :key="pastevent.id">
                                                  <div class="events-item-content-wrap">
                                                      <div class="column thumb-column">
                                                          <div class="thumb-wrap">
                                                              <router-link
                                                                    :to="{
                                                                    name: 'event',
                                                                    params: { id: pastevent.slug },
                                                                    }"
                                                                    >
                                                                    <img
                                                                    v-bind:src="image_src + pastevent.thumbnail"
                                                                    v-bind:alt="pastevent.title"
                                                                    />
                                                                </router-link>
                                                          </div>
                                                      </div>
                                                      <div class="column description-column">
                                                          <div class="short-des-content">
                                                              <div class="events-date-location">
                                                                  <p class="events-date"><span><i class="far fa-calendar"></i></span>{{ dateFormat(pastevent.start_date) }}</p>
                                                              </div>
                                                              <h3 class="event-title">{{ pastevent.title }}</h3>
                                                              <p class="short-description">{{ pastevent.title }}…</p>
                                                              <div class="events-date-location">
                                                                  <p class="events-location"><span><i class="fas fa-map-marker-alt"></i></span>{{pastevent.location}}</p>
                                                              </div>
                                                              <router-link
                                                                :to="{
                                                                name: 'event',
                                                                params: { id: pastevent.slug },
                                                                }"
                                                                class="btn-wrap transparent-btn"
                                                                >More details
                                                            </router-link>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </li>
                                          </ul>
                                      </div>
                                  </div>
                                  <div class="col-sm-12">
                                      <div class="btn-wrap-row">
                                          <button @click="loadMorepast" class="btn-wrap transparent-btn past-events-load-more">Load more</button>
                                      </div>
                                  </div>
                              </div>
                          </div><!--// End Past Events Tab -->
                      </div><!--// End Events Tabs Contents Wrap -->
                  </div>
              </div>
          </div><!--// End Events Tabs Container -->
      </div>
  </section><!--// End Events Section -->
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      pasteventcount:7,
      upcomingeventcount:7,
      events_tab: 1,
      pastevents: [],
      upcomingevents: [],
      loading: false,
      base_url: 'http://localhost/grt',
      image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  mounted() {
    this.loadPastEvents();
    this.loadUpcomingEvents();
  },
  methods: {
     loadPastEvents() {
      this.axios
        .get(this.base_url + "/api/pastevents")
        .then((response) => {
          this.pastevents = response.data;
          this.loading = false;
          console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    loadUpcomingEvents() {
      this.axios
        .get(this.base_url + "/api/upcomingevents")
        .then((response) => {
          this.upcomingevents = response.data;
          this.loading = false;
          console.log(response.data);
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    dateFormat(date) {
      return moment(date).format("ddd DD MMMM YYYY");
    },

      loadMorepast() {
          if (this.pasteventcount > this.pastevents.length) return;
          this.pasteventcount = this.pasteventcount + 10;
          console.log("works")
      },
      loadMoreupcoming() {
          if (this.upcomingeventcount > this.upcomingevents.length) return;
          this.upcomingeventcount = this.upcomingeventcount + 10;
          console.log("works")
      },

  },
    computed: {
        pastEventsLoaded() {
            return this.pastevents.slice(0, this.pasteventcount);
        },
        upcomingEventsLoaded() {
            return this.upcomingevents.slice(0, this.upcomingeventcount);
        },
    },
};
</script>
