<template>
  <!-- Begin Campaign Checkout Section -->
  <section class="section-wrap campaign-checkout-section bg-white">
    <div class="container">
      <div class="row campaign-checkout-row">
        <!-- Begin Campaign Checkout Left Section -->
        <div class="col-sm-7">
          <div class="campaign-checkout-left-content">
            <div class="form-wrap">
              <div class="row">
                <div class="custom-row your-information">
                  <div class="col-sm-12">
                    <h3>Your information</h3>
                  </div>
                </div>

                <div class="custom-row input-row">
                  <div class="col-sm-12">
                    <select
                      name="customertitle"
                      v-model="user.customertitle"
                      class="select-bx"
                    >
                      <option value="Mr">Mr</option>
                      <option value="Mrs">Mrs</option>
                      <option value="Miss">Miss</option>
                      <option value="Dr">Dr</option>
                      <option value="Ms">Ms</option>
                      <option value="Prof">Prof</option>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx"
                      :style="[
                        errors.name
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.name"
                      value=""
                      placeholder="First name"
                      name=""
                    />
                    <div>{{ errors.name }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      :style="[
                        errors.lastname
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      class="input-bx"
                      v-model="user.lastname"
                      value=""
                      placeholder="Last name"
                      name=""
                    />
                    <div>{{ errors.lastname }}</div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="email"
                      @change="checkUniqueEmail()"
                      class="input-bx"
                      :style="[
                        errors.email
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.email"
                      value=""
                      placeholder="Email address"
                      name=""
                    />
                    <div>{{ errors.email }}</div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <vue-tel-input name="contact"
                    placeholder="Contact number" class="input-bx"
                    autoFormat
                    :enableCountryCode = "true"
                    :dropdownOptions="{
                      showFlags: true,
                      showDialCodeInSelection: true,
                    }"
                    :inputOptions="{
                      showDialCode:false
                    }"
                    :style="[
                        errors.contact
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"

                    v-model="user.contact"
                   @input="telValidate"
                    ></vue-tel-input>
                    <div>{{ errors.contact }}</div>
                  </div>
                </div>
                <div v-if="!isUserLoggedIn" class="custom-row">
                  <div class="col-sm-12 want-to-signup">
                    <div class="custom-checkbox">
                          <input type="checkbox" id="wanttoSignup" v-model="user.signup" value="No">
                          <label for="wanttoSignup">Create an account for faster checkout in the future?</label>
                      </div>
                  </div>
                </div>
                <div v-if="!isUserLoggedIn && user.signup" class="custom-row input-row">
                  <div class="col-sm-6">
                    <input
                      type="password"
                      class="input-bx"
                      :style="[
                        errors.password
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.password"
                      value=""
                      placeholder="Password"
                    />
                    <div>{{ errors.password }}</div>
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="password"
                      class="input-bx"
                      :style="[
                        errors.confirm_password
                          ? { border: '1px solid red' }
                          : { backgroundColor: 'white' },
                      ]"
                      v-model="user.confirm_password"
                      value=""
                      placeholder="Confirm password"
                    />
                    <div>{{ errors.confirm_password }}</div>
                    <div class="error-pass-confirmation">
                      {{ errors.password_confirmation }}
                    </div>
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <h3>Billing address</h3>
                  </div>
                </div>
                <div class="custom-row postcode-search">
                    <div class="col-sm-12">
                        <div id="postcodeSearch"></div>
                        <!-- <input type="text" class="input-bx" value="" placeholder="Search your postcode" name="">
                        <button class="btn-wrap">Find my address</button> -->
                    </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="text"
                      class="input-bx" id="addressLine1"
                      v-model="user.addressline1"
                      value=""
                      placeholder="Address"
                      name="address"
                    />
                  </div>
                </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <input
                      type="text"
                      class="input-bx" id="addressLine2"
                      v-model="user.addressline2"
                      value=""
                      placeholder="Address"
                      name="address"
                    />
                  </div>
                </div>
                <div class="custom-row input-row">
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx" id="postCity"
                      v-model="user.city"
                      value=""
                      placeholder="City"
                      name="city"
                    />
                  </div>
                  <div class="col-sm-6">
                    <input
                      type="text"
                      class="input-bx" id="postCode"
                      v-model="user.postcode"
                      value=""
                      placeholder="Post code"
                      name="postcode" 
                    /> 
                  </div>
                </div>
                <!-- <div class="custom-row">
                  <div class="col-sm-6">
                    <select
                      name="country"
                      v-model="user.country"
                      class="select-bx"
                    >
                      <option value="" disabled selected>Country</option>
                      <option value="United Kingdom">United Kingdom</option>
                      <option value="Afganistan">Afghanistan</option>
                      <option value="Albania">Albania</option>
                      <option value="Algeria">Algeria</option>
                      <option value="American Samoa">American Samoa</option>
                      <option value="Andorra">Andorra</option>
                      <option value="Angola">Angola</option>
                      <option value="Anguilla">Anguilla</option>
                      <option value="Antigua &amp; Barbuda">
                        Antigua &amp; Barbuda
                      </option>
                      <option value="Argentina">Argentina</option>
                      <option value="Armenia">Armenia</option>
                      <option value="Aruba">Aruba</option>
                      <option value="Australia">Australia</option>
                      <option value="Austria">Austria</option>
                      <option value="Azerbaijan">Azerbaijan</option>
                      <option value="Bahamas">Bahamas</option>
                      <option value="Bahrain">Bahrain</option>
                      <option value="Bangladesh">Bangladesh</option>
                      <option value="Barbados">Barbados</option>
                      <option value="Belarus">Belarus</option>
                      <option value="Belgium">Belgium</option>
                      <option value="Belize">Belize</option>
                      <option value="Benin">Benin</option>
                      <option value="Bermuda">Bermuda</option>
                      <option value="Bhutan">Bhutan</option>
                      <option value="Bolivia">Bolivia</option>
                      <option value="Bonaire">Bonaire</option>
                      <option value="Bosnia &amp; Herzegovina">
                        Bosnia &amp; Herzegovina
                      </option>
                      <option value="Botswana">Botswana</option>
                      <option value="Brazil">Brazil</option>
                      <option value="British Indian Ocean Ter">
                        British Indian Ocean Ter
                      </option>
                      <option value="Brunei">Brunei</option>
                      <option value="Bulgaria">Bulgaria</option>
                      <option value="Burkina Faso">Burkina Faso</option>
                      <option value="Burundi">Burundi</option>
                      <option value="Cambodia">Cambodia</option>
                      <option value="Cameroon">Cameroon</option>
                      <option value="Canada">Canada</option>
                      <option value="Canary Islands">Canary Islands</option>
                      <option value="Cape Verde">Cape Verde</option>
                      <option value="Cayman Islands">Cayman Islands</option>
                      <option value="Central African Republic">
                        Central African Republic
                      </option>
                      <option value="Chad">Chad</option>
                      <option value="Channel Islands">Channel Islands</option>
                      <option value="Chile">Chile</option>
                      <option value="China">China</option>
                      <option value="Christmas Island">Christmas Island</option>
                      <option value="Cocos Island">Cocos Island</option>
                      <option value="Colombia">Colombia</option>
                      <option value="Comoros">Comoros</option>
                      <option value="Congo">Congo</option>
                      <option value="Cook Islands">Cook Islands</option>
                      <option value="Costa Rica">Costa Rica</option>
                      <option value="Cote DIvoire">Cote D'Ivoire</option>
                      <option value="Croatia">Croatia</option>
                      <option value="Cuba">Cuba</option>
                      <option value="Curaco">Curacao</option>
                      <option value="Cyprus">Cyprus</option>
                      <option value="Czech Republic">Czech Republic</option>
                      <option value="Denmark">Denmark</option>
                      <option value="Djibouti">Djibouti</option>
                      <option value="Dominica">Dominica</option>
                      <option value="Dominican Republic">
                        Dominican Republic
                      </option>
                      <option value="East Timor">East Timor</option>
                      <option value="Ecuador">Ecuador</option>
                      <option value="Egypt">Egypt</option>
                      <option value="El Salvador">El Salvador</option>
                      <option value="Equatorial Guinea">
                        Equatorial Guinea
                      </option>
                      <option value="Eritrea">Eritrea</option>
                      <option value="Estonia">Estonia</option>
                      <option value="Ethiopia">Ethiopia</option>
                      <option value="Falkland Islands">Falkland Islands</option>
                      <option value="Faroe Islands">Faroe Islands</option>
                      <option value="Fiji">Fiji</option>
                      <option value="Finland">Finland</option>
                      <option value="France">France</option>
                      <option value="French Guiana">French Guiana</option>
                      <option value="French Polynesia">French Polynesia</option>
                      <option value="French Southern Ter">
                        French Southern Ter
                      </option>
                      <option value="Gabon">Gabon</option>
                      <option value="Gambia">Gambia</option>
                      <option value="Georgia">Georgia</option>
                      <option value="Germany">Germany</option>
                      <option value="Ghana">Ghana</option>
                      <option value="Gibraltar">Gibraltar</option>
                      <option value="Great Britain">Great Britain</option>
                      <option value="Greece">Greece</option>
                      <option value="Greenland">Greenland</option>
                      <option value="Grenada">Grenada</option>
                      <option value="Guadeloupe">Guadeloupe</option>
                      <option value="Guam">Guam</option>
                      <option value="Guatemala">Guatemala</option>
                      <option value="Guinea">Guinea</option>
                      <option value="Guyana">Guyana</option>
                      <option value="Haiti">Haiti</option>
                      <option value="Hawaii">Hawaii</option>
                      <option value="Honduras">Honduras</option>
                      <option value="Hong Kong">Hong Kong</option>
                      <option value="Hungary">Hungary</option>
                      <option value="Iceland">Iceland</option>
                      <option value="India">India</option>
                      <option value="Indonesia">Indonesia</option>
                      <option value="Iran">Iran</option>
                      <option value="Iraq">Iraq</option>
                      <option value="Ireland">Ireland</option>
                      <option value="Isle of Man">Isle of Man</option>
                      <option value="Israel">Israel</option>
                      <option value="Italy">Italy</option>
                      <option value="Jamaica">Jamaica</option>
                      <option value="Japan">Japan</option>
                      <option value="Jordan">Jordan</option>
                      <option value="Kazakhstan">Kazakhstan</option>
                      <option value="Kenya">Kenya</option>
                      <option value="Kiribati">Kiribati</option>
                      <option value="Korea North">Korea North</option>
                      <option value="Korea Sout">Korea South</option>
                      <option value="Kuwait">Kuwait</option>
                      <option value="Kyrgyzstan">Kyrgyzstan</option>
                      <option value="Laos">Laos</option>
                      <option value="Latvia">Latvia</option>
                      <option value="Lebanon">Lebanon</option>
                      <option value="Lesotho">Lesotho</option>
                      <option value="Liberia">Liberia</option>
                      <option value="Libya">Libya</option>
                      <option value="Liechtenstein">Liechtenstein</option>
                      <option value="Lithuania">Lithuania</option>
                      <option value="Luxembourg">Luxembourg</option>
                      <option value="Macau">Macau</option>
                      <option value="Macedonia">Macedonia</option>
                      <option value="Madagascar">Madagascar</option>
                      <option value="Malaysia">Malaysia</option>
                      <option value="Malawi">Malawi</option>
                      <option value="Maldives">Maldives</option>
                      <option value="Mali">Mali</option>
                      <option value="Malta">Malta</option>
                      <option value="Marshall Islands">Marshall Islands</option>
                      <option value="Martinique">Martinique</option>
                      <option value="Mauritania">Mauritania</option>
                      <option value="Mauritius">Mauritius</option>
                      <option value="Mayotte">Mayotte</option>
                      <option value="Mexico">Mexico</option>
                      <option value="Midway Islands">Midway Islands</option>
                      <option value="Moldova">Moldova</option>
                      <option value="Monaco">Monaco</option>
                      <option value="Mongolia">Mongolia</option>
                      <option value="Montserrat">Montserrat</option>
                      <option value="Morocco">Morocco</option>
                      <option value="Mozambique">Mozambique</option>
                      <option value="Myanmar">Myanmar</option>
                      <option value="Nambia">Nambia</option>
                      <option value="Nauru">Nauru</option>
                      <option value="Nepal">Nepal</option>
                      <option value="Netherland Antilles">
                        Netherland Antilles
                      </option>
                      <option value="Netherlands">
                        Netherlands (Holland, Europe)
                      </option>
                      <option value="Nevis">Nevis</option>
                      <option value="New Caledonia">New Caledonia</option>
                      <option value="New Zealand">New Zealand</option>
                      <option value="Nicaragua">Nicaragua</option>
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option>
                      <option value="Norfolk Island">Norfolk Island</option>
                      <option value="Norway">Norway</option>
                      <option value="Oman">Oman</option>
                      <option value="Pakistan">Pakistan</option>
                      <option value="Palau Island">Palau Island</option>
                      <option value="Palestine">Palestine</option>
                      <option value="Panama">Panama</option>
                      <option value="Papua New Guinea">Papua New Guinea</option>
                      <option value="Paraguay">Paraguay</option>
                      <option value="Peru">Peru</option>
                      <option value="Phillipines">Philippines</option>
                      <option value="Pitcairn Island">Pitcairn Island</option>
                      <option value="Poland">Poland</option>
                      <option value="Portugal">Portugal</option>
                      <option value="Puerto Rico">Puerto Rico</option>
                      <option value="Qatar">Qatar</option>
                      <option value="Republic of Montenegro">
                        Republic of Montenegro
                      </option>
                      <option value="Republic of Serbia">
                        Republic of Serbia
                      </option>
                      <option value="Reunion">Reunion</option>
                      <option value="Romania">Romania</option>
                      <option value="Russia">Russia</option>
                      <option value="Rwanda">Rwanda</option>
                      <option value="St Barthelemy">St Barthelemy</option>
                      <option value="St Eustatius">St Eustatius</option>
                      <option value="St Helena">St Helena</option>
                      <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                      <option value="St Lucia">St Lucia</option>
                      <option value="St Maarten">St Maarten</option>
                      <option value="St Pierre &amp; Miquelon">
                        St Pierre &amp; Miquelon
                      </option>
                      <option value="St Vincent &amp; Grenadines">
                        St Vincent &amp; Grenadines
                      </option>
                      <option value="Saipan">Saipan</option>
                      <option value="Samoa">Samoa</option>
                      <option value="Samoa American">Samoa American</option>
                      <option value="San Marino">San Marino</option>
                      <option value="Sao Tome &amp; Principe">
                        Sao Tome &amp; Principe
                      </option>
                      <option value="Saudi Arabia">Saudi Arabia</option>
                      <option value="Senegal">Senegal</option>
                      <option value="Serbia">Serbia</option>
                      <option value="Seychelles">Seychelles</option>
                      <option value="Sierra Leone">Sierra Leone</option>
                      <option value="Singapore">Singapore</option>
                      <option value="Slovakia">Slovakia</option>
                      <option value="Slovenia">Slovenia</option>
                      <option value="Solomon Islands">Solomon Islands</option>
                      <option value="Somalia">Somalia</option>
                      <option value="South Africa">South Africa</option>
                      <option value="Spain">Spain</option>
                      <option value="Sri Lanka">Sri Lanka</option>
                      <option value="Sudan">Sudan</option>
                      <option value="Suriname">Suriname</option>
                      <option value="Swaziland">Swaziland</option>
                      <option value="Sweden">Sweden</option>
                      <option value="Switzerland">Switzerland</option>
                      <option value="Syria">Syria</option>
                      <option value="Tahiti">Tahiti</option>
                      <option value="Taiwan">Taiwan</option>
                      <option value="Tajikistan">Tajikistan</option>
                      <option value="Tanzania">Tanzania</option>
                      <option value="Thailand">Thailand</option>
                      <option value="Togo">Togo</option>
                      <option value="Tokelau">Tokelau</option>
                      <option value="Tonga">Tonga</option>
                      <option value="Trinidad &amp; Tobago">
                        Trinidad &amp; Tobago
                      </option>
                      <option value="Tunisia">Tunisia</option>
                      <option value="Turkey">Turkey</option>
                      <option value="Turkmenistan">Turkmenistan</option>
                      <option value="Turks &amp; Caicos Is">
                        Turks &amp; Caicos Is
                      </option>
                      <option value="Tuvalu">Tuvalu</option>
                      <option value="Uganda">Uganda</option>
                      <option value="Ukraine">Ukraine</option>
                      <option value="United Arab Erimates">
                        United Arab Emirates
                      </option>
                      <option value="United States of America">
                        United States of America
                      </option>
                      <option value="Uraguay">Uruguay</option>
                      <option value="Uzbekistan">Uzbekistan</option>
                      <option value="Vanuatu">Vanuatu</option>
                      <option value="Vatican City State">
                        Vatican City State
                      </option>
                      <option value="Venezuela">Venezuela</option>
                      <option value="Vietnam">Vietnam</option>
                      <option value="Virgin Islands (Brit)">
                        Virgin Islands (Brit)
                      </option>
                      <option value="Virgin Islands (USA)">
                        Virgin Islands (USA)
                      </option>
                      <option value="Wake Island">Wake Island</option>
                      <option value="Wallis &amp; Futana Is">
                        Wallis &amp; Futana Is
                      </option>
                      <option value="Yemen">Yemen</option>
                      <option value="Zaire">Zaire</option>
                      <option value="Zambia">Zambia</option>
                      <option value="Zimbabwe">Zimbabwe</option>
                    </select>
                  </div>
                </div> -->
                <div v-if="isSingleExist" class="custom-row">
                  <div class="col-sm-12">
                    <h3>Card details for one-off donations</h3>
                  </div>
                </div>
                <div v-if="isSingleExist" class="custom-row card-details-one-off">
                  <div class="col-sm-12">
                    <div ref="card"></div>
                  </div>
                </div>
                <div v-if="isMonthlyExist" class="card-details-direct-debit">
                      <div class="custom-row">
                          <div class="col-sm-12">
                              <h3 class="direct-debit-title">Direct debit details <span>(for recurring payments)</span></h3>
                          </div>
                      </div>
                      <div class="custom-row">
                          <div class="col-sm-12">
                              <input type="text" class="input-bx"  v-model="user.accountname" name="accountname" value="" placeholder="Account Name" required>
                              <div>{{ errors.accountname }}</div>
                          </div>
                      </div>
                      <div class="custom-row input-row">
                          <div class="col-sm-6">
                              <input type="number" class="input-bx"  v-model="user.sortcode" value="" placeholder="Sort Code" name="sortcode" oninput="if(value.length>6)value=value.slice(0,6)" maxlength="6" onkeydown="return event.keyCode !== 69">
                              <div>{{ errors.sortcode }}</div>
                          </div>
                          <div class="col-sm-6">
                                <input type="number" class="input-bx"  v-model="user.accountnumber" value="" placeholder="Account Number" name="accountnumber" oninput="if(value.length>8)value=value.slice(0,8)" maxlength="8" onkeydown="return event.keyCode !== 69">
                                <div>{{ errors.accountnumber }}</div>
                          </div>
                      </div>
                  </div>
                <div class="custom-row">
                  <div class="col-sm-12">
                    <div class="gift-aid-box-wrap">
                      <h3>
                        Increase the value of your donation to £{{
                          (
                            parseInt(totalPrice) +
                            (totalPrice * 25) / 100
                          ).toFixed(2)
                        }}
                      </h3>
                      <p>
                        By choosing to add Gift Aid, you confirm that you are a
                        UK taxpayer and that you would like Palestine Aid to
                        reclaim 25% of tax for every £1 of your donation made in
                        the last four years and any future donations at no extra
                        cost or effort for you.<a href="https://www.gov.uk/donating-to-charity/gift-aid" target="_blank"> What is Gift Aid?</a>
                        <span class="gift-aid-logo">
                            <img src="images/gift-aid-uk-logo.svg" alt="">
                        </span>
                      </p>
                      <div class="gift-aid-box">
                        <ul>
                          <li v-on:click="giftaidActive(1)" :class="{active : giftaid_active_element == 1}">
                            <div class="radio-wrap">
                              <label class="radio-btn">
                                <h4>
                                  Yes, add £{{
                                    ((totalPrice * 25) / 100).toFixed(2)
                                  }}
                                  of my Gift Aid
                                </h4>
                                <input
                                  type="radio"
                                  name="giftaid_radio"
                                  v-model="user.giftaid"
                                  value="true"
                                  class="custom-radio"
                                />
                                <div class="radio-default-state">
                                  <i class="fas fa-circle"></i>
                                </div>
                              </label>
                            </div>
                          </li>
                          <li v-on:click="giftaidActive(2)" :class="{active : giftaid_active_element == 2}">
                            <div class="radio-wrap">
                              <label class="radio-btn">
                                <h4>No, do not my Gift Aid</h4>
                                <input
                                  type="radio"
                                  name="giftaid_radio"
                                  v-model="user.giftaid"
                                  value="false"
                                  class="custom-radio"
                                  checked
                                />
                                <div class="radio-default-state">
                                  <i class="fas fa-circle"></i>
                                </div>
                              </label>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="custom-row">
                    <div class="col-sm-12">
                        <div class="checkout-additional-info-wrap">
                            <div class="checkout-additional-info-inner">
                                <h3>
                                    Additional informations (optional)
                                    <span class="material-icons more" v-on:click="expandContactMethod = !expandContactMethod" :aria-pressed="expandContactMethod ? 'true' : 'false'" :class="{ active: expandContactMethod }">expand_more</span>
                                </h3>
                                <div v-show="expandContactMethod">
                                    <div class="custom-row">
                                        <textarea class="text-area" v-model="user.additionalDonateNote" placeholder="Donation note (any donation requests or water pump names add here)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-additional-info-wrap checkout-contact-method-box-wrap">
                            <div class="checkout-additional-info-inner">
                                <div class="custom-row">
                                    <h4>Your donations are saving lives. Stay involved by keeping up to date with our appeals. </h4>
                                </div>
                                <div class="custom-row">
                                    <div class="checkout-contact-method-wrap">
                                      <ul>
                                          <li v-for="contactmethod in contactmethods" :key="contactmethod.id">
                                            <div class="custom-checkbox">
                                                  <input type="checkbox" :id="contactmethod.id" v-model="contactmethod.checked" >
                                                  <label :for="contactmethod.id">
                                                      {{contactmethod.name}}
                                                  </label>
                                              </div>
                                          </li>
                                          {{getAllCheckedIDs}}
                                      </ul>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-wrap-row">
                  <div class="col-sm-12">
                    <button
                      class="btn-wrap"
                      v-on:click="paymentSubmit"
                      :disabled="disableButton"
                    >
                      {{ loading ? "LOADING" : "Complete donation payment"
                      }}<span v-bind:class="{ loading: loading }"></span>
                    </button>
                    <p class="alert" v-if="isPaymentSuccess">
                      Payment is Success. Redirecting to the thank you page.
                    </p>
                    <p class="alert" v-if="duringPaymentProcess">
                      Payment is processing. Please do not close your browser
                    </p>
                    <p>{{ errors.payment }}</p>
                    <p>{{ errors.cartEmpty }}</p>
                  </div>
                </div>
              </div>
            </div>
            <!-- </form> -->
          </div>
        </div>
        <!--// End Campaign Checkout Left Section -->
        <!-- Begin Campaign Checkout Summary Section -->
        <div class="col-sm-5">
          <div class="sidebar-wrap">
            <div class="campaign-checkout-summary-wrap">
              <div class="title">
                <h2>Your donations ({{ $store.state.cartCount }})</h2>
              </div>
              <div class="campaign-checkout-summary-content">
                <ul>
                  <li v-for="item in $store.state.cart" :key="item.id">
                    <div class="campaign-checkout-summary-item">
                      <div class="title-col column">
                        <!-- <h2>{{ item.title}}x{{ item.quantity }}</h2> -->
                        <h2>{{ item.title }}</h2>
                        <h3>{{ item.paymenttype }} | {{ item.appeal }}</h3>
                      </div>
                      <div class="amount-col column">
                        <h2>
                          £{{
                            parseFloat(
                              item.amount
                                .toString()
                                .replace(/[^0-9.]/g, "")
                                .replace(/(\..*)\./g, "$1")
                                .replace(/(?!^)-/g, "")
                                .replace(/^0+(\d)/gm, "$1")
                            ).toFixed(2)
                          }}
                        </h2>
                        <span
                          class="remove-item"
                          @click.prevent="removeFromCart(item)"
                          >Remove</span
                        >
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <div v-if="totalAdminCost(totalSinglePrice) > 0" class="campaign-checkout-total-amount-wrap">
                <div class="campaign-checkout-total-amount">
                  <div class="total-txt column">
                    <h3>Admin cost(one-off)</h3>
                  </div>
                  <div class="total-amount column">
                    <h3>£{{totalAdminCost(totalSinglePrice)}}</h3>
                  </div>
                </div>
              </div>
              <div class="campaign-checkout-total-amount-wrap">
                <div class="campaign-checkout-total-amount">
                  <div class="total-txt column">
                    <h3>Total donation</h3>
                  </div>
                  <div class="total-amount column">
                    <h3>£{{ totalPrice }}</h3>
                  </div>
                </div>
              </div>
            </div>
            <div class="other-ways-donate-content">
                <div class="sidebar-title">
                    <h3>Other ways to donate</h3>
                </div>
                <div class="bank-transfer-wrap">
                    <h4>Bank transfer</h4>
                    <ul>
                        <li><span class="ac-number-title column-1">Account number:</span><span class="ac-number column-2">00695602</span></li>
                        <li><span class="sort-code-title column-1">Sort code:</span> <span class="ac-code column-2">20-08-64</span></li>
                    </ul>
                    <h4 class="mt-4">International bank transfer</h4>
                    <ul>
                        <li><span class="ac-number-title column-1">Swift/BIC code:</span><span class="ac-number column-2">BUKBGB22</span></li>
                        <li><span class="sort-code-title column-1">IBAN:</span> <span class="ac-code column-2">GB42 BUKB 2008 6400 6956 02</span></li>
                    </ul>
                </div>
            </div>
          </div>
        </div>
        <!--// End Campaign Checkout Summary Section -->
      </div>
    </div>
  </section>
  <!--// End Campaign Checkout Section -->
