<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ElderWisdom</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header {
            text-align: left;
            padding: 20px;
        }

        .logo {
            width: 100px;
            height: 100px;
            background-color: grey;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .footer {
            text-align: center;
            padding: 20px;
        }

        .btn {
            background-color: grey;
            color: white;
            border: none;
            padding: 10px 20px;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 20px;
        }

        /* สไตล์สำหรับโมดัล */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="logo">Logo</div>
    </div>

    <div class="main-content">
        <h1>ElderWisdom</h1>
        <button class="btn" onclick="openCreateDialog()">Open Create Dialog</button>
    </div>

    <!-- โมดัล -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <!-- ปุ่มปิดโมดัล -->
            <span class="close" onclick="closeCreateDialog()">&times;</span>

            <!-- เรียกใช้ create.blade.php ที่นี่ -->
            @include('subjects.create')
        </div>
    </div>

    <div class="footer">
        footer
    </div>

    <script>
        // เพิ่ม JavaScript เพื่อเรียกใช้โมดัล
        function openCreateDialog() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'block';
        }

        function closeCreateDialog() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
        }
    </script>
</body>
</html>
