<template>
    <div class="my-3">
        <form method="PUT" @submit.prevent="Update">
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
                    <label for="username" class="text-right">Username</label>
                    <div class="mt-2">
                        <input 
                            id="username"
                            type="text" 
                            :class="{'is-invalid' : form.errors.has('username')}" class="form-control" 
                            v-model="form.username"
                            @keydown="form.errors.clear('username')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('username')" 
                            v-text="form.errors.get('username')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="password" class="text-right">Password</label>
                    <div class="mt-2">
                        <input 
                            id="password"
                            type="password" 
                            :class="{'is-invalid' : form.errors.has('password')}" class="form-control" 
                            v-model="form.password"
                            @keydown="form.errors.clear('password')"
                        >
                        <div 
                            class="invalid-feedback" 
                            v-show="form.errors.has('password')" 
                            v-text="form.errors.get('password')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-6">
                    <label for="password_confirmation" class="text-right">Confirm Password</label>
                    <div class="mt-2">
                        <input 
                            id="password_confirmation"
                            type="password" 
                            :class="{'is-invalid' : form.errors.has('password_confirmation')}" class="form-control"
                            v-model="form.password_confirmation"
                            @keydown="form.errors.clear('password_confirmation')"
                        >
                        <div
                            class="invalid-feedback" 
                            v-show="form.errors.has('password_confirmation')" 
                            v-text="form.errors.get('password_confirmation')"
                        ></div>
                    </div>
                </div>
                <div class="form-group mb-3 col-md-12">
                    <label for="usertype" class="text-right">User Type</label>
                    <div class="mt-2">
                        <select
                            id="usertype"
                            :class="{'is-invalid' : form.errors.has('usertype')}" 
                            class="form-select"
                            v-model="form.usertype"
                            @change="form.errors.clear('usertype')"
                        >
                            <option v-for="type in JSON.parse(this.usertypes)" :key="type.id" :value="type.id">
                                {{ type.usertype }}
                            </option>
                        </select>
                        <div
                            class="invalid-feedback" 
                            v-show="form.errors.has('usertype')" 
                            v-text="form.errors.get('usertype')"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/users" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'user',
        'usertypes',
    ],
    data() {
        return {
            form: new Form({
                firstname: JSON.parse(this.user).firstname,
                lastname: JSON.parse(this.user).lastname,
                middlename: JSON.parse(this.user).middlename,
                username: JSON.parse(this.user).username,
                password: '',
                password_confirmation: '',
                usertype: JSON.parse(this.user).usertype_id,
            })
        }
    },
    methods: {
        Update() {
            const id = JSON.parse(this.user).id;
            axios.put('/user/update/'+id, this.form)
            .then((response) => {
                window.location.href = '/users';
            })
            .catch(error => {
                this.form.errors.record(error.response.data);
            });
        },
    },
}
</script>