let Router = {
    domainWithPort: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + '/',
    web: {
        v1: {
            auth: {
                login: 'v1/auth/login',
                register: 'v1/auth/register',
            },
            profile: {
                home: 'v1/profile/home',
                types: 'v1/profile/types',
                maingroups: 'v1/profile/maingroups',
                subgroups: 'v1/profile/subgroups',
                products: 'v1/profile/products',
                restraunts: 'v1/profile/restraunt',
            },
        },
    },


    api: {
        v1: {
            user: {
                login: 'api/v1/user/login',
            },


            category: {
                gettypestable: 'api/v1/category/gettypestable',
                addtype: 'api/v1/category/addtype',
                edittype: 'api/v1/category/edittype',
                deletetype: 'api/v1/category/deletetype',


                getMainGroupTable: 'api/v1/category/getmaingrouptable',
                deleteMainGroupTable: 'api/v1/category/deletemaingroup',
                addMainGroup: 'api/v1/category/addmaingroup',
                editMainGroup: 'api/v1/category/editmaingroup',


                getSubGroupTable: 'api/v1/category/getsubgrouptable',
                deleteSubGroupTable: 'api/v1/category/deletesubgroup',
                addSubGroup: 'api/v1/category/addsubgroup',
                editSubGroup: 'api/v1/category/editsubgroup',

            },

            product: {
                getProduct    : 'api/v1/product/getproducttable' ,
                addProduct    : 'api/v1/product/addproduct' ,
                editProduct   : 'api/v1/product/editproduct' ,
                deleteProduct : 'api/v1/product/deleteproduct' ,
            },


            restraunt: {

            },


            menu: {

            },


            artisan: {

            },

        },
    },
}


function Rout(alias) {
    var prefix = Router.domainWithPort;
    return prefix + alias;
}


