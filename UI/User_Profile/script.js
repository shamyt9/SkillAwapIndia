document.getElementById('registerForm').addEventListener('submit', function (e) {
  e.preventDefault();

  // Get form data
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const age = document.getElementById('age').value;
  const dob = document.getElementById('dob').value;
  const gender = document.getElementById('gender').value;
  const state = document.getElementById('state').value;
  const country = document.getElementById('country').value;
  const village = document.getElementById('village').value;
  const pincode = document.getElementById('pincode').value;

  const profilePic = document.getElementById('profilePic').files[0];
  const aadhaarFront = document.getElementById('aadhaarFront').files[0];
  const aadhaarBack = document.getElementById('aadhaarBack').files[0];

  // Convert images to preview URLs
  const reader1 = new FileReader();
  const reader2 = new FileReader();
  const reader3 = new FileReader();

  reader1.onload = function () {
    document.getElementById('displayPic').src = reader1.result;
  };
  reader2.onload = function () {
    document.getElementById('displayAadhaarFront').src = reader2.result;
  };
  reader3.onload = function () {
    document.getElementById('displayAadhaarBack').src = reader3.result;
  };

  reader1.readAsDataURL(profilePic);
  reader2.readAsDataURL(aadhaarFront);
  reader3.readAsDataURL(aadhaarBack);

  // Fill profile data
  document.getElementById('displayName').textContent = name;
  document.getElementById('displayEmail').textContent = email;
  document.getElementById('displayAge').textContent = age;
  document.getElementById('displayDob').textContent = dob;
  document.getElementById('displayGender').textContent = gender;
  document.getElementById('displayState').textContent = state;
  document.getElementById('displayCountry').textContent = country;
  document.getElementById('displayVillage').textContent = village;
  document.getElementById('displayPincode').textContent = pincode;

  // Switch to profile view
  document.getElementById('form-container').classList.add('hidden');
  document.getElementById('profile-container').classList.remove('hidden');
});

document.getElementById('editBtn').addEventListener('click', function () {
  document.getElementById('profile-container').classList.add('hidden');
  document.getElementById('form-container').classList.remove('hidden');
});
