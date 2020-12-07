<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> -->

    <title>Certificate</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/certificate/styles/style.css') }}">
</head>

<body id="loader">
    <div class="c-overlay" id="overlay"></div>
    <div class="certificate" id="widget">
        <div class="border"></div>
        <div class="content">
            <!-- <span>تجربه</span> -->
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <img class="logo" src="{{ url('/certificate/img/iprotect.svg') }}" alt="">
                </div>
                <div class="col-md-4">
                    <img class="egypt" src="{{ url('/certificate/img/egypt.png') }}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="title center-div-ar">
                    <img class="title-left" src="{{ url('/certificate/img/title-left.svg') }}" alt="">
                    <span class="text">شهادة إثبات ملكية فكرية</span>
                    <img class="title-right" src="{{ url('/certificate/img/title-right.svg') }}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="cer-ar">
                    <span class="center-ar">بعد الاطلاع على المادة ٣٦١ من قانون حمایة المستند الالكترونى الصادر</span>
                    <div class="spacer"></div>
                    <span class="center-ar">بالقانون رقم ١٥ لسنة ٢٠٢٠ وعلى طلب حق الملكیة الفكریة المقدم تحت رقم .......
                        فى ٢٠٢٠</span>
                    <div class="spacer"></div>
                    <span class="center-ar">والمستندات الملحقه به</span>
                    <div class="spacer"></div>
                    <span class="center-ar">تثبت ملكیة المحتوى تحت رقم ....... إلى</span>
                    <div class="spacer"></div>
                    <span class="center-ar">الإسم : <b>{{$certificate->user->first_name}} {{$certificate->user->middle_name}} {{$certificate->user->last_name}}</b> </span>
                    <div class="spacer"></div>
                    <span class="center-ar">رقم القومى : <b>{{$certificate->user->id_number}}</b> </span>
                    <div class="spacer"></div>
                    <span class="center-ar">عن <b>عمل فني/تصميم</b> </span>
                    <div class="spacer"></div>
                    <span class="center-ar">وتم تسمیته من قبل مقدم الطلب تحت اسم</span>
                    <div class="spacer"></div>
                    "<span class="center-ar"><b>{{$certificate->title}}</b></span>"
                    <div class="spacer"></div>
                </div>
            </div>
            <div class="row" style="margin-top: 20px">
                <div class="title center">
                    <img class="title-left" src="{{ url('/certificate/img/title-left.svg') }}" alt="">
                    <span class="text">Certificate of intellectual property</span>
                    <img class="title-right" src="{{ url('/certificate/img/title-right.svg') }}" alt="">
                </div>
            </div>
            <div class="row">
                <div class="cer-ar center">
                    <p>After reviewing Article (Article No.) of the Electronic Document Protection Law</p><br>
                    <p>promulgated by Law No. ... for year 2000 and the request for intellectual property</p><br>
                    <p>right submitted under No. ....... in 2020 and the documents attached thereto</p><br>
                    <p>The ownership of the content is proven under no ....... belongs to:</p><br>
                    <p>Name: <b>{{$certificate->user->first_name}} {{$certificate->user->middle_name}} {{$certificate->user->last_name}}</b></p><br>
                    <p>National ID: <b>{{$certificate->user->id_number}}</b></p><br>
                    <p>For <b>Artwork/Concept design</b></p><br>
                    <p>And it was named by the applicant under the name</p> <br>
                    <p><b>"{{$certificate->title}}"</b></p>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="row">
                <div class="col-md-5">
                    <div class="signature">
                        <img src="{{ url('/certificate/img/footer.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="qrcode-details">
                        <p class="ar">هذا الكود يحتوي على بيانات الختم الزمني للملف التشفير الخاص بتكنولوجي البلوك شين</p>
                        <p>This QR code contains the encryption information of the certificate using block
                            ￼chain technology</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="qrcode" class="qrcode"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- <button id="btnSave">Save</button>
    <div id="img-out"></div> --}}
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"
    integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg=="
    crossorigin="anonymous"></script>
    <script src="{{ url('/certificate/js/jq-loading.min.js') }}"></script>
<!-- <script src="/certificate/js/html2canvas.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://github.com/niklasvh/html2canvas/releases/download/0.4.1/html2canvas.js"></script>
<script src="{{ url('/certificate/js/jquery-qrcode-0.18.0.min.js') }}"></script>
<script src="{{ url('/certificate/js/main.js') }}"></script>

</html>
