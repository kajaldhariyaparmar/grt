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
                <h1>Zakat</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--// End Banner Section -->

    <!-- Begin Zakat Calculate Page Section -->
    <section class="section-wrap zakat-calculate-page-section">
      <div class="container">
          <div class="row">
              <!-- Begin Zakat Calculate Left Content -->
              <div class="col-sm-4">
                  <div class="sidebar-wrap">
                      <div class="sidebar-menu">
                          <ul>
                            <li>
                                <a href="zakat.html" class="active">
                                    What is zakat
                                    <span><i class="fas fa-angle-right"></i></span>
                                </a>
                            </li>
                            <li><router-link to="/zakat-calculator"> Calculate zakat<span><i class="fas fa-angle-right"></i></span></router-link></li>
                          </ul>
                      </div>
                  </div>
              </div><!--// End Zakat Calculate Left Content -->

               <!-- Begin Zakat Right Content -->
               <div class="col-sm-8">
                    <div class="zakat-pages-content">
                        <h1>Your Zakat will change lives.</h1>
                        <h5>Zakat is one of the five pillars of Islam and is obligatory for every able-bodied Muslim to pay before the end of the Islamic year.</h5>
                        <h3 class="mb-4"><em>“…Teach them that Allah has made it obligatory for them to pay the Zakat from their property and it is to be taken from the wealthy among them and given to the poor."</em> <span>(Bukhari)</span></h3>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/Aj0E6kqP_cQ" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <p>Zakat is given to those in desperate need. By giving your Zakat to Orphans in Need you will be helping to relieve the hardships of the most vulnerable in society, including impoverished orphan children and widowed families.</p>
                        <h3>How will your Zakat Help?</h3>
                        <p>When you donate your zakat, Orphans in Need will distribute it amongst the neediest orphans and widows around the world, like Hajira.</p>
                        <p>When Hajira went to make tea for her husband the gas cylinder, used for the cooker, exploded.</p>
                        <p>Unknowingly to her, the gas was leaking. The accident left Hajira with severe burns all over her body that have permanently damaged her ability to move. Her children who were asleep at the time also
                        suffered leaving one child disfigured. Hajira’s husband didn’t survive.</p>
                        <p>Even after weeks of recovery Hajira couldn’t sit or stand for too long and with young children who needed their mother, Hajira failed to provide for them. She desperately needed help.</p>
                        <p>We have been supporting Hajira and her family by providing regular food parcels and other essentials
                        like access to better medical care. We also gave safety training in gas usage so that the family can
                        feel safer at home again.</p>
                        <p>Your Zakat helps us be there for widows like Hajira and their orphan children in their time of need.
                        Your Zakat to Orphans in Need is like a Sadaqah Jariyah, a gift that keeps on giving.</p>
                        <p>By providing food, clothes, medical support and education, to relieve their suffering you are giving
                        orphans and widows better opportunities for the future.</p>
                        <p>We have carried out projects all over the 14 different countries we work in using all of your Zakat to better the lives of thousands of the neediest orphans and widows.</p>
                        <p>Give your Zakat to Orphans in Need and start making a difference.</p>

                        <p>If you don’t know how much Zakat you are due to pay, use our quick <a href="calculate-zakat.html">Zakat Calculator</a> to help.</p>
                        <p>If you need more information about Zakat then read our <a href="zakat-rules.html">Zakat rules</a> to help answer all your questions.</p>

                    </div>
                </div><!--// End Zakat Right Content -->
          </div>
      </div>
    </section><!--// End Zakat Calculate Page Section -->
  </div>
</template>
