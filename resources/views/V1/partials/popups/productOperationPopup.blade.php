<!--TypeOperationPopup-->

<style>

    .container-popup{
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

    .content-popup{
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
        .content-popup{
            width: 85%;
            height: 80%;
        }
    }

    @media (min-width:1200px){
        .content-popup{
            left: 41%;
            width: 60%;

        }
    }

</style>

<div class="container-popup" >

    <div class="content-popup" dir="rtl">

        <button id="close-popup" type="button" class="close" aria-label="Close" onclick="collapsePopup(false)">
            <span style="font-size: 34px;" aria-hidden="true">&times;</span>
        </button>

        <div class="main-content-popup" dir="rtl">

            <h2 id="title-popup" style="text-align: center ; margin-bottom: 2.0rem;"></h2>

            <div id="product-code" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> کد محصول </label></div>
                <input  type="text" class="form-control"  placeholder="کد محصول را وارد کنید" >
            </div>



            <div id="product-name" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> نام محصول </label></div>
                <input  type="text" class="form-control"  placeholder="نام محصول را وارد کنید" >
            </div>


            <div id="type" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> دسته </label></div>
                <input  type="text" class="form-control"  placeholder="نام ماهیت را وارد کنید" >
            </div>


            <div id="mainGroup" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> 'گروه اصلی' </label></div>
                <input  type="text" class="form-control"  placeholder="نام گروه اصلی را وارد کنید" >
            </div>


            <div id="subGroup" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> گروه فرعی </label></div>
                <input  type="text" class="form-control"  placeholder="نام گروه فرعی را وارد کنید" >
            </div>


            <button onclick="submitPopup('edit')" id="submit-popup" class="btn btn-default">ثبت</button>

            <div id="error">
            </div>

        </div>

    </div>

</div>




