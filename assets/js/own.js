// Get the image upload input element
const imageUpload = document.getElementById('imageUpload');

// Get the image preview area element
const imagePreview = document.getElementById('imagePreview');

// Add event listener for file selection
imageUpload.addEventListener('change', function(event) {
  // Get the selected file
  const file = event.target.files[0];

  // Create a FileReader object
  const reader = new FileReader();

  // Set up the FileReader onload event
  reader.onload = function(e) {
    // Update the image preview with the selected image
    imagePreview.style.backgroundImage = `url(${e.target.result})`;
  };

  // Read the selected file as a data URL
  reader.readAsDataURL(file);
});