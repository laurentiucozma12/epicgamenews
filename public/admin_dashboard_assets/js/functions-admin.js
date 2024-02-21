$(document).ready(function () {
    ////// Select //////
    $(".single-select").select2({
        theme: "bootstrap4",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
        allowClear: Boolean($(this).data("allow-clear")),
    });
    $(".multiple-select").select2({
        theme: "bootstrap4",
        width: $(this).data("width")
            ? $(this).data("width")
            : $(this).hasClass("w-100")
            ? "100%"
            : "style",
        placeholder: $(this).data("placeholder"),
        allowClear: Boolean($(this).data("allow-clear")),
    });
    ////// End of Select //////

    ////// START - Alert Messages //////
    // $(document).ready(function () {

    $("img").lazyload();

    setTimeout(() => {
        $(".general-message").fadeOut();
    }, 5000);

    setTimeout(() => {
        $(".info-message").fadeOut();
    }, 60000);

    // });
    ////// END - Alert Messages //////

    ////// START - Cropping //////
    let cropper;
    let croppedImageDataURL;

    // Initialize the Cropper.js instance when the modal is shown
    $("#cropImageModal").on("shown.bs.modal", function () {
        cropper = new Cropper($("#imageToCrop")[0], {
            aspectRatio: 16 / 9,
            viewMode: 1,
            autoCropArea: 0.8,
        });
    });

    // Destroy the Cropper.js instance when the modal is hidden
    $("#cropImageModal").on("hidden.bs.modal", function () {
        cropper.destroy();
        cropper = null;
    });

    let previousFileName = null; // Initialize with null

    // Show the image cropping modal when an image is selected
    $("#thumbnail").on("change", function (event) {
        const file = event.target.files[0];
        const fileReader = new FileReader();

        // Get the value from the file input element
        const filePath = $("#thumbnail").val();
        // Use JavaScript to extract only the file name
        const fileName = filePath.split("\\").pop();

        if (fileName === previousFileName) {
            clearSelectedImage();
        }

        // Update the previous file name
        previousFileName = file.name;

        fileReader.onload = function (e) {
            $("#imageToCrop").attr("src", e.target.result);
            $("#cropImageModal").modal("show");
        };

        fileReader.readAsDataURL(file);
    });

    // Handle the "Crop and Upload" button click
    $("#cropAndUpload").on("click", function () {
        croppedImageDataURL = cropper.getCroppedCanvas().toDataURL();

        // Convert the cropped image to WebP
        convertToWebP(croppedImageDataURL);

        $("#cropImageModal").modal("hide");
        $("#croppedImage").attr("src", croppedImageDataURL);
        $("#croppedImage").show();
    });

    // Prevent modal from closing when clicking outside
    $("#cropImageModal").modal({
        backdrop: "static",
        keyboard: false,
    });

    // Handle the "Cancel" button click
    $("#cancelCrop").on("click", function () {
        clearSelectedImage();
        $("#cropImageModal").modal("hide");
    });

    // Clear selected image data and image preview
    function clearSelectedImage() {
        $("#thumbnail").val(""); // Clear the thumbnail input value
        $("#imageToCrop").attr("src", ""); // Clear the image preview
        $("#croppedImageData").val(""); // Clear the hidden input value
        $("#croppedImage").attr("src", "").hide(); // Remove the cropped image preview and hide it
    }

    // Function to convert the image to WebP
    function convertToWebP(dataURL) {
        const image = new Image();
        image.src = dataURL;

        image.onload = function () {
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");

            canvas.width = image.width;
            canvas.height = image.height;
            context.drawImage(image, 0, 0, canvas.width, canvas.height);

            // Convert the canvas to WebP format
            canvas.toBlob(function (blob) {
                const reader = new FileReader();

                reader.onloadend = function () {
                    const webpDataURL = reader.result;

                    // Set the WebP data URL in the hidden input
                    $("#croppedImageData").val(webpDataURL);
                };

                // Convert the blob to a data URL with the "image/webp" MIME type
                blob.type = "image/webp";
                reader.readAsDataURL(blob);
            }, "image/webp");
        };
    }
    ////// END - Cropping //////

    ////// START - Tiny MCE //////
    images_upload_handler = (blobInfo, progress) =>
        new Promise((resolve, reject) => {
            const formData = new FormData();
            let _token = $("input[name='token']").val();

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('admin.upload_tinymce_image') }}");

            xhr.onload = () => {
                if (xhr.status === 403) {
                    reject({
                        message: "HTTP Error: " + xhr.status,
                        remove: true,
                    });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    reject("HTTP Error: " + xhr.status);
                    return;
                }

                const json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != "string") {
                    reject("Invalid JSON: " + xhr.responseText);
                    return;
                }

                resolve(json.location);
            };

            formData.append("_token", "{{ csrf_token() }}");
            formData.append("file", blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        });

    tinymce.init({
        selector: "#body, #description",
        plugins:
            "advlist  anchor autolink autosave charmap codesample directionality emoticons help image insertdatetime link linkchecker lists media nonbreaking pagebreak searchreplace table visualblocks visualchars wordcount",
        toolbar:
            "undo redo spellcheckdialog  | blocks fontfamily fontsizeinput | bold italic underline forecolor backcolor | link image | align lineheight checklist bullist numlist | indent outdent | removeformat typography",
        height: "700px",

        //HTML custom font options
        font_size_formats:
            "8pt 9pt 10pt 11pt 12pt 14pt 18pt 24pt 30pt 36pt 48pt 60pt 72pt 96pt",

        toolbar_sticky: true,
        autosave_restore_when_empty: true,
        spellchecker_active: true,
        spellchecker_language: "en_US",
        spellchecker_languages:
            "English (United States)=en_US,English (United Kingdom)=en_GB,Danish=da,French=fr,German=de,Italian=it,Polish=pl,Spanish=es,Swedish=sv",
        typography_langs: ["en-US"],
        typography_default_lang: "en-US",

        image_title: true,
        automatic_uploads: true,

        images_upload_handler: images_upload_handler,
    });
    ////// END - Tiny MCE //////

    ////// START - GAMES API //////
    $(document).keyup(function (event) {
        // Check if the pressed key is Enter (key code 13)
        if (event.keyCode === 13) {
            // Trigger the click event for the button with the specified ID
            $("#searchGameButton").click();
        }
    });
    $("#searchGameButton").on("click", function () {
        // Get the value from the input
        const searchVideoGame = $("#gameName").val();

        // Make an API request to fetch the video game data
        if (searchVideoGame.length > 0) {
            fetch(
                `https://api.rawg.io/api/games?key=${GAMES_API}&search=${searchVideoGame}`
            )
                .then((response) => response.json())
                .then((data) => {
                    // Update the input with the fetched video game name
                    if (data.results.length > 0) {
                        // Display other information
                        const gameThumbnail = $("#fetchedGameThumbnail");
                        const gameName = $("#fetchedGameName");
                        const gameSlug = $("#fetchedGameSlug");
                        const gameGenres = $("#fetchedGameGenres");
                        const gamePlatforms = $("#fetchedGamePlatforms");

                        gameThumbnail.empty();
                        gameName.empty();
                        gameSlug.empty();
                        gameGenres.empty();
                        gamePlatforms.empty();

                        data.results.forEach((fetchedVideoGame) => {
                            if (
                                fetchedVideoGame.genres.length > 0 &&
                                fetchedVideoGame.platforms.length
                            ) {
                                // Create new row
                                const newRow = $("<tr></tr>");

                                // Append each piece of information to its respective <td>
                                newRow.append(
                                    $(
                                        `<td><img src="${fetchedVideoGame.background_image}" width="50"></td>`
                                    )
                                );
                                newRow.append(
                                    $("<td>").text(fetchedVideoGame.name)
                                );
                                newRow.append(
                                    $("<td>").text(fetchedVideoGame.slug)
                                );

                                // Display genres
                                let genresNames = "";
                                let genresSlugs = "";
                                if (
                                    fetchedVideoGame.genres &&
                                    fetchedVideoGame.genres.length > 0
                                ) {
                                    fetchedVideoGame.genres.forEach(
                                        (genre, index) => {
                                            genresNames += genre.name;
                                            genresSlugs += genre.slug;

                                            // Add a comma if it's not the last genre
                                            if (
                                                index <
                                                fetchedVideoGame.genres.length -
                                                    1
                                            ) {
                                                genresNames += ", ";
                                                genresSlugs += ", ";
                                            }
                                        }
                                    );

                                    newRow.append($("<td>").text(genresNames));
                                } else {
                                    newRow.append($("<td>"));
                                }

                                // Display platforms
                                let platformsNames = "";
                                let platformsSlugs = "";
                                if (
                                    fetchedVideoGame.platforms &&
                                    fetchedVideoGame.platforms.length > 0
                                ) {
                                    fetchedVideoGame.platforms.forEach(
                                        (platform, index) => {
                                            platformsNames +=
                                                platform.platform.name;
                                            platformsSlugs +=
                                                platform.platform.slug;

                                            // Add a comma if it's not the last platform
                                            if (
                                                index <
                                                fetchedVideoGame.platforms
                                                    .length -
                                                    1
                                            ) {
                                                platformsNames += ", ";
                                                platformsSlugs += ", ";
                                            }
                                        }
                                    );

                                    newRow.append(
                                        $("<td>").text(platformsNames)
                                    );
                                } else {
                                    newRow.append($("<td>"));
                                }

                                var form = $(`
                                    <th>
                                        <form action="/admin/video-games/store_api" method="POST" enctype="multipart/form-data" class="mb-0">
                                            <input type="hidden" name="_token" value="${window.csrf_token}">
                                            <input type="hidden" name="game_background_image" value="${fetchedVideoGame.background_image}">
                                            <input type="hidden" name="game_name" value="${fetchedVideoGame.name}">
                                            <input type="hidden" name="game_slug" value="${fetchedVideoGame.slug}">
                                            <input type="hidden" name="genres_names" value="${genresNames}">
                                            <input type="hidden" name="genres_slugs" value="${genresSlugs}">
                                            <input type="hidden" name="platforms_names" value="${platformsNames}">
                                            <input type="hidden" name="platforms_slugs" value="${platformsSlugs}">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </form>
                                    </th>
                                `);
                                newRow.append(form);

                                // Append the new form to the tbody
                                $("#table-game-api").append(newRow);
                            }
                        });
                    } else {
                        // Handle the case when no matching video game is found
                        alert("Video game not found in the API.");
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
            // end fetching the API
        } else {
            alert("You must write something before searching!");
        }
    });
    ////// END - SEARCH FOR GAMES API //////
}); // End document ready
