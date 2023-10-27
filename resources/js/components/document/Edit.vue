<template>
    <div class="my-3">
        <form method="PUT" @submit.prevent="Update">
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
                <label for="name" class="text-right">Document Name</label>
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
            <div class="d-flex justify-content-between">
                <a href="/documents" class="btn btn-info">Back</a>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: [
        'document',
    ],
    data() {
        return {
            form: new Form({
                code: JSON.parse(this.document).code,
                name: JSON.parse(this.document).name,
            })
        }
    },
    methods: {
        Update() {
            const id = JSON.parse(this.document).id;
            axios.put('/document/update/'+id, this.form)
            .then((response) => {
                window.location.href = '/documents';
            })
            .catch(error => {
                this.form.errors.record(error.response.data);
            });
        },
    },
}
</script>