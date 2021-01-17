<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- EDD คะเนกำหนดคลอด -->
<script>
    $(document).ready(function () {
        // LMP | ประจำเดือนครั้งสุดท้าย
        $('#mens_lastdate').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: false,
            language: 'en', //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย 'th' (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
            autoclose: true,
            todayHighlight: true,
            orientation: "top auto",
             thaiyear: false              //Set เป็นปี พ.ศ. | true           
            // startDate: "+0d",    // disable วันที่ ผ่านมา
            // defaultViewDate: "+0d"
        }).on('change', function () {
            var getC =$('#mens_lastdate').val();
            console.log(getC);
            // call function
            var age = getAge(this);
        });
        // get date & convert dateTH->dateEN | Ex. 31/12/2563 -> 31/12/2020
        function getAge(dateVal) {
            var thDate = dateVal.value;
            // get string day,month,year
            var date_components = thDate.split("/");
            var dayString = date_components[0]; // Get day
            var monthString = date_components[1]; // Get Month
            var yearString = date_components[2]; // Get Year
            
            // var convEnTh =yearString+543;
            // $('#yearThai').val(convEnTh);
            // console.log('convEnT=' + convEnTh);

            // convert Year TH -> EN | กรณี calendar TH
            var yearEN =yearString-543;
            // console.log('yearEN=' + yearEN);
            /*  intial EN date
                result =mm/dd/yyyy
            */ 
            // join sting to date mm/dd/yyyy
            var PerfectDate= [monthString, dayString, yearString].join('/');
            console.log('PerfectDate=' +PerfectDate);
            // covert date mm/dd/yyyy -> toString | Ex. Tue Dec 22 2020 00:00:00 GMT+0700 (Indochina Time)
            var lmp = new Date(PerfectDate).toString();
            // call function
            addDays(lmp);
            // Get EN Year TO convert only Show Convert Year EN->TH
            var dateCTest1 = new Date(PerfectDate); // date Format toString | Ex. Sun Sep 19 2021 00:00:00 GMT+0700 (Indochina Time)
            var getYearTest1 = dateCTest1.getFullYear(); // Get only Year
            // convert year EN -> TH
            var yearVal =getYearTest1+543;  // | กรณี calendar TH
            $('#yearThai').val(yearVal);
        }
        // + 278 days to estimated delivery
        function addDays(getD){
            var getLMP = getD;
            var n = 278;
            var t = new Date(getLMP); // date Format  toString | EX. Wed Dec 23 2020 00:00:00 GMT+0700 (Indochina Time)
            t.setDate(t.getDate() + n); 
            var month = "0"+(t.getMonth()+1);
            var date = "0"+t.getDate();
            month = month.slice(-2);
            date = date.slice(-2);
            // result=mm/dd/yyyy
            var date = month +"/"+date+"/"+t.getFullYear();
            console.log('result=' + date);
            convertDate(date);
        }
        /*
            convert dete TH->EN
            If use Thai calendar. this function must be called.
            If use English calendar. do not call this function and output result @addDays function
        */  
        function convertDate(dTH){
            var dateEN = dTH;
            var dateObj2 = new Date(dateEN); // date Format toString | Ex. Sun Sep 19 2021 00:00:00 GMT+0700 (Indochina Time)
            var yearEN = dateObj2.getFullYear(); // Get only Year
            // convert year EN -> TH
            var yearTH =yearEN+543;  // | กรณี calendar TH
            // console.log('yearTH=' + yearTH);
            var monthTH = dateObj2.getMonth() + 1;
            var day = dateObj2.getDate();
            
            if(day < 10){
                var day ="0"+dateObj2.getDate();
            } else{
                var day = dateObj2.getDate();
            }
            if(monthTH < 10){
                var monthTH ='0'+monthTH;
            } else{
                var monthTH = monthTH;
            }
            // complete result date Format TH. | Ex. 30/9/2564 | *กรณี calendar TH
            // var estimatedDelivery = [day, monthTH, yearTH].join('/');
            // complete result date Format TH. | Ex. 30/9/202x | *กรณี calendar EN
            var estimatedDelivery = [day, monthTH, yearEN].join('/');
            $("#kane_clode").val(estimatedDelivery);
        }
        // function convertThDate(){

        // }
    });
</script>
<!-- END -->
</head>
<body>
    <input type="text" name="mens_lastdate" id="mens_lastdate" style="text-align:center;"  value="" placeholder="" autocomplete="off" />
    <input type="text" name="kane_clodedate" id="kane_clode" style="text-align:center;"  value="<?=$eddDate1;?>" placeholder="" autocomplete="off" />
</body>
</html>
