<style>
    #add-img1{
        display: none;
    }
    #add-img2{
        display: none;
    }
    #add-img3{
        display: none;
    }

    .add-restaurant-Popup{
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


    }
    .content-Pupup{
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
        .content-Pupup{
            width: 85%;
            height: 80%;
        }
    }

    @media (min-width:1200px){
        .content-Pupup{
            left: 41%;
            width: 60%;

        }
    }
</style>

<div class="add-restaurant-Popup" >

    <div class="content-Pupup" dir="rtl">
        <button id="close-add-restaurant" type="button" class="close" aria-label="Close">
            <span style="font-size: 34px;" aria-hidden="true">&times;</span>
        </button>
        <div class="container " dir="rtl">
            <h2 style="text-align: center">افزودن رستوران</h2>

                <div class="form-group" id="add-name-input">
                    <label >نام </label>
                    <input id="add-name-restaurant-Popup" type="text" class="form-control"  placeholder="نام  را وارد کنید" >
                    <div class="alert alert-danger" role="alert" style="display:none;">
                        فیلد مورد نظر الزامی است
                    </div>
                </div>

            <div class="form-group" id="add-address-input">
                <label >آدرس</label>
                <input id="add-address-restaurant-Popup" type="text" class="form-control"  placeholder="آدرس را وارد کنید" >
                <div class="alert alert-danger" role="alert" style="display:none;">
                    فیلد مورد نظر الزامی است
                </div>
            </div>

            <div class="form-group" id="add-phone-input">
                <label >شماره تلفن</label>
                <input id="add-phone-restaurant-Popup" type="text" class="form-control"  placeholder="شماره تلفن را وارد کنید" >
                <div class="alert alert-danger" role="alert" style="display:none;">
                    فیلد مورد نظر الزامی است
                </div>
            </div>


            <div class="form-group" id="add-firstFile-input">
                <label >عکس اول</label>
                <input type="file" class="form-control-file" id="add-file1">
                <img id="add-img1" src="#/" style="width: 100px; height: 100px">
                <div class="alert alert-danger" role="alert" style="display:none;">
                    عکس انتخاب شده معتبر نیست
                </div>
            </div>


            <div class="form-group" id="add-secondFile-input">
                <label >عکس دوم</label>
                <input type="file" class="form-control-file" id="add-file2">
                <img id="add-img2" src="#/" style="width: 100px; height: 100px">
                <div class="alert alert-danger" role="alert" style="display:none;">
                    عکس انتخاب شده معتبر نیست
                </div>
            </div>

            <div class="form-group" id="add-thirdFile-input">
                <label >عکس سوم</label>
                <input type="file" class="form-control-file" id="add-file3">
                <img id="add-img3" src="#/" style="width: 100px; height: 100px">
                <div class="alert alert-danger" role="alert" style="display:none;">
                    عکس انتخاب شده معتبر نیست
                </div>
            </div>


            <button id="submit-add-restaurant" class="btn btn-default">ثبت</button>
        </div>

    </div>
</div>



