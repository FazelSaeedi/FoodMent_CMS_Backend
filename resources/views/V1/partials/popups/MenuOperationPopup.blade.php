<!--TypeOperationPopup-->

<style>

    .container-popup-menu{
        position: fixed;
        top: 0;
        bottom: 0;
        z-index: 999999999999999999;
        width: 100%;
        background: rgba(0,0,0,.7);
        width: 100%;
        /* opacity: 0;*/
        -webkit-transition: .5s ease-in-out;
        -moz-transition: .5s ease-in-out;
        -o-transition: .5s ease-in-out;
        transition: .5s ease-in-out;
        overflow: hidden;
        display: none;
        font-family: 'BYekan';

    }

    .content-popups-menu{
        background-color: white;
        transform: translate(-50%, -50%);
        position: absolute;
        top: 50%;
        left: 50%;
        width: 50%;
        height: 70%;
        z-index: 10000!important;
        padding: 50px;
        border-radius: 11px;
        overflow: auto;
    }

    @media (max-width:580px) {
        .content-popups-menu{
            width: 85%;
            height: 80%;
        }
    }

    @media (min-width:1200px){
        .content-popups-menu{
            left: 41%;
            width: 60%;

        }
    }

</style>

<div class="container-popup-menu" >

    <div class="content-popups-menu" dir="rtl">

        <button id="close-popup-menu" type="button" class="close" aria-label="Close" onclick="collapsePopup( 'container-popup-menu' , false)">
            <span style="font-size: 34px;" aria-hidden="true">&times;</span>
        </button>

        <div class="main-content-popup" dir="rtl">

            <h2 id="menu-title-popup" style="text-align: center ; margin-bottom: 2.0rem;"></h2>

            <div id="menu-name" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> نام محصول  </label></div>
                <input  type="text" class="form-control"  placeholder="نام محصول را وارد کنید" >
            </div>

            <div id="menu-price" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> قیمت  </label></div>
                <input  type="text" class="form-control"  placeholder="قیمت محصول را وارد کنید" >
            </div>

            <div id="menu-discount" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> تخفیف  </label></div>
                <input  type="text" class="form-control"  placeholder="تخفیف محصول را وارد کنید" >
            </div>

            <div id="menu-makeups" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> مواد تشکیل دهنده  </label></div>
                <input  type="text" class="form-control"  placeholder="تخفیف محصول را وارد کنید" >
            </div>

            <button  id="submit-popup-menu" class="btn btn-default">ثبت</button>

            <div id="error">
            </div>

        </div>

    </div>

</div>




