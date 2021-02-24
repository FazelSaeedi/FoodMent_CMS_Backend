class Router
{
    constructor(Base_URL) {
        this.Base_URL = Base_URL;
    }

    ROUTS = {

        home :{
            home : '/v1/profile/home',
        } ,


        type : {
            gettypestable : '/api/v1/category/gettypestable/',
            addtype : '/api/v1/category/addtype' ,
            edittype : '/api/v1/category/edittype' ,
            deletetype: '/api/v1/category/deletetype' ,
        },


        auth : {
            APIlogin : '/api/v1/user/login' ,
            login : '/v1/auth/login'
        },


    }

    Rout( page , aliases )
    {
        return this.Base_URL+this.ROUTS[page][aliases];
    }

}




