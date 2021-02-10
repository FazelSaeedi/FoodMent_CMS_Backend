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


            <div id="restraunt-code" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> کد  </label></div>
                <input  type="text" class="form-control"  placeholder="کد رستوران را وارد کنید" >
            </div>


            <div id="restraunt-name" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> نام  </label></div>
                <input  type="text" class="form-control"  placeholder="نام رستوران را وارد کنید" >
            </div>


            <div id="restraunt-address" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> آدرس </label></div>
                <input  type="text" class="form-control"  placeholder="آدرس رستوران را وارد کنید" >
            </div>

            <div id="restraunt-phone" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> تلفن </label></div>
                <input  type="text" class="form-control"  placeholder="تلفن رستوران را وارد کنید" >
            </div>

            <div id="restraunt-admin" class="form-group" >
                <div style="text-align: center;"><label  style="margin-bottom: 2.0rem;"> مدیر  </label></div>
                <input  type="text" class="form-control"  placeholder="نام مدیر را وارد کنید" >
            </div>

            <div id="restraunt-photo1" class="form-group" >
                <label >عکس اول</label>
                <input type="file" class="form-control-file" >
                <img  src="#/" style="width: 100px; height: 100px">
            </div>

            <div id="restraunt-photo2" class="form-group" >
                <label >عکس اول</label>
                <input type="file" class="form-control-file" >
                <img  src="#/" style="width: 100px; height: 100px">
            </div>

            <div id="restraunt-photo3" class="form-group" >
                <label >عکس اول</label>
                <input type="file" class="form-control-file" >
                <img  src="#/" style="width: 100px; height: 100px">
            </div>



            <button onclick="submitPopup('edit')" id="submit-popup" class="btn btn-default">ثبت</button>

            <div id="error">
            </div>

        </div>

    </div>

</div>




