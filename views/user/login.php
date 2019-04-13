
<div style="margin: 0 auto; width: 60%;">
<form method="post" id="form_login">
    <table >

        <tr>
            <td>用户名/邮箱:</td>
            <td ><input type="text" name="User[username]" size="16" maxlength="16"/></td>
        </tr>

        <tr>
            <td>密码 :</td>
            <td ><input type="password" name="User[passwd]"  size="16" maxlength="16"/></td></tr>

            <td colspan=2"><input type="submit" value="登录" onclick="return sub_login();"></td>
        </tr>

    </table>
</form>
</div>
<script>

    function sub_login(){
        var data = $("form").serializeArray();
        $.post('./?c=user&a=login',data,
            function (res){
                if(res.success){
                    alert(res.message);
                    document.getElementById("form_login").reset();
                    location.href = './?c=article&a=lists'
                }else{
                    alert(res.message);
                }
            },'json');

        return false;
    }

</script>