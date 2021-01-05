class Ajax
{

    constructor(Token)
    {
        this.Token = Token;
        this.domainWithPort = location.protocol+'//'+location.hostname+(location.port ? ':'+location.port: '');
    }

    getMainCategory()
    {
       var statusCode ;
       var data;
       $.ajax({
           async : false ,
           headers: { "Authorization": 'Bearer '+this.Token } ,
           url: this.domainWithPort+'/api/v1/category/getmaincategorylist',
           data: 'data to send',
           success: function (resp) {
               data = resp;
           },
           error: function (error) {
               console.log(error)
               statusCode = error.status
           },
           statusCode: {
               200: function (response) {
                   statusCode = 200 ;
               },
               401: function (response) {
                   statusCode = 401 ;
               }
           }
       });


       if(statusCode == 401)
       {
           window.location.href = domainWithPort+"/v1/auth/login";
       }else if (statusCode == 200){
           return data;
       }


    }

    addCategory(name)
    {
        var data;
        var statusCode ;
            $.ajax({
                type: 'POST',
                async : false ,
                headers: { "Authorization": 'Bearer '+this.Token } ,
                url: "http://127.0.0.1:8000/api/v1/category/addCategory",
                data: 'data to send',
                success: function (resp) {
                    data = resp;
                },
                error: function () {},
                statusCode: {
                    200: function (response) {
                        statusCode = 200 ;
                    },
                    401: function (response) {
                        statusCode = 401 ;
                    }
                }
            });
    }

    checkToken()
    {

        var data;
        var statusCode ;
        $.ajax({
            type: 'POST',
            async : false ,
            headers: { "Authorization": 'Bearer '+this.Token } ,
            url: this.domainWithPort+"/api/v1/user/getuserinfo",
            data: 'data to send',
            success: function (resp) {
                data = resp;
            },
            error: function () {},
            statusCode: {
                200: function (response) {
                    statusCode = 200 ;
                },
                401: function (response) {
                    statusCode = 401 ;
                }
            }
        });


        if(statusCode == 401)
        {
            return false
        }else if (statusCode == 200){
            return true;
        }
    }

}
