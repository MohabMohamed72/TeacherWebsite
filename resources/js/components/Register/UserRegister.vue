<script setup lang="ts">
import { ref } from 'vue';
import LoginPenIcon from '../Icons/LoginPenIcon.vue';

const password = ref('');
const phoneNumber = ref('');
const name = ref('');
const age = ref('');
const level = ref('');
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
            name: name.value,
            age: age.value,
            level: level.value,
        }),
    })
}

</script>
<template>
    <div class="login-container">
        <form @submit.prevent="UserRegister" class="login-form">
            <LoginPenIcon class="pen-icon" />
            <p class="login-header">منصة النبراس</p>
            <div class="form-group">
                <label for="phone">رقم الهاتف</label>
                <input type="text" id="phone" v-model="phoneNumber" placeholder="ادخل رقم الهاتف" required />
            </div>
            <div class="form-group">
                <label for="pass">كلمة المرور</label>
                <input type="text" id="pass" v-model="password" placeholder="ادخل كلمة المرور" required />
            </div>
            <div class="form-group">
                <label for="name">اسم المستخدم</label>
                <input type="text" id="name" v-model="name" placeholder="ادخل اسم المستخدم" required />
            </div>
            <div class="form-group">
                <label for="age">السن</label>
                <input type="text" id="age" v-model="age" placeholder="ادخل سنك" required />
            </div>
            <div class="form-group">
                <label for="level">المرحلة</label>
                <input type="text" id="level" v-model="level" placeholder="ادخل المرحلة" required />
            </div>
            <button type="submit" class="submit-btn">تسجيل الدخول</button>
        </form>
    </div>
</template>

<style scoped lang="scss">
.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 110vh;
    background-color: #00ceb9;
    .login-form{
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: center;
        background-color:white;
        width: 50%;
        // height: 50%;
        border-radius: 15px;
        padding: 20px;
        gap: 20px;
        position: relative;
        box-shadow: 26px 13px 19px 0px #00000038;
        .login-header{
            width: 100%;
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
            font-weight: 700;
            color:#8a8a8a;
        }
        .pen-icon {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%);
         
        }
        .form-group{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items:flex-end ;
            width:100% ;
            gap: 6px;

            label{
                color:#8a8a8a;

            }

            input{
                text-align: right;
                background-color: #d3d3d3;
                border: none;
                padding: 10px;
                border-radius: 10px;
                width: 100%;

                &::placeholder{
                    color:#ababab;
                }

                &:focus{
                    outline: none;
                }
            }
        }
        .submit-btn{
            margin-top: 20px;
            width: 100%;
            padding: 10px;
            border-radius: 10px;
            background-color: #ffd202;
            color: white;
            cursor: pointer;

            &:hover{
                background-color: #f0c40084;
            }
        }
    }
}
</style>