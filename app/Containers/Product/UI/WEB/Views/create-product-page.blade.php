<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Product</title>
</head>

<style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Roboto', sans-serif;
        font-weight: 100;
        height: 100%;
        margin: 0;
    }

    .parent {

        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
    }

    .content {
        text-align: center;
        margin-top: 20px;
        padding: 20px;
        width: 60%;
        border-radius: 5px;
        height: 100%;
    }

    .custom-file-upload {
        border: 1px solid #ccc;
        display: flex;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;

        justify-content: flex-start;
        height: fit-content;
        margin-right: 15px
    }

    input[type="file"] {
        display: none;
    }

    .add-new-product {
        text-align: center;
        justify-content: center;
        margin: 20px 0;
        padding: 20px;
        border-radius: 5px;
        border: #636b6f 1px solid;
    }

    .back-to-list {
        text-align: left;
    }

    a {
        text-decoration: none;
        color: #411df3;
        font-size: 18px;
    }

    a:hover {
        color: #9b2d2d;
    }

    form {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    input {
        margin-bottom: 10px;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    button {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ddd;
        background-color: #9b2d2d;
        color: white;
        font-size: 18px;
        font-weight: bold;
    }

    button:hover {
        background-color: #7a1f1f;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    table th,
    table td {
        text-align: left;
        padding: 16px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }

    tr:hover {
        background-color: #ddd;
    }

    th {
        background-color: #9b2d2d;
        color: white;
    }

    .btn-create {
        background-color: #9b2d2d;
        color: white;
        font-size: 18px;
        font-weight: bold;
    }

    .btn-create:hover {
        background-color: #7a1f1f;
    }

    #preview,
    img {
        width: 100px;
        height: 100px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .error {
        color: red;
        font-size: 14px;
    }

    .product {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .image {
        width: 100px;
        height: 100px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
    }

    .name {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .description {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .info {
        text-align: left;
    }

    .btn-edit {
        background-color: #351593;
        color: white;
        font-size: 18px;
        font-weight: bold;
        margin-right: 10px;
    }

    .btn-edit:hover {
        background-color: #411df3;
    }

    .notiError {
        color: red;
    }
</style>

<script>
    function confirmCreateNewProduct() {
        var name = document.getElementById('name').value;
        var description = document.getElementById('description').value;
        var image = document.getElementById('image').value;

        if (name.trim() == "") {
            alert("Name is required!");
            return;
        } else if (name.trim().length < 3) {
            alert("The Name must be at least 3 characters.");

            return;
        } else if (name.trim().length > 255) {
            alert("The Name may not be greater than 255 characters.");
            return;
        }

        if (description.trim() == "") {
            alert("Description is required!");
            return;
        } else if (description.trim().length < 3) {
            alert("The Description must be at least 3 characters.");
            return;
        } else if (description.trim().length > 4096) {
            alert("The Description may not be greater than 4096 characters.");
            return;
        }

        if (image) {
            var extension = image.split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'svg']) == -1) {
                alert('Invalid Image File!');
                return;
            }
            var imageSize = document.getElementById("image").files[0].size;
            if (imageSize > 10000000) {
                alert("Image size is too large!");
                return;
            }
        } else {
            alert('Please select an image!');
            return;
        }


        if (name == '' || description == '' || image == '') {
            alert('Please fill in all fields');
        } else {
            document.querySelector("#create-product").submit();
        }
    }

    function previewImage() {
        var file = document.getElementById("image").files;
        if (file.length > 0) {
            document.getElementById("preview").style.display = "inline-block";
            var fileReader = new FileReader();
            fileReader.onload = function(event) {
                document.getElementById("preview").setAttribute("src", event.target.result);
            };
            fileReader.readAsDataURL(file[0]);
        } else {
            document.getElementById("preview").style.display = "none";
        }

        var image = document.getElementById('image').value;
        if (image) {
            var extension = image.split('.').pop().toLowerCase();
            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg', 'svg']) == -1) {
                document.getElementById("errorImage").innerHTML = "Invalid Image File!";
                return;
            } else {
                document.getElementById("errorImage").innerHTML = "";
            }
            var imageSize = document.getElementById("image").files[0].size;
            if (imageSize > 10000000) {
                document.getElementById("errorImage").innerHTML = "Image size is too large!";
                return;
            } else {
                document.getElementById("errorImage").innerHTML = "";
            }
        }
    }

    function validateDescription() {
        var description = document.getElementById('description').value;
        if (description.trim() == "") {
            document.getElementById("errorDescription").innerHTML = "Description is required!";
            return;
        } else if (description.trim().length < 3) {
            document.getElementById("errorDescription").innerHTML = "The description must be at least 3 characters.";
            return;
        } else if (description.trim().length > 4096) {
            document.getElementById("errorDescription").innerHTML =
                "The description may not be greater than 4096 characters.";
            return;
        } else {
            document.getElementById("errorDescription").innerHTML = "";
        }
    }

    function validateName() {
        var name = document.getElementById('name').value;
        if (name.trim() == "") {
            document.getElementById("errorName").innerHTML = "Name is required!";
            return;
        } else if (name.trim().length < 3) {
            document.getElementById("errorName").innerHTML = "The name must be at least 3 characters.";
            return;
        } else if (name.trim().length > 255) {
            document.getElementById("errorName").innerHTML = "The name may not be greater than 255 characters.";
            return;
        } else {
            document.getElementById("errorName").innerHTML = "";
        }
    }
</script>

<body>
    <div class="parent">
        <div class="content">
            <div class="back-to-list">
                <a href="{{ route('web_product_get_all_products') }}"> Back to List products</a>
            </div>
            <div class="add-new-product">
                <form id="create-product" action="{{ route('web_product_create') }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <h2>Add new product</h2>
                    <input id="name" type="text" name="name" placeholder="Name"
                        @php if (old('name')) {
                            echo 'value="' . old('name') . '"';
                        } @endphp
                        oninput="validateName()">
                    <span id="errorName" class="notiError">
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </span>

                    <input id="description" type="text" name="description" placeholder="Description"
                        @php if (old('name')) {
                      echo 'value="' . old('description') . '"';
                    } @endphp
                        oninput="validateDescription()">
                    <span id="errorDescription" class="notiError">
                        @if ($errors->has('description'))
                            {{ $errors->first('description') }}
                        @endif
                    </span>

                    <div style="display: flex; width: 100%; padding-bottom: 15px">
                        <label class="custom-file-upload">
                            <input type="file" name="image" id="image" oninput="previewImage()" />
                            Upload Product's Image
                        </label>
                        <img id="preview" src="" alt="image" width="100px" height="100px">
                    </div>
                    <span id="errorImage" class="notiError">
                        @if ($errors->has('image'))
                            {{ $errors->first('image') }}
                        @endif
                    </span>

                    <button type="button" onclick="confirmCreateNewProduct()">Add new product</button>
                </form>
            </div>
            @if ($product != null)
                <div class="product">
                    <h2 style="color: #411df3">Create New Product Successfully!!</h2>
                    <div class="image">
                        <img src="{{ asset($product->image) }}" alt="" width="100px">
                    </div>
                    <div class="info">
                        <div class="name">
                            <h3>Product Name: {{ $product->name }}</h3>
                        </div>
                        <div class="description">
                            <p>Product Description: {{ $product->description }}</p>
                        </div>
                    </div>
                    <form action="{{ route('web_product_find_by_id', $product->id) }}" method="GET">
                        <input type="submit" class="btn-edit" value="More Detail">
                    </form>
                </div>
            @else
                <h2>Product not found</h2>
            @endif
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    previewImage();
</script>

</html>
