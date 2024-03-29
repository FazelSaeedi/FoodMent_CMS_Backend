class Cookie
{

    domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');

    logout()
    {
        this.delete_cookie('token');
        this.delete_cookie('menuActive');
        window.location = Rout(Router.web.v1.auth.login);
    }



    delete_cookie(name)
    {
         document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }



    setCookie(name , value , expire)
    {
        var d = new Date();
        d.setTime(d.getTime() + (expire*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = name + "=" + value + ";" + expires + ";path=/";
    }



    getCookie(cname)
    {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }


    setObjectLocalStorage(key , value)
    {
        localStorage.setItem(key, JSON.stringify(value));
    }


    getObjectLocalStorage(key)
    {

        var retrievedObject = localStorage.getItem(key);
        var json = JSON.parse(retrievedObject);

        return json
    }


}
