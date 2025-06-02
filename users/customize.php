<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: ../login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cutomize</title>
    <link rel="shortcut icon" href="../admin/assets/images/logo/icon-logo.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        /* Your existing CSS styles */
        .drawing-area {
            position: absolute;
            top: 60px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            width: 200px;
            height: 400px;
        }

        .canvas-container {
            width: 100%;
            height: 100%;
            position: relative;
            user-select: none;
        }

        #tshirt-div {
            width: 100%;
            max-width: 452px;
            height: auto;
            position: relative;
            background-color: #fff;
            margin: 0 auto;
        }

        #canvas {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            user-select: none;
            cursor: default;
        }

        .upload-btn {
            border: none;
            background-color: whitesmoke;
            padding: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .upload-img {
            width: 50px;
        }

        .texts {
            font-size: 13px;
            margin-bottom: 0;
        }

        .color-option {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ccc;
            cursor: pointer;
            transition: transform 0.2s, border-color 0.2s;
        }

        .color-option:hover {
            transform: scale(1.1);
            border-color: #000;
        }

        .color-option.active {
            border: 3px solid #000;
        }

        .design-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100;
        }

        .design-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            max-width: 90%;
            justify-content: center;
        }

        .design-option {
            width: 100px;
            height: 100px;
            object-fit: cover;
            cursor: pointer;
            border: 2px solid #ccc;
            border-radius: 5px;
        }

        .font-size-container {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Helvetica Neue', sans-serif;
            padding: 8px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 350px;
            transition: all 0.3s ease-in-out;
        }

        .font-size-container label {
            font-size: 15px;
            font-weight: 600;
            color: #333;
            margin-right: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .font-size-container input[type="range"] {
            width: 100%;
            max-width: 180px;
            -webkit-appearance: none;
            appearance: none;
            height: 8px;
            border-radius: 10px;
            background: linear-gradient(to right, #007BFF, #6c757d, #28a745);
            outline: none;
            transition: background 0.3s ease;
        }

        .font-size-container input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: #fff;
            border: 2px solid #007BFF;
            cursor: pointer;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .font-size-container input[type="range"]::-webkit-slider-thumb:hover {
            background-color: #007BFF;
            border-color: #fff;
        }

        .font-size-container #font-size-value {
            font-size: 18px;
            font-weight: 600;
            color: #007BFF;
            min-width: 40px;
            text-align: center;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .drawing-area {
                top: 30px;
                width: 150px;
                height: 300px;
            }

            #tshirt-div {
                max-width: 300px;
            }

            .design-option {
                width: 80px;
                height: 80px;
            }

            .font-size-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 5px;
            }

            .font-size-container input[type="range"] {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row">
            <!-- T-Shirt Display Section -->
            <div class="col-md-6 text-center">
                <div id="tshirt-div" class="position-relative">
                    <img id="tshirt-backgroundpicture" src="https://ourcodeworld.com/public-media/gallery/gallery-5d5afd3f1c7d6.png" class="img-fluid" />
                    <div id="drawingArea" class="drawing-area">
                        <div class="canvas-container">
                            <canvas id="tshirt-canvas" width="200" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customization Options -->
            <div class="col-md-6">
                <div class="mb-3">
                    <button id="choose-design-btn" class="upload-btn">
                        <img src="https://img.icons8.com/?size=100&id=zjaqmfyMzl83&format=png&color=000000" class="upload-img">
                        <p class="texts">Design</p>
                    </button>
                </div>

                <!-- Modal or Dropdown for Design Selection -->
                <div id="design-modal" class="design-modal d-none">
                    <div class="design-container">
                        <img src="{{asset('img/batman.png')}}" class="design-option" alt="Design 1" data-image="{{asset('img/batman.png')}}" />
                        <img src="{{asset('img/real.png')}}" class="design-option" alt="Design 2" data-image="{{asset('img/real.png')}}" />
                        <img src="{{asset('img/shark.png')}}" class="design-option" alt="Design 3" data-image="{{asset('img/shark.png')}}" />
                        <img src="{{asset('img/pizza.png')}}" class="design-option" alt="Design 4" data-image="{{asset('img/pizza.png')}}" />
                        <img src="{{asset('img/today.png')}}" class="design-option" alt="Design 5" data-image="{{asset('img/today.png')}}" />
                        <img src="{{asset('img/bless.png')}}" class="design-option" alt="Design 6" data-image="{{asset('img/bless.png')}}" />
                        <img src="{{asset('img/crazy.png')}}" class="design-option" alt="Design 7" data-image="{{asset('img/crazy.png')}}" />
                        <img src="{{asset('img/drag.jpg')}}" class="design-option" alt="Design 8" data-image="{{asset('img/drag.jpg')}}" />
                        <img src="{{asset('img/fighter.jpg')}}" class="design-option" alt="Design 9" data-image="{{asset('img/fighter.jpg')}}" />
                        <img src="{{asset('img/pray.png')}}" class="design-option" alt="Design 10" data-image="{{asset('img/pray.png')}}" />
                        <img src="{{asset('img/love.png')}}" class="design-option" alt="Design 11" data-image="{{asset('img/love.png')}}" />
                    </div>
                </div>

                <div class="mb-3">
                    <label for="tshirt-color" class="form-label">Colors:</label>
                    <div id="tshirt-color" class="form-select d-flex gap-2">
                        <div class="color-option" data-color="#fff" style="background-color: #fff;" title="White"></div>
                        <div class="color-option" data-color="#000" style="background-color: #000;" title="Black"></div>
                        <div class="color-option" data-color="#f00" style="background-color: #f00;" title="Red"></div>
                        <div class="color-option" data-color="#008000" style="background-color: #008000;" title="Green"></div>
                        <div class="color-option" data-color="#ff0" style="background-color: #ff0;" title="Yellow"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <button type="button" id="upload-button" class="upload-btn">
                        <img src="https://img.icons8.com/?size=100&id=368&format=png&color=000000" class="upload-img">
                        <p class="texts">Upload</p>
                    </button>
                    <input type="file" id="tshirt-custompicture" class="form-control d-none" />
                </div>

                <div class="mb-3">
                    <button type="button" id="text-button" class="upload-btn">
                        <img src="https://img.icons8.com/?size=100&id=nWIoqYLYpN0K&format=png&color=000000" class="upload-img">
                        <p class="texts">Text</p>
                    </button>
                    <input type="color" id="text-color-picker" value="#000000" title="Choose text color">
                </div>

                

                <div class="mb-3">
                    <div class="font-size-container">
                        <label for="font-size">Font Size:</label>
                        <input type="range" id="font-size" min="10" max="100" value="30">
                        <span id="font-size-value">30</span>
                    </div>
                </div>
            


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="../javascript/index.min.js"></script>
    <script>
        let canvas = new fabric.Canvas('tshirt-canvas');

        // Show the modal when the "Choose Design" button is clicked
        document.getElementById('choose-design-btn').addEventListener('click', function () {
            document.getElementById('design-modal').classList.remove('d-none');
        });

        // Hide the modal when a design is selected
        document.querySelectorAll('.design-option').forEach(option => {
            option.addEventListener('click', function () {
                const imageURL = this.getAttribute('data-image');
                updateTshirtImage(imageURL);
                document.getElementById('design-modal').classList.add('d-none');
            });
        });

        // Close the modal if the user clicks outside the design container
        document.getElementById('design-modal').addEventListener('click', function (e) {
            if (!e.target.closest('.design-container')) {
                this.classList.add('d-none');
            }
        });

        function updateTshirtImage(imageURL) {
            fabric.Image.fromURL(imageURL, function (img) {
                img.scaleToHeight(300);
                img.scaleToWidth(300);
                canvas.centerObject(img);
                canvas.add(img);
                canvas.renderAll();
            });
        }

        // Handle T-Shirt Color Change
        const colorOptions = document.querySelectorAll('.color-option');
        colorOptions.forEach(option => {
            option.addEventListener('click', function () {
                colorOptions.forEach(opt => opt.classList.remove('active'));
                this.classList.add('active');
                const selectedColor = this.getAttribute('data-color');
                document.getElementById('tshirt-div').style.backgroundColor = selectedColor;
            });
        });

        // Handle Upload Button Click
        document.getElementById('upload-button').addEventListener('click', function () {
            document.getElementById('tshirt-custompicture').click();
        });

        // Handle Custom Picture Upload
        document.getElementById('tshirt-custompicture').addEventListener("change", function (e) {
            var reader = new FileReader();
            reader.onload = function (event) {
                var imgObj = new Image();
                imgObj.src = event.target.result;
                imgObj.onload = function () {
                    var img = new fabric.Image(imgObj);
                    img.scaleToHeight(300);
                    img.scaleToWidth(300);
                    canvas.centerObject(img);
                    canvas.add(img);
                    canvas.renderAll();
                };
            };
            if (e.target.files[0]) {
                reader.readAsDataURL(e.target.files[0]);
            }
        }, false);

        // Handle Delete Key Press
        document.addEventListener("keydown", function (e) {
            if (e.keyCode == 46) {
                canvas.remove(canvas.getActiveObject());
            }
        }, false);

        // Handle Text Button Click
        document.getElementById('text-button').addEventListener('click', function () {
            let text = new fabric.IText('Your Text', {
                left: 50,
                top: 150,
                fontFamily: 'Arial',
                fill: '#000',
                fontSize: 30,
                selectable: true,
                editable: true
            });
            canvas.add(text);
            canvas.setActiveObject(text);
            canvas.renderAll();
            addDeleteControl(text);
        });

        // Handle Text Color Change
        document.getElementById('text-color-picker').addEventListener('input', function (e) {
            const selectedColor = e.target.value;
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.isType('IText')) {
                activeObject.set({ fill: selectedColor });
                canvas.renderAll();
            }
        });

        // Handle Font Size Change
        document.getElementById('font-size').addEventListener('input', function (e) {
            const fontSize = e.target.value;
            document.getElementById('font-size-value').textContent = fontSize;
            const activeObject = canvas.getActiveObject();
            if (activeObject && activeObject.set) {
                activeObject.set({ fontSize: fontSize });
                canvas.renderAll();
            }
        });

        // Add Delete Control to Objects
        function addDeleteControl(object) {
            object.controls.deleteControl = new fabric.Control({
                x: 0.5,
                y: -0.5,
                offsetY: -15,
                offsetX: 15,
                cursorStyle: 'pointer',
                mouseUpHandler: deleteObject,
                render: renderDeleteIcon,
                cornerSize: 30
            });
        }

        // Delete Object Handler
        function deleteObject(eventData, transform) {
            const target = transform.target;
            canvas.remove(target);
            canvas.requestRenderAll();
        }

        // Render Delete Icon
        function renderDeleteIcon(ctx, left, top, styleOverride, fabricObject) {
            const size = this.cornerSize;
            ctx.save();
            ctx.fillStyle = 'red';
            ctx.beginPath();
            ctx.arc(left, top, size / 2.5, 0, 2 * Math.PI, false);
            ctx.fill();
            ctx.strokeStyle = 'white';
            ctx.lineWidth = 4;
            ctx.beginPath();
            ctx.moveTo(left - size / 4, top - size / 4);
            ctx.lineTo(left + size / 4, top + size / 4);
            ctx.moveTo(left + size / 4, top - size / 4);
            ctx.lineTo(left - size / 4, top + size / 4);
            ctx.stroke();
            ctx.restore();
        }
       
    </script>
</body>
</html>