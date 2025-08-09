

<script setup lang="ts">
import { onMounted, ref, watch } from "vue";
import Dialog from 'primevue/dialog';
import ErrorIcon from "../Icons/ErrorIcon.vue";

const props = defineProps({
    dialog_visable: {
        type: Boolean,
        default: false
    },
    error_message: {
        type: String,
        default: 'An error occurred'
    }
});

const visible = ref(props.dialog_visable);
const ErrorMessage = ref(props.error_message);



watch(() => props.dialog_visable, (newVal) => {
    visible.value = newVal;
});
watch(() => props.error_message, (newVal) => {
    ErrorMessage.value = newVal;
});

</script>

<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="visible" :showHeader="false" :dismissable-mask="true" modal  :style="{ width: '25rem' }">
           <ErrorIcon class="error-icon" />
           <p class="error-message">{{ ErrorMessage }}</p>
        </Dialog>
    </div>
</template>


<style scoped lang="scss">

</style>