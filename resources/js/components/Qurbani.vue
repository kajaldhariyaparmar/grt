<template>
    <div style="margin-bottom: 40px;">
      <section
        class="single-page-banner clear"
        style="background: url(http://localhost/grt/images/single-banner.jpg) no-repeat center 0;  background-size: cover;
        ">
        <div class="single-page-banner-container">
          <div class="container">
            <div class="row">
              <div class="col-sm-12">
                <div class="page-title">
                  <h1>QURBANI 2022</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--// End Banner Section -->
  
      <!-- Begin Qurbani Section -->
      <section class="zakat-calculate-page-section">
        <div class="container">
            <div class="row">
                <!-- Begin Qurbani Left Content -->
                <div class="col-sm-6">
                    <div class="zakat-pages-content">
                        <h2 class="qurbani-h2"><b>Qurbani Appeal - Fulfil your sacrifice for the pleasure of Allah</b></h2>
                        <p><b>What is Qurbani?</b></p>
                        <p><strong>Qurbani</strong> or Udhiya, means to sacrifice (slaughter) an animal. Every year Muslims sacrifice sheep, goats and cattle between the 10th and 12th days of Dhul Hijjah, the final month of the Islamic calendar. This obligatory act is performed for us to reflect on Prophet Ibrahim’s (AS) willingness to sacrifice his son Ismail for the pleasure of Allah.</p>
                        <p>We at Global Relief Trust source and sacrifice the healthiest animals, getting value for money with your donations whilst respecting your duty as a Muslim and guaranteeing your Qurbani reaches those who need it the most, on time.</p>
                        <p>Make Eid ul-Adha extra special for those living in poverty and hunger.</p>
                        <p>Fulfill your Qurbani obligations now.</p>
  
                        <div class="custom-row crt-btn-div">
                            <router-link class="m-auto" to="/qurbani-packs"><button class="btn btn-sm crt-button">DONATE QURBANI NOW</button></router-link>
                        </div>
                        <div class="custom-row">
                            <img src="http://localhost/grt/images/Qurbani-2022-Final.png" alt="">
                        </div>
                    </div>
                    <div class="zakat-pages-content">
                        <p><b>The significance of Qurbani</b></p>
                        <p>The practice of Qurbani can be traced back to the Prophet Ibrahim (AS).</p>  
                        <p>It is a sacred act to honour the tradition of the blessed Prophet Ibrahim (AS) and Ismail (AS) and their story of sacrifice and devotion to Allah SWT.</p>  
                        <p>Eid-al-Adha, the festival of sacrifice, is celebrated during the twelfth month of the Islamic calendar, known as Dhul Hijjah – which translates as ‘Lord of the Pilgrimage’. 
                        It is during this month that pilgrims travel to Mecca in order to visit the Kaaba.
                        Hajj is performed from the eighth to the twelfth of Dhul Hajj. Eid ul-Adha is celebrated on tenth of Dhul Hajj and is celebrated for 3 days.</p>  
                        <p>Sacrificed meat is distributed among the poor and vulnerable across the globe. At least one third of the meat from the animal must go to poor or vulnerable people. 
                        Traditionally, a Muslim would keep one third of the meat for their family and give the final third to their neighbours.</p>  
                        <p>Those who receive the Qurbani meat include widows, orphaned children, refugees, the poor, and the elderly or disabled people. 
                        For the majority, meat is not part of their regular diet. The Qurbani meat allows some families to eat meat after a whole year.<strong>Your Qurbani can provide up to 60 meals.</strong></p>
                        <p>When families receive Qurbani meat, it allows them to celebrate Eid with nutritional food along with millions of other Muslims across the world.</p>
                        <div class="custom-row">
                            <div>
                                <input type="checkbox" id="question1" name="q" class="questions">
                                <label for="question1" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Who is Qurbani Compulsory for?
                                </label>
                                <div class="answers">
                                    <p>According to many scholars, Qurbani is an obligation for all sane adult male or female Muslims who meet the Zakat threshold (nisaab).</p>
                                    <p><b>The Prophet (ﷺ) said, “It is the Sunnah of your father Ibrahim (AS). For every hair of the Qurbani you receive a reward from Allah (SWT).”</b></p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question2" name="q" class="questions">
                                <label for="question2" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Where will my Qurbani be distributed?
                                </label>
                                <div class="answers">
                                    <p>We will be distributing Qurbani meals to impoverished people across Yemen, Syria, Bangladesh, Rohingya, Burundi, Lebanon, India and Pakistan.</p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question3" name="q" class="questions">
                                <label for="question3" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Do I need to do Qurbani on behalf of my children?
                                </label>
                                <div class="answers">
                                    <p>This depends on the school of thought you follow.
                                        Please consult your local Imam/Shaykh for further clarification.
                                        According to the Hanafi school of thought it is obligatory for:</p>
                                    <ul>
                                        <li>Every sane Muslim of mature age who has wealth above the nisaab.</li>
                                        <li>Non-travelling persons</li>
                                        <li>Those who possess wealth which is beyond their needs, equal to (or more than) the current level of nisaab (see our <router-link to="/zakat">Zakat Calculator</router-link> for further information)</li>
                                    </ul>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question4" name="q" class="questions">
                                <label for="question4" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Do I need to give the names for the people of the Qurbani?
                                </label>
                                <div class="answers">
                                    <p>No, this is not necessary as long as you have made the intention that you are giving this Qurbani on behalf of a certain person.</p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question5" name="q" class="questions">
                                <label for="question5" class="question">
                                    <i class="fa fa-plus plus-icon"></i>When will Qurbani be done?
                                </label>
                                <div class="answers">
                                    <p>This depends on the country you have chosen. Qurbanis are performed after the Eid Salah by our team in Yemen, Syria, Bangladesh, Burundi, Lebanon, India and Pakistan.</p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question6" name="q" class="questions">
                                <label for="question6" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Can you do more than one Qurbani?
                                </label>
                                <div class="answers">
                                    <p>In short yes, you can do as many as you wish. The Prophet (SAW) carried out multiple Qurbanis for himself and the Ummah.</p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question7" name="q" class="questions">
                                <label for="question7" class="question">
                                    <i class="fa fa-plus plus-icon"></i>Can I do Qurbani for a deceased person?
                                </label>
                                <div class="answers">
                                    <p>Yes you can. It is not an obligation however it can be done as Sadaqah Jariyah for a loved one. Many Muslims around the world offer multiple Qurbani for our beloved Prophet SAW.</p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question8" name="q" class="questions">
                                <label for="question8" class="question">
                                    <i class="fa fa-plus plus-icon"></i>When should I make payment?
                                </label>
                                <div class="answers">
                                    <p>You should do this as soon as possible. We will take Qurbani orders until 2am (UK Time) on 10th Dhul Hijjah (Eid day). We have reserved thousands of sheep, goats and cattle however you must hurry as once we have allocated all the ones we have reserved we will not be taking on any more orders.
                                    </p>
                                </div>
                            </div>
                            <div>
                                <input type="checkbox" id="question9" name="q" class="questions">
                                <label for="question9" class="question">
                                    <i class="fa fa-plus plus-icon"></i>How do we define costs of Qurbani?
                                </label>
                                <div class="answers">
                                    <p>At Global Relief Trust, we are always looking at ensuring Qurbani prices are kept as low as possible but there is always an inflation of livestock around Qurbani time. 
                                        The costs of Qurbani includes not only the purchasing of the animals, but feeding them, taking care of them, their transport, 
                                        slaughter, butcher costs, distribution, monitoring and other support costs. 
                                        Support costs are essential to ensure that good healthy animals are purchased and taken care of as well as 
                                        selecting the most vulnerable people to give meat to.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--// End Qurbani Left Content -->
  
                <!-- Begin Qurbani Right Content -->
                <div class="col-sm-6">
                    <div class="zakat-pages-content">
                        <h3 class="qurbani-h3"><b>Fulfill your Qurbani obligation with GRT to one of the following countries:</b></h3>
                        <div class="row">
                            <div class="col-sm-6 text-center" v-for="pack in packs"
                                                    :key="pack.id">
                                <router-link :to="{ name: 'all-donation', params: { id: pack.slug } }" >
                                <img class="card-img-top"
                                            v-bind:src="image_src + pack.thumbnail"
                                            v-bind:alt="pack.title" 
                                        />
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div><!--// End Qurbani Right Content -->
            </div>
        </div>
      </section><!--// End Qurbani Page Section -->
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        loading: false,
        packs: [],
        base_url: 'http://localhost/grt',
        image_src:'http://localhost/grt/storage/app/public/',
       };
    },
   
    mounted() {
        this.loadQurbaniPacks();
    },
    methods: {
        loadQurbaniPacks() {
        this.axios
            .get(this.base_url + "/api/qurbanipacks")
            .then((response) => {
            this.packs = response.data;
            this.loading = false;
            console.log(response.data);
            })
            .catch((error) => {
            callback(error, error.response.data);
            });
        },
    },
  };
  </script>
  