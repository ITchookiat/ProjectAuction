<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    @php
      function DateThai($strDate){
        $strYear = date("Y",strtotime($strDate))+543;
        $strMonth= date("n",strtotime($strDate));
        $strDay= date("d",strtotime($strDate));
        $strMonthCut = Array("" , "ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $strMonthThai=$strMonthCut[$strMonth];
        return "$strDay $strMonthThai $strYear";
      }
    @endphp

    <style>
      td.container > div {
          width: 100%;
          height: 100%;
          overflow:hidden;
      }
      td.container {
          height: 20px;
      }
    </style>

  </head>
  {{--
    <!-- <h2 class="card-title p-3" align="center">รายงาน ปล่อยงานตาม</h2>
    <h3 class="card-title p-3" align="center">ดิววันที่ {{ DateThai($fdate) }} ถึงวันที่ {{ DateThai($tdate) }} ปล่อยงานตามวันที่ {{ DateThai($date) }}</h3> -->
--}}
    <hr>
  <body>
      <br />

  </body>
</html>
