document.getElementById('bookNowBtn').addEventListener('click', showBookingForm);

function showBookingForm() {
  document.getElementById('bookingForm').classList.remove('hidden');
}

function submitBookingForm() {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "process_booking.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var formData = new FormData(document.getElementById('petBookingForm'));
  xhr.send(formData);
  xhr.onload = function () {
    if (xhr.status == 200) {
      alert(xhr.responseText);
    } else {
      alert('Error submitting the form. Please try again.');
    }
  };
}
