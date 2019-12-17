<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>

        </script>
        <style>
        .fakeimg {
          height: 200px;
          background: #aaa;
        }
        </style>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                @foreach($data as $key => $row)
                  <script>
                    function addCommas(nStr){
                       nStr += '';
                       x = nStr.split('.');
                       x1 = x[0];
                       x2 = x.length > 1 ? '.' + x[1] : '';
                       var rgx = /(\d+)(\d{3})/;
                       while (rgx.test(x1)) {
                         x1 = x1.replace(rgx, '$1' + ',' + '$2');
                        }
                      return x1 + x2;
                    }


                    var OpenPrice = {{$row->OpenBit_car}};
                    var ClosePrice = {{$row->CloseBit_car}};

                    if (OpenPrice < ClosePrice) {
                      var Price = ClosePrice;
                    }else {
                      var Price = OpenPrice;
                    }
                    // console.log(Price);


                    function CalculatePlus(){
                        Price += 2000;

                        console.log(Price);
                        document.getElementById('ClosePrice').innerHTML  = addCommas(Price);
                        document.getElementById('ClosePriceShow').value  = addCommas(Price);
                    }

                    function Calculatedelete(){
                        Price -= 2000;

                        console.log(Price);
                        document.getElementById('ClosePrice').innerHTML  = addCommas(Price);
                        document.getElementById('ClosePriceShow').value  = addCommas(Price);
                    }
                  </script>
                  <div class="title m-b-md" id="DivShow">
                    @if($row->CloseBit_car != 0)
                      <p id="ClosePrice" style="text-align: center;font-size: 230px;color: red; background-color: yellow; font-weight: bold;" >{{number_format($row->CloseBit_car)}}</p>
                    @else
                      <p name="ClosePrice" id="ClosePrice" style="text-align: center;font-size: 230px;color: red; background-color: yellow; font-weight: bold;">{{number_format($row->OpenBit_car)}}</p>
                    @endif
                  </div>
                  <form method="get" action="{{ route('Auction') }}">
                    <div class="input-group">
                        <input type="search" name="searchDatacar" class="form-control">
                        <span class="glyphicon glyphicon-trash">
                          <button type="submit" style="width: 150px;height: 40px;" class="delete-modal btn btn-danger btn-sm">ค้นหา</button>
                        </span>
                    </div>
                  </form>
                  <form name="form1" id="form-data" method="post" action="{{ action('AuctionController@update',$row->id) }}">
                    @csrf
                    @method('put')
                    @if($row->CloseBit_car != 0)
                      <input type="hidden" name="ClosePriceShow" id="ClosePriceShow">
                    @else
                      <input type="hidden" name="ClosePriceShow" id="ClosePriceShow">
                    @endif
                    <div class="links">
                      <div class="jumbotron text-center" style="margin-bottom:-80px;margin-top:-45px;">
                        <input type="hidden" name="IDCard" id="IDCard" value="{{$row->IDCard_car}}">
                        <input type="hidden" name="Brandcar" id="Brandcar" value="{{$row->Brand_car}}">
                        <input type="hidden" name="Regiscar" id="Regiscar" value="{{$row->Regis_car}}">
                        <input type="hidden" name="Yearcar" id="Yearcar" value="{{$row->Year_car}}">
                        <input type="hidden" name="Versioncar" id="Versioncar" value="{{$row->Version_car}}">
                        <input type="hidden" name="Notecar" id="Notecar" value="{{$row->Note_car}}">
                        <h1 style="color: red; background-color: yellow; font-weight: bold; padding: 30px;">คันที่ {{$row->IDCard_car}}</h1>
                        <h3>ป้ายทะเบียน {{$row->Regis_car}}</h3>
                        <div class="row">
                          <div class="col-md-6">
                            <h2>ราคาเปิด</h2>
                            <h2><input type="text" id="OpenPriceShow" name="OpenPriceShow" value="{{number_format($row->OpenBit_car)}}"></h2>
                          </div>
                          <div class="col-md-6">
                              @if($row->CloseBit_car != 0)
                                <h2 style="color:red;">ราคาปิด</h2>
                                <h2><input type="text" style="color:red;" value="{{number_format($row->CloseBit_car)}}"></h2>
                              @endif
                          </div>
                        </div>
                        <p>Resize this responsive page to see the effect!</p>
                      </div>

                      <div class="navbar navbar-expand-sm bg-dark navbar-dark">
                        <div class="form-inline">
                          <div class="row">
                            <table border="0">
                              <tr>
                                <td width="600px"></td>
                                <td width="80">
                                  <input type="text" name="Agentcar" id="Agentcar" value="" class="form-control">
                                </td>
                                <td width="80">
                                  <button type="button" id="printRe" class="delete-modal btn btn-danger btn-sm" style="width: 70px;height: 40px;"/>
                                    <span class="glyphicon glyphicon-trash"></span> พิมพ์
                                  </button>
                                </td>
                                <td width="80px">
                                  <button type="button" class="delete-modal btn btn-danger btn-sm" style="width: 70px;height: 40px;" onclick="Calculatedelete();"/>
                                    <span class="glyphicon glyphicon-trash"></span> ลบ
                                  </button>
                                </td>
                                <td width="80px">
                                  <button type="button" class="delete-modal btn btn-danger btn-sm" style="width: 70px;height: 40px;" onclick="CalculatePlus();"/>
                                    <span class="glyphicon glyphicon-trash"></span> เพิ่ม
                                  </button>
                                </td>
                                <td width="80px">
                                  <button type="submit" class="delete-modal btn btn-danger btn-sm" style="width: 70px;height: 40px;">
                                    <span class="glyphicon glyphicon-trash"></span> ถัดไป
                                  </button>
                                </td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>

                  </form>
                @endforeach
                <!-- <button type="button" onclick='window.print();'>print</button> -->

                @if($Countdata == 0)
                  <div class="title m-b-md">
                    บริษัท ชูเกียรติลิสซิ่ง จำกัด
                    <!-- <img class="img-responsive" src="{{ asset('logo.jpg') }}" alt="User Image" style = "width:30%"> -->
                    <div class="form-inline" align="center">
                      <a href="{{ action('AuctionController@index') }}" style="width: 150px;height: 40px;" class="delete-modal btn btn-danger btn-sm">
                        <span class="glyphicon glyphicon-trash"></span> เริ่มประมูลใหม่
                      </a>
                    </div>
                  </div>
                @endif
            </div>
        </div>

        <script type="text/javascript">
          $(document).ready(function() {
            $('#printRe').click(function(event) {
              var price_close = $('#ClosePriceShow').val();
              var price_Open = $('#OpenPriceShow').val();
              var ID_Card = $('#IDCard').val();
              var Brand_car = $('#Brandcar').val();
              var Regis_car = $('#Regiscar').val();
              var Year_car = $('#Yearcar').val();
              var Version_car = $('#Versioncar').val();
              var Note_car = $('#Notecar').val();
              var Agent_car = $('#Agentcar').val();

              // var divToPrint = document.getElementById('container'); // เลือก div id ที่เราต้องการพิมพ์
             	var html =  '<html>'+ //
             				'<head>'+
             					'<link href="css/print.css" rel="stylesheet" type="text/css">'+
             				'</head>'+
             					'<body onload="window.print(); window.close();">' +
                      '<hr />' +
                      '<table border="2" align="center">' +
                        '<tr><td>'+
                          '<table border="0" align="center" width="400px">' +
                          '<tr align="center"><td colspan="4" style="line-height:200%;">บริษัท ชูเกียรติลิสซิ่ง จำกัด</td></tr>' +
                          '<tr align="center"><td colspan="4" style="line-height:200%;">17/8 ม.4 ต.รูสะมิแล อ.เมือง จ.ปัตตานี 94000</td></tr>' +
                          '<tr align="left"><td colspan="4"><hr /></td></tr>' +
                          '<tr align="left"><td colspan="4"><b>ข้อมูลรถ</b></td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">คันที่ :</td><td>' + ID_Card +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ยี่ห้อ :</td><td>' + Brand_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ป้ายทะเบียน :</td><td>' + Regis_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ปีรถ :</td><td>' + Year_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">รายละเอียด :</td><td colspan="4">' + Version_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">หมายเหตุ :</td><td colspan="4">' + Note_car +'</td></tr>' +
                          '<tr align="left"><td colspan="4"><hr /></td></tr>' +
                          '<tr align="left"><td colspan="4"><b>รายละเอียดการประมูล</b></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">หมายเลขผู้ประมูล :</td><td align="center">หมายเลขที่ ' + Agent_car +'</td><td width="50px"></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">ราคาเริ่มต้น :</td><td align="right">' + price_Open +' บาท</td><td width="50px"></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">ราคาชนะประมูล :</td><td align="right">' + price_close +' บาท</td><td width="50px"></td></tr>' +
                          '<tr><td colspan="4"></td></tr>' +
                          '<tr><td width="50px"></td><td width="100px" align="right">ลงชื่อ :</td><td>....................................</td></tr>' +
                          '<tr><td width="50px"></td><td width="100px" align="right"></td><td>(..................................)</td></tr>' +
                          '</table>' +
                        '</td></tr>' +
                      '</table>' +
                      '<hr />' +
                      '<table border="2" align="center">' +
                        '<tr><td>'+
                          '<table border="0" align="center" width="400px">' +
                          '<tr align="center"><td colspan="4" style="line-height:200%;">บริษัท ชูเกียรติลิสซิ่ง จำกัด</td></tr>' +
                          '<tr align="center"><td colspan="4" style="line-height:200%;">17/8 ม.4 ต.รูสะมิแล อ.เมือง จ.ปัตตานี 94000</td></tr>' +
                          '<tr align="left"><td colspan="4"><hr /></td></tr>' +
                          '<tr align="left"><td colspan="4"><b>ข้อมูลรถ</b></td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">คันที่ :</td><td>' + ID_Card +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ยี่ห้อ :</td><td>' + Brand_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ป้ายทะเบียน :</td><td>' + Regis_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">ปีรถ :</td><td>' + Year_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">รายละเอียด :</td><td colspan="4">' + Version_car +'</td></tr>' +
                          '<tr align="left"><td width="50px"></td><td width="100px">หมายเหตุ :</td><td colspan="4">' + Note_car +'</td></tr>' +
                          '<tr align="left"><td colspan="4"><hr /></td></tr>' +
                          '<tr align="left"><td colspan="4"><b>รายละเอียดการประมูล</b></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">หมายเลขผู้ประมูล :</td><td align="center">หมายเลขที่ ' + Agent_car +'</td><td width="50px"></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">ราคาเริ่มต้น :</td><td align="right">' + price_Open +' บาท</td><td width="50px"></td></tr>' +
                          '<tr><td width="50px"></td><td width="150px">ราคาชนะประมูล :</td><td align="right">' + price_close +' บาท</td><td width="50px"></td></tr>' +
                          '<tr><td colspan="4"></td></tr>' +
                          '<tr><td width="50px"></td><td width="100px" align="right">ลงชื่อ :</td><td>....................................</td></tr>' +
                          '<tr><td width="50px"></td><td width="100px" align="right"></td><td>(..................................)</td></tr>' +
                          '</table>' +
                        '</td></tr>' +
                      '</table>' +
                      '</body>'+
             				'</html>';

             	var popupWin = window.open();
             	popupWin.document.open();
             	popupWin.document.write(html); //โหลด print.css ให้ทำงานก่อนสั่งพิมพ์
             	popupWin.document.close();
              event.preventDefault();
            });
          });
        </script>
    </body>

</html>
