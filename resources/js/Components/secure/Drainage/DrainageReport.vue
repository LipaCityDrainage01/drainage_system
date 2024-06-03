<script>
import axios from "axios";
import { parsePhoneNumber } from 'libphonenumber-js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    name: "AdminListComponent",

    data() {
        return {
            search: '',
            editDialog: false,
            removeDialog: false,
            form: {
                'contact_no': '+639'
            },

            rules: {

                requiredRules: [
                    value => {
                        if (value) return true

                        return 'This field is required.'
                    },
                ],

                emailRules: [
                    value => {
                        if (value) return true

                        return 'This field is required.'
                    },
                    value => {

                        if (value?.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) return true;

                        return 'Please enter a valid email address'
                    },
                ],

                contactNumberRules: [
                    value => {
                        if (value) return true

                        return 'This field is required.'
                    },

                    value => {
                        try {
                            const parsedNumber = parsePhoneNumber(value);
                            return parsedNumber.isValid();
                        } catch (error) {
                            return 'Phone number format is invalid'
                        }

                    },

                    value => {
                        if (value?.length === 13) return true

                        return 'Phone number format is invalid'
                    }

                ],

                passwordRule : [
                    value => {
                        if (value.length >= 8) return true

                        return 'Password must be 8 characters long'
                    }
                ]
            },
            roles: [],
            message: [],
            saveLoading: false,
            selected: [],
            table: [],
            headers: [
                {
                    title: 'Type',
                    align: 'start',
                    key: 'name',
                },
                { title: 'Remarks', key: 'remarks' },
                { title: 'Status', key: 'status' },
                { title: 'Date & Time', key: 'date_time' },
            ],
            id: '',
            location: '',
            isMaintenance: false,
        }
    },

    beforeMount() {
    },

    created() {

    },


    mounted() {
        let urlPath = window.location.pathname;
        let splitPath = urlPath.split('/');
        this.id = splitPath[splitPath.length - 1];
        this.initialize();
        this.getLocation();

    },

    methods: {

        async getLocation() {
            await axios.get('/api/barangay/' + this.id)
                .then(response => {
                    this.location = response.data;
                })
                .catch(error => console.log(error))
        },

        async initialize() {
            await axios.get('/api/getDrainageReport/' + this.id)
                .then(response => {
                    this.table = [...response.data];
                    let isClogged = this.table.some(item => item.status === 'Clogged');
                    if (isClogged) {
                        this.isMaintenance = true;
                    }
                })
                .catch(error => console.log(error))
        },

        openDialog(dialogType, item) {
            this.form = item;

            if(dialogType === 'edit') {
                this.editDialog = true;
            } else {
                this.removeDialog = true;
            }
        }
    }
}
</script>

<template>
    <v-row>
        <v-col
            cols="12">
            <v-alert
                text="Drainage 1 - Lipa is in maintenance status. Please have some time to perform maintenance procedure."
                title="Warning"
                type="warning"
                variant="elevated"
                v-if="isMaintenance"
            ></v-alert>
        </v-col>
    </v-row>
    <v-row>
        <v-col
            cols="12">
            <v-card>
                <v-card-title>
                    <div class="text-black text-h6">Location: {{ location?.name }}</div>
                </v-card-title>
                <v-card-item>
                    <div class="text-center">
                        <v-progress-circular :model-value="location?.detection?.sensor_data" :rotate="360" :size="250" :width="30" color="blue">
                            <template v-slot:default> {{ location?.detection?.sensor_data }} % </template>
                        </v-progress-circular>
                    </div>
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
    <div class="row mt-3">
        <div class="col-12">

            <v-card border>
                <v-card-title class="d-flex align-center pe-2">
                    <v-icon icon="mdi-database"></v-icon> &nbsp;
                    Maintenance History

                    <v-spacer></v-spacer>

                    <v-text-field
                        v-model="search"
                        prepend-inner-icon="mdi-magnify"
                        density="compact"
                        label="Search all Fields"
                        single-line
                        flat
                        hide-details
                        variant="solo-filled"
                    ></v-text-field>
                </v-card-title>
                <v-data-table
                    v-model:search="search"
                    v-model="selected"
                    :headers="headers"
                    :items="table"
                    item-value="order_ref_number"
                    class="elevation-1">
                    <template v-slot:item="{ item }">
                        <tr>
                            <td>{{ item.type }}</td>
                            <td>{{ item.remarks }}</td>
                            <td>{{ item.status }}</td>
                            <td>{{ $filters.formatDate(item.created_at)}}</td>
                        </tr>
                    </template>
                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

<style scoped>

</style>
