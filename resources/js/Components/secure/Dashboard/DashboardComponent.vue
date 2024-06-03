<template>
    <v-row>
        <v-col
            cols="12"  v-for="l in location">
            <v-alert
                v-if="l.detection?.sensor_data > 75"
                :text="'Drainage' + l.id +' - '+ l.name  +' is in maintenance status. Please have some time to perform maintenance procedure.'"
                title="Warning"
                type="warning"
                variant="elevated"
            ></v-alert>
        </v-col>
    </v-row>
    <v-row>
        <v-col
            cols="4"
            v-for="l in location"
        >
            <v-card>
                <v-card-title>
                    <div class="text-black text-h6">Drainage {{ l.id}}: {{ l.name }}</div>
                </v-card-title>
                <v-card-item>
                    <div class="text-center">
                        <v-progress-circular :model-value="l.detection?.sensor_data" :rotate="360" :size="250" :width="30" :color="getRandomColor">
                            <template v-slot:default> {{ l.detection?.sensor_data }} %  - {{ l.detection?.status }}</template>
                        </v-progress-circular>
                    </div>
                </v-card-item>
            </v-card>
        </v-col>
    </v-row>
</template>

<script>
import axios from "axios";
import { Bar, Doughnut } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)

export default {
    name: "DashboardComponent",

    components: { Bar, Doughnut },

    data() {
        return {
            loaded: false,
            chartData: {
                labels: [ '70%' ],
                datasets: [
                    {
                        data: [10],
                        backgroundColor: [
                            'rgb(54, 162, 235)',
                        ],
                    }
                ],

            },
            chartOptions: {
                responsive: true,
            },
            location: [],
        }
    },

    mounted() {
        console.log("Charts")
        setInterval(() => {
            this.getLocation();
        }, 5000)
    },

    computed: {
        getRandomColor() {
            // Generate a random integer between 0 and 255 for each color component.
            const r = Math.floor(Math.random() * 256);
            const g = Math.floor(Math.random() * 256);
            const b = Math.floor(Math.random() * 256);

            // Return the RGB color string.
            console.log(r,g,b);
            return `rgb(${r}, ${g}, ${b})`;
        }
    },

    methods: {

        async getLocation() {
            await axios.get('/api/barangay')
                .then(response => {
                    this.location = response.data;
                })
                .catch(error => console.log(error))
        },

    }
}
</script>

<style>

</style>
