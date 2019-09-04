function validateForm() {
    var sid = document.forms["myform"]["sid"].value;
    var pass = document.forms["myform"]["pass"].value;
    if (sid == "") {
        alert("กรุณากรอกรหัสประจำตัวนักเรียน");
        return false;
    }
    if (sid.length < 5) {
        alert("กรุณากรอกรหัสประจำตัวนักเรียนให้ครบถ้วน");
        return false;
    }
    if (sid.length > 5) {
        alert("กรอกรหัสประจำตัวนักเรียนเกิน");
        return false;
    }
    if(!sid.match(/^\d+/)){
        alert("รหัสประจำตัวนักเรียนกรอกข้อมูลได้เฉพาะตัวเลขเท่านั้น");
        return false;
    }
    if (pass == "") {
        alert("กรุณากรอกรหัสผ่าน");
        return false;
    }
}