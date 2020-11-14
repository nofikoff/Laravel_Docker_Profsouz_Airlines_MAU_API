<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
    <div class="header">
        <div>Голові  профспілки ЛЛП </div>
        <div>«Міжнародних авіаліній України»</div>
        <div>Полянському  О.М.</div>
        <div><i><u>@strToPdf($pdf_fio, 60)</u></i></div>
        <div class="caption">(ПІБ повністю)</div>
        <div>____________________________________</div>
        <div style="font-size: 10px">№ телефон<i><u>@strToPdf($pdf_phone, 70)</u></i></div>
        <div>____________________________________</div>
        <div class="small">Паспорт серії <i><u>@strToPdf($pdf_passport_seria, 25)</u></i> № <i><u>@strToPdf($pdf_passport_code, 40)</u></i></div>
        <div class="small">виданий _________________________________</div>
        <div class="caption">(дата)</div>
        <div><i><u>@strToPdf($pdf_extradited, 65)</u></i></div>
        <div class="caption">(ким виданий)</div>
        <div class="small">ідентифікаційний код <i><u>@strToPdf($pdf_identification, 30)</u></i></div>
    </div>

    <br><br>
    <div class="title">ЗАЯВА</div>
    <br><br><br>

    <div class="content">
        <div class="paragraph">Прошу  надати  мені   грошову  допомогу  в зв’язку</div>
        <div class=""><u>@strToPdf($title, 100)</u></div>
        <div class="">_____________________________________________________________________________</div>
        <div class="">Грошову  допомогу прошу  перерахувати  на  картковий рахунок</div>
        <div class=""><i><u>@strToPdf($pdf_identification, 110)</u></i>,  відкритий</div>
        <div class="">в банк <i><u>@strToPdf($pdf_bank, 110)</u></i></div>
        <div class="">р\р <i><u>@strToPdf($pdf_rr, 80)</u></i> МФО <i><u>@strToPdf($pdf_mfo, 20)</u></i> ЭДРПОУ</div>
        <div class=""><i><u>@strToPdf($pdf_edrpoy, 80)</u></i></div>
    </div>

    <div class="footer">
        <span class="left">Дата</span>
        <p class="right" dir="rtl">Підпис</p>
    </div>
</div>
</body>
</html>

<style>
    div {
        font-size: 14px;
    }

    .footer {
        margin-top: 100px;
        margin-left: 100px;
        margin-right: 100px;
    }

    .footer div {
        display: inline-block;
    }

    .right {
        margin-top: -16px;
    }

    .left {
        margin-left: 100px;
    }

    .content {
        text-align: left;
        margin-left: 70px;
    }

    .container {
        width: 600px;
    }

    .header{
        margin-left: 325px;
    }

    .title {
        text-align: center;
        font-size: 14px;
    }

    .small {
        font-size: 12px;
    }

    .caption {
        text-align: center;
        font-size: 10px;
    }

    .paragraph {
        margin-left: 30px;
    }
</style>