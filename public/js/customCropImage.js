$(document).ready(function() {
    ////// Cropping //////
    let cropper;
    let croppedImageDataURL;

    // Initialize the Cropper.js instance when the modal is shown
    $('#cropImageModal').on('shown.bs.modal', function() {
        cropper = new Cropper($('#imageToCrop')[0], {
            aspectRatio: 16 / 9,
            viewMode: 1,
            autoCropArea: 0.8,
        });
    });

    // Destroy the Cropper.js instance when the modal is hidden
    $('#cropImageModal').on('hidden.bs.modal', function() {
        cropper.destroy();
        cropper = null;
    });

    let previousFileName = null; // Initialize with null

    // Show the image cropping modal when an image is selected
    $('#thumbnail').on('change', function(event) {
        const file = event.target.files[0];
        const fileReader = new FileReader();

        // Get the value from the file input element
        const filePath = $('#thumbnail').val();
        // Use JavaScript to extract only the file name
        const fileName = filePath.split('\\').pop();
        
        if (fileName === previousFileName) {
            clearSelectedImage();            
        }

        // Update the previous file name
        previousFileName = file.name;

        fileReader.onload = function(e) {
            $('#imageToCrop').attr('src', e.target.result);
            $('#cropImageModal').modal('show');
        };

        fileReader.readAsDataURL(file);
    });

    // Handle the "Crop and Upload" button click
    $('#cropAndUpload').on('click', function() {
        croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();

        // Convert the cropped image to WebP
        convertToWebP(croppedImageDataURL);

        $('#cropImageModal').modal('hide');
        $('#croppedImage').attr('src', croppedImageDataURL);
        $('#croppedImage').show();
    });

    // Prevent modal from closing when clicking outside
    $('#cropImageModal').modal({
        backdrop: 'static',
        keyboard: false
    });

    // Handle the "Cancel" button click
    $('#cancelCrop').on('click', function() {
        clearSelectedImage();
        $('#cropImageModal').modal('hide');
    });

    // Clear selected image data and image preview
    function clearSelectedImage() {
        $('#thumbnail').val(''); // Clear the thumbnail input value
        $('#imageToCrop').attr('src', ''); // Clear the image preview
        $('#croppedImageData').val(''); // Clear the hidden input value
        $('#croppedImage').attr('src', '').hide(); // Remove the cropped image preview and hide it
    }

    // Function to convert the image to WebP
    function convertToWebP(dataURL) {
        const image = new Image();
        image.src = dataURL;

        image.onload = function() {
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            canvas.width = image.width;
            canvas.height = image.height;
            context.drawImage(image, 0, 0, canvas.width, canvas.height);

            // Convert the canvas to WebP format
            canvas.toBlob(function(blob) {
                const reader = new FileReader();

                reader.onloadend = function() {
                    const webpDataURL = reader.result;

                    // Set the WebP data URL in the hidden input
                    $('#croppedImageData').val(webpDataURL);
                };

                // Convert the blob to a data URL with the "image/webp" MIME type
                blob.type = 'image/webp';
                reader.readAsDataURL(blob);
            }, 'image/webp');
        };
    }

    // Upload the cropped image to the server
    function uploadCroppedImage() {
        const formData = new FormData();
        formData.append('_token', $('input[name=_token]').val());
        formData.append('thumbnail', dataURLtoFile(croppedImageDataURL, 'cropped-image.png'));

        $.ajax({
            url: "{{ route('admin.posts.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.status === 'success') {
                    $('#croppedImage').attr('src', "{{ env('APP_UPLOADS_URL') }}/" + response.filename);
                    $('#croppedImage').show();
                }
            },
            error: function(xhr, status, error) {
                // Handle errors
            },
        });
    }

    // Helper function to convert a data URL to a File object
    function dataURLtoFile(dataURL, filename) {
        const arr = dataURL.split(',');
        const mime = arr[0].match(/:(.*?);/)[1];
        const bstr = atob(arr[1]);
        let n = bstr.length;
        const u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, { type: mime });
    }
    ////// End of Cropping //////
});