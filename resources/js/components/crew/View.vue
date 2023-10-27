<template>
    <div class="my-2">
        <div class="d-flex justify-content-between mb-3">
            <div class="d-flex align-items-center">
                <label>Rank:</label>
                <select v-model="selectedRank" class="form-select ms-2">
                    <option v-for="rank in ranks" :key="rank.id" :value="rank.code+' - '+rank.name">
                        {{ rank.code }} &#45; {{ rank.name }}
                    </option>
                </select>
                <button class="btn btn-secondary ms-2" @click="ResetTable">Reset</button>
            </div>
            <a href="/crew/create" class="btn btn-primary">Add Crew</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Email</th>
                    <th>Birth Date</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Rank</th>
                    <th>Height</th>
                    <th>Weight</th>
                    <th>BMI</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(crew, index) in crews" :key="index">
                    <td>
                        <a class="btn btn-link" :href="'/crew/'+crew.id">{{ crew.firstname }}</a>
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
                    <td>
                        <div class="d-flex justify-content-start">
                            <a :href="'/crew/edit/'+crew.id" class="btn btn-info m-1">Update</a>
                            <button @click="Delete(crew.id)" class="btn btn-danger m-1">Delete</button>
                        </div>
                    </td>
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
            axios.get('/ranks/data')
            .then(response => {
                this.ranks = response.data
            }); 
            this.All();
            const alertShow = document.querySelector('.alert');
            if (alertShow) {
                setTimeout(() => {
                    alertShow.remove();
                }, 3000);
            }
        },
        watch: {
            selectedRank: 'filterRank'
        },
        methods: {
            All() {
                axios.get('/crews/data')
                .then(response => {
                    this.crews = response.data

                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);
                }); 
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/crew/delete/'+id)
                    .then(response => {
                        this.All();
                    });
                } 
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