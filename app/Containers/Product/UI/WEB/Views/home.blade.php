@extends('product::products-list')

@section('css')
    <style>
        html,
        body {
            background-color: #fff;
            color: #000000;
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
            width: 70%;
            border-radius: 5px;
            height: 100%;
        }

        .links {
            text-align: center;
            justify-content: center;
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
            border: #636b6f 1px solid;
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
            text-align: center;
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
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .btn-create:hover {
            background-color: #7a1f1f;
        }

        .create-new-product {
            width: 20%;
        }

        img {
            border-radius: 5px;
        }

        .search-area {
            width: 100%;
            text-align: end;
            margin-bottom: 20px;
        }

        .input-search {
            width: 25%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .operation {
            text-align: center;

        }

        td .btn-edit {
            background-color: #1b529e;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        td .btn-edit:hover {
            background-color: #0e2d5e;
        }

        td .btn-delete {
            background-color: #7a1f1f;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        td .btn-delete:hover {
            background-color: #4a0f0f;
        }

        .delete-more-product {
            display: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 20%;
        }

        .btn-delete {
            background-color: #7a1f1f;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }

        .paginationWrap {
            text-align: center;
            margin-top: 20px;
        }

        .paginationWrap ul li {
            display: inline-block;
            margin: 0 5px;
        }

        a {
            text-decoration: none;
        }

        .paginationWrap ul li a {
            padding: 5px 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .paginationWrap ul li.active a {
            background-color: #25458a;
            color: white;
        }

        .paginationWrap ul li a:hover {
            background-color: #3266ab;
            color: white;
        }

        .paginationWrap ul li.disabled a {
            background-color: #ddd;
            color: #636b6f;
        }

        .paginationWrap ul li.disabled a:hover {
            background-color: #ddd;
            color: #636b6f;
        }

        .icon-sort-item {
            width: 20px;
            height: 12px;
        }

        .icon-sort-item:hover {
            cursor: pointer;
        }

        .group-sort-icon {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .sort {
            display: flex;
            flex-direction: row;
            align-items: center;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function searchByNameProduct() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementsByClassName("input-search")[0];
            filter = input.value.toUpperCase();
            table = document.getElementsByTagName("table")[0];
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];

                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter.trim()) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function confirmDeleteProduct(id) {
            var result = confirm("Are you sure you want to delete this product?");
            if (result) {
                $('#form-detele-product' + id.toString()).submit();
            }
        }

        function checkAll(productID_json) {
            var checkAll = document.getElementById('checkAll');
            var select_product = document.getElementById('select_product');
            if (checkAll.checked == true) {
                for (var i = 0; i < productID_json.length; i++) {
                    document.getElementById('select_product' + productID_json[i]).checked = true;
                    document.getElementsByClassName('delete-more-product')[0].style.display = "block";

                }
            } else {
                for (var i = 0; i < productID_json.length; i++) {
                    document.getElementById('select_product' + productID_json[i]).checked = false;
                    document.getElementsByClassName('delete-more-product')[0].style.display = "none";

                }
            }
        }

        function checkOne(productID_json) {
            var checkAll = document.getElementById('checkAll');
            var count = 0;
            for (var i = 0; i < productID_json.length; i++) {
                if (document.getElementById('select_product' + productID_json[i]).checked == true) {
                    count++;
                }
            }
            if (count == productID_json.length) {
                checkAll.checked = true;
            } else {
                checkAll.checked = false;
            }

            if (count > 0) {
                document.getElementsByClassName('delete-more-product')[0].style.display = "block";
            } else {
                document.getElementsByClassName('delete-more-product')[0].style.display = "none";
            }
        }

        function confirmDeleteMoreProduct(listID) {
            for (var i = 0; i < listID.length; i++) {
                if (!document.getElementById('select_product' + listID[i]).checked) {
                    document.getElementById('selectedManyProductToDel' + listID[i].toString()).removeAttribute("name");
                }
            }
            if (confirm("Are you sure you want to delete this product?")) {
                document.querySelector('#form-delete-more-product').submit();
            }
        }

        function sortFunc(num, oldNum) {
            console.log(oldNum);
            $('#sort').val(num);

            if (num == oldNum) {
                $('#sort').val(num + 1);
                console.log(document.getElementById('sort').value);
                return;
            }

            $('#form-sort').submit();

        }
    </script>
@endsection
