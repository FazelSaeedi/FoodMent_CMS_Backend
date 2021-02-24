class Router
{
    constructor(Base_URL) {
        this.Base_URL = Base_URL;
    }

    ROUTS = {

        type : {
            gettype : 'gettype'
        }

    }

    Rout( page , aliases )
    {
        return this.Base_URL+this.ROUTS[page][aliases];
    }

}




