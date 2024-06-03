<template>
    <div class="row">
        <div class="col-12 mb-3">
            <v-btn color="primary" class="float-right" prepend-icon="mdi-plus" @click="createDialog = true">Create</v-btn>
        </div>
        <div class="col-12">
            <v-card border>
                <v-card-title class="d-flex align-center pe-2">
                    <v-icon icon="mdi-database"></v-icon> &nbsp;
                    Maintenance List

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
                    class="elevation-1"
                >
                    <template v-slot:item="{ item }">
                        <tr>
                            <td>{{ item.location?.name }}</td>
                            <td>{{ item.type }}</td>
                            <td>{{ item.remarks }}</td>
                            <td>{{ item.status }}</td>
                            <td>
                                <v-btn @click="openDialog('edit', item)" class="mr-2" density="comfortable" icon="mdi-pencil"  color="warning"></v-btn>
                                <v-btn @click="openDialog('delete', item)"  class="mr-2 text-white" density="comfortable" icon="mdi-delete" color="danger"></v-btn>
                            </td>
                        </tr>
                    </template>
                </v-data-table>
            </v-card>
        </div>

    </div>
    <v-dialog
        v-model="createDialog"
        persistent
        width="700"
    >
        <v-card>
            <v-toolbar class="bg-primary" title="Edit Record">
                <v-icon icon="mdi-close" @click="createDialog = false" class="mr-5"></v-icon>
            </v-toolbar>
            <v-form fast-fail @submit.prevent ref="form">
                <v-card-text>
                    <v-container>
                        <div class="col-12 mt-2">
                            <v-autocomplete
                                variant="outlined"
                                v-model="form['location_id']"
                                label="Location"
                                :items="location"
                                item-title="name"
                                item-value="id"
                            ></v-autocomplete>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['type']"
                                label="Type *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['remarks']"
                                label="Remarks *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['status']"
                                label="Status *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                    </v-container>
                    <small>* indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="createDialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="store"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
    <v-dialog
        v-model="editDialog"
        persistent
        width="700"
    >
        <v-card>
            <v-toolbar class="bg-primary" title="Edit Record">
                <v-icon icon="mdi-close" @click="editDialog = false" class="mr-5"></v-icon>
            </v-toolbar>
            <v-form fast-fail @submit.prevent ref="form">
                <v-card-text>
                    <v-container>
                        <div class="col-12 mt-2">
                            <v-autocomplete
                                variant="outlined"
                                v-model="form['location_id']"
                                label="Location"
                                :items="location"
                                item-title="name"
                                item-value="id"
                            ></v-autocomplete>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['type']"
                                label="Type *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['remarks']"
                                label="Remarks *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                        <div class="col-12 mt-2">
                            <v-text-field
                                variant="outlined"
                                v-model="form['status']"
                                label="Status *"
                                :rules="rules.requiredRules"
                            ></v-text-field>
                        </div>
                    </v-container>
                    <small>* indicates required field</small>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="editDialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue-darken-1"
                        variant="text"
                        @click="update"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
    <v-dialog
        v-model="removeDialog"
        persistent
        width="700"
    >
        <v-card>
            <v-toolbar class="bg-danger text-white" title="Remove Record">
                <v-icon icon="mdi-close" @click="removeDialog = false" class="mr-5"></v-icon>
            </v-toolbar>
            <v-form fast-fail @submit.prevent ref="form">
                <v-card-text>
                    <v-container>
                        <h6>Are you sure you want to delete this Record?</h6>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="red-darken-1"
                        variant="text"
                        @click="remove"
                    >
                        Delete
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-dialog>
</template>

<script>
import axios from "axios";
import { parsePhoneNumber } from 'libphonenumber-js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import { AgGridVue } from "ag-grid-vue3";  // the AG Grid Vue Component
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-material.css";
import { ModuleRegistry } from '@ag-grid-community/core';
import { RangeSelectionModule } from '@ag-grid-enterprise/range-selection';

export default {
    name: "MaintenanceReportComponent",

    components: {
        AgGridVue,
    },

    data() {
        return {
            search: '',
            editDialog: false,
            removeDialog: false,
            createDialog: false,
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
                    title: 'Location',
                    align: 'start',
                    key: 'name',
                },
                { title: 'Type', key: 'type' },
                { title: 'Remarks', key: 'remarks' },
                { title: 'Status', key: 'status' },
                { title: 'Action', key: 'action' },
            ],
            location: [],
        }
    },

    beforeMount() {
    },

    created() {

    },


    mounted() {
        this.getLocation();
        this.initialize();
    },

    methods: {
        async getLocation() {
            await axios.get('/api/barangay')
                .then(response => {
                    this.location = response.data;
                })
                .catch(error => console.log(error))
        },

        async initialize() {
            await axios.get('/api/maintenance/')
                .then(response => {
                    this.table = [...response.data];
                })
                .catch(error => console.log(error))
        },

        async update() {
            await axios.put('/api/maintenance/' + this.form.id, this.form)
                .then(response => {
                    toast(response.data.message, {
                        autoClose: 3500,
                        type: "success",
                        transition: "slide",
                        theme: "colored"
                    })
                    this.$refs.form.reset();
                    this.$refs.form.resetValidation()
                    this.initialize();
                    this.editDialog = false;
                }).catch(error => {
                    if(error.response.status === 422){
                        const err = error.response.data.errors;
                        for (const e in err) {
                            toast(err[e], {
                                autoClose: 3500,
                                type: "error",
                                transition: "slide",
                                theme: "colored"
                            })
                        }
                    }
                })
        },

        async store() {
            await axios.post('/api/maintenance', this.form)
                .then(response => {
                    toast(response.data.message, {
                        autoClose: 3500,
                        type: "success",
                        transition: "slide",
                        theme: "colored"
                    })
                    this.$refs.form.reset();
                    this.$refs.form.resetValidation()
                    this.initialize();
                    this.editDialog = false;
                }).catch(error => {
                    if(error.response.status === 422){
                        const err = error.response.data.errors;
                        for (const e in err) {
                            toast(err[e], {
                                autoClose: 3500,
                                type: "error",
                                transition: "slide",
                                theme: "colored"
                            })
                        }
                    }
                })
        },

        async remove() {
            await axios.delete('/api/maintenance/' + this.form['id'])
                .then(response => {
                    toast(response.data.message, {
                        autoClose: 3500,
                        type: "info",
                        transition: "slide",
                        theme: "colored"
                    });
                    this.initialize();
                    this.removeDialog = false;
                }).catch(error => console.log(error))
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
