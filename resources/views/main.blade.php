<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ElderWisdom</title>
<style>
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .btn {
        background-color: transparent;
        color: black;
        padding: 8px 16px;
        font-size: 16px;
        border: 1px solid black;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        position: relative; /* เพื่อการแอนิเมชันแบบอิสระ */
        overflow: hidden; /* ป้องกันข้อความออกนอกขอบเขต */
    }

    .btn:hover {
        background-color: black;
        color: white;
    }

    .btn:focus {
        outline: none;
    }

    .btn:active {
        transform: scale(0.98);
    }

    .btn span {
        display: inline-block;
        transition: transform 0.3s; /* เพิ่ม transition เพื่อการเคลื่อนไหวที่นุ่มนวล */
    }

    .btn:hover span {
        animation: bounce 0.5s; /* เรียกใช้ keyframes ที่ชื่อว่า bounce */
        animation-fill-mode: forwards; /* ทำให้ข้อความอยู่ในตำแหน่งสุดท้ายของการแอนิเมชัน */
    }
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
</style>
</head>
<body>

<div class="header">
  <div class="logo">Logo</div>
</div>

<div class="main-content"></div>
  <h1>ElderWisdom</h1>
  <div class="btn-parent">
  <button class="btn">
    <span>Let's Go →</span>
</button>
</div>

<div class="footer">
  footer
</div>

</body>
</html>