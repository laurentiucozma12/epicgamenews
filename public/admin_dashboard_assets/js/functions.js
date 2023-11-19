
$(document).ready(function() {

    ////// START - Alert Messages //////
        $(document).ready(function () {
    
            $('img').lazyload();
    
            setTimeout(() => {
                $(".general-message").fadeOut();
            }, 5000);
    
            setTimeout(() => {
                $(".info-message").fadeOut();
            }, 60000);
    
        });
    ////// END - Alert Messages //////
    
    ////// START - Cropping //////
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
    ////// END - Cropping //////
    
    ////// START - Tiny MCE //////
        images_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {  
            const formData = new FormData();
            let _token = $("input[name='token']").val();
    
            const xhr = new XMLHttpRequest();
            xhr.open('POST', "{{ route('admin.upload_tinymce_image') }}");
    
            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
                    return;
                }
    
                if (xhr.status < 200 || xhr.status >= 300) {
                    reject('HTTP Error: ' + xhr.status);
                    return;
                }
    
                const json = JSON.parse(xhr.responseText);
    
                if (!json || typeof json.location != 'string') {
                    reject('Invalid JSON: ' + xhr.responseText);
                    return;
                }
    
                resolve(json.location);
            };
    
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });
    
        tinymce.init({
            selector: 'textarea#body',
            plugins: 'advlist autolink lists link image media charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
            height: '500',
    
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image code | rtl ltr',
            toolbar_mode: 'floating',
    
            image_title: true,
            automatic_uploads: true,
    
            images_upload_handler: images_upload_handler,
        });
    ////// END - Tiny MCE //////
    
    
    });