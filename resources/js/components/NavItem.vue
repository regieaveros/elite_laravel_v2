<template>
    <div class="d-flex flex-column flex-md-row">
        <li v-for="item in items" :key="item" class="nav-item ms-md-3">
            <a class="nav-link" :href="item">{{ Capitalize(item) }}</a>
        </li>
    </div>
</template>

<script>
    export default {
        props: ['restrictions'],
        data() {
            return {
                items: [],
            }
        },
        mounted() {

            const jsonString = this.restrictions;
            const jsonData = JSON.parse(jsonString);
            const sanitizedRestrictions = jsonData.restriction.slice(1, -1).split('","').map(item => item.replace(/\\"/g, '"')).map(item => item.replace(/[^\w\s]/g, ''));
            this.items = sanitizedRestrictions;

        },
        methods: {
            Capitalize(text) {
                return text.charAt(0).toUpperCase() + text.slice(1);
            }
        }
    }
</script>