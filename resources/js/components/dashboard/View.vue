<template>
    <div class="my-2">
        <div class="d-flex justify-content-end mb-3">
            <div class="d-flex align-items-center">
                <label>Rank:</label>
                <select v-model="selectedRank" class="form-select ms-2">
                    <option v-for="rank in ranks" :key="rank.id" :value="rank.code+' - '+rank.name">
                        {{ rank.code }} &#45; {{ rank.name }}
                    </option>
                </select>
                <button class="btn btn-secondary ms-2" @click="ResetTable">Reset</button>
            </div>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th width="10%">First Name</th>
                    <th width="10%">Last Name</th>
                    <th width="10%">Middle Name</th>
                    <th width="10%">Email</th>
                    <th width="10%">Birth Date</th>
                    <th>Age</th>
                    <th width="12%">Address</th>
                    <th width="10%">Rank</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th width="10%">BMI</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(crew, index) in crews" :key="index">
                    <td>
                        <a class="btn btn-link" :href="'/dashboard/'+crew.id+'/crew/list'">{{ crew.firstname }}</a>
                    </td>
                    <td>{{ crew.lastname }}</td>
                    <td>{{ crew.middlename }}</td>
                    <td>{{ crew.email }}</td>
                    <td>{{ crew.birthdate }}</td>
                    <td>{{ crew.age }}</td>
                    <td>{{ crew.address }}</td>
                    <td>{{ crew.rankcode }} &#45; {{ crew.rankname }}</td>
                    <td>{{ crew.height }}m</td>
                    <td>{{ crew.weight }}</td>
                    <td>{{ crew.bmi }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectedRank: '',
                crews: [],
                ranks: [],
            }
        },
        mounted() {
            this.Ranks();
            this.All();
        },
        watch: {
            selectedRank: 'filterRank'
        },
        methods: {
            Ranks() {
                axios.get('/ranks/data')
                .then(response => {
                    this.ranks = response.data
                }); 
            },
            All() {
                axios.get('/crews/data')
                .then(response => {
                    this.crews = response.data
                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);
                }); 
            },
            filterRank() {
                const table = $('#datatables').DataTable();
                if (this.selectedRank) {
                    table.column(7).search(this.selectedRank, true, false).draw();
                } else {
                    table.column(7).search('').draw();
                }
            },
            ResetTable() {
                const table = $('#datatables').DataTable();
                table.search('').columns().draw();
                this.selectedRank = null;
            }
        },
    }
</script>