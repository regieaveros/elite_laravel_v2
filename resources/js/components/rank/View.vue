<template>
    <div class="my-2">
        <div class="d-flex justify-content-end mb-3">
            <a href="/rank/create" class="btn btn-primary">Add Rank</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Rank</th>
                    <th>Alias</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(rank, index) in ranks" :key="index">
                    <td>{{ rank.code }}</td>
                    <td>{{ rank.name }}</td>
                    <td>{{ rank.alias }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a :href="'/rank/edit/'+rank.id" class="btn btn-info m-1">Update</a>
                            <button @click="Delete(rank.id)" class="btn btn-danger m-1">Delete</button>
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
                ranks: [],
            }
        },
        mounted() {
            this.All();
            
            const alertShow = document.querySelector('.alert');

            if (alertShow) {
                setTimeout(() => {
                    alertShow.remove();
                }, 3000);
            }
            
        },
        methods: {
            All() {
                axios.get('/ranks/data')
                .then(response => {
                    this.ranks = response.data

                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);

                }); 
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/rank/delete/'+id)
                    .then(response => {
                        this.All();
                    });
                } 
            }
        },
    }
</script>