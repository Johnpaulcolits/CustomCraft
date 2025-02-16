<style>
     .drawing-area{
                position: absolute;
                top: 60px;
                left: 122px;
                z-index: 10;
                width: 200px;
                height: 400px;
            }

            .canvas-container{
                width: 200px; 
                height: 400px; 
                position: relative; 
                user-select: none;
            }

            #tshirt-div{
                width: 452px;
                height: 548px;
                position: relative;
                background-color: #fff;
            }

            #canvas{
                position: absolute;
                width: 200px;
                height: 400px; 
                left: 0px; 
                top: 0px; 
                user-select: none; 
                cursor: default;
            }
            .upload-btn{
                border: none;
                background-color: whitesmoke;
                padding-left: 10px;
                padding-right: 10px;
                
                
            }
            .upload-img{
                width: 50px;

            }
            .texts{
                font-size: 13px;
                margin-bottom: 0px;
            }
          /* Style for color circles */
    .color-option {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #ccc;
        cursor: pointer;
        transition: transform 0.2s, border-color 0.2s;
    }

    /* Hover effect */
    .color-option:hover {
        transform: scale(1.1);
        border-color: #000;
    }

    /* Selected color effect */
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
    max-width: 80%;
    justify-content: center;
}

.design-option {
    width: 150px;
    height: 150px;
    object-fit: cover;
    cursor: pointer;
    border: 2px solid #ccc;
    border-radius: 5px;
}

/* Container for the font size controls */
.font-size-container {
    display: flex;
    align-items: center;
    gap: 20px; /* Spacious gap between elements */
    font-family: 'Helvetica Neue', sans-serif;
    padding: 8px;
    background-color: #fff; /* Clean white background */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow with more depth */
    width: 350px;
    max-width: 100%;
    transition: all 0.3s ease-in-out; /* Smooth transition for interaction */
}

/* Label for the font size */
.font-size-container label {
    font-size: 15px;
    font-weight: 600;
    color: #333;
    margin-right: 20px;
    text-transform: uppercase; /* Adds a professional, clean touch */
    letter-spacing: 0.5px; /* Slight spacing for a modern look */
}

/* Range input styling */
.font-size-container input[type="range"] {
    width: 180px;
    -webkit-appearance: none;
    appearance: none;
    height: 8px;
    border-radius: 10px;
    background: linear-gradient(to right, #007BFF, #6c757d, #28a745); /* Smooth gradient */
    outline: none;
    transition: background 0.3s ease;
}

/* Custom thumb for the range input */
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
    transition: all 0.3s ease; /* Smooth thumb transition */
}

/* Hover effect for the thumb */
.font-size-container input[type="range"]::-webkit-slider-thumb:hover {
    background-color: #007BFF;
    border-color: #fff;
}

/* Focus effect for the range input */
.font-size-container input[type="range"]:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
}

/* Range input value displayed next to the slider */
.font-size-container #font-size-value {
    font-size: 18px;
    font-weight: 600;
    color: #007BFF;
    min-width: 40px; /* Ensures the value is aligned */
    text-align: center;
    transition: all 0.3s ease;
}

/* Hover and active effect for the font-size value */
.font-size-container:hover #font-size-value {
    color: #28a745; /* Change to a green shade when hovered */
}

 
</style>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="./javascript/index.min.js"></script>

