<template>
    <div class="my-3">
        <form method="POST" @submit.prevent="Add">
            <div class="form-group mb-3">
                <label for="usertype" class="text-right">User Type</label>
                <div class="mt-2">
                    <input 
                        id="usertype"
                        type="text" 
                        :class="{'is-invalid' : form.errors.has('usertype')}" class="form-control" 
                        v-model="form.usertype"
                        @keydown="form.errors.clear('usertype')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('usertype')" 
                        v-text="form.errors.get('usertype')"
                    ></div>
                </div>
            </div>
            <div class="mb-3">
                <label class="text-right">Restriction</label>
                <div class="d-flex flex-wrap rounded bg-secondary bg-gradient text-light p-2">
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="dashboard" value="dashboard" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="dashboard">
                            Dashboard
                        </label>
                    </div>
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="crews" value="crews" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="crews">
                            Crew
                        </label>
                    </div>
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="users" value="users" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="users">
                            User
                        </label>
                    </div>
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="documents" value="documents" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="documents">
                            Document
                        </label>
                    </div>
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="usertypes" value="usertypes" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="usertypes">
                            User Type
                        </label>
                    </div>
                    <div class="form-check me-4">
                        <input class="form-check-input" v-model="form.restriction" type="checkbox" id="ranks" value="ranks" @click="form.errors.clear('restriction')">
                        <label class="form-check-label" for="ranks">
                            Rank
                        </label>
                    </div>
                </div>
                <div class="mt-1">
                    <small
                        class="text-danger"
                        v-show="form.errors.has('restriction')" 
                        v-text="form.errors.get('restriction')"
                    ></small>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/usertypes" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            form: new Form({
                usertype: '',
                restriction: [],
            })
        }
    },
    methods: {
        Add() {
            axios.post('/usertype/store', this.form)
            .then((response) => {
                window.location.href = '/usertypes';
            })
            .catch(error => {
                this.form.errors.record(error.response.data);
            });
        },
    },
}
</script>