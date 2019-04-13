
<div style="margin: 0 auto; width: 60%;">
<form method="post" id="form_reg">
    <table >

        <tr>
            <td>用户名:</td>
            <td ><input type="text" name="User[username]" size="16" maxlength="16"/></td>
        </tr>
        <tr>
            <td>邮箱:</td>
            <td><input type="text" name="User[email]" size="30" maxlength="100"/></td>
        </tr>
        <tr>
            <td>密码 :</td>
            <td ><input type="password" name="User[passwd]"  size="16" maxlength="16"/></td></tr>

            <td colspan=2"><input type="submit" value="注册" onclick="return sub_reg();"></td>
        </tr>

    </table>
</form>
</div>
<script>

    function sub_reg(){
        var data = $("form").serializeArray();
        console.log(data);
        $.post('./?c=user&a=reg',data,
            function (res){
                //console.log(res);
                if(res.success){
                    alert(res.message);
                    document.getElementById("form_reg").reset();
                    location.href = './?c=article&a=lists'
                }else{
                    alert(res.message);
                }
            },'json');

        return false;
    }

</script>