function makeAlert(msg,duration)
{
    var el = document.createElement("div");
    el.setAttribute("style","position:fixed;bottom:2%;left:2%;z-index:9999999");
    el.innerHTML = '<div class="alert alert-danger alert-dismissible" style=" z-index: 0;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <strong>Error!! </strong><br/>'+msg+'</div>';
   setTimeout(function(){
        el.parentNode.removeChild(el);
    },duration);
    document.body.appendChild(el);
}

function makeSAlert(msg,duration)
{
    var el = document.createElement("div");
    el.setAttribute("style","position:fixed;bottom:2%;left:2%; width:20%");
    el.innerHTML = '<div class="alert alert-success alert-dismissible" style=" z-index: 0;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><i class="fa fa-check" aria-hidden="true"></i> <strong>Success!! </strong><br/>'+msg+'</div>';
    setTimeout(function(){
        el.parentNode.removeChild(el);
    },duration);
    document.body.appendChild(el);
}

function makeSAlertright(msg,duration)
{
    var el = document.createElement("div");
    el.setAttribute("style","position:fixed;bottom:2%;right:2%; width:20%");
    el.innerHTML = '<div class="alert alert-success" style=" z-index: 1;"><i class="fa fa-check" aria-hidden="true"></i> <strong>Success!! </strong>'+msg+' .</div>';
    setTimeout(function(){
        el.parentNode.removeChild(el);
    },duration);
    document.body.appendChild(el);
}

function checkpass(str,min,max,nonum,noletter,special) {
    if (str.length < min) {
        return("mật khẩu quá ngăn");
    } else if (str.length > max) {
        return("mật khẩu quá dài");
    } else if (str.search(/\d/) == nonum) {
        return("mật khẩu không có số");
    } else if (str.search(/[a-zA-Z]/) == noletter) {
        return("mật khẩu không có chữ");
    } else if (str.search(/[^a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+]/) == special) {
        return("mật khẩu chứa kí tự đặc biệt");
    }
    return("ok");
}