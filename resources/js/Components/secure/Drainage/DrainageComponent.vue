<template>
    <div class="row">
        <div class="col-12">
            <v-card border>
                <v-card-title class="d-flex align-center pe-2">
                    <v-icon icon="mdi-database"></v-icon> &nbsp;
                    Barangay List

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
                            <td>{{ item.name }}</td>
                            <td>
                                <v-btn :href="'/drainage/' + item.id" class="mr-2" density="comfortable" icon="mdi-google-analytics"  color="success"></v-btn>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-card>
        </div>
    </div>
</template>

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
                    title: 'Name',
                    align: 'start',
                    key: 'name',
                },
                { title: 'Action', key: 'action' },
            ],
        }
    },

    beforeMount() {
    },

    created() {

    },


    mounted() {
        this.initialize();
    },

    methods: {

        async initialize() {
            await axios.get('/api/barangay/')
                .then(response => {
                    this.table = [...response.data];
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

<style>

</style>