<div class="container py-4">
  <div class="row">
    <!-- T-Shirt Display Section -->
    <div class="col-md-6 text-center">
      <div id="tshirt-div" class="position-relative">
        <img id="tshirt-backgroundpicture" src="https://ourcodeworld.com/public-media/gallery/gallery-5d5afd3f1c7d6.png" class="img-fluid" />
        <div id="drawingArea" class="drawing-area position-absolute top-0 start-50 translate-middle-x">
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
        <img src="{{asset('img/batman.png')}}" class="design-option"
         alt="Design 1" data-image="{{asset('img/batman.png')}}" />
        <!-- Add more default designs as needed -->
        <img src="{{asset('img/real.png')}}" class="design-option"
         alt="Design 2" data-image="{{asset('img/real.png')}}" />
         <img src="{{asset('img/shark.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/shark.png')}}" />
         <img src="{{asset('img/pizza.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/pizza.png')}}" />
         <img src="{{asset('img/today.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/today.png')}}" />
         <img src="{{asset('img/bless.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/bless.png')}}" />
         <img src="{{asset('img/crazy.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/crazy.png')}}" />
         <img src="{{asset('img/drag.jpg')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/drag.jpg')}}" />
         <img src="{{asset('img/fighter.jpg')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/fighter.jpg')}}" />
         <img src="{{asset('img/pray.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/pray.png')}}" />
         <img src="{{asset('img/love.png')}}" class="design-option"
         alt="Design 3" data-image="{{asset('img/love.png')}}" />
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
      <button type="button" id="upload-button" class="upload-btn"><img src="https://img.icons8.com/?size=100&id=368&format=png&color=000000" class="upload-img">
      <p class="texts">Upload</p>
    </button>
<input type="file" id="tshirt-custompicture" class="form-control d-none" />
           
      </div>
      <div class="mb-3">
  <button type="button" id="text-button" class="upload-btn">
    <img src="https://img.icons8.com/?size=100&id=nWIoqYLYpN0K&format=png&color=000000" class="upload-img">
    <p class="texts">Text</p>
  </button>   
</div>

      <div class="mb-3">
      <!-- <p id="remove-image-msg" class="mt-3" style="display: none;">To remove images, select it and press <kbd>DEL</kbd> key.</p> -->
      <div class="font-size-container">
    <label for="font-size">Font Size:</label>
    <input type="range" id="font-size" min="10" max="100" value="30">
    <span id="font-size-value">30</span>
</div>


      </div>
    </div>
  </div>

</body>
</html>
<script>
let canvas = new fabric.Canvas('tshirt-canvas');



// Show the modal when the "Choose Design" button is clicked
document.getElementById('choose-design-btn').addEventListener('click', function() {
    document.getElementById('design-modal').classList.remove('d-none');
});

// Hide the modal when a design is selected
document.querySelectorAll('.design-option').forEach(option => {
    option.addEventListener('click', function() {
        const imageURL = this.getAttribute('data-image');
        
        // Call function to update T-shirt design on the canvas
        updateTshirtImage(imageURL);
        
        // Close the modal after the design is selected
        document.getElementById('design-modal').classList.add('d-none');
    });
});

// Close the modal if the user clicks outside the design container
document.getElementById('design-modal').addEventListener('click', function(e) {
    if (!e.target.closest('.design-container')) {
        this.classList.add('d-none');
    }
});

function updateTshirtImage(imageURL){
                fabric.Image.fromURL(imageURL, function(img) {                   
                    img.scaleToHeight(300);
                    img.scaleToWidth(300); 
                    canvas.centerObject(img);
                    canvas.add(img);
                    canvas.renderAll();
                });
            }

// Get all color options
const colorOptions = document.querySelectorAll('.color-option');

// Add click event to each color option
colorOptions.forEach(option => {
    option.addEventListener('click', function() {
        // Remove 'active' class from all options
        colorOptions.forEach(opt => opt.classList.remove('active'));

        // Add 'active' class to the selected color
        this.classList.add('active');

        // Change the T-shirt background color
        const selectedColor = this.getAttribute('data-color');
        document.getElementById('tshirt-div').style.backgroundColor = selectedColor;
    });
});



// When the user clicks on upload a custom picture, trigger the file input
document.getElementById('upload-button').addEventListener('click', function() {
    document.getElementById('tshirt-custompicture').click();
});

// When the user selects a picture, upload and display it on the canvas
document.getElementById('tshirt-custompicture').addEventListener("change", function(e){
    var reader = new FileReader();
    
    reader.onload = function (event){
        var imgObj = new Image();
        imgObj.src = event.target.result;

        // When the picture loads, create the image in Fabric.js
        imgObj.onload = function () {
            var img = new fabric.Image(imgObj);

            img.scaleToHeight(300);
            img.scaleToWidth(300); 
            canvas.centerObject(img);
            canvas.add(img);
            canvas.renderAll();
        };
    };

    // If the user selected a picture, load it
    if(e.target.files[0]){
        reader.readAsDataURL(e.target.files[0]);
    }
}, false);

