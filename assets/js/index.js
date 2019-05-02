import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/js/src/index';

import Vue from 'vue';
import axios from 'axios';
import vueAxios from 'vue-axios';
import Dashboard from './vue/components/dashboard';

import './init';

Vue.use(BootstrapVue);
Vue.use(vueAxios, axios);

const root = document.getElementById('app');

if (root) {
  const app = new Vue({
    el: root,
    components: {
      Dashboard,
    },
  });
}