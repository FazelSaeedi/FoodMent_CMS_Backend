class Cookie
{
     test()
     {
         alert("salam")
     }

     logout()
     {
         this.delete_cookie('token');
         window.location = 'http://127.0.0.1:8000/v1/auth/login';
     }


     delete_cookie(name)
     {
         document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
     }


}