// When the user selects a picture that has been added and press the DEL key
// The object will be removed !
document.addEventListener("keydown", function(e) {
    var keyCode = e.keyCode;

    if(keyCode == 46){
        console.log("Removing selected element on Fabric.js on DELETE key !");
        canvas.remove(canvas.getActiveObject());
    }
}, false);







// Function to load image onto the canvas
  function loadImageToCanvas(imageUrl) {
    const canvas = document.getElementById("tshirt-canvas");
    const ctx = canvas.getContext("2d");
    
    // Create an image element
    const img = new Image();
    img.src = imageUrl;

    // Draw image to canvas once it has loaded
    img.onload = function() {
      ctx.clearRect(0, 0, canvas.width, canvas.height); // Clear previous drawing
      ctx.drawImage(img, 20, 100, 160, 200); // Position and size on canvas
    };
  }

  // Event listener for design options
  const designOptions = document.querySelectorAll(".design-option");
  designOptions.forEach(option => {
    option.addEventListener("click", function() {
      const selectedImage = this.getAttribute("data-image");
      loadImageToCanvas(selectedImage); // Load selected design onto the canvas
    });
  });




  
// Handle Text Button Click
document.getElementById('text-button').addEventListener('click', function () {
    // Automatically add editable text "Your Text"
    let text = new fabric.IText('Your Text', {
        left: 50,
        top: 150,
        fontFamily: 'Arial',
        fill: '#000', // Default text color is black
        fontSize: 30,
        selectable: true,
        editable: true
    });

    // Add text to the canvas
    canvas.add(text);
    canvas.setActiveObject(text);
    canvas.renderAll();

    // Enable editing on double-click
    text.on('mousedown', function (options) {
        if (options.e.detail === 2) { // Double-click detection
            text.enterEditing();      // Enable in-place editing
            text.selectAll();         // Select all text for easy editing
        }
    });

    // Add a custom "X" delete button to the top-right corner
    addDeleteControl(text);
});

// Function to add a delete (X) button on the object
function addDeleteControl(object) {
    object.controls.deleteControl = new fabric.Control({
        x: 0.5,               // Position at the top-right corner
        y: -0.5,
        offsetY: -15,
        offsetX: 15,
        cursorStyle: 'pointer',
        mouseUpHandler: deleteObject,
        render: renderDeleteIcon,
        cornerSize: 30  // Increased size of the button
    });
}

// Delete handler
function deleteObject(eventData, transform) {
    const target = transform.target;
    canvas.remove(target);
    canvas.requestRenderAll();
}

// Render the delete icon (X)
function renderDeleteIcon(ctx, left, top, styleOverride, fabricObject) {
    const size = this.cornerSize;
    ctx.save();
    ctx.fillStyle = 'red';

    // Bigger red circle
    ctx.beginPath();
    ctx.arc(left, top, size / 2.5, 0, 2 * Math.PI, false);
    ctx.fill();

    // Thicker and larger white "X"
    ctx.strokeStyle = 'white';
    ctx.lineWidth = 4;  // Thicker lines for the "X"
    ctx.beginPath();
    ctx.moveTo(left - size / 4, top - size / 4);
    ctx.lineTo(left + size / 4, top + size / 4);
    ctx.moveTo(left + size / 4, top - size / 4);
    ctx.lineTo(left - size / 4, top + size / 4);
    ctx.stroke();

    ctx.restore();
}

// Resize text based on font-size input
document.getElementById('font-size').addEventListener('input', function (e) {
    const fontSize = e.target.value;
    document.getElementById('font-size-value').textContent = fontSize; // Update font size label

    const activeObject = canvas.getActiveObject();
    if (activeObject && activeObject.set) {
        activeObject.set({ fontSize: fontSize }); // Update the font size of the active object
        canvas.renderAll(); // Re-render the canvas to reflect the changes
    }
});









</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>