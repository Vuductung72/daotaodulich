/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('tree-view', require('./components/tree-view/tree-view').default);
// Vue.component('tree-item', require('./components/tree-view/tree-item').default);
// Vue.component('tree-checkbox', require('./components/tree-view/tree-checkbox').default);
// Vue.component('tree-radio', require('./components/tree-view/tree-radio').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Ready Event
const app = new Vue({
    el: "#app",

    // data:{
    //     valuePrice:0
    // },

    mounted: function () {
        this.addFlashMessages();
    },

    methods: {
        editPrice(){
            console.log(this.value);
        },

        notifyError() {
            for (let item of this.errors.items) {
                toastr['error'](item.msg, 'Thông báo hệ thống');
            }
        },
        onSubmit: function (e) {
            this.toggleButtonDisable(true);

            this.$validator.validateAll().then(result => {
                if (result) {
                    e.target.submit();
                } else {
                    this.notifyError();
                    this.toggleButtonDisable(false);
                }
            });
        },

        onSubmitScope: function (scope, event) {
            this.toggleButtonDisable(true);

            this.$validator.validateAll(scope).then(result => {
                if (result) {
                    event.target.submit();
                } else {
                    this.toggleButtonDisable(false);
                }
            });
        },

        toggleButtonDisable(value) {
            let buttons = document.getElementsByTagName("button");

            for (var i = 0; i < buttons.length; i++) {
                buttons[i].disabled = value;
            }
        },

        addFlashMessages: function () {
            flashMessages.forEach(function (flash) {
                toastr[flash.type](flash.message, 'Thông báo hệ thống');
            }, this);
        },
    }
});

// require('./global/app');

// require('./layouts/layout');
// require('./layouts/demo');
// require('./layouts/quick-sidebar');
// require('./layouts/quick-nav');


