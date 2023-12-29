
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
    

    ////// START - SEARCH FOR GAMES in video_games/post_api.blade.php //////
    $('#searchGameButton').on('click', function () {
        // Get the value from the input
        const searchVideoGame = $('#gameName').val();
    
        // Make an API request to fetch the video game data
        fetch(`https://api.rawg.io/api/games?key=${GAMES_API}&search=${searchVideoGame}`)
            .then(response => response.json())
            .then(data => {
                // Handle the API response
                console.log(data);
    
                // Update the input with the fetched video game name
                if (data.results.length > 0) {
                    // Display other information
                    const gameName = $('#fetchedGameName');
                    const gameSlug = $('#fetchedGameSlug');
                    const gameGenres = $('#fetchedGameGenres');
                    const gamePlatforms = $('#fetchedGamePlatforms');
                    
                    gameName.empty();
                    gameSlug.empty();
                    gameGenres.empty();
                    gamePlatforms.empty();
    
                    data.results.forEach(fetchedVideoGame => {
                        $('#inputProductTitle').val(fetchedVideoGame.name);
    
                        gameName.append(`${fetchedVideoGame.name}`);
                        gameSlug.append(`${fetchedVideoGame.slug}`);
    
                        // Update the input with the fetched video game name
                        if (data.results.length > 0) {
                            // Create new row
                            const newRow = $('<tr></tr>');

                            // Append each piece of information to its respective <td>
                            newRow.append($('<td>').text(fetchedVideoGame.name));
                            newRow.append($('<td>').text(fetchedVideoGame.slug));

                            // Display genres
                            if (fetchedVideoGame.genres && fetchedVideoGame.genres.length > 0) {
                                let genresString = "";

                                fetchedVideoGame.genres.forEach((genre, index) => {
                                    genresString += genre.name;

                                    // Add a comma if it's not the last genre
                                    if (index < fetchedVideoGame.genres.length - 1) {
                                        genresString += ", ";
                                    }
                                });

                                newRow.append($('<td>').text(genresString));
                            } else {
                                newRow.append($('<td>').text('No genres'));
                            }

                            // Display platforms
                            if (fetchedVideoGame.platforms && fetchedVideoGame.platforms.length > 0) {
                                let platformsString = "";

                                fetchedVideoGame.platforms.forEach((platform, index) => {
                                    platformsString += platform.platform.name;

                                    // Add a comma if it's not the last platform
                                    if (index < fetchedVideoGame.platforms.length - 1) {
                                        platformsString += ", ";
                                    }
                                });

                                newRow.append($('<td>').text(platformsString));
                            } else {
                                newRow.append($('<td>').text('No platforms'));
                            }

                            newRow.append($('<td class="d-flex order-actions"><button type="button" class="btn btn-primary" id="searchGameButton">Add</button></td>'));

                            // Append the new row to the tbody
                            $('tbody').append(newRow);
                        } else {
                            // Handle the case when no matching video game is found
                            alert('Video game not found in the API.');
                        }

                    });
                } else {
                    // Handle the case when no matching video game is found
                    alert('Video game not found in the API.');
                }
            })
            .catch(error => {
                console.error(error);
            });
    });
    ////// END - SEARCH FOR GAMES in video_games/post_api.blade.php //////


    ////// START - GAMES_API //////
    // const gameList = document.querySelector(".gameList");
    // const loadMoreGamesBtn = document.querySelector(".main-button");
    // let nextGameListUrl = null;

    // const gamesURL = `https://api.rawg.io/api/games?key=${GAMES_API}&date=2023-12-01,2023-12-12&ordering=-added`;

    // const getPlatformsStr = (platforms) => {
    //     const platformsStr = platforms.map(each => each.platform.name).join(", ")

    //     if (platformsStr.length > 30) {
    //         return platformsStr.subtring(0, 30) + "...";
    //     }

    //     return platformsStr;
    // };

    // const getGenresStr = (genres) => {
    //     const genresStr = genres.map(each => each.genre.name).join(", ")

    //     if (genresStr.length > 30) {
    //         return genresStr.subtring(0, 30) + "...";
    //     }

    //     return genresStr;
    // };

    // console.log(gamesURL, "check");

    // function loadGames(gamesURL) {

    //     fetch(gamesURL)
    //         .then(response => response.json())
    //         .then(data => {
    //             console.log(data);
    //             nextGameListUrl = data.next ? data.next : null;
    //             const games = data.results;

    //             games.forEach(game => {
    //                 const gameItemEl = `
    //                     <div class="col-lg-4 col-md-6 col-sm-12">
    //                         <div class="item">
    //                             <img src="${game.background_image}" alt="${game.name} image"/>
    //                             <h4 class="game-name">${game.name}</br>
    //                                 <span class="platforms">${getPlatformsStr(game.parent_platforms)}</span></br>
    //                                 <span class="categories">${getGenresStr(game.parent_genres)}</span>
    //                             </h4>
    //                         </div>
    //                     </div>
    //                 `
    //                 gameList.insertAdjacentElement("beforeend", gameItemEl);
    //             });

    //             if (nextGameListUrl) {
    //                 loadMoreGamesBtn.classList.remove("hidden");
    //             } else {
    //                 loadMoreGamesBtn.classList.add("hidden");                
    //             }
    //         })
    //         .catch(error => {
    //             console.log("An error occured: ", error)
    //         })

    // }

    // loadGames(gamesURL);

    // loadMoreGamesBtn.addEventListener('click', () => {
    //     if(nextGameListUrl) {
    //         loadGames(nextGameListUrl);
    //     }
    // })
    ////// END - GAMES_API //////

    
}); // End document ready