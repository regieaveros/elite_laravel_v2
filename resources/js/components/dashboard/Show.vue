<template>
    <div class="my-2">
        <div class="row mb-2">
            <div class="col-6">
                <p><strong>First Name:</strong> {{ JSON.parse(this.crew).firstname }}</p>
            </div>
            <div class="col-6">
                <p><strong>Last Name:</strong> {{ JSON.parse(this.crew).lastname }}</p>
            </div>
            <div class="col-6">
                <p><strong>Middle Name:</strong> {{ JSON.parse(this.crew).middlename }}</p>
            </div>
            <div class="col-6">
                <p><strong>Email:</strong> {{ JSON.parse(this.crew).email }}</p>
            </div>
            <div class="col-6">
                <p><strong>Birth Date:</strong> {{ JSON.parse(this.crew).birthdate }}</p>
            </div>
            <div class="col-6">
                <p><strong>Age:</strong> {{ JSON.parse(this.crew).age }}</p>
            </div>
            <div class="col-6">
                <p><strong>Address:</strong> {{ JSON.parse(this.crew).address }}</p>
            </div>
            <div class="col-6">
                <p>
                    <strong>Rank:</strong> {{ JSON.parse(this.crew).rankcode }} &#45; {{ JSON.parse(this.crew).rankname }}
                </p>
            </div>
            <div class="col-6">
                <p><strong>Height:</strong> {{ JSON.parse(this.crew).height }}m</p>
            </div>
            <div class="col-6">
                <p><strong>Weight:</strong> {{ JSON.parse(this.crew).weight }}</p>
            </div>
            <div class="col-6">
                <p><strong>BMI:</strong> {{ JSON.parse(this.crew).bmi }}</p>
            </div>
        </div>
        <div class="d-flex justify-content-between mb-3">
            <a href="/dashboard" class="btn btn-secondary">Back</a>
        </div>
        <table id="datatables" class="display">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Document Type</th>
                    <th>Document Name</th>
                    <th>Document Number</th>
                    <th>Date Issued</th>
                    <th>Date Expire</th>
                    <th>Uploaded By</th>
                    <th>File Path</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(crew_document, index) in crewdocuments" :key="index">
                    <td>{{ crew_document.code }}</td>
                    <td>{{ crew_document.doctypename }}</td>
                    <td>{{ crew_document.docname }}</td>
                    <td>{{ crew_document.docnum }}</td>
                    <td>{{ crew_document.dateissued }}</td>
                    <td :style="'color:'+crew_document.color+';'">
                        {{ crew_document.dateexpire }}
                    </td>
                    <td>{{ crew_document.uploadedby }}</td>
                    <td>{{ crew_document.docpath }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: [
            'id',
            'crew',
        ],
        data() {
            return {
                documents: [],
                crewdocuments: [],
            }
        },
        mounted() {
            this.CrewDocuments();
            this.Documents();
        },
        methods: {
            CrewDocuments() {
                const id = JSON.parse(this.id);
                axios.get('/crew/'+id+'/documents')
                .then(response => {
                    this.crewdocuments = response.data;
                    setTimeout(() => {
                        $('#datatables').dataTable();
                    }, 10);
                });
            },
            Documents() {
                axios.get('/documents/data')
                .then(response => {
                    this.documents = response.data
                });
            },
        },
    }
</script>