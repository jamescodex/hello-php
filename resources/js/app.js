/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component(
    "admin-departments-component",
    require("./components/admin/DepartmentsComponent.vue").default
);

Vue.component(
    "create-department-component",
    require("./components/admin/CreateDepartmentComponent.vue").default
);

Vue.component(
    "admin-staffs-component",
    require("./components/admin/StaffsComponent.vue").default
);

Vue.component(
    "create-staff-component",
    require("./components/admin/CreateStaffComponent.vue").default
);

Vue.component(
    "example-component",
    require("./components/ExampleComponent.vue").default
);

Vue.component(
    "profile-component",
    require("./components/staff/ProfileComponent.vue").default
);

Vue.component(
    "departments-component",
    require("./components/staff/DepartmentComponent.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app"
});
