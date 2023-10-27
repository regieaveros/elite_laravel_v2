<template>
    <div class="my-2">
        <div class="d-flex justify-content-end mb-3">
            <a href="/user/create" class="btn btn-primary">Add User</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Middle Name</th>
                    <th>Username</th>
                    <th>User Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <td>{{ user.firstname }}</td>
                    <td>{{ user.lastname }}</td>
                    <td>{{ user.middlename }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.type ? user.type : 'None' }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a :href="'/user/edit/'+user.id" class="btn btn-info m-1">Update</a>
                            <button @click="Delete(user.id)" class="btn btn-danger m-1">Delete</button>
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
                users: [],
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
                axios.get('/users/data')
                .then(response => {
                    this.users = response.data

                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);

                }); 
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/user/delete/'+id)
                    .then(response => {
                        this.All();
                    });
                } 
            }
        },
    }
</script>

<style>

</style>