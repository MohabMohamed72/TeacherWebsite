    <script setup lang="ts">
    import { ref, watch } from 'vue';
    import LoginPenIcon from '../Icons/LoginPenIcon.vue';
    import { useRouter } from 'vue-router';
    import ErrorDialog from '../Dialogs/ErrorDialog.vue';
import SuccssesDialog from '../Dialogs/SuccssesDialog.vue';

    const router = useRouter();
    const password = ref('');
    const password_confirm = ref('');
    const phoneNumber = ref('');
    const name = ref('');
    const age = ref('');
    const level = ref('');
    const DialogVisible = ref(false);
    const errorMessage = ref('An error occurred during registration');
    const SuccessDialogVisible = ref(false);
    const SuccessMessage = ref('Registration successful');
    const rememberMe = ref(false);

    const UserRegister = async ()=>{
        await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                phone_number: phoneNumber.value,
                password: password.value,
                password_confirmation: password_confirm.value,
                name: name.value,
                age: age.value,
                level: level.value,
            }),
        }).then(response => {
            if (response.ok) {
                 response.json().then(data => {
                    SuccessDialogVisible.value = true;
                    SuccessMessage.value = data.message ;
                    setTimeout(() => {
                        SuccessDialogVisible.value = false;
                        router.push('/'); 
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
        <div class="login-container reg-container">
            <form @submit.prevent="UserRegister" class="login-form">
                <img src="../../../../public/images/logo.png" class="pen-icon" />

                <p class="login-header"></p>
                <div class="form-group">
                    <label for="name">اسم المستخدم</label>
                    <input type="text" id="name" v-model="name" placeholder="ادخل اسم المستخدم" required />
                </div>
                <div class="form-group">
                    <label for="phone">رقم الهاتف</label>
                    <input type="text" id="phone" v-model="phoneNumber" placeholder="ادخل رقم الهاتف" required />
                </div>
                <div class="form-group">
                    <label for="pass">كلمة المرور</label>
                    <input type="password" id="pass" v-model="password" placeholder="ادخل كلمة المرور" required />
                </div>
                <div class="form-group">
                    <label for="pass-confirm">تأكيد كلمة المرور</label>
                    <input type="password" id="pass-confirm" v-model="password_confirm" placeholder="ادخل تأكيد كلمة المرور" required />
                </div>
                <div class="form-group">
                    <label for="age">السن</label>
                    <input type="text" id="age" v-model="age" placeholder="ادخل سنك" required />
                </div>
                <div class="form-group">
                    <label for="level">المرحلة</label>
                    <select v-model="level" id="level">
                        <option value="1">الصف الاول الثانوى</option>
                        <option value="2">الصف الثانى الثانوى</option>
                        <option value="3">الصف الثالث الثانوى</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">تسجيل الدخول</button>
            </form>
        </div>
    </template>

    <style scoped lang="scss">

    </style>