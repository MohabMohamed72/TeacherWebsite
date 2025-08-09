

<script setup lang="ts">
import { onMounted, ref, watch } from "vue";
import Dialog from 'primevue/dialog';
import SuccessIcon from "../Icons/SuccessIcon.vue";

const props = defineProps({
    dialog_visable: {
        type: Boolean,
        default: false
    },
    succsses_message: {
        type: String,
        default: 'An error occurred'
    }
});

const visible = ref(props.dialog_visable);
const SuccessMessage = ref(props.succsses_message);



watch(() => props.dialog_visable, (newVal) => {
    visible.value = newVal;
});
watch(() => props.succsses_message, (newVal) => {
    SuccessMessage.value = newVal;
});

</script>

<template>
    <div class="card flex justify-center">
        <Dialog v-model:visible="visible" :showHeader="false" :dismissable-mask="true" modal  :style="{ width: '25rem' }">
           <SuccessIcon class="error-icon" />
           <p class="error-message">{{ SuccessMessage }}</p>
        </Dialog>
    </div>
</template>


<style scoped lang="scss">

</style>