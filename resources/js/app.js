import { createApp } from 'vue/dist/vue.esm-bundler';
// Vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import axios from "axios";
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import "@mdi/font/css/materialdesignicons.css";

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import moment from 'moment'
import VuetifyMask from "vuetify-mask";
import {LoadingPlugin} from 'vue-loading-overlay';
import 'vue-loading-overlay/dist/css/index.css';
import DashboardComponent from "./Components/secure/Dashboard/DashboardComponent.vue";
import DrainageComponent from "./Components/secure/Drainage/DrainageComponent.vue";
import DrainageReport from "./Components/secure/Drainage/DrainageReport.vue";
import MaintenanceReportComponent from "./Components/secure/Maintenance/MaintenanceReportComponent.vue";

const {component, config, use} = createApp({
    mounted() {
        console.log('test');
    }
})

config.globalProperties.$http = axios;


config.globalProperties.$filters = {
    capitalize(value) {
        if (!value) return ''
        value = value.toString();
        return value.toUpperCase()
    },

    formatDate(value) {
        if (value) {
            return moment(String(value)).format('MM/DD/YYYY hh:mm a')
        }
    },

    formatDateTime(value) {
        if (!value) return ''
        return new Intl.DateTimeFormat('en-US', { year: 'numeric', month: 'long', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' }).format(value)
    },

    formatDash(value) {
        if (!value) return ''
        value = value.toString();
        value = value.replace(/_/g, ' ')
        return value.toUpperCase();
    }
}

const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
            mdi,
        },
    },
    theme: {
        defaultTheme: 'light'
    }

})

component('dashboard', DashboardComponent);
component('drainage', DrainageComponent);
component('drainage-report', DrainageReport);
component('maintenance', MaintenanceReportComponent);


use(VuetifyMask);
use(VueSweetalert2)
use(vuetify)
use(LoadingPlugin)
    .mount('#app')
