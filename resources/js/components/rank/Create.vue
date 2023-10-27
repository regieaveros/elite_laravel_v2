<template>
    <div class="my-3">
        <form method="POST" @submit.prevent="Add">
            <div class="form-group mb-3">
                <label for="code" class="text-right">Code</label>
                <div class="mt-2">
                    <input 
                        id="code"
                        type="text" 
                        :class="{'is-invalid' : form.errors.has('code')}" class="form-control" 
                        v-model="form.code"
                        @keydown="form.errors.clear('code')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('code')" 
                        v-text="form.errors.get('code')"
                    ></div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="name" class="text-right">Rank</label>
                <div class="mt-2">
                    <input 
                        id="name"
                        type="text" 
                        :class="{'is-invalid' : form.errors.has('name')}" class="form-control" 
                        v-model="form.name"
                        @keydown="form.errors.clear('name')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('name')" 
                        v-text="form.errors.get('name')"
                    ></div>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="alias" class="text-right">Alias</label>
                <div class="mt-2">
                    <input 
                        id="alias"
                        type="text" 
                        :class="{'is-invalid' : form.errors.has('alias')}" class="form-control" 
                        v-model="form.alias"
                        @keydown="form.errors.clear('alias')"
                    >
                    <div 
                        class="invalid-feedback" 
                        v-show="form.errors.has('alias')" 
                        v-text="form.errors.get('alias')"
                    ></div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a href="/ranks" class="btn btn-info">Back</a>
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
                code: '',
                name: '',
                alias: '',
            })
        }
    },
    methods: {
        Add() {
            axios.post('/rank/store', this.form)
            .then((response) => {
                window.location.href = '/ranks';
            })
            .catch(error => {
                this.form.errors.record(error.response.data);
            });
        },
    },
}
</script>