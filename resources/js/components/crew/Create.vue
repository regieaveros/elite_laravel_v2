<template>
    <div class="my-3">
        <form method="POST" @submit.prevent="Add">
            <div class="row">
                <div class="form-group mb-3 col-md-6">
                    <label for="firstname" class="text-right">First Name</label>
                    <div class="mt-2">
                        <input 
                            id="firstname"
                            type="text" 
                            :class="{'is-invalid' : form.errors.has('firstname')}" class="form-control" 
                            v-model="form.firstname"
                            @keydown="form.errors.clear('firstname')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('firstname')" 
                            v-text="form.errors.get('firstname')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="lastname" class="text-right">Last Name</label>
                    <div class="mt-2">
                        <input 
                            id="lastname"
                            type="text" 
                            :class="{'is-invalid' : form.errors.has('lastname')}" class="form-control" 
                            v-model="form.lastname"
                            @keydown="form.errors.clear('lastname')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('lastname')" 
                            v-text="form.errors.get('lastname')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="middlename" class="text-right">Middle Name</label>
                    <div class="mt-2">
                        <input 
                            id="middlename"
                            type="text" 
                            :class="{'is-invalid' : form.errors.has('middlename')}" class="form-control" 
                            v-model="form.middlename"
                            @keydown="form.errors.clear('middlename')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('middlename')" 
                            v-text="form.errors.get('middlename')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="email" class="text-right">Email</label>
                    <div class="mt-2">
                        <input 
                            id="email"
                            type="text"
                            :class="{'is-invalid' : form.errors.has('email')}" class="form-control" 
                            v-model="form.email"
                            @keydown="form.errors.clear('email')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('email')" 
                            v-text="form.errors.get('email')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="birthdate" class="text-right">Birth Date</label>
                    <div class="mt-2">
                        <input 
                            id="birthdate"
                            type="date"
                            :class="{'is-invalid' : form.errors.has('birthdate')}" class="form-control" 
                            v-model="form.birthdate"
                            @keydown="form.errors.clear('birthdate')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('birthdate')" 
                            v-text="form.errors.get('birthdate')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="age" class="text-right">Age</label>
                    <div class="mt-2">
                        <input 
                            id="age"
                            type="number"
                            :class="{'is-invalid' : form.errors.has('age')}" class="form-control" 
                            v-model="form.age"
                            @keydown="form.errors.clear('age')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('age')" 
                            v-text="form.errors.get('age')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="address" class="text-right">Address</label>
                    <div class="mt-2">
                        <input 
                            id="address"
                            type="text"
                            :class="{'is-invalid' : form.errors.has('address')}" class="form-control" 
                            v-model="form.address"
                            @keydown="form.errors.clear('address')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('address')" 
                            v-text="form.errors.get('address')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="rank" class="text-right">Rank</label>
                    <div class="mt-2">
                        <select
                            id="rank"
                            :class="{'is-invalid' : form.errors.has('rank')}" class="form-select" 
                            v-model="form.rank"
                            @keydown="form.errors.clear('rank')"
                        >
                            <option v-for="rank in JSON.parse(this.ranks)" :key="rank.id" :value="rank.id">
                                {{ rank.code }} &#45; {{ rank.name }}
                            </option>
                        </select>
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('rank')" 
                            v-text="form.errors.get('rank')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="height" class="text-right">Height <small>&#40;meter&#41;</small></label>
                    <div class="mt-2">
                        <input 
                            id="height"
                            type="number"
                            :class="{'is-invalid' : form.errors.has('height')}" class="form-control" 
                            v-model="form.height"
                            @keydown="form.errors.clear('height')"
                            step="0.01"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('height')" 
                            v-text="form.errors.get('height')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="weight" class="text-right">Weight</label>
                    <div class="mt-2">
                        <input 
                            id="weight"
                            type="number"
                            :class="{'is-invalid' : form.errors.has('weight')}" class="form-control" 
                            v-model="form.weight"
                            @keydown="form.errors.clear('weight')"
                            step="0.01"
                        >
                        <div
                            class="invalid-feedback" 
                            v-show="form.errors.has('weight')" 
                            v-text="form.errors.get('weight')"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/crews" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'ranks'
    ],
    data() {
        return {
            form: new Form({
                firstname: '',
                middlename: '',
                lastname: '',
                email: '',
                birthdate: '',
                age: '',
                address: '',
                rank: '',
                height: '',
                weight: '',
            })
        }
    },
    methods: {
        Add() {
            axios.post('/crew/store', this.form)
            .then((response) => {
                window.location.href = '/crews';
            })
            .catch(error => {
                this.form.errors.record(error.response.data);
            });
        },
    },
}
</script>