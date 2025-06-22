<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Radial Menu - Demo</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      height: 100vh;
      background: linear-gradient(135deg, #f4f6fa, #dee8f7);
      overflow: hidden;
    }

    .radial-menu {
      position: fixed;
      bottom: 40px;
      right: 40px;
      width: 70px;
      height: 70px;
      z-index: 999;
    }

    .center-btn {
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background-color: #0d6efd;
      color: white;
      border: none;
      cursor: pointer;
      position: relative;
      z-index: 2;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }

    .center-btn img {
      width: 35px;
      height: 35px;
      object-fit: contain;
    }

    .item {
      position: absolute;
      width: 50px;
      height: 50px;
      background: #0d6efd;
      color: white;
      border-radius: 50%;
      top: 10px;
      left: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
      transform: scale(0);
      transition: all 0.4s ease;
      text-decoration: none;
      font-size: 22px;
    }

    .radial-menu.active .item {
      opacity: 1;
      transform: scale(1);
    }

    /* Circular positions */
    .item:nth-child(2) { transform: rotate(0deg) translate(100px) rotate(0deg); }
    .item:nth-child(3) { transform: rotate(72deg) translate(100px) rotate(-72deg); }
    .item:nth-child(4) { transform: rotate(144deg) translate(100px) rotate(-144deg); }
    .item:nth-child(5) { transform: rotate(216deg) translate(100px) rotate(-216deg); }
    .item:nth-child(6) { transform: rotate(288deg) translate(100px) rotate(-288deg); }

    .radial-menu.active .item:nth-child(2) { transform: rotate(0deg) translate(100px) rotate(0deg); }
    .radial-menu.active .item:nth-child(3) { transform: rotate(72deg) translate(100px) rotate(-72deg); }
    .radial-menu.active .item:nth-child(4) { transform: rotate(144deg) translate(100px) rotate(-144deg); }
    .radial-menu.active .item:nth-child(5) { transform: rotate(216deg) translate(100px) rotate(-216deg); }
    .radial-menu.active .item:nth-child(6) { transform: rotate(288deg) translate(100px) rotate(-288deg); }

    .item:hover {
      background: #6610f2;
    }

    /* Tooltip on hover */
    .item::after {
      content: attr(title);
      position: absolute;
      bottom: 60px;
      background: #343a40;
      color: #fff;
      padding: 4px 8px;
      font-size: 12px;
      border-radius: 4px;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.3s;
    }

    .item:hover::after {
      opacity: 1;
    }
  </style>
</head>
<body>

  <!-- RADIAL MENU -->
  <div class="radial-menu">
    <button class="center-btn" id="menuToggle">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6e/BKN_logo.png" alt="BKN" />
    </button>

    <!-- Radial Menu Items -->
    <a href="https://example.com/bpkad" class="item" title="BPKAD"><i class="ri-home-4-line"></i></a>
    <a href="https://example.com/simpeg" class="item" title="SimPeg"><i class="ri-user-line"></i></a>
    <a href="https://example.com/lkpd" class="item" title="LKPD"><i class="ri-folder-3-line"></i></a>
    <a href="https://example.com/aset" class="item" title="Aset TIK"><i class="ri-computer-line"></i></a>
    <a href="https://example.com/other" class="item" title="Lainnya"><i class="ri-more-2-fill"></i></a>
  </div>

  <!-- JavaScript -->
  <script>
    document.getElementById("menuToggle").addEventListener("click", function () {
      document.querySelector(".radial-menu").classList.toggle("active");
    });
  </script>

</body>
</html>
