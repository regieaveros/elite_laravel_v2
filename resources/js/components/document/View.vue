<template>
    <div class="my-2">
        <div class="d-flex justify-content-end mb-3">
            <a href="/document/create" class="btn btn-primary">Add Document</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Code</th>
                    <th width="70%">Document Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(document, index) in documents" :key="index">
                    <td>{{ document.code }}</td>
                    <td>{{ document.name }}</td>
                    <td>
                        <div class="d-flex justify-content-start">
                            <a :href="'/document/edit/'+document.id" class="btn btn-info m-1">Update</a>
                            <button @click="Delete(document.id)" class="btn btn-danger m-1">Delete</button>
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
                documents: [],
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
                axios.get('/documents/data')
                .then(response => {
                    this.documents = response.data

                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);

                }); 
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/document/delete/'+id)
                    .then(response => {
                        this.All();
                    });
                } 
            }
        },
    }
</script>