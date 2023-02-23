import store from './store.js';
import Home from './components/Home.vue';
import AllPosts from './components/Posts.vue';
import SinglePost from './components/SinglePost.vue';
import AllCampaigns from './components/Campaigns.vue';
import SingleCampaign from './components/SingleCampaign.vue';
import YourDetails from './components/YourDetails.vue';
import PaymentDetails from './components/PaymentDetails.vue';
import PaymentDetails1 from './components/PaymentDetails1.vue';
import PaymentComplete from './components/PaymentComplete.vue';
import Checkout from './components/Checkout.vue';
import Events from './components/Events.vue';
import SingleEvent from './components/SingleEvent.vue';
import EventBooking from './components/Eventbooking.vue';
import EventBookingPayment from './components/EventbookingPayment.vue';
import EventBookingThankyou from './components/EventbookingThankyou.vue';
import Thankyou from './components/Thankyou.vue';
import About from './components/About.vue';
import Getinvolved from './components/Getinvolved.vue';
import Contact from './components/Contact.vue';
import Signin from './components/Signin.vue';
import UserDashboard from './components/UserDashboard.vue';
import UserDashboardSingle from './components/UserDashboardSingle.vue';
import Createindividualcampaign from './components/CreateIndividualCampaign.vue';
import Createteamcampaign from './components/CreateTeamCampaign.vue';
import Cfhome from './components/Cfhome.vue';
import CfsingleCampaign from './components/CfsingleCampaign.vue';
import CfjoinTeam from './components/CfjoinTeam.vue';
import Cfcheckout from './components/Cfcheckout.vue';
import Cfyourdetails from './components/Cfyourdetails.vue';
import Cfpaymentdetails from './components/Cfpaymentdetails.vue';
import Cfdashboard from './components/Cfdashboard.vue';
import CfeditIndividualCampaign from './components/CfeditIndividualCampaign.vue';
import CfeditTeamCampaign from './components/CfeditTeamCampaign.vue';
import CfauthorProfile from './components/CfauthorProfile.vue';
import Cfthankyou from './components/Cfthankyou.vue';
import Zakat from './components/Zakat.vue';
import ZakatCalculator from "./components/ZakatCalculator.vue";
import Qurbani from "./components/Qurbani.vue";
import QurbaniPacks from "./components/QurbaniPacks.vue";
import QurbaniPacksDetails from "./components/SingleQurbaniPackage.vue";
import Blogs from "./components/Blogs.vue";
import SingleBlog from "./components/SingleBlog.vue";


function isAuthenticated() {
    console.log(localStorage.getItem('usertoken'));
    return localStorage.getItem('usertoken');
}

export const routes = [
    {
        name: "home",
        path: "/",
        component: Home,
    },
    {
        name: "AllPosts",
        path: "/posts",
        component: AllPosts,
    },
    {
        name: "edit",
        path: "/news/:id",
        component: SinglePost,
        props: true,
    },
    {
        name: "campaigns",
        path: "/campaigns/:id?", // ? is used for optional params
        component: AllCampaigns,
    },
    {
        name: "campaign",
        path: "/campaign/:id",
        component: SingleCampaign,
    },
    {
        name: "checkout",
        path: "/checkout",
        component: YourDetails,
    },
    {
        name: "your-details",
        path: "/your-details",
        component: YourDetails,
    },
    {
        name: "payment-details",
        path: "/payment-details",
        component: PaymentDetails,
    },
    {
        name: "payment-details1",
        path: "/payment-details1",
        component: PaymentDetails1,
    },
    {
        name: "payment-complete",
        path: "/payment-complete",
        component: PaymentComplete,
    },
    {
        name: "thankyou",
        path: "/thankyou",
        component: PaymentComplete,
    },
    {
        name: "about",
        path: "/about",
        component: About,
    },
    {
        name: "getinvolved",
        path: "/getinvolved",
        component: Getinvolved,
    },
    {
        name: "contact",
        path: "/contact",
        component: Contact,
    },
    {
        name: "events",
        path: "/events",
        component: Events,
    },
    {
        name: "event",
        path: "/event/:id",
        component: SingleEvent,
    },
    {
        name: "eventbooking",
        path: "/eventbooking/:id",
        component: EventBooking,
    },
    {
        name: "eventbookingpayment",
        path: "/eventbookingpayment/:id?",
        component: EventBookingPayment,
    },
    {
        name: "eventbookingthankyou",
        path: "/eventbookingthankyou/:id?",
        component: EventBookingThankyou,
    },
    {
        name: "signin",
        path: "/signin",
        component: Signin,
        beforeEnter(to, from, next) {
            // if (this.$store.state.adminCost) {
            if (isAuthenticated() == "false") {
                next();
            } else {
                next("/checkout");
            }
        },
    },
    {
        name: "userdashboard",
        path: "/userdashboard",
        component: UserDashboard,
        beforeEnter(to, from, next) {
            // if (this.$store.state.adminCost) {
            if (isAuthenticated() == "true") {
                next();
            } else {
                next("/signin");
            }
        },
    },
    {
        name: "donation-details",
        path: "/donation-details/:id",
        component: UserDashboardSingle,
    },
    {
        name: "create-individual-campaign",
        path: "/fundraising/create-individual-campaign",
        component: Createindividualcampaign,
    },
    {
        name: "create-team-campaign",
        path: "/fundraising/create-team-campaign",
        component: Createteamcampaign,
    },
    {
        name: "join-team",
        path: "/fundraising/join-team",
        component: CfjoinTeam,
    },
    {
        name: "cfdashboard",
        // path: '/fundraising/dashboard',
        path: "/dashboard",
        component: Cfdashboard,
    },
    {
        name: "cfauthorprofile",
        path: "/fundraising/author",
        component: CfauthorProfile,
    },
    {
        name: "CfeditIndividualCampaign",
        path: "/fundraising/edit-individual-campaign",
        component: CfeditIndividualCampaign,
    },
    {
        name: "CfeditTeamCampaign",
        path: "/fundraising/edit-team-campaign",
        component: CfeditTeamCampaign,
    },
    {
        name: "cfthankyou",
        path: "/fundraising/thankyou",
        component: Cfthankyou,
    },
    {
        name: "fundraising",
        path: "/fundraising",
        component: Cfhome,
    },
    {
        name: "fundraisingsingle",
        path: "/fundraising/:id",
        component: CfsingleCampaign,
    },
    {
        name: "cfcheckout",
        path: "/fundraising/checkout",
        component: Cfcheckout,
    },
    {
        name: "cfyourdetails",
        path: "/fundraising/your-details",
        component: Cfyourdetails,
    },
    {
        name: "cfpaymentdetails",
        path: "/fundraising/payment-details",
        component: Cfpaymentdetails,
    },
    {
        name: "Zakat",
        path: "/zakat",
        component: Zakat,
    },
    {
        name: "ZakatCalculator",
        path: "/zakat-calculator",
        component: ZakatCalculator,
    },
    {
        name: "Qurbani",
        path: "/qurbani",
        component: Qurbani,
    },
    {
        name: "QurbaniPacks",
        path: "/qurbani-packs",
        component: QurbaniPacks,
    },
    {
        name: "all-donation",
        path: "/all-donation/:id?", // ? is used for optional params
        component: QurbaniPacksDetails,
    },
    {
        name: "blogs",
        path: "/blogs", 
        component: Blogs,
    },
    {
        name: "blog",
        path: "/blog/:id",
        component: SingleBlog,
    },
    
    
];
