<form action="<?= \app\core\createUrl('add_user') ?>" id="usToAdd" class="registration" name="register" method="post">

        <h1>Registration</h1>

        <label for="login">Login </label>
        <input name="userName" class="field" id="login" required/>

        <label for="passWord">Enter your Password</label>
        <input class="field" id="passWord" name="passWord" type="password" required/>

        <label for="confirmPassWord">Confirm the Password</label>
        <input class="field" id="confirmPassWord" name="confirmPassWord" type="password" required/>


        <div class="buttons">
            <input class="button" type="reset" name="reset" value="Reset"/>
            <input class="button" type="submit" name="register" value="Register" form="usToAdd"/>
        </div>
</form>