</template>

<script>
export default {
  data() {
    return {
      user: {
        customertitle: "Mr",
        name: "",
        lastname: "",
        email: "",
        contact: "",
        address: "",
        city: "",
        postcode: "",
        country: "",
        giftaid: "false",
        signup: "",
        password: "",
        confirm_password: "",
        allcontactmethods: [],
        additionalDonateNote: '',
        accountname: "",
        accountnumber: "",
        sortcode: "",
        phone: "",
        countryCode: "",
      },
      errors: [],
      isPaymentSuccess: false,
      duringPaymentProcess: false,
      disableButton: false,
      loading: false,
      amount_single: 0,
      amount_monthly: 0,
      amount_weekly: 0,
      stripePublickey: "",
      stripe: "",
      elements: "",
      card: "",
      isemailexist: 0,
      adminPercentage:0,
      admincost: this.$store.state.adminCost,
      isUserLoggedIn: false,
      contactmethods: [
          { id: 'telephone', name: 'Contact by phone', checked: false },
          { id: 'email', name: 'Email', checked: false },
          { id: 'sms', name: 'WhatsApp/SMS', checked: false },
          { id: 'post', name: 'Post', checked: false }
      ],
      expandContactMethod: true,
      giftaid_active_element: 2,
      loginuserdetails: "",
      base_url: '/grt',
      reference: Math.random().toString(36).slice(2),
      currency: 'GBP'
    };
  },
  mounted() {
    this.mountStripeElements();
    this.getAdminPercentage();
    this.getloginuserdetails();
    this.getloginstate();
    this.searchPostCode();
  },
  computed: {
    isMonthlyExist() {
      let amount_monthly_weekly = 0
      for(let item of this.$store.state.cart) {
        if (item.paymenttype == "Monthly" || item.paymenttype == "Weekly")
        amount_monthly_weekly += item.totalPrice;
      }
      if(amount_monthly_weekly > 0)
        return true;
      else
        return false;
    },
    isSingleExist() {
      let amount_single = 0;
      for(let item of this.$store.state.cart) {
        if (item.paymenttype == "One-off")
        amount_single += item.totalPrice;
      }
      if(amount_single > 0)
        return true;
      else
        return false;
    },
    totalPrice() {
      let total = 0;
      for (let item of this.$store.state.cart) {
        // total += parseInt(item.totalPrice);
        let price = 0;
        price = item.totalPrice;
        total += Number(
          price
            .toString()
            .replace(/[^0-9.]/g, "")
            .replace(/(\..*)\./g, "$1")
            .replace(/(?!^)-/g, "")
            .replace(/^0+(\d)/gm, "$1")
        );
        if (item.paymenttype == "Monthly") {
          this.amount_monthly += item.totalPrice;
        } else if (item.paymenttype == "Weekly") {
          this.amount_weekly += item.totalPrice;
        } else {
          this.amount_single += item.totalPrice;
        }
      }
      if(this.admincost)
       return (parseFloat(total)+parseFloat(this.adminPercentage*this.totalSinglePrice/100)).toFixed(2);
      else
      //  return totalPrice;
      return total.toFixed(2);
    },
    totalSinglePrice() {
      let total = 0;

      for (let item of this.$store.state.cart) {
        if (item.paymenttype == "One-off") {
        // total += parseInt(item.totalPrice);
        let price = 0;
        price = item.totalPrice;
        total += Number(
          price
            .toString()
            .replace(/[^0-9.]/g, "")
            .replace(/(\..*)\./g, "$1")
            .replace(/(?!^)-/g, "")
            .replace(/^0+(\d)/gm, "$1")
        );
        }
      }

      // return parseInt(total).toFixed(2);
      return total.toFixed(2);
    },
    getAllCheckedIDs: function () {
        this.user.additionalSelected = this.contactmethods.filter(contactmethod => contactmethod).map(contactmethod => contactmethod.id+ ":" + contactmethod.checked)
    },
  },
  methods: {
    giftaidActive:function(el) {
        this.giftaid_active_element = el;
    },
    searchPostCode() {
      console.log(1);
      IdealPostcodes.PostcodeLookup.setup({
        apiKey: 'ak_ld02zk29vVc6YWCvQGWU3sEQHMtt8', //ak_l8sp5kelbfEbfNRzVpNqjid2HZPvt
        context: "#postcodeSearch",
        outputFields: {
          line_1: '#addressLine1',
          line_2: '#addressLine2',
          post_town: '#postCity',
          postcode: '#postCode'
        }
        });
    },
    getloginstate() {
      let self = this;
      axios.get(self.base_url + "/loginstate").then((response) => {
        self.isUserLoggedIn = response.data;
      });
    },
    getloginuserdetails() {
      let self = this;
      axios.get(self.base_url + "/loginuserdetails").then((response) => {
        self.user.email = response.data;
      });
    },
    totalPricewithAdminCost(totalPrice, totalSinglePrice) {
       if(this.admincost)
       return (parseFloat(totalPrice)+parseFloat(this.adminPercentage*totalSinglePrice/100)).toFixed(2);
       else
       return totalPrice;
    },
    totalAdminCost(totalSinglePrice) {
       if(this.admincost)
       return parseFloat(this.adminPercentage*totalSinglePrice/100).toFixed(2);
       else
       return 0;
    },
    getAdminPercentage() {
      return this.axios.get(this.base_url + "/api/admincost").then((response) => {
        this.adminPercentage = response.data;
      });
    },
    checkUniqueEmail() {
      this.axios.get(this.base_url + `/checkuniquemail/${this.user.email}`).then((response) => {
        this.isemailexist = response.data;
      });
    },
    removeFromCart(item) {
      this.$store.commit("removeFromCart", item);
    },
    stripepublickey: function () {
      let self = this;
      return this.axios.get(self.base_url + "/api/stripepublickey").then((response) => {
        this.stripepublickey = response.data;
        return this.stripepublickey;
      });
    },
    mountStripeElements: function () {
      let self = this;
      this.stripepublickey().then((data) => {
        (self.stripe = Stripe(data)),
          (self.elements = self.stripe.elements()),
          (self.card = undefined);
        self.card = self.elements.create("card", { hidePostalCode: true });
        self.card.mount(self.$refs.card);
      });
    },
    telValidate(telnumber,object) {
        this.user.phone = object.number;
        this.user.countryCode = object.countryCode;
    },
    paymentSubmit() {
      // if cart is not empty
      if (this.$store.state.cartCount > 0) {
        // form validation
        this.validateForm();

        // if form is validated
        if (!this.errors.length) {
          this.loading = true;
          let self = this;
          if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
            self.makeSingleWeeklyMonthlyPayment();
          if (self.amount_single > 0 && self.amount_monthly > 0 && self.amount_weekly == 0)
            self.makeSingleMonthlyPayment();
          if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
            self.makeSingleWeeklyPayment();
          if (self.amount_single == 0 && self.amount_monthly > 0 && self.amount_weekly > 0)
            self.smartdebitWeeklyMonthlyPayment();
          if (self.amount_monthly > 0 && self.amount_single == 0 && self.amount_weekly == 0)
            // self.stripeMonthlyPayment();
            self.smartdebitMonthlyPayment();
          if (self.amount_single > 0 && self.amount_monthly == 0 && self.amount_weekly == 0)
            self.stripeSinglePayment();
          if (self.amount_single == 0 && self.amount_monthly == 0 && self.amount_weekly > 0)
            self.smartdebitWeeklyPayment();
        }
      } else {
        this.errors.push("Cart is empty");
        this.errors.cartEmpty = "Cart is empty";
      }
    },
    makeSingleWeeklyMonthlyPayment() {
        this.disableButton = true;
        let self = this;
        self.stripe.createToken(self.card).then(function (result) {
          // console.log(self.user);
          // console.log(result.token.id);
          if (result.error) {
            self.loading = false;
            self.disableButton = false;
            self.errors.payment = result.error.message;
            self.errors.push(result.error);
          } else {
            self.disableButton = true;
            const token = {
              id: result.token.id,
              user: self.user,
              cartContent: self.$store.state.cart,
              cartTotal: self.totalPrice,
              reference: self.reference,
              currency: self.currency,
            };
            self.axios
              .post(self.base_url + `/api/singlePaymentProcess`, token)
              .then((response) => {
                const charge = response.data;
                if (charge.error) {
                  self.isPaymentSuccess = false;
                  self.duringPaymentProcess = false;
                  self.loading = false;
                  self.errors.payment = charge.error.message;
                  self.errors.push(charge.error.message);
                }
                self.duringPaymentProcess = true;
                if (charge.status && charge.status == "succeeded") {
                  self.smartdebitWeeklyPayment();
                  self.smartdebitMonthlyPayment();
                }
              })
              .catch((error) => {
                console.log(error);
              });
          }
          // Access the token with result.token
          console.log(result);
        });
    },
    makeSingleMonthlyPayment() {
      this.disableButton = true;
      let self = this;
      self.stripe.createToken(self.card).then(function (result) {
        // console.log(self.user);
        // console.log(result.token.id);
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = {
            id: result.token.id,
            user: self.user,
            cartContent: self.$store.state.cart,
            cartTotal: self.totalPrice,
            reference: self.reference,
            currency: self.currency,
          };
          self.axios
            .post(self.base_url + `/api/singlePaymentProcess`, token)
            .then((response) => {
              const charge = response.data;
              if (charge.error) {
                self.isPaymentSuccess = false;
                self.duringPaymentProcess = false;
                self.loading = false;
                self.errors.payment = charge.error.message;
                self.errors.push(charge.error.message);
              }
              self.duringPaymentProcess = true;
              if (charge.status && charge.status == "succeeded") {
                self.smartdebitMonthlyPayment();
              }
            })
            .catch((error) => {
              console.log(error);
            });
        }
        // Access the token with result.token
        console.log(result);
      });
    },
    makeSingleWeeklyPayment() {
      this.disableButton = true;
      let self = this;
      self.stripe.createToken(self.card).then(function (result) {
        // console.log(self.user);
        // console.log(result.token.id);
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = {
            id: result.token.id,
            user: self.user,
            cartContent: self.$store.state.cart,
            cartTotal: self.totalPrice,
            reference: self.reference,
            currency: self.currency,
          };
          self.axios
            .post(self.base_url + `/api/singlePaymentProcess`, token)
            .then((response) => {
              const charge = response.data;
              if (charge.error) {
                self.isPaymentSuccess = false;
                self.duringPaymentProcess = false;
                self.loading = false;
                self.errors.payment = charge.error.message;
                self.errors.push(charge.error.message);
              }
              self.duringPaymentProcess = true;
              if (charge.status && charge.status == "succeeded") {
                self.smartdebitWeeklyPayment();
              }
            })
            .catch((error) => {
              console.log(error);
            });
        }
        // Access the token with result.token
        console.log(result);
      });
    },
    smartdebitWeeklyMonthlyPayment() {
      let self = this;

      // self.disableButton = true;
      const token = {
        user: self.user,
        cartContent: self.$store.state.cart,
        cartTotal: self.totalPrice,
        reference: self.reference,
        currency: self.currency,
      };
      self.axios
        .post(self.base_url + `/api/weeklyPaymentProcess`, token)
        .then((response) => {
          const charge = response.data;
          if (charge.error) {
            self.isPaymentSuccess = false;
            self.duringPaymentProcess = false;
            self.loading = false;
            self.errors.payment = charge.error.message;
            self.errors.push(charge.error.message);
          }
          if (charge.status && charge.status == "active") {
            self.smartdebitMonthlyPayment();
          }
        })
        .catch((error) => {
          (self.duringPaymentProcess = false),
            (self.errors.payment = error);
          self.errors.push(error);
        });

    },
    stripeSinglePayment() {
      this.disableButton = true;
      let self = this;
      console.log(self.totalPrice);
      self.stripe.createToken(self.card).then(function (result) {
        if (result.error) {
          self.loading = false;
          self.disableButton = false;
          self.errors.payment = result.error.message;
          self.errors.push(result.error);
        } else {
          self.disableButton = true;
          const token = {
            id: result.token.id,
            user: self.user,
            cartContent: self.$store.state.cart,
            cartTotal: self.totalPrice,
            reference: self.reference,
            currency: self.currency,
          };
          self.axios
            .post(self.base_url + `/api/singlePaymentProcess`, token)
            .then((response) => {
              const charge = response.data;
              if (charge.error) {
                self.isPaymentSuccess = false;
                self.duringPaymentProcess = false;
                self.loading = false;
                self.errors.payment = charge.error.message;
                self.errors.push(charge.error.message);
              }
              self.duringPaymentProcess = true;
              if (charge.status && charge.status == "succeeded") {
                self.isPaymentSuccess = true;
                self.duringPaymentProcess = false;
                self.loading = false;
                localStorage.clear();
                self.$router.push({ name: "thankyou" });
                // window.location.href = '/thankyou';
              }
            })
            .catch((error) => {
              (self.duringPaymentProcess = false),
                (self.errors.payment = error);
              self.errors.push(error);
              console.log(error);
            });
        }
        // Access the token with result.token
        console.log(result);
      });
    },
    smartdebitMonthlyPayment() {
      let self = this;

      // self.disableButton = true;
      const token = {
        user: self.user,
        cartContent: self.$store.state.cart,
        cartTotal: self.totalPrice,
        reference: self.reference,
        currency: self.currency,
      };
      self.axios
        .post(self.base_url + `/api/monthlyPaymentProcess`, token)
        .then((response) => {
          const charge = response.data;
          if (charge.error) {
            self.isPaymentSuccess = false;
            self.duringPaymentProcess = false;
            self.loading = false;
            self.errors.payment = charge.error.message;
            self.errors.push(charge.error.message);
          }
          if (charge.status && charge.status == "active") {
            self.isPaymentSuccess = true;
            self.duringPaymentProcess = false;
            self.loading = false;
            localStorage.clear();
            self.$router.push({ name: "thankyou" });
            // window.location.href = "/thankyou";
          }
        })
        .catch((error) => {
          (self.duringPaymentProcess = false),
            (self.errors.payment = error);
          self.errors.push(error);
        });

    },
    smartdebitWeeklyPayment() {
      let self = this;

      // self.disableButton = true;
      const token = {
        user: self.user,
        cartContent: self.$store.state.cart,
        cartTotal: self.totalPrice,
        reference: self.reference,
        currency: self.currency,
      };
      self.axios
        .post(self.base_url + `/api/weeklyPaymentProcess`, token)
        .then((response) => {
          const charge = response.data;
          if (charge.error) {
            self.isPaymentSuccess = false;
            self.duringPaymentProcess = false;
            self.loading = false;
            self.errors.payment = charge.error.message;
            self.errors.push(charge.error.message);
          }
          if (charge.status && charge.status == "active") {
            self.isPaymentSuccess = true;
            self.duringPaymentProcess = false;
            self.loading = false;
            localStorage.clear();
            self.$router.push({ name: "thankyou" });
            // window.location.href = "/thankyou";
          }
        })
        .catch((error) => {
          (self.duringPaymentProcess = false),
            (self.errors.payment = error);
          self.errors.push(error);
        });

    },
    stripeMonthlyPayment() {
      this.disableButton = true;
      let self = this;
      self.stripe
        .createPaymentMethod({
          type: "card",
          card: self.card,
          billing_details: {
            email: self.user.email,
          },
        })
        .then(function (result) {
          if (result.error) {
            self.loading = false;
            self.disableButton = false;
            self.errors.payment = result.error.message;
            self.errors.push(result.error);
          } else {
            self.disableButton = true;
            const token = {
              pm: result.paymentMethod["id"],
              user: self.user,
              cartContent: self.$store.state.cart,
              cartTotal: self.totalPrice,
              reference: self.reference,
              currency: self.currency,
            };
            self.axios
              .post(self.base_url + `/api/monthlyPaymentProcess`, token)
              .then((response) => {
                const charge = response.data;
                if (charge.error) {
                  self.isPaymentSuccess = false;
                  self.duringPaymentProcess = false;
                  self.loading = false;
                  self.errors.payment = charge.error.message;
                  self.errors.push(charge.error.message);
                }
                if (charge.status && charge.status == "active") {
                  self.isPaymentSuccess = true;
                  self.duringPaymentProcess = false;
                  self.loading = false;
                  localStorage.clear();
                  self.$router.push({ name: "thankyou" });
                  // window.location.href = "/thankyou";
                }
              })
              .catch((error) => {
                (self.duringPaymentProcess = false),
                  (self.errors.payment = error);
                self.errors.push(error);
              });
          }
        });
    },
    passwordConfirmationRule() {
      if (this.user.confirm_password.length > 0) {
        if (this.user.password != this.user.confirm_password) {
          this.errors.password_confirmation =
            "Password and Confirm password must be match";
          this.errors.push("Password and Confirm password must be match");
        }
      }
    },
    validateForm() {
      this.errors = [];

      if (!this.user.name) {
        this.errors.push("The name field is required.");
        this.errors.name = "The name field is required.";
      }
      if (!this.user.lastname) {
        this.errors.push("The last name field is required.");
        this.errors.lastname = "The last name field is required.";
      }
      if (!this.user.contact) {
        this.errors.contact = "The contact field is required.";
        this.errors.push("The contact field is required.");
      }
      if (this.user.signup) {
        if (!this.user.password) {
          this.errors.password = "The password field is required.";
          this.errors.push("The password field is required.");
        } else if (!this.validPassword(this.user.password)) {
          this.errors.password =
            "Password must be 5 characters long";
          this.errors.push(
            "Password must be 5 characters long"
          );
        }
        if (!this.user.confirm_password) {
          this.errors.confirm_password =
            "The confirm password field is required.";
          this.errors.push("The confirm password field is required.");
        }

        // Whether email exists or not
        if (this.isemailexist == 1) {
          this.errors.push("The email has already been taken.");
          this.errors.email = "The email has already been taken.";
        }

        this.passwordConfirmationRule();
      }
      if (!this.user.email) {
        this.errors.push("The email field is required.");
        this.errors.email = "The email field is required.";
      } else if (!this.validEmail(this.user.email)) {
        this.errors.push("Valid email is required.");
        this.errors.email = "Valid email is required.";
      }

      if(this.isMonthlyExist) {
        if (!this.user.accountname) {
          this.errors.accountname = "The account name field is required.";
          this.errors.push("The account name field is required.");
        }
        if (!this.user.sortcode) {
          this.errors.sortcode = "The sort code field is required.";
          this.errors.push("The sort code field is required.");
        }
        if (!this.user.accountnumber) {
          this.errors.accountnumber = "The account number field is required.";
          this.errors.push("The account number field is required.");
        }
      }

      if (!this.errors.length) {
        return true;
      } else {
        window.scrollTo({ top: 200, behavior: "smooth" });
      }
    },
    validEmail: function (email) {
      var re =
        /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    validPassword: function (password) {
      var re = /^(?=.*[A-Za-z0-9]).{5,}$/;
      // var re = /^(?=.*[A-Za-z])(?=.*?[0-9])(?=.*?[!@#\$&*~]).{8,}$/;
      return re.test(password);
    },
  },
};
</script>
