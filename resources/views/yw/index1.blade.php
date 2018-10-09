<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">

    <script type="text/javascript" src="{{ asset('yw/js/rem.js?v=1') }}"></script>
    <link rel="stylesheet" href="{{ asset('yw/css/style3.css?v=1') }}">
    <title>亚威智云工业互联网平台</title>
    <link rel="stylesheet" href="{{ asset('yw/css/index.css?v=1') }}">
    <style>
        .nav {height:5%;line-height:5%;width:100%;background:#121d2c;}
        .nav ul {height:73%;line-height:100%;width:800px;margin:0 auto;}
        .nav ul li {height:100%;line-height:100%;width:200px;display:inline-block; float:left;font-size:14px;font-weight:bold;text-align:center;}
        .nav ul li:hover {background:#2096e8;}
        .nav ul li.selected {background:#2096e8;}
        .nav ul li a {display:inline-block;width:100%;padding-top: 0.08rem;color:#ccdafd;text-decoration:none;}
    </style>
{{--    <script src="../../../../../../Applications/MAMP/htdocs/suxin/public/yw/js/config.js"></script>--}}
</head>

<body style="visibility: hidden;">
<div class="nav">
    <ul>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywIndex' ?>">首页</a></li>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywAlgorithm' ?>">机器学习</a></li>
        <li class="selected"><a href="#">设备管理</a></li>
        <li><a href="#">系统管理</a></li>
    </ul>
</div>
<div class="container-flex1" tabindex="0" hidefocus="true">
    <div class="box-left">
        <div class="left-top-first"></div>
    </div>
    <div class="box-center">
        <div class="center-top">
            <h1>亚威智云工业互联网平台</h1>
        </div>
    </div>
    <div class="box-right">
        <div class="right-top-first"></div>
    </div>
</div>

<div class="container-flex2" tabindex="0" hidefocus="true">
    <div class="left">
        <div style="height: 45%">
            <div class="title-box">
                <h6 >设备列表</h6>
            </div>
            <div class="box-4-4">
                <table>
                    <tr>
                        <th>序号</th>
                        <th>编号</th>
                        <th>类型</th>
                        <th>型号</th>
                        <th>客户</th>
                        <th>厂家</th>
                    </tr>
                    <tr >
                        <td><a href="">1</a></td>
                        <td>YW172891</td>
                        <td>数控转塔冲床</td>
                        <td>HBE3058</td>
                        <td>江苏卓岸</td>
                        <td>亚威</td>
                    </tr>
                    <tr style="border:1px solid #f5b033;">
                        <td><a href="">2</a></td>
                        <td>YW171214</td>
                        <td>数控折弯机</td>
                        <td>PBC-160/4100</td>
                        <td>南京天加</td>
                        <td>亚威</td>
                    </tr>
                    <tr>
                        <td><a href="">3</a></td>
                        <td>YW180100</td>
                        <td>数控折弯机</td>
                        <td>PBH-160/3100</td>
                        <td>太苍锦捷</td>
                        <td>亚威</td>
                    </tr>
                    <tr>
                        <td><a href="">4</a></td>
                        <td>YW171112</td>
                        <td>数控折弯机</td>
                        <td>PBH-160/3100</td>
                        <td>东华宏泰</td>
                        <td>亚威</td>
                    </tr>
                    <tr>
                        <td><a href="">5</a></td>
                        <td>YW152007</td>
                        <td>数控转塔冲床</td>
                        <td>HPE3048</td>
                        <td>青岛锐德</td>
                        <td>亚威</td>
                    </tr>
                    <tr>
                        <td><a href="">6</a></td>
                        <td>GM050-01</td>
                        <td>数控立式车床</td>
                        <td>VL-125c</td>
                        <td>江苏和阳</td>
                        <td>高明</td>
                    </tr>
                    <tr>
                        <td><a href="">7</a></td>
                        <td>YWL-1517</td>
                        <td>数控激光切割机</td>
                        <td>HLCP-1530</td>
                        <td>武进恒丰</td>
                        <td>亚威</td>
                    </tr>
                    <tr>
                        <td><a href="">8</a></td>
                        <td>YW170707</td>
                        <td>数控折弯机</td>
                        <td>PBA-50/2050</td>
                        <td>深圳利业</td>
                        <td>亚威</td>
                    </tr>

                </table>
            </div>
        </div>
        <div style="height: 25%">

            <div class="box-4-3">
                <h2 >设备状态</h2>
                <table>
                    <tr>
                        <th>设备状态</th>
                        <th>检测部件</th>
                        <th>振动</th>

                    </tr>
                    <tr>
                        <td><img src="{{ asset('yw/images/zt.png')}}" style="width: 10px;padding-bottom: 3px;">运行</td>
                        <td>油缸</td>
                        <td id="acc">200</td>
                    </tr>

                </table>
                <table>
                    <tr>
                        <th>油温（℃）</th>
                        <th>健康诊断</th>
                        <th>预计寿命（天）</th>
                    </tr>
                    <tr>

                        <td>38</td>
                        <td id="gl">98%</td>
                        <td id="day">3650</td>

                    </tr>
                </table>
            </div>

            <div class="box-4-3">
                <h2 >报警统计</h2>
                <table>
                    <tr>
                        <th>编号</th>
                        <th>信息</th>
                        <th>次数</th>
                        <th>详情</th>
                    </tr>
                    <tr>
                        <td>14015</td>
                        <td>轴3正限位报警</td>
                        <td>2</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>11024</td>
                        <td>轴1跟随误差报警</td>
                        <td>3</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>24010</td>
                        <td>后挡料未到位</td>
                        <td>5</td>
                        <td>...</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="height: 30%">
            <div id="gdMap" class="gd-map"></div>
        </div>
    </div>
    <div class="center">
        <div style="height: 35%">
            <div class="title-box">
                <h6>设备预警</h6>
            </div>
            <div class="box-4-2">
                <table>
                    <tr>
                        <th>设备编号</th>
                        <th>检测部件</th>
                        <th>故障概率</th>
                        <th>预计寿命（月）</th>
                        <th>操作</th>
                    </tr>
                    <tr style="background-color: #451c2a">
                        <td>YW150401</td>
                        <td>滑块</td>
                        <td>96.5%</td>
                        <td>2</td>
                        <td>处理</td>
                    </tr>
                    <tr style="background-color: #451c2a">
                        <td>YW131216</td>
                        <td>丝杆</td>
                        <td>93.6%</td>
                        <td>2.5</td>
                        <td>处理</td>
                    </tr>
                    <tr style="background-color: #451c2a">
                        <td>YW160118</td>
                        <td>齿轮齿条</td>
                        <td>94.7%</td>
                        <td>2.8</td>
                        <td>处理</td>
                    </tr>
                    <tr style="background-color: #444229">
                        <td>YW100704</td>
                        <td>滑块</td>
                        <td>94.5%</td>
                        <td>3</td>
                        <td>处理</td>
                    </tr>
                    <tr style="background-color: #444229">
                        <td>YW150715</td>
                        <td>丝杆</td>
                        <td>91.1%</td>
                        <td>3.5</td>
                        <td>处理</td>
                    </tr>
                    <tr style="background-color: #444229">
                        <td>YW141101</td>
                        <td>滑块</td>
                        <td>93.3%</td>
                        <td>3.8</td>
                        <td>处理</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="height: 65%">
            <div id='main' style="height: 7rem;"></div>
        </div>
    </div>

</div>

</body>
<script type="text/javascript" src="{{ asset('yw/js/jquery-3.3.1.min.js?v=1') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/layer.min.js?v=1') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/laydate/laydate.js?v=1') }}"></script>
<script type="text/javascript" src="{{ asset('yw/echarts.min.js?v=1') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/china.js?v=1') }}"></script>

<script src="{{ asset('yw/js/esl.js?t=1') }}"></script>
<script type="text/javascript">
    $('document').ready(function () {
        $("body").css('visibility', 'visible');
        var localData = [$('#teacher').val(), $('#start').val() + '/' + $('#end').val(), $('#leader').val()]
        localStorage.setItem("data", localData);
        $('#conBtn').on('click', function () {
            localData = [$('#teacher').val(), $('#start').val() + '/' + $('#end').val(), $('#leader').val()]
            if (typeof (Storage) !== "undefined") {
                localStorage.setItem("data", localData);
                var arr = localStorage.getItem("data").split(',');
                $('#name_a').html(arr[0]);
                $('#date_a').html(arr[1]);
                $('#lea_a').html(arr[2]);
            }
        })
        $('#fangda').on('click', function () {
            if ($(this).siblings('ul').is(":hidden")) {
                $(this).addClass('active').siblings('ul').show();
            } else {
                $(this).removeClass('active').siblings('ul').hide();
            }
        })

        $('.modal-btn>li').on('click', function () {
            var index = $(this).index();
            if (index <= 2) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(index).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
            } else if (index > 2 && index < 5) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(3).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
                if (index != 3) {
                    $('.pop-data .ranking-box').hide();
                } else {
                    $('.pop-data .ranking-box').show();
                }
                $('.cont-div').eq(index - 3).attr('style', 'visibility: visible').siblings('.cont-div').attr('style', 'visibility: hidden');
            } else if (index == 5) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(3).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
                $('.pop-data .ranking-box').hide();
                if ($('#switchBtn').find('.active').data('datatype') == "income") {
                    $('#titles').html('收入数据');
                    $('#totalProfits').html('123,456.5元');
                    $('.cont-div').eq(2).attr('style', 'visibility: visible').siblings('.cont-div').attr('style', 'visibility: hidden');
                } else if ($('#switchBtn').find('.active').data('datatype') == 'expend') {
                    $('#titles').html('支出数据');
                    $('#totalProfits').html('32,111.4元');
                    $('.cont-div').eq(2).attr('style', 'visibility: visible').siblings('div').attr('style', 'visibility: hidden');
                }
            }
        })
    })
</script>
<script>
    require.config({
        paths: {
            'geoJson': '../geoData/geoJson',
            'theme': '../theme',
            'data': './data',
            'map': '../map',
            'extension': '../extension'
        },
        packages: [
            {
                main: 'echarts',
                location: '{{ asset('yw/js/echarts')}}',
                name: 'echarts'
            },
            {
                main: 'zrender',
                location: '{{ asset('yw/js/zrender')}}',
                name: 'zrender'
            }
        ]
        // urlArgs: '_v_=' + +new Date()
    });
    </script>
<script>

    require([
        'echarts',
        'echarts/chart/scatter',
        'echarts/chart/effectScatter',
        'echarts/component/legend',
        'echarts/component/geo'
    ], function (echarts) {

        var data = [
            {name: '南京', value: 100},
            {name: '徐州', value: 43},
            {name: '连云港', value: 30},
            {name: '宿迁', value: 53},
            {name: '淮安', value: 92},
            {name: '盐城', value: 63},
            {name: '扬州', value: 98},
            {name: '泰州', value: 83},
            {name: '镇江', value: 46},
            {name: '常州', value: 58},
            {name: '苏州', value: 96},
            {name: '南通', value: 60},
            {name: '无锡', value: 56}
        ];

         $.get('{{ asset('yw/js/echarts/map/json/province/jiangsu.json?t=123')}}', function (jiangsuJson) {
       /* var jiangsuJson = {"type":"FeatureCollection","features":[{"id":"320100","geometry":{"type":"MultiPolygon","coordinates":[["@@IIOWECG@CBCDBHFJRTLFJ@DABAAE","@@HJFBDDH@DABEAUCCC@AAACDCJ@DAAK@ETCBDFBDA@IBAJBHF@BHFdDBBAJB@HGF@FDAFDFFBP@LDLFDE@ESICGC@BQDQC@EDKI@CFCP@FB@DDDD@@KREB@BNLBA@B@BADBHADBDABBF@BGFKpiFGBQNOJEd@LHFDBJL@DBJFTETBDADYDGJKZOBE@KDCAIBIDCA@CAIBADI@MAWUIFEBG@ACAYLODG@AIIAGC@GCCI@QBKJEBINGD@HDD@BG@GEAY@EA@EDA\\IPKGEGKKCEE@EDEZWBAIK@YCIHK@EEKFIBGAKBEBICKCEAEFEdIdEJINGlFrDlCpIªaZKKK]SCCAKCCMCYGK@MJWEQAM@QFQHGBUGIGG@{OOBCEFAEIAQ_@QAYIMMBEIGMYIAIE@KECBCH@@AB@@BFABAFDBAJBLCL@DCJ@ECB@ACFD@CB@@BBAADF@DGACJ@DCXLN@HADMJOFEJFF@DABECaIWMMBOJO@KFGAMDEDMKMBCP@DFTIBCBWNC@ME@EDC@ACCQEGC@E@EDSNO@OIGFKBWGMAIIMAKIBMPWREL@FHNAJBTEPALIVDJGFKBYFGCIBAJC@KCIMEIM@KCKGEGEgHCBEHYQUCCIU@MOK@I@W@MEABE@YCAA@EACM@CCDGDAEGBAPCDCLEFID@BGLOF@JE@IDAKQaBEAAKBEEMAABA@AHANBJHFABADFHPBBF@LGDHJ@PLJANJ\\@VMF@BDN@DCCKBCP@HGHMBMFCPEHBDACIDCHGLCHEJYBAR@FILIDGBKJDDITADAD@FAH@NCBAHM@GEKAKBIDAFKCGGGBEdCDE@MJG@IBAH@LFJ@LDBIGOAOMaKS@IDIEIQO@IAAOIQACCBECEIIAWZEHCBAEECECEGEAKEEK@KEAEGA[@EGAE@ENG@IEUGMOKAEBGNAJGFAHDJ@HWBO@wFQDGR@H@FCVUDGDMTCFEDE@ACAQMSUCOGGBCDE@IMAAC@GOCEECGOASDKSCOQAGQIGQCG@MGKMC_YDIDCDCAEIGEEBKJKBECGEK@MDEFECC@KDKAGHG@WOWGIBENCBICQBW@G@GCC@QHY@EDCDIBWKKAM@eDEF_EE@OGE@GC@CIEMBKLGAKACGGCCBK@CFOHGHELDRAJGJIHSTKDkDI@CBg\\OHDDFB^QDzB@DFDLR\\VxRZVFDGFIBEAKEKBADA^LLBTAVFRHHJZHVTD@BC^nJNCDClJfN`LdDdB\\EHGBKA@LDN@PBJLPMLCH@HFPBHCBSBGBBDPHCZIFKTG@K@MHOD[CBIKGSACBMRKDDJINDJADIFAHTHNNADIFIBGFIJKDKIOFGCIAEC@CGI@C@CAC@CBG@CIG@AB@BAECBIEE@CAABCEA@AADEAABA@CEAA@EK@CP@HKFMGSDKGC@[H_BKJMBAFHTBFCFGLHRF@FEDCPJRPAJBDFDN@XVH@BDMLGB@JCHSHYBQ@ABCDBNABCAEBGDABNJ@FGBABAJGBU@CEECAEEAIHMFKEOS[GG@EJABSQIOCCCBENCBA@CIA@CDKJKEAD@JK@C@DFLFRBALDFN@BBCFKAEJEBSIGBIDIBGFGTSEIBKDHbP`V~K@OD_NEHIFABBJAJBBLN@DADgJGFKDEHqROPIHEBGASBIHKNUJADBJJNAZHJPN@HGLAFBBVBFHBPCNBJ@NDHN@D@BDAFCDODIH@FDT@BJFBDCJGBCBAF@FFDDAD@FFDNCF@DJBFEB@BB@JL@DBFNJEZBBB@FHCHHLDDHHAJHL@LNFBBDAHBDDBLALFNDJAB@@DGHCLHDBBCFDHNGB@@BADOhEJBNAJBBTHDDAJBHDBPIJAJFHJPERDBB@FDBTERJJBB@DEFAL@JDBA@EDCBDFFVDNHH@NED@RJNFNPbbRfADABMBEDEFCF@DVh@JCHABIAGDAF@FFDTJHHHFPBPAFB@B@DCBOBEB@F@BHDDBRCJ@DDDH@HABODCF@FFFI@CD@DDFJ@FD@BEDGLDBHADB@HKBABJF@DEHEBCCAGCAENOJCHNVH^@DCTFjDDALDNCNCBG@WEgLABA@GAECCGQBKGGBEDY@ALUBGDAF@fFDZAPNDHAHCHOBEDJV@FEHMHMFODaTEFADF`DNZPHDHARLFABElIHELUBBB@DBD@@DFB@DABBBBBD@BFF@DBB@AFFFH@DGF@D@FABDDAD@\\IHADD@FALGJ@BD@DGDADE@KDEH@BFALGLBFLDPBL@DLHCDGBYTOD@FBDDBB@LBBJ@PJPAVIBGEMH@HEFCH@LBPBFDBFAHHD"]],"encodeOffsets":[[[121722,32278],[121662,33379]]]},"properties":{"cp":[118.767413,32.041544],"name":"南京市","childNum":2}},{"id":"320200","geometry":{"type":"Polygon","coordinates":["@@C{FMDODIVKHGBGACQOAECA@AdEFCzUnKbCFUJCVELEDKJIJOBWJDLCPMNEFGCKBI@EMGAGHUHCBKZ@@DDDTF@OBAB@ZP\\WHSBKAGNCFIDUACGCCEGEGBAAEMBMDEBGJ@BALED@DCAEACOKIMKCM@KGCIFE@GBGESQABADCV@XGRCHKMOLIEKRQIEICMDO@MGEABEAC@CSCGLMAEEDaDCAGDEDCF@VJHEJBINFBFBVAFCNOFWD_LCACAIDGAIDKGKC@CEC@ABCTABA@KEQOOI[IGMEE@EBC@GHCDM@COIGEQEQDCAOGCICASAMK]CME]AuHFGK@KFMAiWWµ¯wiÁǇÿeAQIKCCAIAEDQLM@GDIEMBC@IJKAGDGK@EHCDC@EKI[IG@IPEBGCEBCF@DHNAFCDGBCDIFMAMIG@MECBKCE@GHC@KCQCO@ECEQEIGCE@OJSHIPK@QEAA@IEAEEOCEEGEGO@IAAMEQAK@CAUcEEOBUAIBEHC`ONGJ]NGHQNHRLPHBFDF@BB@HBRARAXCHHJEHMDQNAFG@CFKDLLCF@DJHBFCTJF@HIDDPADHHCFMHEFATED@JNTHF@RCNA\\@LFNHLBFJRBH@JCDCBCHBD`P@bDDF@jEDJD@BB@PBBH@DDBJCDBHDF@DEB@DoCAH@DBBN@BBDRCDALGDAD@D@VDBVEHBFTLZBJFHJFFRHLNJHBTBDHNHHBFHFJGJALCDBF@FCHJJL@RJPBNCDIFANBR_BGFEDIPBFC@OFSBCNBLJLBHCRADAbIJ@TB\\C^I\\UXQT@LBJJRX@DBXBxHNKLEVENELCDMAYRI^[BVPIVDDAHERALEBCPI@ECCFKQ­EOMSMs@QFSPWTMhMzMVF@HGZHYFEDAHA\\JxVzLLdTRHDBDAfPGRFVRZPPFHGDACCBCDBPM@GEMB@DFHADAB@LEDBXED@HUBI@MJI@CCSLCBCHHPADEHABDFJFFHLHHHBXfVPPDFZDFBJbBTBbDV^QTPGDKDDRFBLBAFHDARADDF@TEbBZHDBBTDFEP@@AFGBGbHAHENIHOjELMNDLFLQFDNMFCJBDFFFBFDAFJFFJHNBJCHMLO@UEKGKACGk@IGeB[EIKiYGABCMGIK[HCLABGACEEKKDEACFEAAB@ACF@TGA@NONCH\\HDJFD@JNVKDADCHG@CFEDHP@DADJLTFNJEFEFIHGNBHAJBNDBHBP\\WÐaI~EDvRø"],"encodeOffsets":[[123260,32759]]},"properties":{"cp":[120.301663,31.574729],"name":"无锡市","childNum":1}},{"id":"320300","geometry":{"type":"Polygon","coordinates":["@@FD@DADD@BDBBRBFCDE@CDCB@VJFFDHBBBNCB@DDFLFBD@D@FINCL@DADHHF@FEHBDJAHBFQBL@AHBDFBBBIHDHE@EBBHFBD@FEDDHBJ@THBDD@HD@DCFDDODAD@DBAJF@BB@@BB@FAD@BAB@AEBCBB@FD@@B@FDBDBDBRKBBB@DFFDELIFAECCCB@AA@C@@DC@@BBBBFFB@@B@BB@ADB@A@AHBBC@DBBBA@AD@PHFLJ@DDLCFBHFCDBBHELCD@z]@gBEJGLCTIDSBCJGJAD@BACENENMPULS@AXBJ@DAFE@MBQ@@H@FJABh@FAVADCTAHFFHDBF@NAHCRQLC^@DBDHRVJXDDV@FEF@FBJHFDBFF@FGFAXRFJXTFJLRDdhC\\ALAUdOPKHBNA@FCBADBJADBFIJDJEH@DHJ@BEJ@FAN@NCPDL@PJnIHFZANCH@FNAAGZCPBDBHFBHFBDA@IFCD@HDLHB@DKHAP@FAFHL@DDFA@GDAp@NtF@HARE^CHHHLHHLBLA\\I\\CBAAQF@HITABOTADXBDPAAGRBRCRGBFDBjA@ENJVCJCFGQWPGAKXIDC@IWkABCBEGAEECCCGACAEEEIAIlIbITILJJFHABCAE@EJEPCD@FDJ@TCACZEGM[cAIFEIMUESGECOY@AHAHCAIRCCCLGFCNEVKJEBW@aGW@EDCAMIUEEBCBIRCDDDRJ@BC@MBAZBDGZDAFHpVMJFJ@DHA@JBDBBT@@RBFLBdCBFHDB@@KBAbBTAFDD@BKjELBFJZNLAHBHPLKBE@KDAJHNEHKDAVEH@FBHALGH@pT@HNJNLD@TLVFNIP@jMVIFMH@NFFRDPFBFNDDTBZG\\ERBFA@MFA@INABKZAHQBG@KGIWSGEMAEBEC@EDIAO@IBCCAIAAAEWO@EA@CFELADGD[EWO@ACcD]@CACCKAEEG@ECCMJ[KECEEWCOAKFQDCPGCM@MGKEOGUAM@K@S@C@IFQKEECAAE@IDAFAAIIMAMBMBELCJ@FAcOUECCIIQGIBOLUHKCQ@SHRgBS@WCESCGCCEAG³ESNSj@^kbAFABYK[DMFKEACBGHGAKAGCCMCIBePQAQGEDCBADBFAFMFCDIVWLEG@EGCGKFGQGcC[EKAMGYBGa@ODSHCDELABCACEC@EPO`HVHRBHOX}AGECAEDMJEBAACGADWOQCCEBCFaAAGDECKEABCAEJSDATAHCDEDIRAVKJALDDADSAIEKDE^AFCFGHAHFFLBXP@DALKPYHiLaLQTKDCFWFI@YDONBDA@GFS@GAKGI[HAYIIGM@EPGFCBIDEBQHMACMCCSIB]GOBULKNMLCBI@IEDC@AE@CAA@ACAIC@BSKBAE@BEB@@CE@@FCA@FYCBACADKGA@AGBAAC@@DA@@FA@BDK@@FE@AEIB@COD@BC@@FWEI@IDCPGJCBMIEIAC@ECUEGMEKCODUFADA@AFKABCIA@BI@@CEA@GDCDMMAIFC@ALM@KDE@YHUDG@EAIAUHGAICGAABMB[EACEEGCKGS@III@AEE@@EA@@B@@AAC@AAIBBLGDBBMD@CAB@DA@BBA@DHELABMFCFBHADDFRDLNDJF^H\\Hd@HKV@DHDFhDDE\\F@BHFPAVCHEDKDIAOE[QKAGDONEJUnKPMLCDEHB`ADIHGLALDNFJD@DN@LADGD@DCBEFgZ@HQ@GJKHKFI@ECBCHGFK@QCKKEWEICEICCKEMCGBEBEHCFGVCFCDGBEDIFAJAHF\\CFKL[VQLIBI@ISEAEAcEaSkQQC]AIBIFEHGTILKLEDO@GBCF@DBDFDDJCHMHMLQH[A[GK@CAEGGWC@QBMDIHAHOBEAEAACEAGEO@AK@@CYVI@@K]@UNUHMHEBSAL`MBGCYHG@@FBDAVEPGFW@KDGHKNKJ[@GBIDEFSFOECNMRMAMBFLDTBFLNHRJDDDAPJREDGB@PBFHD@B@HGJEBKCQMMFCZQBOFcV]VAF@NDNJPBLKFCH@JDLV\\BL@LCHOHWD@PPdKBCDCB[F[LWJUDuKQIOKCAaCg@ILedWPGNEDGBABBNGTIL[R_LkJ»@aLUNWFGAQBIAEBo@MBGF@BBFHBF@LEJAJ@JDDJGVOBaVQNCHYTIDW@QHKJULURGJAF@JDPILIHGJBJCLGFQAOBQFSLIHADAFBVAFCHEBI@UCgSQGKBKFKN@FPPLRBLAVXZDHBJAHIHGDkPHV@PDJHFZFN@N@JFBJ@jDFP@LAhDDFBHNE@DLF@HBDF@AD@DDCB@@DDFACBNRHFBAFJ@CF@C@BFA@@DA@@FNA@BJ@@JNAA@DA@@LA@DFA@DB@AEH@@AJ@@DB@@BfBBBBHH@BBTCBBGB@BLAF@@EfF@BJD@DD@@CD@T@fHAHF@@CFB@@NBXD@BDBH@DD@@BBFCBHB@@FHDBFE@DHD@BDNCDFNI@CD@@CF@BANCJ@D@@FBBH@@@B@@@X@BHB@BDH@BCLA@AB@@ABAL@RHBEJCHGJCN@PCVE@KNAHF^AHHH`HJ^C@JWHG\\PC@`\\IBP@EFCHCLCLOVMnOrUFMNKXIf@HABIP@@EKACCCcBMBCPDXyJQPSDBJFD@HAROjSPOBEESBGDCRADCHMAYBIDCHCTEBACEBAJMDA@GaOEGIUCGDKCWHSNQFCF@LDXRD@lBFIJDDAJQFEHmDMRaHULk@OA@M@GMD]@WHSJBNBJBFALaSIBEFWH@BADBDBFNJAGWPABBXIFDEJHIPLHJBAGGWQQcDA"],"encodeOffsets":[[120034,35272]]},"properties":{"cp":[117.184811,34.261792],"name":"徐州市","childNum":1}},{"id":"320400","geometry":{"type":"Polygon","coordinates":["@@O[GACAAMBIAEBGFGJGFEFEMISEIKBC@CGOFCDEH@DGBCLCMU@IECCI[GDGPM@MHB@SBCDAFBDEFBLCFLDFHBBADK\\GJLNHADHBjZJL\\FfAJHl@DHLBLHVFP@NKDGAIGMEIIEBEECEAEEACDINECMREEKCKNMFKPiJGFMBGaGAHEH@BO@EFSCAAGCAYFa@SCEBCBQGCBEKAEACQLCHCSO]RCUAaASIaEAYCCEOOeUAWGGKGEGIECEBAFGBCGODGDATKDDJ@NIJ@VA@GFCAWFC@KBABCEG@CNAHFN@AODCDABDHCEGOOQYEUHQeOCBCAQGcSKKUyIwB[BGFCZEGHY@GUEyNgNSNOXET@RNtNTFPR®ELDD@FOJADKFQBGFCBUCOJAU]\\QJBZCNKDMFUFKFMLwGWACAcB_AQWIIKAS@WR[V]J[DSAI@aJCBQBGDKAKIKACDET@PEDOACJEFAHQ`OACBCJMDIAGAOGK@IIDG@EAEDCBKHICGGIGAMGCGSAGAMIGKEQIEEGAIKYESGAUFCA@U@CBCHCBKDCCQAAM@AA@CBGpD@CFA@CCEAGDCAICCG@AA@OAAC@CIiFE@CC@a_OACDGDADC@IAGIQAEGKEM@KB[DM@QUW@KFCBSFENGDEGGBCCOJC@EIGDSAEIG@CDEKKLCDEH@BERMPEDEGIDGBWBQAQ@GAAE@ECGAKOGQQBSGMDYLKBEEAOCAML_CEBEH@FMLQNQ@BFEDI@EEBCEEEAEBIHMBGICAGBCP@LLJV@@DMHGBCAAIEC@FKEGEIBEF@JCBGEENETFL@PDNCDBHNHFNBH@JLHANOFALEN@JQPAHADMC@iIKBKGMIEGJO@GBKBGAAAEBKCO@CEGCIBGAKIMEEDERWBBEACGEI@C@EJcLGFBF@FMEEEACC@GHCHDZ@JBDCDMBIFIBND@HDDLB@JCFADHHDPTVRNDB@BILSDCNCHUVEDG@Q@CHER@xAPGXI@GCEBIHMBAHBFPLHNFX@HMH@FHN\\@HBBFLFL@FFBLHFDFDFFFABGDYFBXJJDFAFDDRBPJBB@JRPFJCJ@JLTNbBPHPFCXHTFPHFBPHLDLLXLNLTVX|@FOHHFABCJDHLF@DKNCBYAEB@fAPALT^FFFDCFDNIDAD@FFRAFCBNXXVDJEBCH@FJLJFFDDED@DBDBBAZ@HGDGFGHAJBL@HEFILE@CHARATCLFHEBGN@FDBBWXGREHIAABCFBJHDHJ@BCBADTHBDHAVRJ@VGDGAEDETBLMHAHEFGVEHEdDV@BBZBLNB@BA@GDCTANMVABADQDCEQPBDGJABA@GBQ@EHCHOB@V@HJHAHEPC@MHGDMHGIHGFSXOBMBERANGbC@DCJGL@HFJCTNTJJBHAJTBB@DJADHJBT\\AJ@DBLABBIJAHDFFB@B@JTNXfYBaAIEOCMTBT@LQPCN@@JC\\`RBBBAHDL@HFJHH@DMNCLGJQF@DTCF@JFB@JDF@BCDBFFHDB@BMDLZZnJLHBPARBNGXDDHHDPCDCDGDATNR_JEFBJLFBFCAIBERmFGPMFA^BdCFDRDXBJSteVQ"],"encodeOffsets":[[122903,32735]]},"properties":{"cp":[119.946973,31.772752],"name":"常州市","childNum":1}},{"id":"320500","geometry":{"type":"Polygon","coordinates":["@@[OC@@AC@@BA@@CC@BEA@E@@HD@@BA@ADEA@CACEABDC@@FCBCCEBBCCAC@AABCABAADAC@BCACEAB@@CICEDAEC@CDC@@AEBA@BCGCAAGCCB@DABCC@EC@CAAAACCAC@@B@@AB@CC@BLA@AA@AA@BCC@@AA@AAEAAFB@@BD@@BGAAJ@DEFBFA@ECEB@@BIE@GI@ADAAGEBCCG@CAKBDDCBMGGE@EQCIG@AECAEBEIEOEGBCAABGACB[KBAACBCA@BENEPABAACB@@DB@@GEBACBAC@@BGAC@@AEA@CI@@CD@B@@GD@BAB@BAD@@AAABABBDCACDCCDICBCEC@ACABAD@BAE@CADEKCBAB@BA@ADCACMC@BC@BAC@AABAME@BIC@BA@@CAAAFSGBEHADCMAAEC@C@@DC@@CBGAKDAAEF@DAJBFGE@@GLAND@EAABGAADA@CBABA@CA@AADA@AC@@ECA@CCABI@CBA@E@ABIF@NBADJJDEJOEAFCB@BCCA@CD@@CDB@CD@@AF@DIA@@@C@BAGA@CCCEAKACB@DC@AAC@ABBBCBAAC@BDEB@CGBEDBDGB@BA@@CEBGAMOEC@@D@AAKDGVADA@@BA@CDCBCABAEECMAGFACGECcE@@B@AQBAAAAAB@@MACCBCAJA@BD@@EBA@AAB@GEABEB@B@BCF@ACC@@GC@@CLyC@@CF@@ADABACA@A@ABA@CEABCJBBAICBCFEBEEA@AAABAFBDG@CIABCFB@CA@BCGC@EA@@DAA@AECBEE@@DC@@BA@@BK@CABAG@C@AHGA@CGC@EFAGQC@@BCAAFEDGA@FC@@AACGABCIGuAOCNmF[ISCODcCEAKKCG@GCCMICGC@AKFEDBBAB@BCBAH@@DF@BBF@@CF@AC@ARAH@@FB@BGDEDGDBFC@CFE@CI@AOGW@I@GDC@EFKDCAc@EA@I@@KEAAMUI@AIACAK@@IC@@AC@@BCAABCACDEDGEEAAFCACBCJcPCBcAmICAACEEEBABA@CQDQ@CWEQQGEO@CBGJKFWAGDCACGCAMJSUGI\\IT[FODSAMCMHiWCAEFIBEACGEA@CDGB@FBBOHAHC@EIMCEKMQCFCDA@AE@KECBOA@EBMFABBFA@OASDQKQCWDMFABKGEIaSIGAGGGMQGMo_cWHGDCLKRGNANBPCHADI@IDELIBADAJBDJD@B@\\IHCLIBCBKHBJVNBDADKFMVIBADBHBJLFBDABEDAF@NELWNE@CCAANoKCKGcGU@I@CKI@@EOCMPBBAFDBAN@FCL@DDRHD@FCHAJVVBF@DwQYCQE]EWC[AOAQ@[CCAMBOASBAAABcHQCCDMDJEDADEBABG@EAEB@BeXur]RibgN]JcVCDCXINEVKLYTQZOPKTCBCA@BFB@FMf@JBLAHEHSNMRAPǆĀÂj°x¶XjXNBLEL@EHvG^BNF^DNLTBDBDJPHDBRCRFHFPJ@DCNGD@HAD@FFFHN\\JPJRPLFB@BADSBAD@DFD@HJCPBHCHBJBDKDC`EXMPEDUBEAEAJMIAGFUIE@CDCFBHCDCbFFNBHKTD@DBDAFFBNHP@NCJDJFQRFLKJNPGLQDWHU@CDABRBFTAH@HEFDJLHN@LDJNPLDJCDC@KFABI@AHCFANFNBBHAHFDFHDBDCVEJMDBHALGT[XYOA@AB@PSECC@CY@ALGDGVBHNH@FAJDLEHMFONKDICAXIPIJCLKFUFIDEVaDmLyVEDcF@BDBBFRPBDAHGHULCJCPEND|TPPP`T¾|GlUÂkjEhI\\@VB¦V¸NTBVIRcZS¦čN]rbMvGĐ@`Kr]MFAŨř²xe"],"encodeOffsets":[[124256,32269]]},"properties":{"cp":[120.619585,31.299379],"name":"苏州市","childNum":1}},{"id":"320600","geometry":{"type":"Polygon","coordinates":["@@RFjJJEF[EIgEXMNAXAMAetUÜ¡ĮfGÄK\\GrS^OZSPW`ÅLÇHaNQHkPYD[CcO]EaNkPcZA@j[¢UƖ­FEJ_JMìßR_LWHu^PYÝhNMFUE_FJ¯ƁđnÓpSCIDA@_NQFC@AIMDAD[H[L[VC@QLAFUFCBWDaXU@UFYBQDSJ]JSVU`LDIRKHip_TtMFKBO@UCSCaIoUaKqWg]}ycFq^_Lď@uHaNqM^¥ĎYTQdUJSA·M¥UUA[@gJiFXJPBHURDF@NUJS@KFEFEHC\\EXuPIHbKHWBJW@@AC@[DI@@PCJGPE@GhFF@LLDFBBTDDPZBJ@FHBBDCTIVEDIAKJEHAND@DDGTBNDHDD@tZJBBGNOPAXMH@HFFBBBFFHLFENKFBB@RG@KEKAQII@KCCCAEG@ILEJEAECG@KHCLFFDHK\\@JGbBTCJGFEjBDCHBNCBK^CFGBABBLTBDDCHEDBLCBFjFV@FCFKVDBBDGJ@BDHGT@L@DGJE@GEOCEGMCGGCAGBILIBGDAFABCJABDFDBNC@FGDBPFJ@JFFD@BLF@BPALNDBB@FCFC@ADBdRDbDrAJDXNd\\LFHE@CJDBADEJ@BFAFRDRCRDPATLFBJEDBLCEaFADEdDDIDC@EHCZAJ{JIA@DE@SF@RBN@NBHAFCBDHDHALKNAA^RDD@LINAbARCLHR@DATDFCJ@XJDHPLJGFENEBGEA@APKBCKeACDGH@BF@HFDBDHJFAB@BGDAF@D@BDDAZSCIBGIECKJGCODCJAHBBFLNDH@FTNZLNDJBF@FERABQR@B@DKP@ATDFªFBOC]ZH^TZJJTP@JCJ@^LABICMDIIA@@VZDAVBLF"],"encodeOffsets":[[123810,33423]]},"properties":{"cp":[120.864608,32.016212],"name":"南通市","childNum":1}},{"id":"320700","geometry":{"type":"MultiPolygon","coordinates":[["@@@DB@BACC","@@SCECAC@CN_@GCAE@ABOhEDE@QCGKMGSGYMIMQiY@qFg@YCOSwDINEDKIqCEGEACAGPSRElyNGJAZHRA\\KPKhUXIdAFBDHF@FBHBbGDCBIDA^D¢FE^BBD@HAJEH@FADMDELAV@DABG^GLCBCBACEMD@CGCAEIAMDOAQNUHK@EQHQBGBEA@ALMFA\\A|@~CvWfMLA^JFAAOCEIEIAEKCA_@AAAMBMACAAG@IHG@ECEWKO@Ez_t[RMRGTB^EJKFS\\agtYa®caHGvuECQEMGBGECAG@ML]DOBOUm@EFIZ]BEAGCC_IGCKOAGGG[GAAGKBKDKAGACQGEE@ICIIEOEIGIKaYqOGeKMGcYIEK@GE_YOGQCK@IBCBACMKKGKM{aNWH@`LDQ@QDGK@BMOCbw\\NHKHOVHJI\\SEI@OKMECW@US`wEAJUIMBAEEC@EJIH[EED@TEFYDIA@CBGMGEIEAQCOK_QgAJOBEZBBAFCBU@ICIFAHFJCF@HCDIFAFCFELEBOA@ABEIAMBECBC@CEMCK@AN_D@LEBeBEAWBBABABA@GCAgAEDI@G@@LAFGDINGD[BejEPGJEFKBIPGHABBDTR@DIHEN]LGJMK[XRJNPEFBF@JDB@HADMD@PEF@D@P@FAHeB]D@VED@XCB@FG@BtcFCDDPFHBZHhAHKREPFV[GCTERChBLDJLXCN@HnBH\\EWBCKAYGAAGO@GDADFJQCiCASCAHEYQKOCIUOAE@O@CC@G@E@ADBZAJ[^OOC@C@EJIGC@A@EFA@KUg@U@YCiFM@KEKMQBGAEO@IBECGGCOYKIAEGEACOAMEIBOH@DFHABWVQKE@G@CJGBI@GBKHC@CBEHEDUHKAS@BIAAGBKDGDc\\CFBZCJ@FFDFANBRLRRDF@LAHGRYBALMB@JEB@NEBQA[FYHSAEECKEACOEQMEG@CLABUJiNO@KJE@QESKC@MKMI@GoSG@KHGBEAG@UFCBGLMFIGCB@LAFKLEDHLDH@LDF@JF\\FLDFTLDFNbBVARMfI^@JGxPh@NFHHFJGJCHEJBFBFLH@FCJ@BPALEFMHCREJDJ@HFFFJ@@`GJ@PDHFFLJLPHNBD^CJDBbADCFEDAVBXLZDRAPDBADIDYDC`GJCLCLBHDPJRBJCZYLEN@\\VZJH@`@RBNJNHPDDJDD\\T@BILURGFI@MEMAG@MFKNGAMBCB@F@BDFEFDJADNFLDJ@JCDJBNCDWLDDPHF@PCPAHBLHL@DBFNDPCRLNAD[VCHBDDDH@PCPBRCF@DDDNAPBVFNPRFPXbpvLHDFCfDR@NBHDJBNAhAH@RFHLB^HdNHDHH^FDBHCJKFCJAxNN@LDNAPJLB|CJALBh@RJfArAFDBB@XDDHBFHPdBDDBVDPDZLHBV@HD\\BTGP@FDDDBFPFHJDBPBBBFCF@FCLAFENAZANMDOHEBCDC","@@F@BA@CAAEACB@FBB","@@EBACAACAA@FHHDFA@ACA","@@BAC@BB"]],"encodeOffsets":[[[122360,35525],[122170,35919],[122751,35359],[122149,35705],[122250,35591]]]},"properties":{"cp":[119.178821,34.600018],"name":"连云港市","childNum":5}},{"id":"320800","geometry":{"type":"Polygon","coordinates":["@@AACBAA@BC@ABEGCA@AC@B@ACAKDSDKBkBE@IGAKKDGAG@CBCAQHGJSDABCDBDE@CDABCACB@ACDCAMWGE@IAQICGCASEMB[NeFEFK@QFGJ]HCAEECACDG@MACCSWcCCEK@KEGBKJMJK@SAUEO@KEMFOEK@SBKEKDQAODCDIPEPBDC@KGMQOQMGYCC@IFIDK@OESBMLCF@NLN@DAH@TGJALCDGBWDC@GACCMQE@GBABAHBJAFEFIBU@IDCFIVALBDNDHF@HALEJAFDHIH@LHPEBIAIAEDAD@BBLCBM@U@GAYOC\\EJAPIPM@LBDDFJHVJjL\\DPFRPPJBDCJIDeBSAMBSLMNObA\\@`GfM\\iDFR\\ACHETkJFF\\GD@DF@RCNWC@FOA@@PBBJOCBD`DDvF`EJBHAbVH|^F@¸GĐQjf´¤TTVÌhú|Ün¨JNBJCFCLJH^BXAT@LD\\JFBTD@HBDDBRcXOPIROVGNKbTDTCXIPFZFZFFFFL@FFBPADCBCJDDFDCFAFFJADGBMPAHBPHNAFOJCJFJDLHLBJEJC^BFJDDDDFBLJLFTLJDDDNRJhbLDDJCFBBNDF@VMHAJBPFL@LFHFLPHBLEH@DDFJF@FAF@BDAHDFFBPANHF@FCPOH@BIX@CONAHBRTPJFH@JD@DAFHDBAD@DNDFAPPBXCJ@HWD@BDH@F@DLHN@FJPHNAFFHBFHAFDH@JBB\\VFFHDPNRHPBPRNHJHLVANBNFLDDFDBFFLHFJDLABALMFOfi\\AHCJMHCBE@KH@J@FChBDB@HABABABXAFBfAFA@K`CBML@NDDFD@DAFNAJBAF@BPBHADKDEBEJEDC@GDEEIBGJEJDV@DABEAAFYPABIh`RPLRDFBFJNHAH@DNDVEFE@SFC\\FJGHIHFLILQLAFER@HCIAJYKERUVWBEJKJADHNFTICIC@EEFM@GHEDAOm@GDGOG]UQASGIEGKQS_SKII[MKIO@CDK@EMGCCAUGUMICCMcIICI@C@KAYKGWYMKEAGABGHA@KDA@CHCJOOKAQP@JI{_GNMB@GBIFCDKDCJ_DM@ONQFYJOBMN]AUL_RKBGHCNMFAFDPAJKFEHKZYDEdFFOBCV@JCPMBKVKHMCSIEQC_U]MGKUDKTSHMBOa@OCiYWOMEYCME³O¯CgGgMcGIAM@KECGPULaHGLIHKSCY@ICYCOGuGE@YCYGEBEB@GNIFICOKSQKGU@OHUHMH@VICFCRABHNABACCH]NkIIFQBCnNNG\\MYRKNu\\cFOLWjW@]IQ_eeYAYBcHmb±JkI}YoeSKóvAEMBQHq~OPIDIBMN@HIRIJ@hOEeGGF@HDDDD@FADBHBBFABDJ@BDMLBBFDAHBB@DAFEHCJIAGBGBBF_AYIASDIAOMCAUD_JC@@GU@CJ@LHHBDMFI@AA@CAASDGAEEGBEFI@ICAABSG@ECDKHIBKEKGDEAAA@QAAOFCFKFE@MGEG@ILICKDMEEAWGAAC@CNKASECU@MIU@GFG@EDECAFCAGFCA@BC@BBC@@B"],"encodeOffsets":[[121606,33647]]},"properties":{"cp":[119.021265,33.597506],"name":"淮安市","childNum":1}},{"id":"320900","geometry":{"type":"Polygon","coordinates":["@@RGT@fIÐOfGrM\\IPIlQc¼}ň¯ºgRKVI@EGMFkFid`}R{HyP}´ĭ¾ĭ^ãZNgMUDOLSBMI_BMDINUNQncTYJUPKTYHOAOBKLIRGRSZTAPSXDUBQJ[J[jcPY\\E\\DRARCPINMHSBMCKEGIAGO@eJhćPqLYPYzWRIFGHUXÍAIAEEEUILkNANGH]EYHI@E@MFMZQP[BcGMWJGXALCDMIGCKIWOEECEASHIDIBSNUBEAKAEAgHgQEOKICABUYC@UB@JJNCJDBAAA[II@IDO@ISYI]SYGD^AP©ECEBSO@CLA@Q@ARQBEFOAgOSM@ECGKMAEGAGBEDDPIHDLJFAHDJYTCBACC@E@CBAHA@EBGIACEC@GAEG@CHBDLfADOL@BFBAHMFEFIHOKCGWII@EDSCCBQ@KGQDaBMBKJC@QCB]MBKLGBGCACEDGBMAM@QAE@@TCFB@IJI|YBGD@FCDCJcCCFEBFbKDCAIFEASKOBQCQDQCBEAEI@CFABIC@DGFKEc[WMICqBaCQCAcBCD@DE@EAAMCBKAOE@AKC@EE@IEIAOHC@EMDCACEMD@HDPAJE@CFIBCLQ@@OkKQ@IBGCKAIEGAMFAACDATCHCB@DLFBENFAL@FD@@LALEFHP@NAPHLHHD@NCFJFNBNZCBBBFGH@FRLRIDFNJAjEJpJH@BFPVTNHJALIPSGYCEIMMMCQJ@DWBGFBHFBLHADDDGNCBEB@JJFDDJC^ANZ@BY@DLDFTRBJAFR@DBFN@LSDBDBLG@CDK@CBS@BJBF@DBBD`ADGF@nABrCFABQJAN@HC\\BBDHB@NEXRANFD@DBBKBEBBPHAHCJDBB@D@HCJDFNXHX@HCF@LA`DX@NDRAD@HEPIDBDBB@BGFKFAHGH@DDJ@RCLCB@DBDBJDLDPBFODkBI@EAC@SHQ@wFZeLUHaJZ[HeyMaAAF]MQ@MCG@LcKKAW@E@EDCAAGACEDSBEKMDDJ@HAF[BUC³]OEOIW@EBOAEFGLEF@HLBALBFFDJ@@DGFCDHJEBCCQ@OHAB@FABBVFZ@B@BPABDMBCLQLOBmLAHKR@DFBDFFPHJFLAFDFFFFALDDBILALADMDANC@C@AAQAAGuEAGCAE@[ZFRCRGBIJDFDNEDBLCBaCA^GTD@Ol_DGAKEEBSjF@HL^N`VRDJFDTGNULALONIDU@ADEPcECFYZGLEFILOBECEBMNGDAHQLK`BVM^ANIPEZMR@PCNI`CDCLEDAJ@HNAHM|`IJO@BRPLIPGD@DCB@LGBAHHBFBNLXZLHBZ@L@DDJJJNdDDNJHVBVDDNH@FCL@DJPNLJ\\LJ`TRTHLJFTHRB^VPHCH@HPnCBGF@HENFFD@DJSJMECGIBILAFUXQVLFIZJBGDQ@EFKBKRMLJNIVFB_xVTX@FDLN@PFJ[TIJUGGPGL[MaxPDANL@CH@RCR_KG@MX|bLNLHNLBDDAJAL@RDPH`ZHFL@JFdZNHfLPHrbZJLJHPFJFDJ@JFFRHBDBHCLALHLBB\\HHHBHLPHD`JDDBHAFY^EJ@FVnAPCPK^@NBHFDAHNHRF"],"encodeOffsets":[[122688,35314]]},"properties":{"cp":[120.139998,33.377631],"name":"盐城市","childNum":1}},{"id":"321000","geometry":{"type":"Polygon","coordinates":["@@AWEQE@GFGGKUGGICKKMGECOGCE@KG@Oy@S@KAOLCLKZOTQJOHYBYNgBUDGROA_IU@MGMAGBCDQFKHGPIEUPgDCHC^CHAF@XFHDNNLJHBHCFI@CAMJgLCAOBADAHEDECEGG@ARGSQ@CJGBG@EACMGGICSDEHEXGLDXLD@JAAIEECIBA@IHEHGLCpGHI@EMGKMUKCKBKBEHGLIHIDI@OHGLAFCLICGCACMAOHEFALAX@FMBK@ICO@ELOFKBGIGWE[@QHMJCFIFYJGBE@EEGMGSWS@ENOBC@EAOEI@KXgNEBE@GEIQQAMBIDmAIMI@C@WEQ`QTHTDFGHWDKHEHADCGQ@ELEBCAE]G@ICEKGEIBETWHKAGa[DKBYEE@EHKBCAECGIGaWGGaVOFQDaBoI]SY[S[MBQJG@EKGGUMSCiEMGGEEKFWAQEMCECA@jERGHODKAEEACDOAGUEcC@DBJ@BXcBaEDGSKACDCAAmgC@GJGDsLaByIkU_WQSi@LQ@YD[A_B_CYBQAOEWK©boJkDqCkEMHIJcFcJEFBFDFDLAJAFBLAHEJFL@FGLDJ@ZJLABYXCF@FFFLDHLHFOL[JCF@BFBZ@FB@HAHC@GCC@MHAJIFAL@RBFBDHDD@BHJJ@BCHKPBZBDH@FAJEXVNBJ@BCJAFBLMJCNAHFNVDDnXNNNJ\\BADIJPVDFBJADDNFDVPBD@FCJWRCDBJNJ^HCHJDAFBDCHBBAHBB@FTLHKEGBELQNAPGFALBDF@`DLBFLDDHUFCDAL@DFN@JADQJCFFÊENBJ@HAF@\\EJILABKxERCnG^L@ôuLfTZpJ~Ila²GnAdBZfZ`fJR@^iXKXEP[dMvQLZ[NMHmMADERJJMlG^DDABMBAGQBEDDUJG@GNGV@PHVRLLTDPEJMJ@HFAFAZHZDF@vHPHZDJDZ@TDGLKJGHKbOVDHLFN@JBdHhNhH°D´PNFZDNFXPjZPDb@vNJBH@FATGLSPCTiBAD@LFHB`CPkC@HSB]bDDAAKFCCMCEJIHADQEQ\\YF@DBBHvFBHRBBBD@D@BMNCBCBKHIBAOEEBEECEBEEKGIEOCEEA@CBEJKBG\\E"],"encodeOffsets":[[122586,34017]]},"properties":{"cp":[119.421003,32.393159],"name":"扬州市","childNum":1}},{"id":"321100","geometry":{"type":"Polygon","coordinates":["@@`MRITQbgPYPoD]JUDcFWVuDKj»fpFMWAQCECcD]AEBONEHQnAFBJEDEAIKEAIFQ`SMCBCHCDODGCCGWCMHQAOBGAIKYmKYNC@ACAEGAEDC@ACE@IEA@IDES@CREHIDKNM@CGGEI@GCKBGAAQA[_ID@@DMRO@KASNSPDJFbBZAWeSM@I@AEACEBGJIAAKBCAI@[BASGIBCCIA@SABIAGIIMSDSEI@GHKDI@CaDMHQBAFANWPETGHJGHCNGH@NODGFGBGIU@A@GPGD@FAR@HABIBCHOAFRCDAPCDUBMNSBCD@HABA@KMYAAAU@cCGFUFEHGFGBKNSACFBFCHUHI@UQGBACSGBCDA@AGIGCAIDEBAJBFGHQXWAAECM@AHGFKESDQBGB@DKFEJGFK@IAGBEHCHGHY@ABCACAC@CFECSQ@GDEFACIWUMWDABEEQ@EBCJCCMDEECEES]BKBO@eFAZBDALM@CKECIFIGEPG@EGWKWCKSUMKWKKKKCOGEAOGSEWGEDAJKCI@KEG@AB@JIH@NCFcDAFHHDHELCBAJBLFL@HGNABMDG@EBC@CBSBCJICALCHKJEJQ@ABIZGFKDGHCDDJCBGAOFEDANGNGHO@ADDLCDM@ACE@UN[@MIIBOKI@CGKHE@AAGOCEABEBIGMAGBADBBFNAFBLFBbALRCB@JIFE@KPAHC@EJKFCDODABFHCBCHDDN@BD@FBBZDF@BANFX@J@L@NPV@DJVDZRFGDAhGHFHFDL@LJNNFDJ@LIDABDJEHAZELIHUCKJOBSFIAMBEGK@QFOXANLJNBJJNBXHLAHEPJP@TMFCF@D@FHDRBDD@FCF@@F@HMDAXADSJCEO@ADLNCNCFBNEH@LIPAPNNJXDbAFCBE@IEEFIPCNGBM@WKCDI@BDCHE@BCAB@AA@@DECBDA@FDI@EFIAKDIAABECABEB@AA@@BG@ADFF@JJFJBNZJHAFNNZJRB`@BRFJEBDDP@|PH@JHTFJ@`MJ@ZBXFNIH@^HJBFDDNDD^TLLYLXL^H^A`D`A\\BZCR@Kj@RT`XlVzJbAtKHCHID@nhBBCDBDTLCHbFdAAWI@CA@dDVFBHCPBDFFLBPCHGFQ@iDBDFFNBREXFLHFNHjFTDVNHHFLH@RINAT\\Z\\^TpJbARCPE\\O"],"encodeOffsets":[[122695,33078]]},"properties":{"cp":[119.452753,32.204402],"name":"镇江市","childNum":1}},{"id":"321200","geometry":{"type":"Polygon","coordinates":["@@Z@PJPF´^VD\\ABE@GCINCFLTAFCBDBHDBFCF@X@LBdLKH@NDR@^NBEbBzNf\\GYbIVGfKYxER@TGD@FBJ@lAPCAECOCKAIAC@CDADK@QCI@CHGBGLEHE@AAAACJCFO@GBCCQ@MCWB_@KDE@GGWMWCEDI@G@CAAICGDGBAOFALAAA@CECBMWQF@MGAAC[AGDM@IBAREBqDBA@mHEBCC_AA@CAEAIT@DAL@DCH@AKACTC@KEMCAQ@BEAISQCECKZ@@AMY]BIDCCIE@IFADAHMCCBCKGEAAGHEXA@CRINDNNFJZDTHJOBKGISMOUAEG@oIFIBiMICEQJQK@EHGAEAAYDAMEMEIMDC@GGGKBO@MGOFEBK@KC@@EBKMEAFKE@CDADGDUREHBJFLBHDJAR@lL@PR@DKJADEF@BICO@GNEFIBABEHCJAJKHADBHHNDFHPDHFF@HI@C@KHSCG@AHIACCALUDE@EEUEiDAAKFCDGCCSAAKBAHADEL]DAAMDGACFiHEDIASHa@IL[CGEEDKLGH@FDFBFIJKH@BFDDLDJ@RJLBLFH@@QAALEFMKEEGAEAAEE@GNGBWPOHMAAYI@sCCCGAMHSCCC@BMFGLIJBFCJUDSACGA@EAIOYCCASEAKC@KEEHgF@HODI@OJ@\\CD@@BX@IXALGaJGvOFWD[FGFELET@VI@MCEVQAGIOyTkVH½{_SOOSOcS÷uQC}FJÏbXKFURsfOboei¼CLUvEXCdIVC^OpOZahSRQJ_NHHbXJHDHBFADGL@FFFAZCLb\\BHGLSXAFFJLHDF@J^HBFADKF@FHRCDGBGFCLGXEHSCSG_RFR@X@DNJBJCnAJBNRRFJ@HAFMFWh@LFJBP@FADMP@FXTHTHNFFF@HAZIJEDENIRG\\@XFJHALQX@FDP@JALENW@KBEBGFBPDNDBDHKJEDKBGH@PCJGJKJGHAFALDLVLLNNH@FGJoHKDGHGF@JABDJFFBJIBC@WKKCWHGFCFDTHJNHBD@FAHIH@DTRQH@BHHDFCFGFCBABBPKDIhBN@DEJGDGAKIMMGCWEE@GB]DGDCDOhFVOJGHELCRADBHHN@NJVB`QPCHAVMhAZGZIPSRYPKLKDBP@L@TPzH@@LDFPHFDNHLLJDHHLVHHHEF@FRBXVCRKDKNAACOB@A@AEYAUBA@EBAPGR@DDFAGIDCHE@CI@ECAEBKKA@GFEHKDEL@FBDA"],"encodeOffsets":[[122634,33927]]},"properties":{"cp":[119.915176,32.484882],"name":"泰州市","childNum":1}},{"id":"321300","geometry":{"type":"Polygon","coordinates":["@@LEJANFPBBDHFBFLJPZHDDHAF@JFPHBRALNLFN@jEZDV@h@LVB@FEB@D@JHFID@D@PP\\]BIAYBCF@H@D@@D@PBFVPDJLPZRGFDBBTjDRDEIBCHCP@BHHBBZDLXAFG[mA@GDMKWCIAKDgFQDS\\HEUFOLQBGGgAYEGCODCdEAsH@@EDA@WFC@U^CfABG@E@O@CFE@ONCBC@GCA@IAEFEMOQI\\WNLHI^KFMJG@CUUBAHGJOQIEKAEIEEMAMBMKUIGMGOQOAQGOMGCEE[UAA@ICGBEEGGAEEMBOGEIM@KG@C@ECG@AXC@GDIAWOOEBMC@CBCCAEGCBC@@IEGOIQSGAMBDPW@AJG@OPEDE@MGOBEACEBGACE@EBE@EICCG@KFGAKOGEKEK@OEIAGBUNE@MCAADECIKCgaQICMCCKIESIKAKCECCICAED]FIAIGKCKEIDIPIBEGMAOBGNOHABCEIBEDEECCCDIDABCAOEEK@EEEEEYEYJODWSSCLaHMPUJQPOdWAQCCGAC@ASIEC[@KBSAWG]KIDDEAIIM§Ûmù{ËgUSS³£ieďR·HE@{]UGGVKNaZaNSIQSEO@EFW@ECGMG©aUGUMQEYAGAANI@BMKEE@ANALBFABUHORSFCFCJCFGBIAIBCVAHGDAHJJPBBB@DAFQVOHI@eCO@GBGJ@DBDPXBNCHKLbBBDNNTFpBFDDDHFFAB_DMRAFBDBBV@\\CDBRHZVLNHFBDGH@FDRCHQR@HJ^BfFFBD@RDJDFHFLRFBNdXA_A|F\\C@@DE@@DIB@HA@@FT@@DB@@LP´C^GPRJ¢ET@TCPD`FP]J@BN`VCF@HDFJFDDDcJDTNDBDGNARCFAJEDOH@FHNJJBZ\\GHJBL@HETAHABMACP@ZEJEXCDSLKRKbGjU`IHO@AWEKGEGBEHED]BCFFLBJCTCBKCIBULQBCJCFGDSBCBITBFADFBDLCFBHbBDEFADDPRCXHBBDABIFCNBFFDBHW~GPQAUG_GOP@FFDBDADKBCFGDCT@PHbZANHLB\\FdDRHEHHLHD@FFHXKJUDCNEBEAEBCDAFCRHRBfOJANDDDBHBLGHAHBDLFNE\\CZLBABEla@]TiTM´FBHDFHDTDFXDT@hAQTGR@LDVGPKJARHJJDDVFdPEBI@KDAFANBNJNBJEBCB@JBFDBFFRLE@J@D@T@LBNHVFPHL@NDNOHCDERBLDPFXDFLFI\\DNFDH@FFLBDDDB^@dCBDP@FXC`CDKBGFBFV@@BFVBBJBDBlaVEBBAJT@DBL@RGFCFGDAD@LGHAJ@HADIH@F@RLXUBAEG@ADC"],"encodeOffsets":[[121611,35136]]},"properties":{"cp":[118.275162,33.963008],"name":"宿迁市","childNum":1}}],"UTF8Encoding":true};
        console.log(jiangsuJson);*/
        echarts.registerMap('jiangsu', jiangsuJson);

        var geoCoordMap = {
            '南京':[118.767413,32.041544],
            '徐州':[117.184811,34.261792],
            '连云港':[119.178821,34.600018],
            '宿迁':[118.275162,33.963008],
            '淮安':[119.021265,33.597506],
            '盐城':[120.139998,33.377631],
            '扬州':[119.421003,32.393159],
            '泰州':[119.915176,32.484882],
            '镇江':[119.452753,32.204402],
            '常州':[119.946973,31.772752],
            '苏州':[120.619585,31.299379],
            '南通':[120.864608,32.016212],
            '无锡':[120.301663,31.574729]
        };

        var convertData = function (data) {
            var res = [];
            for (var i = 0; i < data.length; i++) {
                var geoCoord = geoCoordMap[data[i].name];
                if (geoCoord) {
                    res.push({
                        name: data[i].name,
                        value: geoCoord.concat(data[i].value)
                    });
                }
            }
            return res;
        };

        var myChart = echarts.init(document.getElementById('main'));

        myChart.setOption({
            //backgroundColor: '#404a59',
            title: {
                text: '',
                subtext: '',
                sublink: '',
                left: 'center',
                textStyle: {
                    color: '#fff'
                }
            },
            tooltip : {
                trigger: 'item'
            },

            geo: {
                map: 'jiangsu',
                label: {
                    emphasis: {
                        show: false
                    }
                },
                roam: true,
                itemStyle: {
                    normal: {
                        areaColor: 'transparent',
                        borderColor: '#0e94eb',
                        shadowBlur: 10,
                        shadowColor: '#0e94ea'
                    },
                    emphasis: {
                        areaColor: 'transparent'
                    }
                }
            },
            series : [
                {
                    name: 'pm2.5',
                    type: 'scatter',
                    coordinateSystem: 'geo',
                    data: convertData(data),
                    symbolSize: function (val) {
                        return val[2] / 10;
                    },
                    label: {
                        normal: {
                            formatter: '{b}',
                            position: 'right',
                            show: true
                        },
                        emphasis: {
                            show: true
                        }
                    },
                    itemStyle: {
                        normal: {
                            color: '#36bd96'
                        }
                    }
                }

            ]
        });
        });
    });

</script>

<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart;

    var data = [];
    getAcc(9,false);

    require(
        [
            'echarts',
        ],
        function (ec) {
            // 基于准备好的dom，初始化echarts图表
            myChart = echarts.init(document.getElementById('gdMap'));
            option = {
                title: {
                    text: '振动/时间',
                    textStyle: {
                        color: '#cce0ff',
                        fontSize: 12
                    },
                    top: '1',
                    left: '10'

                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['平均振动'],
                    right: "1%",
                    textStyle: {
                        color: '#cce0ff'
                    }
                },
                toolbox: {},
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'time',
                        boundaryGap: false,
                        axisLabel: {
                            color: '#cce0ff'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        splitLine: {
                            show: false,
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        boundaryGap: [0, '100%'],
                        axisLabel: {
                            color: '#cce0ff'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        min:0,

                    }
                ],
                series: [
                    {
                        name: '平均振动',
                        type: 'line',
                        showSymbol: false,
                        hoverAnimation: false,
                        itemStyle: {
                            normal: {
                                color: "#2096e8",
                                borderWidth: 2,
                            }
                        },
                        //data: [220, 182, 191, 234, 290, 330, 310]
                    }

                ]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }
    );


    setInterval(function () {

        getAcc(1,true);

        myChart.setOption({
            series: [{
                data: data
            }]
        });
    }, 4000);



    function getAcc(num,isShift){
        $.ajax({
            url:'{{route('api.algorithm.getAcc')}}',
            type:'POST',    //GET
            data:{
                num:num,
            },
            timeout:5000,    //超时时间
            dataType:'json',
            success:function(info){
                info.reverse()
                for (var i = 0; i < info.length; i++) {
                    console.log(i);
                    if(isShift){
                        data.shift();
                        $('#acc').html(info[i].acc_peak);
                        $('#gl').html(100-info[i].test2+'%');
                        $('#day').html(3650-3650*info[i].test2/100);
                    }
                    data.push(randomData(info[i]));
                }
            },
            error:function(info){

            }
        });
    }


    function randomData(info) {
        return {
            name: info.second,
            value: [
                info.second,
                info.acc_peak
            ]
        }
    }
</script>
</html>