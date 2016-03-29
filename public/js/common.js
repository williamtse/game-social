/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function layerLogin() {
    layer.open({
        type: 2,
        title: '登陆',
        shadeClose: true,
        shade: 0.8,
        area: ['400px', '300px'],
        content: '/signup/layerlogin' //iframe的url        
    });
}

function follow(followingId){
    $.ajax({
        url:'/user/follow',
        type:'post',
        data:{followingId:followingId},
        dataType:'json',
        success:function(re){
            if(re.status===503){
                layerLogin();
            }else if(re.status===200){
                history.go(0);
            }else{
                alert(re.message);
            }
        }
    });
}
function unfollow(followingId){
    $.ajax({
        url:'/user/unfollow',
        type:'post',
        data:{followingId:followingId},
        dataType:'json',
        success:function(re){
            if(re.status===503){
                layerLogin();
            }else{
                history.go(0);
            }
        }
    });
}