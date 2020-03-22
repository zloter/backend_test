/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';


import Vue from 'vue'
import axios from "axios";

// Change default delimiters 'cause of twig
Vue.options.delimiters = ['[[', ']]'];

new Vue({
    el: '#app',
    data: {
        input: [null],
        output: [],
        errors: '',
        active: true
    },
    methods: {
        addInput: function () {
            if (this.input.length < 10) {
                this.input.push(null);
            }
        },
        removeInput: function (item) {
            this.input.splice(item, 1);
            this.output[item] && this.output.splice(item, 1);
            this.errors = [];
        },
        calculate: function () {
            this.output = [];
            this.active = false;
            this.errors = [];
            let data = new FormData();
            this.input.forEach((item) => {
                data.append('input[]', item)
            });
            axios.post('/', data).then(response => {
                this.output = response.data.results;
            }).catch((error) => {
                let response = error.response
                if (typeof response === "object" && typeof response.data === "object") {
                    this.errors = response.data.errors;
                }
            }).then(() => {
                this.active = true;
            });
        }
    }
});


