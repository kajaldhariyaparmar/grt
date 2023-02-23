<template>
  <!-- Begin News Section -->
  <section class="section-wrap news-page-section bg-light-grey">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Latest news about our projects, team and opportunities</h2>
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
              name=""
              class="select-bx"
              v-model="category"
              @change="filterPosts()"
            >
              <option value="0">All posts</option>
              <option
                v-for="data in categories"
                v-bind:key="data.id"
                v-bind:value="data.id"
              >
                {{ data.name }}
              </option>
            </select>
            <select
              name=""
              class="select-bx"
              v-model="sortby"
              @change="filterPosts()"
            >
              <option value="desc">Newest</option>
              <option value="asc">Oldest</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="news-page-content" v-bind:class="{ loading: loading }">
            <ul>
              <li v-for="post in loadposts" :key="post.id">
                <div class="news-item-content-wrap">
                  <div class="column thumb-column">
                    <div class="thumb-wrap">
                      <img
                        v-bind:src="image_src + post.image"
                        v-bind:alt="post.title"
                      />
                    </div>
                  </div>
                  <div class="column short-des-column">
                    <div class="short-des-content">
                      <h3>{{ post.title }}</h3>
                      <p class="short-description" v-html="post.excerpt"></p>
                      <div class="news-read-btn">
                        <router-link
                          :to="{ name: 'edit', params: { id: post.slug } }"
                          class="full-link"
                          >Read more
                        </router-link>
                      </div>
                    </div>
                  </div>
                  <router-link
                    :to="{ name: 'edit', params: { id: post.slug } }"
                    class="full-link"
                  >
                  </router-link>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="col-sm-12" v-if="postsVisible < posts.length">
            <div class="btn-wrap-row">
                <button class="btn-wrap transparent-btn news-load-more" @click="postsVisible += step" v-if="postsVisible < posts.length">
                    Load more
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End News Section -->
</template>
 
<script>
export default {
  data() {
    return {
      posts: [],
      category: 0,
      sortby: "desc",
      loading: true,
      categories: [],
      base_url: '/grt',
      image_src:'/grt/storage/app/public/',
      postsVisible: 3,
      step: 3
    };
  },
  computed: {
    loadposts() { 
      return this.posts.slice(0, this.postsVisible);
    }
  },
  mounted() {
    this.filterPosts();
    this.filterCategories();
  },
  methods: {
    deletePost(id) {
      this.axios.delete(this.base_url + `/api/post/delete/${id}`).then((response) => {
        let i = this.posts.map((item) => item.id).indexOf(id); // find index of your object
        this.posts.splice(i, 1);
      });
    },
    filterPosts() {
      this.postsVisible = 3;
      this.loading = false;
      this.axios
        .get(this.base_url + "/api/posts", {
          params: {
            category_id: this.category,
            sortby: this.sortby,
          },
        })
        .then((response) => {
          this.posts = response.data;
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
    filterCategories() {
      this.postsVisible = 3;
      this.loading = false;
      this.axios
        .get(this.base_url + "/api/categories")
        .then((response) => {
          this.categories = response.data;
          this.loading = false;
        })
        .catch((error) => {
          callback(error, error.response.data);
        });
    },
  },
};
</script>