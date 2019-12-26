/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require("./bootstrap");
window.Vue = require("vue");
import VueEvents from "vue-events";
window.Vue.use(VueEvents);

require('bootstrap-tour');

import DataTable from "datatables.net-bs4";



/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);
Vue.component(
    "posts-component",
    require("./components/Posts/PostsComponent.vue").default
);
Vue.component(
    "posts-create",
    require("./components/UserPosts/PostsCreate.vue").default
);
Vue.component(
    "posts-list",
    require("./components/Posts/PostsList.vue").default
);

Vue.component(
    "posts-like-button",
    require("./components/Posts/PostLikeButton.vue").default
);
Vue.component(
    "posts-update",
    require("./components/UserPosts/PostsUpdate.vue").default
);
Vue.component(
    "posts-delete",
    require("./components/UserPosts/PostsDelete.vue").default
);

Vue.component(
    "posts-data-tables",
    require("./components/Posts/PostsTable/PostDataTables.vue").default
);

Vue.component(
    "user-posts",
    require("./components/UserPosts/UserPosts.vue").default
);

Vue.component(
    "chartjs-component",
    require("./components/samples/Chartjs.vue").default
);
Vue.component(
    "pusher-sample",
    require("./components/samples/Pusher.vue").default
);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
