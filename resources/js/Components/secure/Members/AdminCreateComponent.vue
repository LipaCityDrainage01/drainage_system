<template>
    <div class="row">
        <div class="card">
            <div class="card-header ">
            </div>
            <v-form fast-fail @submit.prevent ref="form">
            <div class="card-body">
                <div class="col-12 mt-2">
                    <v-text-field
                        variant="outlined"
                        v-model="form['name']"
                        label="Full name"
                        :rules="rules.requiredRules"
                    ></v-text-field>
                </div>
                <div class="col-12 mt-2">
                    <v-text-field
                        variant="outlined"
                        v-model="form['username']"
                        label="Username"
                        :rules="rules.requiredRules"
                    ></v-text-field>
                </div>
                <div class="col-12 mt-2">
                    <v-text-field
                        variant="outlined"
                        v-model="form['email']"
                        label="Email"
                        :rules="rules.emailRules"
                    ></v-text-field>
                </div>
                <div class="col-12 mt-2">
                    <v-text-field
                        type="tel"
                        variant="outlined"
                        v-model="form['contact_no']"
                        label="Contact Number"
                        :rules="rules.contactNumberRules"
                    ></v-text-field>
                </div>

            </div>
            <div class="card-footer text-end">
                <v-btn :loading="saveLoading" @click="store" color="primary" prepend-icon="mdi-content-save">Save Record</v-btn>
                <v-btn :href="'/members'" color="warning" class="text-white ml-3" prepend-icon="mdi-cancel">Cancel</v-btn>
            </div>
            </v-form>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { parsePhoneNumber } from 'libphonenumber-js';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

export default {
    name: "AdminCreateComponent",

    data() {
        return {
            form: {
                'contact_no': '+63'
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

                ]
            },
            roles: [],
            message: [],
            saveLoading: false,
        }
    },

    mounted() {

    },

    methods: {



        async store() {
            this.saveLoading = true;
            await axios.post('/api/members', this.form)
                .then(response => {
                    toast(response.data.message, {
                        autoClose: 3500,
                        type: "success",
                        transition: "slide",
                        theme: "colored"
                    })
                    this.$refs.form.reset();
                    this.$refs.form.resetValidation()
                    this.form = {
                        contact_no: '+639'
                    }
                })
                .catch(error => {
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
                });
            this.saveLoading = false;
        },

        resetForm() {
            this.$refs.form.reset();
            this.$refs.form.resetValidation();
        }
    }
}
</script>

<style>

</style>
