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
            gettype : 'gettype'
        },


        auth : {
            login : '/api/v1/user/login'
        },


    }

    Rout( page , aliases )
    {
        return this.Base_URL+this.ROUTS[page][aliases];
    }

}




