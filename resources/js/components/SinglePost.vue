<template>
  <div>
    <!-- Begin News Single Section -->
    <section class="section-wrap news-single-section">
      <div class="container">
        <div class="row">
          <!-- Begin News Single Left Content -->
          <div class="col-sm-8">
            <!-- Begin Breadcrumb -->
            <div class="breadcrumb-wrap">
              <ul>
                <li><a :href="base_url + '/posts'"><span class="material-icons">arrow_back</span> Back to News</a></li>
              </ul>
            </div>
            <!--// End Breadcrumb -->
            <!-- Begin News Single Content -->
            <div class="news-single-content">
                <h1>{{ post.title }}</h1>
            </div>
            <div class="post_featured_image">
            <img
              v-bind:src="image_src + post.image"
              v-bind:alt="post.title"
            />
            </div>
            <div class="news-single-content" v-html="post.body"></div>
            <!--// End News Single Content -->
          </div>
          <!--// End News Single Left Content -->
          <!-- Begin News Single Right Content -->
          <div class="col-sm-4">
            <div class="sidebar-wrap">
              <div class="news-single-sidebar">
                <div class="title">
                  <h3>Latest news</h3>
                </div>
                <ul>
                  <li v-for="latestpost in latestposts" :key="latestpost.id">
                    <a
                      :href="
                        $router.resolve({
                          name: 'edit',
                          params: { id: latestpost.slug },
                        }).href
                      "
                      >{{ latestpost.title }}</a
                    >
                  </li>
                </ul>
              </div>
              <div class="news-single-sidebar sidebar-categories">
                <div class="title">
                  <h3>Categories</h3>
                </div>
                <ul>
                  <li v-for="category in categories" :key="category.id">
                    <a href="#"
                      >{{ category.name }}
                      <span>({{ category.posts_count }})</span></a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!--// End News Single Right Content -->
        </div>
      </div>
    </section>
    <!--// End News Single Section -->
  </div>
</template>
 
<script>
export default {
  data() {
    return {
      post: {},
      latestposts: {},
      categories: {},
      base_url: '/grt',
      image_src:'/grt/storage/app/public/',
    };
  },
  created() {
    this.axios
      .get(this.base_url + `/api/post/edit/${this.$route.params.id}`)
      .then((response) => {
        window.scrollTo(0, 0);
        this.post = response.data.post;
        this.latestposts = response.data.latestposts;
        this.categories = response.data.categories;
      });
  },
};
</script>