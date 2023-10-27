<template>
    <div class="my-2">
        <div class="d-flex justify-content-end mb-3">
            <a href="/usertype/create" class="btn btn-primary">Add User Type</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>User Type</th>
                    <th width="55%">Restriction</th>
                    <th width="15%">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(usertype, index) in usertypes" :key="index">
                    <td>{{ usertype.usertype }}</td>
                    <td>{{ usertype.restriction }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a :href="'/usertype/edit/'+usertype.id" class="btn btn-info m-1">Update</a>
                            <button @click="Delete(usertype.id)" class="btn btn-danger m-1">Delete</button>
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
                usertypes: [],
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
                axios.get('/usertypes/data')
                .then(response => {
                    this.usertypes = response.data

                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);

                }); 
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/usertype/delete/'+id)
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