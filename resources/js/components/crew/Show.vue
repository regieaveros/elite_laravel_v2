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
            <a href="/crews" class="btn btn-secondary">Back</a>
            <button type="button" @click="toggleCreate()" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_document">Add Document</button>
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
                    <th>Action</th>
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
                    <td>
                        <div class="d-flex justify-content-start">
                            <button type="button" @click="toggleEdit(crew_document)" class="btn btn-primary m-1" data-bs-toggle="modal" data-bs-target="#modal_document">Update</button>
                            <button @click="Delete(crew_document.id)" class="btn btn-danger m-1">Delete</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <crew-modal
            :documents="documents"
            :form="form"
            :formAdd="formAdd"
            :formEdit="formEdit"
            :submitForm="submitForm"
        ></crew-modal>
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
                form: new Form({
                    id: '',
                    crew_id: JSON.parse(this.id),
                    code:  '',
                    doctype: '',
                    docname: '',
                    docnum: '',
                    docfile: null,
                    dateissued: '',
                    dateexpire: '',
                }),
                formAdd: false,
                formEdit: false,
            }
        },
        mounted() {
            const alertShow = document.querySelector('.alert');
            if (alertShow) {
                setTimeout(() => {
                    alertShow.remove();
                }, 3000);
            }
            this.CrewDocuments();
            this.Documents();
        },
        methods: {
            toggleCreate() {
                this.form.code = '';
                this.form.doctype = '';
                this.form.docname = '';
                this.form.docnum = '';
                this.form.dateissued = '';
                this.form.dateexpire = '';
                this.formAdd = true;
                this.formEdit = false;
            },
            toggleEdit(crew_document) {
                this.form.reset();
                this.form.id = crew_document.id;
                this.form.crew_id = crew_document.crew_id;
                this.form.code = crew_document.code;
                this.form.doctype = crew_document.doctype;
                this.form.docname = crew_document.docname;
                this.form.docnum = crew_document.docnum;
                this.form.dateissued = crew_document.dateissued;
                this.form.dateexpire = crew_document.dateexpire;
                this.formEdit = true;
                this.formAdd = false;
            },
            submitForm() {
                if (this.formEdit) {
                    this.Update();
                } else {
                    this.Add();
                }
            },
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
            Add() {
                const formData = new FormData();
                formData.append('crew_id', this.form.crew_id);
                formData.append('code', this.form.code);
                formData.append('doctype', this.form.doctype);
                formData.append('docname', this.form.docname);
                formData.append('docnum', this.form.docnum);
                formData.append('docfile', this.form.docfile);  
                formData.append('dateissued', this.form.dateissued);
                formData.append('dateexpire', this.form.dateexpire);
                axios.post('/crew/document/store', formData)
                .then((response) => {
                    this.CrewDocuments();
                })
                .catch(error => {
                    this.form.errors.record(error.response.data);
                });
            },
            Update() {
                const formData = new FormData();
                formData.append('crew_id', this.form.crew_id);
                formData.append('code', this.form.code);
                formData.append('doctype', this.form.doctype);
                formData.append('docname', this.form.docname);
                formData.append('docnum', this.form.docnum);
                formData.append('docfile', this.form.docfile);
                formData.append('dateissued', this.form.dateissued);
                formData.append('dateexpire', this.form.dateexpire);
                axios.post('/crew/document/update/'+this.form.id, formData)
                .then((response) => {
                    this.CrewDocuments();
                })
                .catch(error => {
                    this.form.errors.record(error.response.data);
                });
            },
            Delete(id) {
                if (confirm("Are you sure you want to Delete")) {
                    axios.delete('/crew/document/delete/'+id)
                    .then(response => {
                        this.CrewDocuments();
                    });
                } 
            },
        },
    }
</script>