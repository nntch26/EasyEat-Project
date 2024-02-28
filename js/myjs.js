// เอาวันที่ปัจจุบัน
var now = new Date();
var hours = ("0" + now.getHours()).slice(-2);
var minutes = ("0" + now.getMinutes()).slice(-2);
var currentTime = hours + ":" + minutes;

// เอา input field ของ time
var timeInput = document.getElementById("booking_time");

// ปิดให้แบบฟอร์มไม่สามารถเลือกเวลาที่ผ่านมาได้
timeInput.min = currentTime;
