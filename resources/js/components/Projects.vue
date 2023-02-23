<template>
  <!-- Begin Projects Section -->
  <section class="section-wrap projects-page-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="section-title">
            <h2>Find out more about our projects</h2>
            <h3>
              While we battle the root causes of poverty through sustainable,
              empowering projects, we also recognise the importance of providing
              emergency relief to communities affected by crises. Learn more
              about our current appeals here, and donate today.
            </h3>
          </div>
        </div>
      </div>
      <!-- Begin Projects Tabs Container -->
      <div class="row">
        <div class="col-sm-12">
          <div class="projects-tab-container">
            <!-- Begin Projects Tabs Menu -->
            <div class="projects-tab-menu">
              <nav class="projects-tab-nav">
                <ul id="projectsTabNav">
                  <li class="active">By category</li>
                  <li>By countries</li>
                </ul>
              </nav>
            </div>
            <!--// End Projects Tabs Menu -->
            <!-- Begin Projects Tabs Contents Wrap -->
            <div class="projects-tab-contents-wrap" id="projectsTab">
              <!-- Begin Projects Category Tab -->
              <div class="projects-tab-contents">
                <!-- Begin Projects Category Filter Nav -->
                <div class="projects-filter-nav projects-category-filter-nav">
                  <ul>
                    <li class="active" data-filter="*">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">All category</span>
                          <small class="item-count">20 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".food-security">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Food security</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".winter">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Winter</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".emergencies">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Emergencies</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".water-sanitation">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Water & Sanitation</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".education">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Education</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".health-medical">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Health & Medical</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".livelihoods">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Livelihoods</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <!--// End Projects Category Filter Nav -->
                <!-- Begin Projects Category Filter Items Content -->
                <div class="row">
                  <div
                    class="campaigns-content projects-category-item-contents"
                  >
                    <ul>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          education
                          livelihoods
                        "
                      >
                        <div class="campaign-item-wrap">
                          <span class="tag-wrap bg-red">Zakatable</span>
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li class="col-sm-4 projects-category-item winter">
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          food-security
                          emergencies
                          education
                        "
                      >
                        <div class="campaign-item-wrap">
                          <span class="tag-wrap bg-red">Zakatable</span>
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="col-sm-4 projects-category-item water-sanitation"
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          health-medical
                          water-sanitation
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          food-security
                          emergencies
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          food-security
                          emergencies
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          winter
                          food-security
                          emergencies
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          food-security
                          emergencies
                        "
                      >
                        <div class="campaign-item-wrap">
                          <span class="tag-wrap bg-red">Zakatable</span>
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-category-item
                          food-security
                          emergencies
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="col-sm-4 projects-category-item health-medical"
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li class="col-sm-4 projects-category-item livelihoods">
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!--// End Projects Category Items Content -->
              </div>
              <!--// End Projects Category Tab -->

              <!-- Begin Projects Countries Tab -->
              <div class="projects-tab-contents">
                <!-- Begin Projects Countries Filter Nav -->
                <div class="projects-filter-nav projects-countries-filter-nav">
                  <ul>
                    <li class="active" data-filter="*">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">All</span>
                          <small class="item-count">20 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".bangladesh">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Bangladesh</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".burma">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Burma</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".pakistan">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Pakistan</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".palestine">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Palestine</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".syria">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Syria</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".turkey">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Turkey</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                    <li data-filter=".yemen">
                      <div class="filter-nav-item">
                        <span class="icon">
                          <img
                            src="images/filter-icon-default.png"
                            alt=""
                            class="icon-default"
                          />
                          <img
                            src="images/filter-icon-active.png"
                            alt=""
                            class="icon-active"
                          />
                        </span>
                        <div class="filter-nav-name">
                          <span class="filter-type">Yemen</span>
                          <small class="item-count">5 campaigns</small>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                <!--// End Projects Countries Filter Nav -->
                <!-- Begin Projects Countries Filter Items Content -->
                <div class="row">
                  <div
                    class="campaigns-content projects-countries-item-contents"
                  >
                    <ul>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          bangladesh
                          turkey
                        "
                      >
                        <div class="campaign-item-wrap">
                          <span class="tag-wrap bg-red">Zakatable</span>
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          bangladesh
                          yemen
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li class="col-sm-4 projects-countries-item yemen turkey">
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          syria
                          bangladesh
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li class="col-sm-4 projects-countries-item palestine">
                        <div class="campaign-item-wrap">
                          <span class="tag-wrap bg-red">Zakatable</span>
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li class="col-sm-4 projects-countries-item pakistan">
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          burma
                          palestine
                          pakistan
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          bangladesh
                          palestine
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          burma
                          palestine
                          pakistan
                          bangladesh
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          burma
                          syria
                          palestine
                          pakistan
                          bangladesh
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="col-sm-4 projects-countries-item syria palestine"
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                      <li
                        class="
                          col-sm-4
                          projects-countries-item
                          palestine
                          pakistan
                        "
                      >
                        <div class="campaign-item-wrap">
                          <div class="thumb-wrap">
                            <img src="images/campaign-img.jpg" alt="title" />
                          </div>
                          <div class="campaign-bottom-content">
                            <div class="title">
                              <h3>Orphans & widows</h3>
                            </div>
                            <div class="campaign-short-des">
                              <p>
                                Across the world, millions of families have been
                                torn apart by the death of Across the world,
                                millions of families have been torn apart by the
                                death of
                              </p>
                            </div>
                            <div class="campaign-donate-btn">
                              <a href="campaign-single.html" class="btn-wrap"
                                >Donate now</a
                              >
                            </div>
                          </div>
                          <a href="campaign-single.html" class="full-link"></a>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
                <!--// End Projects Countries Items Content -->
              </div>
              <!--// End Projects Countries Tab -->
            </div>
            <!--// End Projects Tabs Contents Wrap -->
          </div>
        </div>
      </div>
      <!--// End Projects Tabs Container -->
    </div>
  </section>
  <!--// End Projects Section -->
</template>
 
