<template>
    <div class="modal fade" id="modal_document" tabindex="-1" aria-labelledby="modal_document_label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_document_label">
                        {{ formEdit ? 'Edit Document' : 'Create Document' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" @submit.prevent="submitForm">
                    <div class="modal-body row">
                        <div class="form-group mb-3 col-md-6">
                            <label for="code" class="text-right">Document Code</label>
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
                        <div class="form-group mb-3 col-md-6">
                            <label for="doctype" class="text-right">Document Type</label>
                            <div class="mt-2">
                                <select 
                                    id="doctype"
                                    type="text" 
                                    :class="{'is-invalid' : form.errors.has('doctype')}" class="form-select" 
                                    v-model="form.doctype"
                                    @change="form.errors.clear('doctype')"
                                >
                                    <option v-for="document in this.documents" :key="document.id" :value="document.id">
                                        {{ document.code }} &#45; {{ document.name }}
                                    </option>
                                </select>
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('doctype')" 
                                    v-text="form.errors.get('doctype')"
                                ></div>
                            </div>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="docname" class="text-right">Document Name</label>
                            <div class="mt-2">
                                <input 
                                    id="docname"
                                    type="text" 
                                    :class="{'is-invalid' : form.errors.has('docname')}" class="form-control" 
                                    v-model="form.docname"
                                    @keydown="form.errors.clear('docname')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('docname')" 
                                    v-text="form.errors.get('docname')"
                                ></div>
                            </div>
                        </div>
                        <div class="form-group mb-3 col-md-6">
                            <label for="docnum" class="text-right">Document Number</label>
                            <div class="mt-2">
                                <input 
                                    id="docnum"
                                    type="text" 
                                    :class="{'is-invalid' : form.errors.has('docnum')}" class="form-control" 
                                    v-model="form.docnum"
                                    @keydown="form.errors.clear('docnum')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('docnum')" 
                                    v-text="form.errors.get('docnum')"
                                ></div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="docfile" class="text-right">Document File</label>
                            <div class="mt-2">
                                <input 
                                    id="docfile"
                                    type="file"
                                    :class="{'is-invalid' : form.errors.has('docfile')}" class="form-control"
                                    @input="form.docfile = $event.target.files[0]"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('docfile')" 
                                    v-text="form.errors.get('docfile')"
                                ></div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="dateissued" class="text-right">Date Issued</label>
                            <div class="mt-2">
                                <input 
                                    id="dateissued"
                                    type="date" 
                                    :class="{'is-invalid' : form.errors.has('dateissued')}" class="form-control" 
                                    v-model="form.dateissued"
                                    @click="form.errors.clear('dateissued')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('dateissued')" 
                                    v-text="form.errors.get('dateissued')"
                                ></div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="dateexpire" class="text-right">Date Expire</label>
                            <div class="mt-2">
                                <input 
                                    id="dateexpire"
                                    type="date" 
                                    :class="{'is-invalid' : form.errors.has('dateexpire')}" class="form-control" 
                                    v-model="form.dateexpire"
                                    @click="form.errors.clear('dateexpire')"
                                >
                                <div 
                                    class="invalid-feedback" 
                                    v-show="form.errors.has('dateexpire')" 
                                    v-text="form.errors.get('dateexpire')"
                                ></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            {{ formEdit ? 'Save' : 'Create' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'documents',
        'form',
        'formAdd',
        'formEdit',
        'submitForm',
    ]
}
</script>