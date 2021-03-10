let Router = {
    domainWithPort: location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + '/',
    web: {
        v1: {
            auth: {
                login:      'v1.0/auth/login'           ,
                register:   'v1.0/auth/register'        ,
            },
            profile: {
                home:       'v1.0/profile/home'         ,
                types:      'v1.0/profile/types'        ,
                maingroups: 'v1.0/profile/maingroups'   ,
                subgroups:  'v1.0/profile/subgroups'    ,
                products:   'v1.0/profile/products'     ,
                restraunts: 'v1.0/profile/restraunt'    ,
            },
        },
    },


    api: {
        v1: {
            user: {
                login                      :   'api/v1.0/user/login'                                                 ,
                getUserTable               :   'api/v1.0/user/getusers'                                              ,
                getuserinfo                :   'api/v1.0/user/getuserinfo'                                           ,
            },


            category: {

                gettypestable              :   'api/v1.0/category/gettypestable'                                     ,
                addtype                    :   'api/v1.0/category/addtype'                                           ,
                edittype                   :   'api/v1.0/category/edittype'                                          ,
                deletetype                 :   'api/v1.0/category/deletetype'                                        ,


                getMainGroupTable          :   'api/v1.0/category/getmaingrouptable'                                 ,
                deleteMainGroupTable       :   'api/v1.0/category/deletemaingroup'                                   ,
                addMainGroup               :   'api/v1.0/category/addmaingroup'                                      ,
                editMainGroup              :   'api/v1.0/category/editmaingroup'                                     ,


                getSubGroupTable           :   'api/v1.0/category/getsubgrouptable'                                  ,
                deleteSubGroupTable        :   'api/v1.0/category/deletesubgroup '                                   ,
                addSubGroup                :   'api/v1.0/category/addsubgroup'                                       ,
                editSubGroup               :   'api/v1.0/category/editsubgroup'                                      ,

            },

            product: {

                getProduct                 :   'api/v1.0/product/getproducttable'                                    ,
                addProduct                 :   'api/v1.0/product/addproduct'                                         ,
                editProduct                :   'api/v1.0/product/editproduct'                                        ,
                deleteProduct              :   'api/v1.0/product/deleteproduct'                                      ,
                getProductName             :   'api/v1.0/product/getproductlist'                                     ,
                getProductPhoto            :   'images/{restrauntId}/food/' +
                                                         '{ProductMenuId}/{bannernumber}.jpg'                        ,
            },


            restraunt: {

                getRestrauntphoto          :   'images/{restrauntId}/banner/banner{bannernumber}.jpg'                ,
                getRestrauntTable          :   'api/v1.0/restraunt/getrestraunttable'                                ,
                editRestraunt              :   'api/v1.0/restraunt/editrestraunt'                                    ,
                deleteRestraunt            :   'api/v1.0/restraunt/deleterestraunt'                                  ,
                addRestraunt               :   'api/v1.0/restraunt/addrestraunt'                                     ,

            },


            menu: {
                getMenuRestraunt           :   'api/v1.0/menu/getmenutable/{restrauntid}/{paginationnumber}'         ,
                addRestrauntMenu           :   'api/v1.0/menu/addmenuproduct'                                        ,
                editMenuRestraunt          :   'api/v1.0/menu/editmenuproduct'                                       ,
                deleteMenuProduct          :   'api/v1.0/menu/deletemenuproduct'                                     ,
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


