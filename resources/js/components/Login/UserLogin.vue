<script setup lang="ts">
import { ref } from 'vue';
import LoginPenIcon from '../Icons/LoginPenIcon.vue';
import { useRouter } from 'vue-router';
import ErrorDialog from '../Dialogs/ErrorDialog.vue';
import SuccssesDialog from '../Dialogs/SuccssesDialog.vue';

const router = useRouter();
const password = ref('');
const phoneNumber = ref('');
const rememberMe = ref(false);
  const DialogVisible = ref(false);
    const errorMessage = ref('An error occurred during registration');
    const SuccessDialogVisible = ref(false);
    const SuccessMessage = ref('Registration successful');
const UserLogin = async ()=>{
    await fetch('/api/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            phone_number: phoneNumber.value,
            password: password.value,
        }),
    }).then(response => {
            if (response.ok) {
                 response.json().then(data => {
                    SuccessDialogVisible.value = true;
                    SuccessMessage.value = data.message ;
                    setTimeout(() => {
                        SuccessDialogVisible.value = false;
                    }, 1000);
                 })
            } else {
                response.json().then(data => {
                    DialogVisible.value = true;
                    errorMessage.value = data.message || 'An error occurred during registration';
                    setTimeout(() => {
                        DialogVisible.value = false;
                    }, 3000);
                });
            }
        }).catch(error => {
            console.error('Error during registration:', error);
        });
}

</script>
<template>
          <ErrorDialog 
            :dialog_visable="DialogVisible" 
            :error_message="errorMessage"
        />
        <SuccssesDialog
        :dialog_visable="SuccessDialogVisible"
        :succsses_message="SuccessMessage"
        />
    <div class="login-container">
        <form @submit.prevent="UserLogin" class="login-form">
            <img src="../../../../public/images/logo.png" class="pen-icon" />
            <p class="login-header"></p>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" id="phone" v-model="phoneNumber" placeholder="ادخل رقم الهاتف" required />
            </div>
            <div class="form-group">
                <label for="pass">كلمة المرور</label>
                <input type="password" id="pass" v-model="password" placeholder="ادخل كلمة المرور" required />
            </div>
            <button type="submit" class="submit-btn">تسجيل الدخول</button>
            <router-link to="/register" class="w-full">
                <button class="create-account-btn" >إنشاء حساب</button>
            </router-link>
        </form>
    </div>
</template>

<style scoped lang="scss">

</style>