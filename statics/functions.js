function deleteAllCookies() {
    document.cookie.split(";").forEach(function(cookie) {
        let name = cookie.split("=")[0].trim();
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
    });
}


function redirect($dst){
    window.location.href = $dst;
}