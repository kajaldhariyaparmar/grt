<template>
  <!-- Begin Crowdfunding Edit Campaign Section -->
  <section class="cf-section-wrap cf-edit-campaign-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Edit your campaign</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="cf-edit-campaign-wrap">
            <!-- <form @submit.prevent="formSubmit"> -->
            <div class="custom-row">
              <label>Campaign name</label>
              <input
                type="text"
                name="title"
                v-model="form.title"
                :style="[
                  errors.title
                    ? { border: '1px solid red' }
                    : { backgroundColor: 'white' },
                ]"
                class="cf-input-bx"
                value="Allah Bless You"
                placeholder="Give your campaign a name"
              />
              <span>{{ errors.title }}</span>
            </div>
            <div class="custom-row">
              <label>Campaign goal</label>
              <div class="input-wrap">
                <input
                  type="number"
                  name="goal"
                  v-model="form.goal"
                  :style="[
                    errors.goal
                      ? { border: '1px solid red' }
                      : { backgroundColor: 'white' },
                  ]"
                  class="cf-input-bx"
                  oninput="if(value.length>100)value=value.slice(0,100)"
                  value="500.00"
                />
                <span class="cf-currency-icon"
                  ><i class="fas fa-pound-sign" aria-hidden="true"></i
                ></span>
                <span>{{ errors.goal }}</span>
              </div>
            </div>
            <div class="custom-row">
              <label>Campaign photo</label>
              <div class="cf-edit-campaign-banner-img">
                <img
                  v-if="imagePreview"
                  v-bind:src="imagePreview"
                  v-show="showPreview"
                  class="ccf-edit-campaign-banner-img"
                />
                <img
                  v-else-if="form.image"
                  v-bind:src="base_url + '/public/cfcampaigns/' + form.image"
                  class="cf-edit-campaign-banner-img"
                />
                <img
                  v-else
                  v-bind:src="image_src + cfAppeal(cfappeals, cfappeal)"
                  class="cdcf-edit-campaign-banner-img"
                />
                <div class="cf-edit-campign-banner-btn-wrap">
                  <div class="cf-edit-campaign-banner-upload-btn">
                    Upload
                    <span>your own photo</span>
                  </div>
                  <input
                    type="file"
                    name="image"
                    class=""
                    id="image"
                    @change="onFileChange"
                  />
                </div>
                <!-- <input class="cf-edit-campaign-banner" type="file" name="image" id="image" @change="onFileChange" accept="image/*"/> -->
              </div>
            </div>
            <span>{{ errors.image }}</span>
            <!-- <div class="custom-row cf-edit-campign-banner-btn-wrap">
                                <div class="own-banenr-btn-wrap cf-edit-campaign-banner-upload float-left">
                                    Upload
                                    <span>your own photo</span>
                                </div>
                            </div> -->
            <div class="custom-row">
              <label>Mission statement </label>
              <div class="cf-edit-campaign-mission">
                <!-- <textarea v-model="form.description" rows="8" class="cf-text-area">
                                    </textarea> -->
                <vue-editor
                  name="description"
                  v-model="form.description"
                ></vue-editor>
              </div>
            </div>
            <div class="custom-row">
              <button
                class="cf-btn-wrap"
                v-on:click="formSubmit"
                :disabled="disableButton"
              >
                {{ loading ? "Loading..." : "Update Campaign" }}
              </button>
            </div>
            <div class="custom-row">
              <span v-if="editSuccess" class="campaign-update-success-alert"
                >Campaign updated successfully.</span
              >
              <ul>
                <li v-for="exception in errors.exception" :key="exception.id">
                  {{ exception }}
                </li>
              </ul>
            </div>
            <!-- </form> -->
            <div class="custom-row text-center">
              <router-link :to="{ name: 'cfdashboard' }" class="link-txt"
                >Cancel Changes
              </router-link>
            </div>
            <div class="custom-row text-center">
              <a
                @click="deleteCampaign()"
                class="link-txt cf-delete-campaign-txt"
                >Delete this campaign</a
              >
              <span v-if="deleteSuccess" class="campaign-delete-success-alert"
                >Campaign deleted successfully.</span
              >
              {{ deleteException }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--// End Crowdfunding Edit Campaign Section -->
</template>

<script>
//npm install vue2-editor
import { VueEditor } from "vue2-editor";
export default {
  data() {
    return {
      form: {
        title: this.$route.params.campaign.title,
        goal: this.$route.params.campaign.goal,
        image: this.$route.params.campaign.image,
        description: this.$route.params.campaign.description,
        is_joinbutton_public: false,
        campaignid: this.$route.params.campaign.id,
      },
      errors: [],
      loading: false,
      isLoggedIn: false,
      loggedinUserId: 0,
      disableButton: false,
      cfappeal: this.$route.params.cfappeal,
      cfappeals: this.$route.params.cfappeals,
      imagePreview: false,
      showPreview: false,
      fileTypeError: false,
      fileSizeError: false,
      deleteSuccess: false,
      deleteException: "",
      editSuccess: false,
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
    };
  },
  components: {
    VueEditor,
  },
  mounted() {
    this.getloginstate();
    this.getloginuserid();
  },
  created() {
    let cfDescription = "";
    for (let appealvalue of this.cfappeals) {
      if (this.cfappeal == appealvalue.name) {
        if (this.$route.params.campaign.description)
          cfDescription = this.$route.params.campaign.description;
        else cfDescription = appealvalue.mission_statement;
      }
    }
    this.form.description = cfDescription;
  },
  methods: {
    onFileChange(event) {
      // Set the selected image to the form variable.
      this.form.image = event.target.files[0];

      // Check to see if the file is not empty.
      if (this.form.image) {
        // Ensure the file is an image file.
        if (/\.(jpeg|jpg|png|gif)$/i.test(this.form.image.name)) {
          this.fileTypeError = false;
          // Initialize a file reader object
          let reader = new FileReader();
          if (this.form.image.size < 6291456) {
            this.fileSizeError = false;
            // Image preview
            reader.addEventListener(
              "load",
              function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
              }.bind(this),
              false
            );
            // Display the image in the preview.
            reader.readAsDataURL(this.form.image);
          } else {
            // Display the file type error
            this.fileSizeError = true;
            this.errors.push("File size can not be bigger than 6 MB");
            this.errors.image = "File size can not be bigger than 6 MB";
          }
        } else {
          // Display the file type error
          this.fileTypeError = true;
          this.errors.push("This file type is not allowed");
          this.errors.image = "This file type is not allowed";
        }
      }
    },
    cfAppeal(cfappeals, cfappeal) {
      let cfAppeal = "";
      for (let appealvalue of cfappeals) {
        if (cfappeal == appealvalue.name) {
          cfAppeal = appealvalue.photo;
        }
      }
      return cfAppeal;
    },
    deleteCampaign() {
      let self = this;
      const data = { campaignid: this.form.campaignid };
      this.axios
        .post(self.base_url + "/delete-campaign", data)
        .then((response) => {
          if (response.data.result == "success") {
            this.deleteSuccess = true;
            setTimeout(function () {
              self.$router.push({ name: "cfdashboard" });
            }, 2000);
          } else {
            this.deleteSuccess = false;
            this.deleteException = response.data.error;
          }
        })
        .catch((error) => {
          this.loading = true;
        });
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
      let self = this;
      // validate the form
      this.validateForm();

      // if form is validated
      if (!this.errors.length) {
        let formData = new FormData();
        formData.append("image", this.form.image);
        formData.append("title", this.form.title);
        formData.append("goal", this.form.goal);
        formData.append("description", this.form.description);
        formData.append("is_joinbutton_public", this.form.is_joinbutton_public);
        formData.append("campaignid", this.form.campaignid);

        this.disableButton = true;
        this.loading = true;

        this.axios
          .post(self.base_url + "/submit-edit-campaign", formData)
          .then((response) => {
            if (response.data.result == "success") {
              this.editSuccess = true;
              this.errors.exception = "";
              if (response.data.slug) {
                setTimeout(function () {
                  self.$router.push({
                    name: "fundraisingsingle",
                    params: { id: response.data.slug },
                  });
                }, 2000);
              }
            } else {
              this.loading = false;
              this.editSuccess = false;
              this.disableButton = false;
              this.errors.exception = response.data.result;
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
        this.errors.push("Campaign name is required.");
        this.errors.title = "Campaign name is required.";
      }

      if (!this.form.goal) {
        this.errors.push("Goal is required.");
        this.errors.goal = "Goal is required.";
      }

      if (this.fileTypeError) {
        this.errors.push("This file type is not allowed");
        this.errors.image = "This file type is not allowed";
      }

      if (this.fileSizeError) {
        this.errors.push("File size can not be bigger than 6 MB");
        this.errors.image = "File size can not be bigger than 6 MB";
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
